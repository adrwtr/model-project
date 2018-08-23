describe('Teste de Tabelas', function() {
    it('Acesso', function() {
        // executa a fixture no database
        cy.visit('http://localhost/fixture');
        cy.wait(1000);

        // inicio do teste
        cy.visit('http://localhost');

        cy.get('#ds_busca')
            .type('sistema 1');

        cy.get('.fas').click();
    });

    it('Filtros', function() {
        // deve ter duas linhas na tabela
        cy.get('#table_lista_tabela')
            .children()
            .children()
            .should(
                'have.length',
                4
            );

        cy.get('#ds_busca')
            .type('sistema 1');

        cy.get('#table_lista_tabela')
            .children()
            .children()
            .should(
                'have.length',
                1
            );

        cy.get('#ds_busca')
            .type('{del}{selectall}{backspace}')
            .type('tabela 2');

        cy.get('#table_lista_tabela')
            .children()
            .children()
            .should(
                'have.length',
                2
            );
    });

    it('Adicionar', function() {
        cy.get('#btn_add_tabela')
            .click();

        cy.get('#ds_tabela')
            .type('Nome da Tabela');

        cy.get('#ds_descricao')
            .type('Descrição da tabela');

        cy.get('#btn_salvar_tabela')
            .click();

        cy.get('#ds_busca')
            .type('{del}{selectall}{backspace}')

        cy.get('#table_lista_tabela')
            .children()
            .children()
            .should(
                'have.length',
                2
            );
    });
});

