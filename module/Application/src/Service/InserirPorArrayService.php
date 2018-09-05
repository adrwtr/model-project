<?php
namespace Application\Service;


class InserirPorArrayService {

    private $objSM;

    public function __construct($objSM) {
        $this->objSM = $objSM;
    }

    public function getObjSm() {
        return $this->objSM;
    }

    public function getEntityManager() {
        return $this->getObjSm()
            ->get('doctrine.entitymanager.orm_default');
    }


    /**
     * Insere uma ou mais tabelas no banco de dados
     */
    public function inserirTabelas(
        $objSistema,
        $arrTabelas
    ) {
        foreach ($arrTabelas as $arrTabela) {
            $ds_nome = $arrTabela['ds_nome'];
            $arrCampos = $arrTabela['arrCampos'];
            $arrForeingkeys = $arrTabela['arrForeingkey'];

            // inclui a tabela
            $objTabela = $this->getObjSm()
                ->get(
                    \Application\Service\Repository\TabelaService::class
                )->persistir(
                    $objSistema,
                    $ds_nome
                );

            // inclui campos
            if (count($arrCampos) > 0) {
                $this->processCampos(
                    $objTabela,
                    $arrCampos
                );
            }

            // inclui foreingkeys
            if (is_array($arrForeingkeys) && count($arrForeingkeys) > 0) {
                $this->processForeingKeys(
                    $objSistema,
                    $objTabela,
                    $arrForeingkeys
                );
            }

        }

        return $objTabela;
    }

    private function processCampos(
        $objTabela,
        $arrCampos
    ) {
        $arrCampoObj = [];

        foreach ($arrCampos as $arrCampo) {
            $ds_nome_campo = $arrCampo['ds_nome'];
            $ds_prop = $arrCampo['ds_prop'];
            $sn_pk = $arrCampo['sn_pk'];

            $objCampo = new \stdClass();
            $objCampo->id = null;
            $objCampo->ds_nome = $ds_nome_campo;
            $objCampo->ds_prop = $ds_prop;
            $objCampo->sn_pk = $sn_pk;

            $arrCampoObj[] = $objCampo;
        }

        $this->updateCampos($objTabela, $arrCampoObj);
    }

    /**
     * Organiza o array de foreingkeys para chamar a função
     * de inclusao no banco de daods
     */
    private function processForeingKeys(
        $objSistema,
        $objTabela,
        $arrCampos
    ) {
        $arrForeingkeyObj = [];

        foreach ($arrCampos as $arrForeingkey) {
            $ds_nome_campo = $arrForeingkey['ds_nome_campo'] ?? '';
            $ds_nome_tabela_referencia = $arrForeingkey['ds_nome_tabela_referencia'] ?? '';
            $ds_nome_campo_referencia = $arrForeingkey['ds_nome_campo_referencia'] ?? '';

            $objForeingkey = new \stdClass();
            $objForeingkey->id = null;
            $objForeingkey->ds_nome_campo = $ds_nome_campo;
            $objForeingkey->ds_nome_tabela_referencia = $ds_nome_tabela_referencia;
            $objForeingkey->ds_nome_campo_referencia = $ds_nome_campo_referencia;

            $arrForeingkeyObj[] = $objForeingkey;
        }

        $this->updateForeingkeys(
            $objSistema,
            $objTabela,
            $arrForeingkeyObj
        );
    }

    public function updateCampos(
        $objTabela,
        $arrCampos
    ) {
        if (is_array($arrCampos)) {
            foreach ($arrCampos as $nr_id => $arrCampo) {
                $nr_campo_id = $arrCampo->id ?? 0;
                $ds_nome = $arrCampo->ds_nome ?? '';
                $ds_prop = $arrCampo->ds_prop ?? '';
                $sn_pk = (($arrCampo->sn_pk ?? false) == '1' ? true : false);
                $ds_descricao = $arrCampo->ds_descricao ?? '';
                $nr_ordem = $nr_id;

                $objCampo = $this->getObjSm()
                    ->get(
                        \Application\Service\Repository\CampoService::class
                    )->persistir(
                        $objTabela,
                        $ds_nome,
                        $ds_prop,
                        $ds_descricao,
                        $sn_pk,
                        $nr_ordem,
                        $nr_campo_id
                    );

                $objTabela->addCampo($objCampo);
            }

            $this->getEntityManager()
                ->persist($objTabela);

            $this->getEntityManager()
                ->flush();
        }
    }

