# Model-Project

## Objetivo

Repositorio para desenvolvimento de um aplicativo em PHP para auxilio na analise de sistemas e projetos

## Parte 1

Leituro de arquivos .sql para verificação de estruturas mysql
CRUD tabelas
    incluir - OK
    alterar - OK
    excluir - OK
    Importar SQL - OK
    Importar banco - TODO
    Comparar na criacao - TODO
    Comparar com existente - TODO
    Paginar resultado - TODO

CRUD campos
    incluir - OK
    alterar - Falta edição da descricao
    excluir - OK
    ordenar - OK
    Foreing keys - TODO
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