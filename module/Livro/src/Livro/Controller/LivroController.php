<?php

namespace Livro\Controller;

use Livro\Form\LivroForm;
use Livro\Model\Livro;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LivroController extends AbstractActionController
{
    protected $livroTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'livros' => $this->getLivroTable()->fetchAll(),
        ));
    }
    
     public function verAction()
    {   
        
        $id = (int) $this->params()->fromRoute('id', 0);
        $view = new ViewModel(array('livros' => $this->getLivroTable()->getLivro($id)));
        $view->setTerminal(true);
        return $view;
    }
    
    public function addAction()
    {
        $form = new LivroForm();
        $form->get('submit')->setValue('Salvar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $livro = new Livro();
            $form->setInputFilter($livro->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $livro->exchangeArray($form->getData());
                $this->getLivroTable()->saveLivro($livro);

                // Redirect to list of livros
                return $this->redirect()->toRoute('livro');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('livro', array(
                'action' => 'add'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $livro = $this->getLivroTable()->getLivro($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('livro', array(
                'action' => 'index'
            ));
        }

        $form  = new LivroForm();
        $form->bind($livro);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($livro->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getLivroTable()->saveLivro($livro);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('livro');
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
            return $this->redirect()->toRoute('livro');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');

            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->getLivroTable()->deleteLivro($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('livro');
        }

        return array(
            'id'    => $id,
            'livro' => $this->getLivroTable()->getLivro($id)
        );
    }
    
    public function getLivroTable()
    {
        if (!$this->livroTable) {
            $sm = $this->getServiceLocator();
            $this->livroTable = $sm->get('Livro\Model\LivroTable');
        }
        return $this->livroTable;
    }
}