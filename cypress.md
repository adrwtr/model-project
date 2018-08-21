## Comandos

visit - visita uma url
cy.exec() - to run system commands
cy.task() - to run code in Node.js via the pluginsFile
cy.request() - to make HTTP requests


 // seed a post in the DB that we control from our tests
    cy.request('POST', '/test/seed/post', {
      title: 'First Post',
      authorId: 1,
      body: '...'
    })