    public function updateForeingkeys(
        $objSistema,
        $objTabela,
        $arrForeingkeys
    ) {
        $arrCamposTabela = $objTabela->getArrCampos();

        foreach ($arrForeingkeys as $nr_id => $objForeingkey) {
            $nr_campo_id = $objForeingkey->id ?? 0;
            $ds_nome_campo = $objForeingkey->ds_nome_campo ?? '';
            $ds_nome_tabela_referencia = $objForeingkey->ds_nome_tabela_referencia ?? '';
            $ds_nome_campo_referencia = $objForeingkey->ds_nome_campo_referencia ?? '';

            if ($ds_nome_campo != '' && $ds_nome_campo_referencia != '') {
                if (count($arrCamposTabela) > 0) {
                    $this->processForeingKeyAtual(
                        $objSistema,
                        $objTabela,
                        $ds_nome_campo,
                        $ds_nome_tabela_referencia,
                        $ds_nome_campo_referencia,
                        $arrCamposTabela
                    );
                }
            }
        }

    }


    public function processForeingKeyAtual(
        $objSistema,
        $objTabelaOrigem,
        $ds_nome_campo,
        $ds_nome_tabela_referencia,
        $ds_nome_campo_referencia,
        $arrCamposTabela
    ) {
        $nr_key_campo_atual = 0;
        $nr_key_campo_referencia = 0;
        $objCampoDestino = null;

        // campo atual
        foreach ($arrCamposTabela as $nr_key => $objCampo) {
            if ($objCampo->getDsNome() == $ds_nome_campo) {
                $nr_key_campo_atual = $nr_key;
            }
        }

        // aqui esta o problema
        // a string nao é tratada para tirar o `

        // tabela de referencia
        $objTabelaReferencia = $this->getEntityManager()
            ->getRepository(\Application\Entity\Tabela::class)
            ->findOneBy([
                'ds_nome' => $ds_nome_tabela_referencia,
                'objSistema' => $objSistema
            ]);


        // a tabela nao existe, vamos criar ela
        if ($objTabelaReferencia == null) {
            $objTabelaReferencia = $this->getObjSm()
                ->get(
                    \Application\Service\Repository\TabelaService::class
                )->persistir(
                    $objSistema,
                    $ds_nome_tabela_referencia
                );
        }

        $arrCamposTabelaReferencia = $objTabelaReferencia->getArrCampos();

        // campo referencia
        if (count($arrCamposTabelaReferencia) > 0) {
            foreach ($arrCamposTabelaReferencia as $nr_key => $objCampo) {
                if ($objCampo->getDsNome() == $ds_nome_campo_referencia) {
                    $nr_key_campo_referencia = $nr_key;
                    $objCampoDestino = $objCampo;
                }
            }
        }

        // buscando a chave
        $objTipoDeChave = $this->getObjSm()
            ->get(\Application\Service\Repository\TipoDeChaveService::class)
            ->getTipoDeChaveForingKey();

        // inclui a chave
        $objTabelaChave = $this->getObjSm()
            ->get(\Application\Service\Repository\TabelaChaveService::class)
            ->persistir(
                $objTabelaOrigem,
                $objTabelaReferencia,
                $objTipoDeChave,
                $arrCamposTabela[$nr_key_campo_atual],
                $objCampoDestino,
                0,
                null
            );

        return $objTabelaChave;
    }

    /**
     * Exclui uma serie de campos informados no array
     * o array deve conter uma lista de objetos std->id
     *
     * @param $arrCamposExcluir
     * @return $this
     */
    public function excluirCampos(
        $arrCamposExcluir
    ) {
        if (is_array($arrCamposExcluir)) {
            foreach ($arrCamposExcluir as $nr_id => $arrCampo) {
                $nr_campo_id = $arrCampo->id ?? 0;

                $objCampo = $this->getEntityManager()
                    ->getRepository(
                        \Application\Entity\Campo::class
                    )->findOneBy([
                        'id' => $nr_campo_id
                    ]);

                $this->getEntityManager()
                    ->remove($objCampo);
            }

            $this->getEntityManager()
                ->flush();
        }

        return $this;
    }


    /**
     * Exclui uma serie de chaves de tabela informados no array
     * o array deve conter uma lista de objetos std->id
     *
     * @param $arrTabelaChaveExcluir
     * @return $this
     */
    public function excluirTabelaChave(
        $arrTabelaChaveExcluir
    ) {
        if (is_array($arrTabelaChaveExcluir)) {
            foreach ($arrTabelaChaveExcluir as $nr_id => $arrCampo) {
                $nr_campo_id = $arrCampo->id ?? 0;

                $objTabelaChave = $this->getEntityManager()
                    ->getRepository(
                        \Application\Entity\TabelaChave::class
                    )->findOneBy([
                        'id' => $nr_campo_id
                    ]);

                $this->getEntityManager()
                    ->remove($objTabelaChave);
            }

            $this->getEntityManager()
                ->flush();
        }

        return $this;
    }
}