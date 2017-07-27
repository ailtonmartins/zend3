<?php

namespace Clientes\Controller;


use Clientes\Form\ClientesForm;
use Clientes\Model\Clientes;
use Clientes\Model\ClientesTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\InputFilter\FileInput;
use Zend\Validator;

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

    public function addAction(){


        $form = new ClientesForm();
        $form->get('submit')->setValue('Cadastrar Cliente');

        $request =  $this->getRequest();

        if(!$request->isPost()){
            return new ViewModel(['form' => $form]);
        }

        $data = array_merge_recursive(
            $this->getRequest()->getPost()->toArray(),
            $this->getRequest()->getFiles()->toArray()
        );
        $form->setData($data);

        if (!$form->isValid()) {
            return ['form' => $form , 'Erro' => $form->getMessages()];
        }

        $post = new Clientes();
        $post->exchangeArray($form->getData());
        $foto = '';

        $files =  $request->getFiles()->toArray();
        if(isset($files['foto'])){
            $foto = $files['foto']['name'];

            $file = new FileInput('foto');
            $file->getValidatorChain()->attach(new Validator\File\UploadFile());
            $file->getFilterChain()
                 ->attach(new Filter\File\RenameUpload(array(
                      'target'    => './public/img/cliente/'.$foto,
                      'randomize' => false,
                    )));

            $inputFilter = new InputFilter();
            $inputFilter->add($file)->setData($form->getData());
            if ($inputFilter->isValid()){
                $dataFoto = $inputFilter->getValues();
            }else{
                return ['form' => $form , 'Erro' => 'Erro ao subir a foto'];
            }
        }

        $this->table->save($post , $foto);
        return $this->redirect()->toRoute('clientes');


    }

    public function editAction(){

        $id = (int)$this->params()->fromRoute('idclientes', 0);
        if (!$id) {
            return $this->redirect()->toRoute('clientes');
        }

        try {
            $post = $this->table->find($id);
        } catch (\Exception $e){
            return $this->redirect()->toRoute('clientes');
        }

        $form = new ClientesForm();
        $form->bind($post);
        $form->get('submit')->setAttribute('value', 'Editar Cliente');
        $request = $this->getRequest();

        if (!$request->isPost()){
            return [
                'idclientes' => $id,
                'form' => $form
            ];
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return [
                'idclientes' => $id,
                'form' => $form
            ];
        }

        $this->table->save($post);
        return $this->redirect()->toRoute('clientes');
    }
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('idclientes', 0);
        if (!$id) {
            return $this->redirect()->toRoute('clientes');
        }
        $this->table->delete($id);
        return $this->redirect()->toRoute('clientes');

    }
}