<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * arquivo de exemplo.. nao esta sendo usado
 */
final class Version20181128185837 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
         /*$sql = "
            delete from saas_fatura_situacao;
            delete from saas_parametro;
            delete from admin_usuario_saas_cliente;
            delete from saas_cliente_webhook;
            delete from saas_cliente_gateway;
            delete from saas_gateway;
            delete from saas_cliente;
            delete from admin_grupo_sistema_acao;
            delete from admin_sistema_acao;
            delete from admin_usuario_grupo;
            delete from admin_grupo;
            delete from admin_usuario;
        ";
        $this->addSql($sql);*/

        // usuario admin
        $sql = "
        INSERT INTO admin_usuario
            (id, `ds_nome`, `ds_email`, `ds_login`, `ds_senha`)
        VALUES
            (1, 'Administrador', 'adriano@unimestre.com', 'admin', '35195cf0d80de6eafae06509a38202b6');
        ";
        $this->addSql($sql);

        // Grupo admin
        // Grupo cliente
        $sql = "
        INSERT INTO admin_grupo
            (id, `ds_nome`, `ds_chave`)
        VALUES
            (1, 'Administrador', 'administrador');

        INSERT INTO admin_grupo
            (id, `ds_nome`, `ds_chave`)
        VALUES
            (2, 'Cliente', 'cliente');
        ";
        $this->addSql($sql);


        // Adiciona o admin no grupo de admin
        $sql = "
        INSERT INTO admin_usuario_grupo
            (admin_usuario_id, admin_grupo_id)
        VALUES (1, 1);
        ";
        $this->addSql($sql);

        // acoes do sistema
        $sql = "
        INSERT INTO admin_sistema_acao
            (id, ds_nome, ds_chave) VALUES
            (1, 'Administração de Cliente - Listar', 'saas-cliente-lista'),
            (2, 'Administração de Gateway do Cliente - Listar', 'saas-cliente-gateway-lista'),
            (3, 'Administração de Faturas - Listar', 'saas-fatura-lista');
        ";
        $this->addSql($sql);

        // permissoes do grupo ADMIN
        $sql = "
        INSERT INTO admin_grupo_sistema_acao
            (admin_grupo_id, admin_sistema_acao_id) VALUES
            (1, 1),
            (1, 2),
            (1, 3);
        ";
        $this->addSql($sql);


        // Cliente para testes - VINDI
        $sql = "
        INSERT INTO saas_cliente
            (id, ds_nome, ds_chave, ds_api_auth) VALUES
            (1, 'Unimestre - teste na VINDI', 'unimestre-testes', 'unimestre-testes-auth');
        ";
        $this->addSql($sql);


        // GATEWAY - VINDI
        $sql = "
        INSERT INTO saas_gateway
            (id, ds_nome, ds_chave, ds_url_formulario) VALUES
            (1, 'VINDI', 'VINDI', '/formulario/vindi');
        ";
        $this->addSql($sql);


        // CLIENTE Unimestre x GATEWAY - VINDI
        $sql = "
        INSERT INTO saas_cliente_gateway
            (id, saas_cliente_id, saas_gateway_id) VALUES
            (1, 1, 1);
        ";
        $this->addSql($sql);


        // CLIENTE webhook
        // http://webhookinbox.com/view/pFAS7H58/
        $sql = "
        INSERT INTO saas_cliente_webhook
            (id, saas_cliente_id, ds_url, ds_auth) VALUES
            (1, 1, 'http://api.webhookinbox.com/i/g4tlEAOG/in/', '');
        ";
        $this->addSql($sql);


        // Parametro de instalação para a VINDI - testes UNIMESTRE
        // http://webhookinbox.com/view/pFAS7H58/
        $sql = "
        INSERT INTO saas_parametro
            (id, saas_cliente_id, ds_nome, ds_valor) VALUES
            (1, 1, 'VINDI_API_URI', 'https://app.vindi.com.br/api/v1/'),
            (2, 1, 'VINDI_API_KEY', '');
        ";
        $this->addSql($sql);


        // Situações iniciais das faturas
        $sql = "
        INSERT INTO saas_fatura_situacao
            (id, ds_nome, ds_chave) VALUES
            (1, 'Aguardando Pagamento', 'ABERTA'),
            (2, 'Pagamento agendado', 'AGENDADA'),
            (3, 'Pagamento realizado', 'PAGA');
        ";
        $this->addSql($sql);

        // texto padrao - texto-recorrencia
        $sql = "
        INSERT INTO saas_texto
            (id, saas_cliente_id, ds_chave, me_texto, ds_chave_unimestre)
            VALUES
            (1, null, 'texto-recorrencia', 'Todas as parcelas que estão vencidas serão efetivadas e pagas no ato da aprovação da recorrência. As demais parcelas serão agendadas conforme o resumo da operação.', '')
        ";
        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
