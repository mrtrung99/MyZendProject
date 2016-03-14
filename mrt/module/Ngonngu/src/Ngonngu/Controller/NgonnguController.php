<?php
// module/Blog/src/Blog/Controller/BlogController.php:

namespace Ngonngu\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NgonnguController extends AbstractActionController {
    protected $ngonnguTable;
    public function indexAction() {
	return new ViewModel(array(
		'ngonngu' => $this->getNgonnguTable()->fetchAll(),
	));
}

    public function addAction() {

    }

    public function updateAction() {
        $mann = $this->params()->fromRoute('mann');
        if (!$id) {
            return $this->redirect()->toRoute('ngonngu', array('action' => 'add'));
        }

        $ngonngu = $this->getNgonnguTable()->getNgonngu($mann);

        if (!$ngonngu) {
           return $this->redirect()->toRoute('ngonngu', array('action' => 'index')); 
        }

        $form = new NgonnguForm();
        $form->bind($ngonngu);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($ngonngu->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getNgonnguTable()->saveNgonngu($ngonngu);

                // Tro ve danh sach blog
                return $this->redirect()->toRoute('ngonngu');
            }
        }

        return array('mann' => $mann,'form'=>$form);

    }

    public function deleteAction() {

    }
    
    public function getNgonnguTable() {
        if (!$this->ngonnguTable) {
            $sm = $this->getServiceLocator();
            $this->ngonnguTable = $sm->get('Ngonngu\Model\NgonnguTable');
        }
 
        return $this->ngonnguTable;
    }
    public function confirmAction(){
        $viewModel = new ViewModel();
        return $viewModel;
    }
    
    public function processAction()
    {
        if (!$this->request->isPost()) {
        return $this->redirect()->toRoute(NULL ,
        array( 'controller' => 'ngonngu',
        'action' => 'add'
        ));
        }
        $post = $this->request->getPost();
        $form = new RegisterForm();
        $inputFilter = new RegisterFilter();
        $form->setInputFilter($inputFilter);
        $form->setData($post);
        if (!$form->isValid()) {
        $model = new ViewModel(array(
        'error' => true,
        'form' => $form,
        ));
        $model->setTemplate('ngonngu/ngonngu/index');
        return $model;
        }
        return $this->redirect()->toRoute(NULL , array(
        'controller' => 'ngonngu',
        'action' => 'confirm'
        ));
    }
}
?>