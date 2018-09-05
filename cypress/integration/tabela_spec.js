describe('Teste de Tabelas', function() {
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

        cy.preservarSessao();
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
                5
            );

        cy.preservarSessao();
    });

    it('Alterar', function() {
        // acessa o primeiro botão de alterar da lista
        cy.get(
            '[data-target="#modalFormulario"] > .fas'
        ).first().click();

        // testa o primeiro registro
        cy.get('#ds_tabela')
            .should('have.value', 'Tabela 1');

        cy.get('#ds_descricao')
            .should('have.value', 'Tabela 1');

        cy.get('#btn_close_form_cadastro')
            .click();

        // ok carregou o registro correto
        cy.get('#ds_busca')
            .type('Nome da Tabela');

        // acessa o primeiro botão de alterar da lista
        cy.get(
            '[data-target="#modalFormulario"] > .fas'
        ).first().click();

        cy.get('#ds_tabela')
            .type('{del}{selectall}{backspace}')
            .type('Nome da Tabela - alteracao');

        cy.get('#ds_descricao')
            .type('{del}{selectall}{backspace}')
            .type('Descrição da tabela - alteracao');

        cy.get('#btn_salvar_tabela')
            .click();

        cy.get('#ds_busca')
            .type('{del}{selectall}{backspace}')

        cy.get('#table_lista_tabela')
            .children()
            .children()
            .should(
                'have.length',
                5
            );

        cy.get('#ds_busca')
            .type('{del}{selectall}{backspace}')
            .type('Nome da Tabela - alteracao');

        cy.get('#table_lista_tabela')
            .children()
            .children()
            .should(
                'have.length',
                2
            );

        cy.preservarSessao();
    });


    it('Excluir', function() {
        // acessa o botão de excluir
        cy.get(
            '[data-target="#modalExcluir"] > .fas'
        ).first()
        .click();

        cy.get(
            '#btn_confirmar_excluir'
        ).click();

        cy.get('#ds_busca')
            .type('{del}{selectall}{backspace}')

        cy.get('#table_lista_tabela')
            .children()
            .children()
            .should(
                'have.length',
                4
            );
    });
});