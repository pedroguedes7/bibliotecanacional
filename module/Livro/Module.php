<?php
namespace Livro;

use Livro\Model\Livro;
use Livro\Model\LivroTable;
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
                'Livro\Model\LivroTable' =>  function($sm) {
                    $tableGateway = $sm->get('LivroTableGateway');
                    $table = new LivroTable($tableGateway);
                    return $table;
                },
                'LivroTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Livro());
                    return new TableGateway('livro', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
