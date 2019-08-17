<?php

namespace Emprestimo\Controller;

use Emprestimo\Form\EmprestimoForm;
use Emprestimo\Model\Emprestimo;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EmprestimoController extends AbstractActionController
{
    protected $emprestimoTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'emprestimos' => $this->getEmprestimoTable()->fetchAll(),
        ));
    }
    
    public function devedoresAction()
    {
        return new ViewModel(array(
            'emprestimos' => $this->getEmprestimoTable()->getDevedores(),
        ));
    }
    
    public function addAction()
    {
        $form = new EmprestimoForm();
        $form->get('submit')->setValue('Salvar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $emprestimo = new Emprestimo();
            $form->setInputFilter($emprestimo->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $emprestimo->exchangeArray($form->getData());
                $this->getEmprestimoTable()->saveEmprestimo($emprestimo);

                // Redirect to list of emprestimos
                return $this->redirect()->toRoute('emprestimo');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('emprestimo', array(
                'action' => 'add'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $emprestimo = $this->getEmprestimoTable()->getEmprestimo($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('emprestimo', array(
                'action' => 'index'
            ));
        }

        $form  = new EmprestimoForm();
        $form->bind($emprestimo);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($emprestimo->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getEmprestimoTable()->saveEmprestimo($emprestimo);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('emprestimo');
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
            return $this->redirect()->toRoute('emprestimo');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');

            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->getEmprestimoTable()->deleteEmprestimo($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('emprestimo');
        }

        return array(
            'id'    => $id,
            'emprestimo' => $this->getEmprestimoTable()->getEmprestimo($id)
        );
    }
    
    public function getEmprestimoTable()
    {
        if (!$this->emprestimoTable) {
            $sm = $this->getServiceLocator();
            $this->emprestimoTable = $sm->get('Emprestimo\Model\EmprestimoTable');
        }
        return $this->emprestimoTable;
    }
}