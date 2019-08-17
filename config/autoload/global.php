<?php

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=biblioteca;host=localhost;',
        'username'       =>'root',
        'password'      =>'',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    
    'navigation' => [
        'default' => [
            [
                'label' => 'Livros',
                'route' => 'livro',
                'pages' => [
                    [
                        'label' => 'Cadastro',
                        'route' => 'livro/add',
                        'action' => 'add',
                    ],
                    [
                        'label' => 'Empréstimo para Cliente',
                        'route' => 'livro/emprestimo',
                        'action' => 'emprestimo',
                    ],
                    [
                        'label' => 'Relatório de Empréstimo',
                        'route' => 'livro/relatorio',
                        'action' => 'relatorio',
                    ],
                ]
            ],
            [
                'label' => 'Clientes',
                'route' => 'cliente',
                'pages' => [
                    [
                        'label' => 'Cadastro',
                        'route' => 'cliente/add',
                        'action' => 'add',
                    ],
                    [
                        'label' => 'Relatorio de Devedores',
                        'route' => 'cliente/relatorio',
                        'action' => 'relatorio',
                    ],
                ]
            ],
            [
                'label' => 'Login',
                'route' => 'login',
                'pages' => [
                    [
                        'label' => 'Fazer Logout',
                        'route' => 'login/sair',
                        'action' => 'sair',
                    ],
                ]
            ],
        ]
    ],
);

