<?php
namespace Livro\Form;

use Zend\Form\Form;

class LivroForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('livro');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'titulo',
            
            'type' => 'Text',
            'options' => array(
                'label' => 'Título da Obra',
                'class' => 'form-control',
            ),
            'attributes' => [
                'class' => 'form-control'
            ]
        ));
        $this->add(array(
            'name' => 'autor',
            'type' => 'Text',
            'options' => array(
                'label' => 'Autor',
            ),
            'attributes' => [
                'class' => 'form-control'
            ]
        ));
        $this->add(array(
            'name' => 'editora',
            'type' => 'Text',
            'options' => array(
                'label' => 'Editora',
            ),
            'attributes' => [
                'class' => 'form-control'
            ]
        ));
        $this->add(array(
            'name' => 'dataCadastro',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data Cadastro',
            ),
            'attributes' => [
                'class' => 'form-control',
            ]
        ));
        $this->add(array(
            'name' => 'valor',
            'type' => 'Text',
            'options' => array(
                'label' => 'Valor do Livro',
            ),
            'attributes' => [
                'class' => 'form-control'
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