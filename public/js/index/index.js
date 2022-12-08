var app_lista_tabela = new Vue({
    el: '#vueApp-lista-tabela',

    data: {
        arrSistemas: [],
        arrSistemasOriginal : [],
        sn_carregando : true,
        ds_filtro : '',
    },

    created: function() {
        this.getListRegistros();
    },

    watch: {
        ds_filtro: function ()
        {
            var ds_filtrar = this.ds_filtro;

            this.arrSistemas = this.arrSistemasOriginal;

            if (_.isEmpty(ds_filtrar)) {
                return;
            }

            this.arrSistemas = _.filter(
                this.arrSistemasOriginal,
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
                'sistema/lista-sistemas',
                {
                    credentials: 'include'
                }
            )
            .then(objResponse => objResponse.json())
            .then(
                arrJson => {
                    this.arrSistemas = arrJson;
                    this.arrSistemasOriginal = arrJson;
                    this.sn_carregando = false;
                }
            );
        },

        goToEditar: function(nr_id) {
            document.location = '/sistema/administrar/' + nr_id;
        },

        goToRelatorio: function(nr_id) {
            document.location = '/sistema/relatorio/' + nr_id;
        },

        goToSql: function() {
            document.location = '/sql';
        }
    }
});