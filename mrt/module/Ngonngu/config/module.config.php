<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Ngonngu\Controller\Ngonngu' => 'Ngonngu\Controller\NgonnguController',
        ),
    ),
    // Thêm đoạn này
     'router' => array(
        'routes' => array (
            'ngonngu' => array (
                'type' => 'segment',
                'options' => array(
                    'route' => '/ngonngu[/:action][/:mann]',
                    'constraints' => array (
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'mann' => '[a-zA-Z0-9_-]+',
                    ),
                    'defaults' => array (
                        'controller' => 'Ngonngu\Controller\Ngonngu',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),    'view_manager' => array(
        'template_path_stack' => array(
            'ngonngu' => __DIR__ . '/../view',
        ),
    )
);
?>