<?php
namespace Cliente\Model;

use Zend\Db\TableGateway\TableGateway;

class ClienteTable
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

    public function getCliente($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveCliente(Cliente $cliente)
    {
        $data = array(
            'id' => $cliente->id,
            'cliente'  => $cliente->cliente,
            'dataNascimento' => $cliente->dataNascimento,
            'endereco'  => $cliente->endereco,
            'cpf' => $cliente->cpf,
            'email'  => $cliente->email,
            'telefone'  => $cliente->telefone,
            'obs'  => $cliente->obs,
        );
        
        $id = (int) $cliente->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getCliente($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Cliente id does not exist');
            }
        }
    }

    public function deleteCliente($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}
