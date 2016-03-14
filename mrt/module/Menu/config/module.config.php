<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Menu\Controller\Menu' => 'Menu\Controller\MenuController',
        ),
    ),
    // Thêm đoạn này
    'router' => array(
        'routes' => array (
            'menu' => array (
                'type' => 'segment',
                'options' => array(
                    'route' => '/menu[/:action][/:id]',
                    'constraints' => array (
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array (
                        'controller' => 'Menu\Controller\Menu',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'menu' => __DIR__ . '/../view',
        ),
    )
);
?>