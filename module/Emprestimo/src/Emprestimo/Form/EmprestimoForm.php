<?php
namespace Emprestimo\Form;

use Zend\Form\Form;

class EmprestimoForm extends Form
{
    public function __construct($name = null)
    {
        // Nos iremos ignorar o nome passado
        parent::__construct('emprestimo');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'idCliente',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'cliente',
            'type' => 'Select',
            'options' => array(
                'label' => 'Cliente',
                'value_options' => array(
                    'Cliente 1' => 'Cliente 1',
                    'Cliente 2' => 'Cliente 2',
                    'Cliente 3' => 'Cliente 3',
                    'Cliente 4' => 'Cliente 4',
                ),
            ),
            'attributes' => [
                'class' => 'form-control'
            ]
        ));
        $this->add(array(
            'name' => 'dataEmprestimo',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data Empréstimo',
            ),
            'attributes' => [
                'class' => 'form-control'
            ]
        ));
        $this->add(array(
            'name' => 'titulo',
            'type' => 'Select',
            'options' => array(
                'label' => 'Título da Obra',
                'value_options' => array(
                    'Livro 1' => 'Livro 1',
                    'Livro 2' => 'Livro 2',
                    'Livro 3' => 'Livro 3',
                    'Livro 4' => 'Livro 4',
                ),
            ),
            'attributes' => [
                'class' => 'form-control'
            ]
        ));
        $this->add(array(
            'name' => 'diasSolicitados',
            'type' => 'text',
            'options' => array(
                'label' => 'Dias Solicitados',
            ),
            'attributes' => [
                'class' => 'form-control',
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