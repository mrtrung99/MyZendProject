<?php
// module/Blog/src/Blog/Controller/BlogController.php:

namespace Menu\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MenuController extends AbstractActionController {
    protected $menuTable;
    public function indexAction() {
        $view = new ViewModel();
        return $view;
//	return new ViewModel(array(
//		'blogs' => $this->getBlogTable()->fetchAll(),
//	));
    }

    public function addAction() {

    }

    public function updateAction() {

    }

    public function deleteAction() {

    }
 /*   
    public function getBlogTable() {
        if (!$this->blogTable) {
            $sm = $this->getServiceLocator();
            $this->blogTable = $sm->get('Blog\Model\BlogTable');
        }
 
        return $this->blogTable;
    } */
}
?>