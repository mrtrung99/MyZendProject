<?php
// module/Blog/src/Blog/Controller/BlogController.php:

namespace Chungchi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ChungchiController extends AbstractActionController {
    protected $chungchiTable;
    public function indexAction() {
	return new ViewModel(array(
		'chungchi' => $this->getChungchiTable()->fetchAll(),
	));
}

    public function addAction() {

    }

    public function updateAction() {

    }

    public function deleteAction() {

    }
    
    public function getChungchiTable() {
        if (!$this->chungchiTable) {
            $sm = $this->getServiceLocator();
            $this->chungchiTable = $sm->get('Chungchi\Model\ChungchiTable');
        }
 
        return $this->chungchiTable;
    }
}
?>