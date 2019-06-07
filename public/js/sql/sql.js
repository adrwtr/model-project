// global var

// texto que foi selecionado
var ds_texto_selecionado = '';

// tokens do teclado
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


// sempe que houver uma seleção de texto,
// salva na variavel ds_texto_selecionado
editor.session.selection.on(
    'changeSelection',
    function(e) {
        // seta na global
        ds_texto_selecionado = editor.getCopyText();
    }
);


// sempre que houve uma alteracao
editor.on(
    "change",
    function(e) {
        // le o valor digitado
        ds_token = e.lines[0];

        // se a token for um espaço, ou um enter
        if (ds_token == ' ' || ds_token == '') {
            // pega todas as letras digitadas antes de espaco e enter
            ds_token_temp = arrTokenTemp.reduce(
                function(x, y) {
                    return x.concat(y);
                }
            );

            // remove espaco
            ds_token_temp = ds_token_temp.replace(" ", "");

            arrToken.push(ds_token_temp);
            arrTokenTemp = null;
            arrTokenTemp = new Array();
            arrTokenTemp.push(' ');

            // TODO: espaços, tabs e escapes estão estragando
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

// functional program - globals fn
var getJsonFromAjax = objResponse => objResponse.json();

function getFromAPI(ds_url) {
    return new Promise(
        function(resolve, reject) {
            fetch(
                ds_url,
                {
                    credentials: 'include'
                }
            )
            .then(getJsonFromAjax)
            .then(
                arrJson => resolve(arrJson)
            ).catch(
                error => console.log(error)
            );
        }
    );
}



// inicialização do vue
var app_sql = new Vue({
    el: '#vueApp-sql',

    data: {

        // conexoes
        arrConexao : [],


        tabela_encontrada : '',
        arrCampos : [],
        arrTabelas : [],
        arrCamposEncontrados : []
    },

    created: function() {
        // recupera as conexoes
        this.getConexao();

        // recupera informacoes tabelas
        this.getAllInfoFromTabelas();
    },

    watch: {
    },

    methods: {
        // recupera as conexoes
        getConexao: function() {
            getFromAPI('/sql/lista-conexao').then(
                arrJson => {
                    this.arrConexao = arrJson;
                }
            );
        },

        // recupera informacoes tabelas
        getAllInfoFromTabelas: function() {
            getFromAPI('/sql/lista-all-campos').then(
                arrJson => {
                    this.arrConexao = arrJson;
                }
            );
        },







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

            if (sn_encontrado != undefined) {
                this.helperGetCampos(ds_token);
            }
        },

        helperGetCampos: function(ds_tabela) {
            this.tabela_encontrada = ds_tabela;

            var oCampoTemATabela = R.propEq('ds_nome_tabela', ds_tabela);
            this.arrCamposEncontrados = R.filter(oCampoTemATabela, this.arrCampos);
        }




    }
});


