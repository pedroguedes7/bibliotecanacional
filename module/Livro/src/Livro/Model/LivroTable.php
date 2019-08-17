<?php
namespace Livro\Model;

use Zend\Db\TableGateway\TableGateway;

class LivroTable
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

    public function getLivro($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveLivro(Livro $livro)
    {
        $data = array(
            'id' => $livro->id,
            'titulo'  => $livro->titulo,
            'autor' => $livro->autor,
            'editora'  => $livro->editora,
            'dataCadastro' => $livro->dataCadastro,
            'valor'  => $livro->valor,
            'obs'  => $livro->obs,
        );

        $id = (int) $livro->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getLivro($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Livro id does not exist');
            }
        }
    }

    public function deleteLivro($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}
