<?php

namespace Clientes\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClientesController extends AbstractActionController
{
    public function indexAction(){
        return new ViewModel();
    }
}