// global var
var ds_texto_selecionado = '';

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

        processNomesTabela: function()
        {
            var arrTabelas = Array();

            for(var i=0; i<this.arrCampos.length; i++) {
                arrTabelas[this.arrCampos[i].ds_nome_tabela] = 1;
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
                                    meta: "static"
                                };
                            }
                        )
                    );

                }
            }

            // langTools.setCompleters([staticWordCompleter])
            // or
            editor.completers = [staticWordCompleter];
        }
    }
});