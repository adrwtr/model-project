describe('Tabelas - SQL Administracao', function() {

    Cypress.Cookies.debug(true);

    it('Acesso', function() {
        // executa a fixture no database
        cy.visit('http://localhost/fixture');
        cy.wait(1000);

        // inicio do teste
        cy.visit('http://localhost');

        cy.get('#ds_busca')
            .type('sistema 1');

        cy.get('.fas').click();

        cy.preservarSessao();
    });

    it('Adicionar por sql', function() {
        cy.get('#btn_add_tabela')
            .click();

        cy.get('#tab-sql')
            .click();

        // realiza a leitura do sql
        cy.readFile(
            "cypress/fixtures/mock_create_nu_integracao_externa.sql"
        ).then(
            (ds_sql_arquivo) => {
                ds_sql = ds_sql_arquivo;

                cy.get('#exampleFormControlTextarea1')
                    .type(ds_sql);

                cy.get('#btn_salvar_tabela')
                    .click();

                cy.get('#ds_busca')
                    .type('{del}{selectall}{backspace}')
                    .type('nu_integracao_externa')

                cy.get('#table_lista_tabela')
                    .children()
                    .children()
                    .should(
                        'have.length',
                        2
                    );

                cy.preservarSessao();
            }
        );
    });
});