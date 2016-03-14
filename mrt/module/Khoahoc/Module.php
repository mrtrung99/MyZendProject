<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Khoahoc;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Users\Model\Khoahoc;
use Users\Model\KhoahocTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
  

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
  /*  public function getServiceConfig()
    {
    return array(
      'factories' => array(
        'Users\Model\User' => function ($sm)
        {
          return new Model\User($sm->get ('Zend\Db\Adapter\Adapter'));
        }
      ),
    );
    }*/
  public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Khoahoc\Model\KhoahocTable' =>  function($sm) {
                     $tableGateway = $sm->get('KhoahocTableGateway');
                     $table = new KhoahocTable($tableGateway);
                     return $table;
                 },
                 'KhoahocTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new User());
                     return new TableGateway('khoahoc', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
}
