# Model-Project

## Objetivo

Repositorio para desenvolvimento de um aplicativo em PHP para auxilio na analise de sistemas e projetos

## Parte 1

Leituro de arquivos .sql para verificação de estruturas mysql

Urgente
    Nas ligações, criar os ADDs necessários igual ao tabela campo
    Refatorar Index

CRUD tabelas
    incluir - OK
    alterar - OK
    excluir - OK
    Importar SQL - OK
    Permitir excluir os campos - OK
    Comparar na criacao - OK
    Comparar com existente - OK
    Importar banco - TODO
    Paginar resultado - TODO

CRUD campos
    incluir - OK
    alterar - OK
    excluir - OK
    ordenar - OK
    adicionar foreing keys - OK
    Foreing keys - OK
    Unique Keys - OK

    ✔ - Ler Unique keys @done (18-09-21 17:13)

    ☐ - Exibir as UNIQUE KEYS na tela
    ☐ - Corrigir o merge de tabelas para olhar para o sistema

    Mostrar ligacoes ativas - TODO
    Mostrar ligacoes logicas - TODO

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