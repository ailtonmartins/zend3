<?php

namespace Clientes\Controller;


use Clientes\Model\ClientesTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClientesController extends AbstractActionController
{
    private $table;

    public function __construct(ClientesTable $table){
        $this->table = $table;
    }

    public function indexAction(){

        $clientesTable = $this->table;

        return new ViewModel([
            'clientes' => $clientesTable->fetchAll()
        ]);
    }
}