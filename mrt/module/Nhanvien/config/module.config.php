<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Nhanvien\Controller\Nhanvien' => 'Nhanvien\Controller\NhanvienController',
        ),
    ),
    // Thêm đoạn này
    'router' => array(
        'routes' => array (
            'nhanvien' => array (
                'type' => 'segment',
                'options' => array(
                    'route' => '/nhanvien[/:action][/:id]',
                    'constraints' => array (
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array (
                        'controller' => 'Nhanvien\Controller\Nhanvien',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'nhanvien' => __DIR__ . '/../view',
        ),
    )
);
?>