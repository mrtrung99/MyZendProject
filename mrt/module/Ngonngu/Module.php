<?php
//  module/Blog/Module.php

namespace Ngonngu;

use Ngonngu\Model\Ngonngu;
use Ngonngu\Model\NgonnguTable;
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
    
    public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Ngonngu\Model\NgonnguTable' =>  function($sm) {
                     $tableGateway = $sm->get('NgonnguTableGateway');
                     $table = new NgonnguTable($tableGateway);
                     return $table;
                 },
                 'NgonnguTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Ngonngu());
                     return new TableGateway('ngonngu', $dbAdapter, null, $resultSetPrototype);
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