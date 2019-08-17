<?php
namespace Emprestimo\Model;

use Zend\Db\TableGateway\TableGateway;

class EmprestimoTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getDevedores()
    {
        $hj = date('Y-m-d');
        
        $resultSet = $this->tableGateway->select(array('dataEmprestimo < \''.$hj.'\''));
        return $resultSet;
    }

    public function getEmprestimo($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveEmprestimo(Emprestimo $emprestimo)
    {
        $data = array(
            'id' => $emprestimo->id,
            'cliente'  => $emprestimo->cliente,
            'idCliente' => $emprestimo->idCliente,
            'dataEmprestimo'  => date('Y-m-d', strtotime("+".$emprestimo->diasSolicitados." days",strtotime($emprestimo->dataEmprestimo))),
            'titulo' => $emprestimo->titulo,
            'diasSolicitados'  => $emprestimo->diasSolicitados,
        );

        $id = (int) $emprestimo->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getEmprestimo($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Emprestimo id does not exist');
            }
        }
    }

    public function deleteEmprestimo($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}
