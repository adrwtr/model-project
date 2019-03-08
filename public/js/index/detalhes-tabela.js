Vue.component('v-select', VueSelect.VueSelect);

var app_lista_tabela = new Vue({
    el: '#vueApp-lista-tabela',

    data: {
        // form
        ds_tabela : '',
        ds_descricao : '',
        nr_tabela_id : 0,
        ds_sql : '',
        arrCampos : [],
        arrCamposExcluido : [],

        arrTabelaChaves : [],
        arrTabelaChavesExcluido : [],


        // modal
        nr_tipo_de_chave_id : 0,
        nr_campo_origem_id : 0,
        nr_tabela_destino_id : 0,
        nr_campo_destino_id : 0,
        ds_descricao_fk : '',


        arrTipoDeChaveOptions : [],
        arrTodasAsTabelas : [],
        arrCamposFromTabelaFk : [],
    },

    directives: {
        init: {
            bind: function(el, binding, vnode) {
                vnode.context[binding.arg] = binding.value;
            }
        }
    },

    created: function() {
    },

    methods: {

        getRegistroEditar: function(nr_tabela_id) {
            fetch('/tabela/get/' + nr_tabela_id)
                .then(objResponse => objResponse.json())
                .then(
                    arrJson => {
                        var arrTabela = arrJson.arrTabela[0];
                        var arrCampos = arrJson.arrCampos;
                        var arrTabelaChaves = arrJson.arrTabelaChaves;
                        var arrTipoDeChave = arrJson.arrTipoDeChave;
                        var arrTodasAsTabelas = arrJson.arrTodasAsTabelas;

                        this.nr_tabela_id = arrTabela.id;
                        this.ds_tabela = arrTabela.ds_nome;
                        this.ds_descricao = arrTabela.ds_descricao;
                        this.arrCampos = arrCampos;
                        this.arrTabelaChaves = arrTabelaChaves;
                        this.arrTipoDeChaveOptions =  arrTipoDeChave;
                        this.arrTodasAsTabelas = arrTodasAsTabelas;

                    }
                );
        },

        addCampo: function() {
            this.arrCampos.push(
                {
                    ds_nome: 'nome do campo',
                    ds_prop: 'varchar(255)',
                }
            );
        },

        excluirCampo: function(nr_index) {
            this.arrCamposExcluido.push(this.arrCampos[nr_index]);

            this.arrCampos
                .splice(nr_index, 1);

            this.sn_desfazer_campo_excluido = true;
        },

        salvar: function() {
            var _this = this;
            this.setBtnCarregando();


            var arrPost = {
                nr_tabela_id : this.nr_tabela_id,
                ds_tabela : this.ds_tabela,
                ds_descricao: this.ds_descricao,
                arrCampos : this.arrCampos,
                arrCamposExcluido : this.arrCamposExcluido,
                arrTabelaChaves : this.arrTabelaChaves,
                arrTabelaChavesExcluido : this.arrTabelaChavesExcluido
            };

            console.log(arrPost);

            axios.post(
                '/tabela/update',
                arrPost
            )
            .then(
                function (objResponse) {
                    $('#div_msg_salvado').show();
                    _this.unsetBtnCarregando();
                }
            )
            .catch(
                function (error) {
                    console.log(error);
                    _this.unsetBtnCarregando();
                }
            );
        },


        addTabelaChave : function() {
            var arrNovo = {
                ds_nome_chave : 'teste'
            };
        },

        voltar: function() {
            document.location = '/tabela';
        },

        addCampoFk: function() {
            var arrNovaChave = {
                id : null,
                tabela_origem_id : this.nr_tabela_id,
                ds_nome_tabela_referencia : this.ds_tabela,
                ds_nome_chave : this.nr_tipo_de_chave_id.ds_nome,

                tabela_destino_id : this.nr_tabela_destino_id.id,
                ds_nome_tabela_destino : this.nr_tabela_destino_id.ds_nome,
                ds_nome_tabela_referencia : this.nr_tabela_destino_id.ds_nome,


                campo_origem_id : this.nr_campo_origem_id.id,
                ds_nome_campo_origem : this.nr_campo_origem_id.ds_nome,
                ds_nome_campo : this.nr_campo_origem_id.ds_nome,

                campo_destino_id : this.nr_campo_destino_id.id,
                ds_nome_campo_destino : this.nr_campo_destino_id.ds_nome,
                ds_nome_campo_referencia : this.nr_campo_destino_id.ds_nome
             };

            console.log(arrNovaChave);

            this.arrTabelaChaves.push(arrNovaChave);
        },

        excluirFk: function(nr_index) {
            this.arrTabelaChavesExcluido.push(this.arrTabelaChaves[nr_index]);

            this.arrTabelaChaves
                .splice(nr_index, 1);

            this.sn_desfazer_campo_excluido = true;
        },

        setBtnCarregando: function() {
            $('#btn_salvar').html('');
            $('#btn_salvar').html('<i class="fa fa-spinner fa-refresh fa-spin" aria-hidden="true"></i> - Aguarde');
            $('#btn_salvar').attr('disabled', true);
        },


        unsetBtnCarregando: function() {
            $('#btn_salvar').html('Salvar');
            $('#btn_salvar').attr('disabled', false);
        },
    },

    watch: {
        /**
         * Responsavel por buscar os campos da tabela selecionada
         */
        nr_tabela_destino_id: function() {
            this.nr_campo_destino_id = null;

            if (this.nr_tabela_destino_id != null) {
                var nr_tabela_id = this.nr_tabela_destino_id.id;

                fetch('/tabela/campos/get/' + nr_tabela_id)
                    .then(objResponse => objResponse.json())
                    .then(
                        arrJson => {
                            var arrCampos = arrJson.arrCampos;
                            this.arrCamposFromTabelaFk = arrCampos;
                        }
                    );
            }
        },

        nr_tabela_id: function () {
            this.getRegistroEditar(this.nr_tabela_id);
        },

        nr_tipo_de_chave_id: function () {
            if (this.nr_tipo_de_chave_id.ds_chave == 'UNIQUE_KEY') {
                // esconde outros campos
                $('#div_campo_tabela_destino_campo').hide();
                $('#div_campo_tabela_destino').hide();
                this.nr_tabela_destino_id = null;
                this.nr_campo_destino_id = null;
            } else {
                // mostra outros campos
                $('#div_campo_tabela_destino_campo').show();
                $('#div_campo_tabela_destino').show();
            }
        }

    }
});

