<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Emprestimo\Controller\Emprestimo' => 'Emprestimo\Controller\EmprestimoController',
        ),
    ),

    // A seção a seguir é nova e deve ser adicionada ao arquivo
    'router' => array(
        'routes' => array(
            'emprestimo' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/emprestimo[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Emprestimo\Controller\Emprestimo',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'emprestimo' => __DIR__ . '/../view',
        ),
    ),
);