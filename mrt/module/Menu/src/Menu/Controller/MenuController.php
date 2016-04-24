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
    public function adminAction() {
      //  if(!isset($_SESSION['id'])){
     //        header('Location: http://luanvan.local/dangnhap.php');
     //   } else{
        $id = $_GET['id'];
        $view = new ViewModel(array(
           'id' => $id,
         ));
        return $view;
      //  }
    }
    public function ctAction() {
        $view = new ViewModel();
        return $view;
    }
     public function ngonnguAction() {
        $view = new ViewModel();
        return $view;
    }
    public function dangnhapAction() {
        $view = new ViewModel();
        return $view;
    }

        public function hocvienAction() {
          //  session_start();
if (!isset($_SESSION['username'])) {
	 header('Location: http://luanvan.local/dangnhap.php');
}
         $id = $_GET['id'];
        $view = new ViewModel(array(
           'id' => $id,
         ));
        return $view;
    }
        public function giangvienAction() {
        $id = $_GET['id'];
        $view = new ViewModel(array(
           'id' => $id,
         ));
        return $view;
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