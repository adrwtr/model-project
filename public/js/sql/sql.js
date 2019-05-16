// global var
var ds_texto_selecionado = '';
var arrToken = new Array();
var arrTokenTemp = new Array();
arrTokenTemp.push('');
var ds_token = '';
var ds_token_temp = '';

// inicialização do editor
ace.require("ace/ext/language_tools");

var editor = ace.edit("editor");

editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/sql");


editor.setOptions({
    enableBasicAutocompletion: true,
    enableSnippets: true,
    enableLiveAutocompletion: false
});

editor.session.selection.on(
    'changeSelection',
    function(e) {
        // seta na global
        ds_texto_selecionado = editor.getCopyText();
    }
);

editor.on(
    "change",
    function(e) {
        ds_token = e.lines[0];

        if (ds_token == ' ' || ds_token == '') {
            //arrToken.push()
            ds_token_temp = arrTokenTemp.reduce(
                function(x, y) {
                    return x.concat(y);
                }
            );

            ds_token_temp = ds_token_temp.replace(" ", "");

            arrToken.push(ds_token_temp);
            arrTokenTemp = null;
            arrTokenTemp = new Array();
            arrTokenTemp.push(' ');

            app_sql.helperGetDadosTabela(ds_token_temp);
        }


        if (ds_token != ' ' && ds_token != '') {
            arrTokenTemp.push(ds_token);
        }

        if (e.lines[0] == '.') {
            console.log(e);
            console.log('ponto');
        }
    }
);



// inicialização do vue
var app_sql = new Vue({
    el: '#vueApp-sql',

    data: {
        arrCampos : [],
        arrTabelas : []
    },

    created: function() {
        this.getCampos();
    },

    watch: {
    },
    methods: {

        // api
        getCampos: function() {
            fetch(
                '/sql/campos',
                {
                    credentials: 'include'
                }
            )
            .then(objResponse => objResponse.json())
            .then(
                arrJson => {
                    this.arrCampos = arrJson;
                    this.processNomesTabela();
                }
            );
        },

        // processa
        processNomesTabela: function()
        {

            var getDsNomeTabela = R.prop('ds_nome_tabela');

            var arrTabelas = Array();

            for(var i=0; i<this.arrCampos.length; i++) {
                arrTabelas[getDsNomeTabela(this.arrCampos[i])] = 1;
            }

            this.arrTabelas = R.keys(arrTabelas);

            console.log(this.arrTabelas);

            var staticWordCompleter = {
                getCompletions: (editor, session, pos, prefix, callback) => {
                    var wordList = this.arrTabelas;

                    callback(
                        null,
                        wordList.map(
                            function(word) {
                                return {
                                    caption: word,
                                    value: word,
                                    meta: "tabelas"
                                };
                            }
                        )
                    );

                }
            }

            // langTools.setCompleters([staticWordCompleter])
            // or
            editor.completers = [staticWordCompleter];
        },


        helperGetDadosTabela: function(ds_token) {
            // cria a função de teste da token
            var testaToken = (ds_token_test, ds_find) => ds_token_test == ds_find;

            // deixa a função pronta
            var testeAtual = R.curry(testaToken)(ds_token);

            // usa para encontrar no array
            var sn_encontrado = R.find(testeAtual, this.arrTabelas);

            if (sn_encontrado) {
                this.helperGetCampos(ds_token);
            }
        },

        helperGetCampos: function(ds_tabela) {
            console.log(ds_tabela)
        }




    }
});