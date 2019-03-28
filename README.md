# Model-Project

## Objetivo

Repositorio para desenvolvimento de um aplicativo em PHP para auxilio na analise de sistemas e projetos

## Para rodar testes
É necessario manter atualizado o arquivo sql.sqlite e sql_unittest.sqlite
.\vendor\bin\phpunit

## Para rodar E2E tests
node_modules\.bin\cypress open

## Rotas
    http://localhost/
    http://localhost/fixture

## comandos
    D:\dev\php\modelpage>php ..\composer.phar serve
    D:\dev\php\modelpage>.\vendor\bin\phpunit
    D:\dev\php\modelpage>node_modules\.bin\cypress open

## Doctrine
    > windows:
    vendor\bin\doctrine-module orm:generate-proxies
    vendor\bin\doctrine-module orm:schema-tool:create

    > Unix
    vendor/bin/doctrine-module orm:schema-tool:drop --force
    vendor/bin/doctrine-module orm:schema-tool:create

    php ..\composer.phar require --dev nelmio/alice