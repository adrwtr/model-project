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
    Permitir excluir os campos - TODO

    Importar banco - TODO
    Comparar na criacao - TODO
    Comparar com existente - TODO
    Paginar resultado - TODO

CRUD campos
    incluir - OK
    alterar - OK
    excluir - OK
    ordenar - OK
    adicionar foreing keys - OK
    Foreing keys - WIP
    Mostrar ligacoes ativas - TODO
    Mostrar ligacoes logicas - TODO


## comandos
    D:\dev\php\modelpage>php ..\composer.phar serve
    D:\dev\php\modelpage>.\vendor\bin\phpunit

## Doctrine
    > windows:
    vendor\bin\doctrine-module orm:generate-proxies
    vendor\bin\doctrine-module orm:schema-tool:create

    > Unix
    vendor/bin/doctrine-module orm:schema-tool:drop --force
    vendor/bin/doctrine-module orm:schema-tool:create

    php ..\composer.phar require --dev nelmio/alice