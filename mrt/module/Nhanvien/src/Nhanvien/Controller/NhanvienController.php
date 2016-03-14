<?php
// module/Blog/src/Blog/Controller/BlogController.php:

namespace Nhanvien\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NhanvienController extends AbstractActionController {
    protected $nhanvienTable;
    public function indexAction() {
	return new ViewModel(array(
		'nhanvien' => $this->getNhanvienTable()->fetchAll(),
	));
}

    public function addAction() {

    }

    public function updateAction() {

    }

    public function deleteAction() {

    }
    
    public function getNhanvienTable() {
        if (!$this->nhanvienTable) {
            $sm = $this->getServiceLocator();
            $this->nhanvienTable = $sm->get('Nhanvien\Model\NhanvienTable');
        }
 
        return $this->nhanvienTable;
    }
    public function confirmAction(){
        $viewModel = new ViewModel();
        return $viewModel;
    }
    
    public function processAction()
    {
        if (!$this->request->isPost()) {
        return $this->redirect()->toRoute(NULL ,
        array( 'controller' => 'nhanvien',
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