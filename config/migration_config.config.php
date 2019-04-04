<?php
return array(
    'name' => 'Doctrine Migrations',
    'migrations_namespace' => 'Migrations',
    'table_name' => 'doctrine_migrations',
    'migrations_directory' => realpath(__DIR__ . '/../migrate'),
    'migrations' => array()
);