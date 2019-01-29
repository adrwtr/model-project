var app_lista_tabela = new Vue({
    el: '#vueApp-lista-tabela',

    data: {
        arrTabelas: [],
        arrTabelasOriginal: [],
        sn_carregando : true,
        ds_filtro : '',

        // form
        ds_tabela : '',
        ds_descricao : '',
        nr_tabela_id : 0,
        ds_sql : '',
        arrCampos : [],

        // tabs
        ds_tab_ativa : 'nova',

        // comparador
        arrComparacao: [],
        arrCamposIguais: [],
        arrSemIgualdadeA: [],
        arrSemIgualdadeB: [],

        // ultimo campo excluido
        arrCampoExcluido : [],
        sn_desfazer_campo_excluido : false,

        // merge
        sn_todos_lado_1 : false,
        sn_todos_lado_2 : false
    },

    created: function() {
        this.getListRegistros();
        this.getTemTabelaRepetida();
    },

    watch: {
        ds_filtro: function ()
        {
            var ds_filtrar = this.ds_filtro;
            this.arrTabelas = this.arrTabelasOriginal;

            if (_.isEmpty(ds_filtrar)) {
                return;
            }

            this.arrTabelas = _.filter(
                this.arrTabelasOriginal,
                function (arrValor) {
                    return arrValor.ds_nome
                        .toLowerCase()
                        .indexOf(ds_filtrar.toLowerCase()) >= 0;
                }
            );

        }
    },

    methods: {
        getListRegistros: function() {
            fetch(
                '/tabela/lista-tabelas',
                {
                    credentials: 'include'
                }
            )
            .then(objResponse => objResponse.json())
            .then(
                arrJson => {
                    this.arrTabelas = arrJson;
                    this.arrTabelasOriginal = arrJson;
                    this.sn_carregando = false;
                }
            );
        },

        getRegistroEditar: function(nr_tabela_id) {

            fetch(
                '/tabela/get/' + nr_tabela_id,
                {
                    credentials: 'include'
                }
            )
            .then(objResponse => objResponse.json())
            .then(
                arrJson => {
                    console.log(arrJson);
                    var arrTabela = arrJson.arrTabela[0];
                    var arrCampos = arrJson.arrCampos;

                    this.nr_tabela_id = arrTabela.id;
                    this.ds_tabela = arrTabela.ds_nome;
                    console.log(arrTabela.ds_nome);
                    this.ds_descricao = arrTabela.ds_descricao;
                    this.arrCampos = arrCampos;
                }
            );
        },

        modalIncluir: function () {
            this.limparCampos();
        },

        modalEditar: function (nr_tabela_id) {
            this.nr_tabela_id = nr_tabela_id;
            this.getRegistroEditar(nr_tabela_id);
        },

        modalExcluir: function(nr_tabela_id) {
            this.nr_tabela_id = nr_tabela_id;
        },

        submitModalIncluir: function() {
            if (this.ds_tab_ativa == 'nova') {
                this.ds_sql = '';
            }

            if (this.ds_tab_ativa == 'sql') {
                this.ds_tabela = '';
            }

            var arrPost = {
                nr_tabela_id : this.nr_tabela_id,
                ds_tabela : this.ds_tabela,
                ds_descricao: this.ds_descricao,
                ds_sql : this.ds_sql
            };

            axios.post(
                '/tabela/update',
                arrPost,
                {
                    credentials: 'include',
                    withCredentials: true
                }
            )
            .then(
                function (objResponse) {
                    if (objResponse.data.sn_sucesso == true) {
                        app_lista_tabela.getListRegistros();
                        app_lista_tabela.getTemTabelaRepetida();
                        app_lista_tabela.limparCampos();

                        // processar temporarios?
                        var sn_temporario = objResponse.data.sn_tem_temporario;

                        if (sn_temporario == true) {
                            app_lista_tabela.iniciarCorrecaoTemporarios();
                        }
                        return;
                    }
                }
            )
            .catch(
                function (error) {
                    console.log(error);
                }
            );
        },

        doDelete: function() {
            fetch(
                '/tabela/delete/' + this.nr_tabela_id,
                {
                    credentials: 'include'
                }
            )
            .then(objResponse => objResponse.json())
            .then(
                arrJson => {
                    this.getListRegistros();
                    this.getTemTabelaRepetida();
                    return;
                }
            );
        },

        tabAtiva: function(ds_tab) {
            this.ds_tab_ativa = ds_tab;
        },

        // busca registros temporarios para serem corrigidos
        iniciarCorrecaoTemporarios: function() {
            fetch(
                '/tabela/lista-tabelas-temporarias',
                {
                    credentials: 'include'
                }
            )
            .then(objResponse => objResponse.json())
            .then(
                arrJson => {
                    this.arrComparacao = arrJson.arrComparacao;
                    this.arrCamposIguais = arrJson.arrCamposIguais;
                    this.arrSemIgualdadeA = arrJson.arrSemIgualdadeA;
                    this.arrSemIgualdadeB = arrJson.arrSemIgualdadeB;

                    // abrir modal de comparacao
                    $("#modalTemporario").modal();
                }
            );
        },

        limparCampos: function() {
            this.nr_tabela_id = 0;
            this.ds_tabela = '';
            this.ds_descricao = '';
            this.ds_sql = '';
            this.arrCampos = [];
        },

        verDetalhes: function(tabela_id) {
            document.location = '/tabela/detalhes/' + tabela_id;
        },


        doMergeTabela: function() {
            var arrPost = {
                arrComparacao : this.arrComparacao,
                arrCamposIguais : this.arrCamposIguais,
                arrSemIgualdadeA : this.arrSemIgualdadeA,
                arrSemIgualdadeB: this.arrSemIgualdadeB
            };

            axios.post(
                '/tabela/merge',
                arrPost,
                {
                    credentials: 'include'
                }
            )
            .then(
                function (objResponse) {
                    if (objResponse.data.sn_sucesso == true) {
                        app_lista_tabela.getListRegistros();
                        app_lista_tabela.getTemTabelaRepetida();
                        app_lista_tabela.limparCampos();

                        /*// processar temporarios?
                        var sn_temporario = objResponse.data.sn_tem_temporario;

                        if (sn_temporario == true) {
                            app_lista_tabela.iniciarCorrecaoTemporarios();
                        }*/
                        return;
                    }
                }
            )
            .catch(
                function (error) {
                    console.log(error);
                }
            );
        },

        selecionarTodosLado1: function() {
            this.arrCamposIguais.forEach(
                function (arrCampos) {
                    arrCampos.arrCampo1.sn_selecionado = app_lista_tabela.sn_todos_lado_1;
                }
            );

            this.arrSemIgualdadeA.forEach(
                function (arrCampos) {
                    arrCampos.sn_selecionado = app_lista_tabela.sn_todos_lado_1;
                }
            );
        },

        selecionarTodosLado2: function() {
            this.arrCamposIguais.forEach(
                function (arrCampos) {
                    arrCampos.arrCampo2.sn_selecionado = app_lista_tabela.sn_todos_lado_2;
                }
            );

            this.arrSemIgualdadeB.forEach(
                function (arrCampos) {
                    arrCampos.sn_selecionado = app_lista_tabela.sn_todos_lado_2;
                }
            );
        },

        getTemTabelaRepetida: function() {
            fetch(
                '/tabela/repetida/get',
                {
                    credentials: 'include'
                }
            )
            .then(objResponse => objResponse.json())
            .then(
                arrJson => {
                    if (arrJson.sn_tem_repetido != undefined) {
                        if (arrJson.sn_tem_repetido == true) {
                            app_lista_tabela.iniciarCorrecaoTemporarios();
                        }
                    }
                }
            );
        }
    }
});