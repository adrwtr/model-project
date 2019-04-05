Vue.component('v-select', VueSelect.VueSelect);

var app_lista_tabela = new Vue({
    el: '#vueApp-lista-tabela',

    data: {
        // form
        ds_tabela : '',
        ds_descricao : '',
        ds_tag : '',
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
                        this.ds_tag = arrTabela.ds_tag;
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
                    ds_nome: 'nome',
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
                ds_tag: this.ds_tag,
                arrCampos : this.arrCampos,
                arrCamposExcluido : this.arrCamposExcluido,
                arrTabelaChaves : this.arrTabelaChaves,
                arrTabelaChavesExcluido : this.arrTabelaChavesExcluido
            };

            console.log('Dados do post:');
            console.log(arrPost);


            axios.post(
                '/tabela/update',
                arrPost
            )
            .then(
                function (objResponse) {
                    $('#div_msg_salvado').show();
                    _this.unsetBtnCarregando();

                    // precisa recarregar para buscar os ids dos campos
                    _this.getRegistroEditar(_this.nr_tabela_id);
                }
            )
            .catch(
                function (error) {
                    _this.unsetBtnCarregando();
                }
            );
        },


        addTabelaChave : function() {
            this.nr_tipo_de_chave_id = null;
            this.nr_campo_origem_id = null;
            this.nr_tabela_destino_id = null;
            this.nr_campo_destino_id = null;
            this.ds_descricao_fk = '';
        },

        voltar: function() {
            document.location = '/tabela';
        },

        addCampoFk: function() {

            var ds_nome_chave_temp = '';
            var nr_tipo_de_chave_id_temp = null;

            var tabela_destino_id_temp = null;
            var ds_nome_tabela_destino_temp = null;
            var ds_nome_tabela_referencia_temp = null;

            var campo_destino_id_temp = null;
            var ds_nome_campo_destino_temp = null;
            var ds_nome_campo_referencia_temp = null;

            if (
                this.nr_tipo_de_chave_id != null
                && this.nr_tipo_de_chave_id != undefined
            ) {
                ds_nome_chave_temp = this.nr_tipo_de_chave_id.ds_nome;
                nr_tipo_de_chave_id_temp = this.nr_tipo_de_chave_id.id;
            }

            if (
                this.nr_tabela_destino_id != null
                && this.nr_tabela_destino_id != undefined
            ) {
                tabela_destino_id_temp = this.nr_tabela_destino_id.id;
                ds_nome_tabela_destino_temp = this.nr_tabela_destino_id.ds_nome;
                ds_nome_tabela_referencia_temp = this.nr_tabela_destino_id.ds_nome;
            }

            if (
                this.nr_campo_destino_id != null
                && this.nr_campo_destino_id != undefined
            ) {
                campo_destino_id_temp = this.nr_campo_destino_id.id,
                ds_nome_campo_destino_temp = this.nr_campo_destino_id.ds_nome,
                ds_nome_campo_referencia_temp = this.nr_campo_destino_id.ds_nome
            }

            var arrNovaChave = {
                id : null,
                tabela_origem_id : this.nr_tabela_id,
                ds_nome_tabela_referencia : this.ds_tabela,
                ds_nome_chave : ds_nome_chave_temp,
                nr_tipo_de_chave_id : nr_tipo_de_chave_id_temp,

                tabela_destino_id : tabela_destino_id_temp,
                ds_nome_tabela_destino : ds_nome_tabela_destino_temp,
                ds_nome_tabela_referencia : ds_nome_tabela_referencia_temp,

                campo_origem_id : this.nr_campo_origem_id.id,
                ds_nome_campo_origem : this.nr_campo_origem_id.ds_nome,
                ds_nome_campo : this.nr_campo_origem_id.ds_nome,

                campo_destino_id : campo_destino_id_temp,
                ds_nome_campo_destino : ds_nome_campo_destino_temp,
                ds_nome_campo_referencia : ds_nome_campo_referencia_temp
             };


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
            if (this.nr_tipo_de_chave_id == null) {
                return;
            }

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

