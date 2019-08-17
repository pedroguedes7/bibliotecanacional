<?php
namespace Emprestimo;

use Emprestimo\Model\Emprestimo;
use Emprestimo\Model\EmprestimoTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Emprestimo\Model\EmprestimoTable' =>  function($sm) {
                    $tableGateway = $sm->get('EmprestimoTableGateway');
                    $table = new EmprestimoTable($tableGateway);
                    return $table;
                },
                'EmprestimoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Emprestimo());
                    return new TableGateway('emprestimo', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
