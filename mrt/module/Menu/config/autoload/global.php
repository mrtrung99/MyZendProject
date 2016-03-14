<?php
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=mrt;host=localhost',
        'driver_option' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF-8\'',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);

?>