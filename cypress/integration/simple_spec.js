describe('My First Test', function() {
  it('Visits the Kitchen Sink', function() {
    cy.visit('http://localhost/fixture');
    cy.wait(1000);
    cy.visit('http://localhost');

    cy.get('#ds_busca')
      .type('sistema 1');

    cy.get('#table_lista_sistema')
        .children()
        .children()
        .should('have.length', 2);

    cy.get('.fas').click();
  });
});

