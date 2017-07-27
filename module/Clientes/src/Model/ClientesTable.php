<?php
namespace Clientes\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class ClientesTable
{

    private $tableGateway;
    public function __construct(TableGatewayInterface $tableGateway){
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll(){
        return $this->tableGateway->select();
    }

    public function save(Clientes $post , $foto = "")
    {
      $data = [
          'nome' => $post->nome,
          'email' => $post->email,
          'foto' => $foto,
          'telefone' => $post->telefone
      ];
      $id = (int)$post->idclientes;
      if ($id === 0) {
          $this->tableGateway->insert($data);
          return;
      }
      if (!$this->find($id)) {
          throw new RuntimeException(sprintf(
              'Could not retrieve the row %d', $id
          ));
      }
      $this->tableGateway->update($data, ['idclientes' => $id]);
    }
    public function find($id)
    {
      $id = (int)$id;
      $rowset = $this->tableGateway->select(['idclientes' => $id]);
      $row = $rowset->current();
      if (!$row) {
          throw new RuntimeException(sprintf(
              'Could not retrieve the row %d', $id
          ));
      }
      return $row;
    }
    public function delete($id)
    {
      $this->tableGateway->delete(['idclientes' => (int)$id]);
    }

}