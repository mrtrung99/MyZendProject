<?php
//  module/Blog/Module.php

namespace Menu;

use Menu\Model\Menu;
use Menu\Model\MenuTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
/*    
    public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Blog\Model\BlogTable' =>  function($sm) {
                     $tableGateway = $sm->get('BlogTableGateway');
                     $table = new BlogTable($tableGateway);
                     return $table;
                 },
                 'BlogTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Blog());
                     return new TableGateway('blog', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
    
 /*    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Blog\Model\BlogTable' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new BlogTable($dbAdapter);
                    return $table;
                },
                'BlogTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Blog());
                     return new TableGateway('blog', $dbAdapter, null, $resultSetPrototype);
                 },
            ),
        );
    } */
}
?>