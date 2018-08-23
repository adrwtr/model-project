describe('Teste de Sistema', function() {
    it('Tela de Sistema', function() {
        // executa a fixture no database
        cy.visit('http://localhost/fixture');
        cy.wait(1000);

        // inicio do teste
        cy.visit('http://localhost');

        cy.get('#ds_busca')
            .type('sistema 1');

        // deve ter duas linhas na tabela
        cy.get('#table_lista_sistema')
            .children()
            .children()
            .should(
                'have.length',
                2
            );

        cy.get('#ds_busca')
            .type('{del}{selectall}{backspace}')
            .type('sistema');

        cy.get('#table_lista_sistema')
            .children()
            .children()
            .should(
                'have.length',
                3
        );

        cy.get('#ds_busca')
            .type('{del}{selectall}{backspace}')
            .type('sistema 1');

        cy.get('.fas').click();
    });
});