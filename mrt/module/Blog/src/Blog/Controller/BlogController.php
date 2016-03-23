<?php
// module/Blog/src/Blog/Controller/BlogController.php:

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Model\Blog;
use Blog\Form\BlogForm;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;


class BlogController extends AbstractActionController {
    protected $blogTable;
    protected $connect;
    public function indexAction() {
	return new ViewModel(array(
		'blogs' => $this->getBlogTable()->fetchAll(),
	));
}
    public function downAction(){
        return new ViewModel(array(
		'blogs' => $this->getBlogTable()->fetchAll(),
	));
  /*     $adapter = new Zend\Db\Adapter\Adapter(array(
           'driver' => 'Mysqli',
            'database' => 'mrt',
            'username' => 'root',
            'password' => ''
         ));
*/
      //  $output = '';
     //       $sql = "SELECT * FROM blog ORDER BY id DESC";
      //      $result = mysqli_query($connect, $sql) or die ("Khong the ket noi csdl");
        // $this->setDbAdapter();
          // $connect=$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
  /*          $sql = new Sql($connect);
            $select = $sql->select();
            $select->from('blog');
            //$select->where(array('id' => 2));
            $statement = $sql->prepareStatementForSqlObject($select);
*/
           // $result = $statement->execute();
         //   $connect = mysqli_connect('localhost', 'root', '', 'mrt') or die("Khong vao dc roi");
      /*      $sm = $this->getServiceLocator();
            $this->connect = $sm->get('Zend\Db\Adapter\Adapter');
            $result = mysql_query("Select * from blog") or die ("Khong the ket noi csdl");
            if(mysql_num_rows($result)>0){
                $output .= '
                    <table class="table" bordered="1">
                        <tr>
                            <th>ID</th>
                            <th>Blog</th>
                            <th>Created</th>
                        </tr>
                ';
                while($row = mysql_fetch_array($result)){
                    $output .='
                        <tr>
                            <td>'.$row["id"].'</td>
                            <td>'.$row["blog"].'</td>
                            <td>'.$row["created"].'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                header("Content-Type: application/xls");
                header('Content-Disposition:attachment, filename="download.xls"');
                echo $output;
            }
   */     
    }
    public function addAction() {
        $form = new BlogForm();
        $form->get('submit')->setValue('Add');
 
        $request = $this->getRequest();
 
        if ($request->isPost()) {
            $blog = new Blog();
            $form->setInputFilter($blog->getInputFilter());
            $form->setData($request->getPost());
 
            if ($form->isValid()) {
                $blog->setOptions($form->getData());
                $this->getBlogTable()->saveBlog($blog);                
 
                // Tro ve danh sach blog
                return $this->redirect()->toRoute('blog');
            }
        }
 
        return array('form' => $form);
    }

    public function updateAction() {
        $id = (int) $this->params()->fromRoute('id',0);
        if (!$id) {
            return $this->redirect()->toRoute('blog', array('action' => 'add'));
        }

        $blog = $this->getBlogTable()->getBlog($id);

        if (!$blog) {
           return $this->redirect()->toRoute('blog', array('action' => 'index')); 
        }

        $form = new BlogForm();
        $form->bind($blog);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($blog->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getBlogTable()->saveBlog($blog);

                // Tro ve danh sach blog
                return $this->redirect()->toRoute('blog');
            }
        }

        return array('id' => $id,'form'=>$form);

    }

   public function deleteAction() {
	$id = (int) $this->params()->fromRoute('id',0);

	if (!$id) {
		return $this->redirect()->toRoute('blog', array('action' => 'index'));
	}

	$blog = $this->getBlogTable()->getBlog($id);

	if (!$blog) {
	   return $this->redirect()->toRoute('blog', array('action' => 'index')); 
	}

	$request = $this->getRequest();
	if ($request->isPost()) {
		$del = $request->getPost('del', 'No');

		if ($del == 'Yes') {
			$id = (int) $request->getPost('id');
			$this->getBlogTable()->deleteBlog($id);

		}

		// Tro ve danh sach blog
		return $this->redirect()->toRoute('blog');
	}

	return array(
		'id' => $id,
		'blog' => $this->getBlogTable()->getBlog($id),
		);
    } 
    
    public function getBlogTable() {
        if (!$this->blogTable) {
            $sm = $this->getServiceLocator();
            $this->blogTable = $sm->get('Blog\Model\BlogTable');
        }
 
        return $this->blogTable;
    }
}
?>