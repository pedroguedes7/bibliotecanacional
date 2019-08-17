<?php
namespace Cliente\Form;

use Zend\Form\Form;

class ClienteForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('cliente');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'cliente',
            'type' => 'Text',
            'options' => array(
                'label' => 'Cliente',
            ),
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ));
        $this->add(array(
            'name' => 'dataNascimento',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data Nascimento',
            ),
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ));
        $this->add(array(
            'name' => 'endereco',
            'type' => 'Text',
            'options' => array(
                'label' => 'Endereço',
            ),
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ));
        $this->add(array(
            'name' => 'cpf',
            'type' => 'Text',
            'options' => array(
                'label' => 'CPF',
            ),
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Email',
            'options' => array(
                'label' => 'E-mail',
            ),
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ));
        $this->add(array(
            'name' => 'telefone',
            'type' => 'Text',
            'options' => array(
                'label' => 'Telefone',
            ),
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ));
        $this->add(array(
            'name' => 'obs',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Observações Complementares',
            ),
            'attributes' => [
                'class' => 'form-control'
            ]
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'id' => 'submitbutton',
            ),
            'attributes' => [
                'class' => 'btn btn-primary'
            ]
        ));
        $element = new \Zend\Form\Element('my-reset');
        $element->setAttribute('value', 'Cancelar');
        $element->setAttribute('class', 'btn btn-danger');
        $this->add($element);
    }
}