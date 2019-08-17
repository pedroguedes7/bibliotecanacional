<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Livro\Controller\Livro' => 'Livro\Controller\LivroController',
        ),
    ),

    // A seção a seguir é nova e deve ser adicionada ao arquivo
    'router' => array(
        'routes' => array(
            'livro' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/livro[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Livro\Controller\Livro',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'livro' => __DIR__ . '/../view',
        ),
    ),
);