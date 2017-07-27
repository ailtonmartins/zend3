<?php
namespace Clientes\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

class ClientesForm extends Form
{
    public function __construct($name=null)
    {
        parent::__construct('post');
        $this->add([
            'name' => 'idclientes',
            'type' => 'hidden'
        ]);
        $this->add([
            'name' => 'nome',
            'type' => 'text',
            'options' => [
                'label'=> 'Nome'
            ]
        ]);
        $this->add([
            'name' => 'email',
            'type' => 'text',
            'options' => [
                'label'=> 'Email'
            ]
        ]);

        // File Input
        $file = new Element\File('foto');
        $file
            ->setLabel('Foto')
            ->setAttributes(array(
                'id' => 'foto',
            ));
        $this->add($file);



        $this->add([
            'name' => 'telefone',
            'type' => 'text',
            'options' => [
                'label'=> 'Telefone'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value'=> 'Enviar',
                'id'=>'submitbutton'
            ]
        ]);

        $this->setInputFilter($this->createInputFilter());
    }

    public function createInputFilter(){
        $inputFilter = new InputFilter\InputFilter();
        // File Input
        $file = new InputFilter\FileInput('file');
        $file->setRequired(false);
        $inputFilter->add($file);

        // Text Input
        $text = new InputFilter\Input('text');
        $text->setRequired(false);
        $inputFilter->add($text);

        return $inputFilter;
    }
}