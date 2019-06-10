// global var

// texto que foi selecionado
var ds_texto_selecionado = '';

// popup de resultado
var popup_resultado = null;

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
            // app_sql.helperGetDadosTabela(ds_token_temp);
            app_sql.getInfoFromTabela(ds_token_temp);
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


// add command to lazy-load keybinding_menu extension
editor.commands.addCommand({
    name: "executeSql",
    bindKey: {win: "F9", mac: "F9"},
    exec: function(editor) {
        var ds_sql = (editor.getCopyText() != null && editor.getCopyText() != '')
            ? editor.getCopyText()
            : editor.getValue();

        app_conexao.executeSql(ds_sql);
    }
});


// functional program - globals fn

// retorna o objeto json
var getJsonFromAjax = objResponse => objResponse.json();

// executa a api da url para get de um json
// ao resolver, retorna o json
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

// essa funcao retorna o mapeamento para o autocomplete
var fnMapeamentoAutocomplete = ds_metadata => {
    return (ds_palavra) => {
        return {
            caption: ds_palavra,
            value: ds_palavra,
            meta: ds_metadata
        };
    };
};

// seta o autocomplete do campo
var fnCallbackWordCompleter = (arrNomes, ds_metadata) => {
    return {
        getCompletions : function (editor, session, pos, prefix, callback) {
            callback(
                null,
                arrNomes.map(
                    fnMapeamentoAutocomplete(ds_metadata)
                )
            );
        }
    };
};



// inicialização do vue
var app_sql = new Vue({
    el: '#vueApp-sql',

    data: {

        // array com todas as tabelas - campos - ligações
        arrTabelas : [],

        // informacoes sobre uma tabela
        arrTabelaInfo : [
            {
                'ds_nome' : '',
                'ds_descricao' : '',
                'arrCampos' : []
            }
        ],

        // verificar
        arrCamposEncontrados : []

        /*
        tabela_encontrada : '',
        arrCampos : [],
        arrTabelas : [],
        arrCamposEncontrados : []
        */
    },

    created: function() {
        // recupera informacoes tabelas
        this.getAllInfoFromTabelas();

        // nao mostra mais o menu
        $('#div_menu').hide();
    },

    watch: {
    },

    methods: {
        getArrTabelas: function() {
            return this.arrTabelas;
        },

        // recupera informacoes tabelas
        getAllInfoFromTabelas: function() {
            getFromAPI('/sql/lista-all-campos').then(
                arrJson => {
                    this.arrTabelas = arrJson;
                    this.setTabelasNoAutoComplete(arrJson);
                }
            );
        },

        setTabelasNoAutoComplete: function(arrTabelas) {
            var getNomeTabela = arr => arr.ds_nome

            // cria um array com todos os nomes de tabelas
            var arrNomesDasTabelas = R.map(getNomeTabela, arrTabelas);

            // coloca todos os nomes de tabela no autocomplete do campo
            editor.completers = [fnCallbackWordCompleter(arrNomesDasTabelas, 'tabelas')];
        },

        getInfoFromTabela: function(ds_nome) {
            var fnFiltraTabela = (ds_nome, arrTabela) => {
                // console.log(ds_nome, arrTabela.ds_nome);
                return arrTabela.ds_nome == ds_nome
                    ? arrTabela
                    : null;
            };

            var curryFnFiltraTabela = R.curry(fnFiltraTabela)(ds_nome);

            // retorna a tabela se ela for encontrada no array
            var arrTabela = R.filter(
                curryFnFiltraTabela,
                this.getArrTabelas()
            );

            if (arrTabela[0] != undefined) {
                console.log(arrTabela);
                this.arrTabelaInfo = arrTabela;
            }
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
            // this.arrCamposEncontrados = R.filter(oCampoTemATabela, this.arrCampos);
        }




    }
});





// inicialização do vue
var app_conexao = new Vue({
    el: '#vueApp-conexao',

    data: {
        // lista de conexoes
        arrConexao : [],

        // lista de databases
        arrDatabase : [],

        // contem a conexao atual selecioanda na combo
        conexao_atual : [],

        // contem a database atual selecioanda na combo
        database_atual : []
    },

    created: function() {
        // recupera as conexoes
        this.getConexao();
    },

    methods: {
        // recupera as conexoes
        getConexao: function() {
            getFromAPI('/sql/lista-conexao').then(
                arrJson => {
                    this.conexao_atual = [];
                    this.arrConexao = arrJson;
                }
            );
        },

        // recupera as conexoes
        getConexaoDatabases: function() {
            var arrPost = {
                conexao_atual : this.conexao_atual
            };

            axios.post(
                '/sql/lista-database',
                arrPost
            )
            .then(
                arrJson => {
                    this.arrDatabase = arrJson.data;
                }
            )
            .catch(
                function (error) {
                    console.log(error);
                }
            );
        },

        executeSql: function(ds_sql) {
            var arrPost = {
                conexao_atual : this.conexao_atual,
                database_atual : this.database_atual,
                ds_sql : ds_sql
            };

            axios.post(
                '/sql/executa',
                arrPost
            )
            .then(
                objResponse => {
                    this.setResultadoNewWindow(
                        objResponse.data
                    );
                    console.log(objResponse.data);
                }
            )
            .catch(
                function (error) {
                    console.log(error);
                }
            );
        },

        setResultadoNewWindow: function(arrResultado) {
            if (popup_resultado == null) {
                popup_resultado = window.open(
                    "http://localhost:8000/sql/popup-executado",
                    "teste",
                    "toolbar=yes,scrollbars=yes,resizable=yes,top=10,left=10,fullscreen=yes"
                );

                popup_resultado.focus();

                popup_resultado.addEventListener(
                    'load',
                    teste => {
                        console.log(arrResultado);
                        popup_resultado.setResultado(arrResultado);
                    },
                    true
                );

                return;
            }

            popup_resultado.focus();
            popup_resultado.setResultado(arrResultado);

            return;
        }
    }
});