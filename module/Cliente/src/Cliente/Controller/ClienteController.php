<?php

namespace Cliente\Controller;

use Cliente\Form\ClienteForm;
use Cliente\Model\Cliente;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClienteController extends AbstractActionController
{
    protected $clienteTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'clientes' => $this->getClienteTable()->fetchAll(),
        ));
    }
    
    public function verAction()
    {   
        
        $id = (int) $this->params()->fromRoute('id', 0);
        $view = new ViewModel(array('clientes' => $this->getClienteTable()->getCliente($id)));
        $view->setTerminal(true);
        return $view;
    }

    public function addAction()
    {
        $form = new ClienteForm();
        $form->get('submit')->setValue('Salvar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $cliente = new Cliente();
            $form->setInputFilter($cliente->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $cliente->exchangeArray($form->getData());
                $this->getClienteTable()->saveCliente($cliente);

                // Redirect to list of clientes
                return $this->redirect()->toRoute('cliente');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cliente', array(
                'action' => 'add'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $cliente = $this->getClienteTable()->getCliente($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('cliente', array(
                'action' => 'index'
            ));
        }

        $form  = new ClienteForm();
        $form->bind($cliente);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($cliente->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getClienteTable()->saveCliente($cliente);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('cliente');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cliente');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');

            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->getClienteTable()->deleteCliente($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('cliente');
        }

        return array(
            'id'    => $id,
            'cliente' => $this->getClienteTable()->getCliente($id)
        );
    }
    
    public function getClienteTable()
    {
        if (!$this->clienteTable) {
            $sm = $this->getServiceLocator();
            $this->clienteTable = $sm->get('Cliente\Model\ClienteTable');
        }
        return $this->clienteTable;
    }
}