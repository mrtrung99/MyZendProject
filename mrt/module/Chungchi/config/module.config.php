<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Chungchi\Controller\Chungchi' => 'Chungchi\Controller\ChungchiController',
        ),
    ),
    // Thêm đoạn này
     'router' => array(
        'routes' => array (
            'chungchi' => array (
                'type' => 'segment',
                'options' => array(
                    'route' => '/chungchi[/:action][/:macc]',
                    'constraints' => array (
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'macc' => '[a-zA-Z0-9_-]+',
                    ),
                    'defaults' => array (
                        'controller' => 'Chungchi\Controller\Chungchi',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'chungchi' => __DIR__ . '/../view',
        ),
    )
);
?>