<?php

// module/Blog/src/Blog/Model/BlogTable.php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class BlogTable extends AbstractTableGateway {
  /*  protected $table = "blog";
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
            $select->order('created ASC');
        });

        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\Blog();
            $entity->setId($row->id);
            $entity->setBlog($row->blog);
            $entity->setCreated($row->created);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getBlog($id) {
        $row = $this->select(array('id' => (int) $id))->current();

        if (!$row) {
            return false;
        }

        $blog = new Entity\Blog(array(
            'id' => $row->id,
            'blog' => $row->blog,
            'created' => $row->created,
        ));

        return blog;
    }

    public function saveBlog(Entity\Blog $blog) {
        $data = array(
            'blog' => $blog->getBlog(),
            'created' => $blog->getCreated(),
        );

        $id = (int) $blog->getId();

        if ($id == 0) {
            $data['created'] = date("Y-m-d H:i:s");
            if (!$this->insert($data)) {
                return false;
            }

            return $this->getLastInsertValue();
        } elseif ($this->getBlog($id)) {
            if (!$this->update($data, array('id' => $id)))              {
                return false;
            }

            return true;
        } else {
            return false;
        }
    }

    public function deleteBlog($id) {
        return $this->delete(array('id' => (int) $id));
    } */
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getBlog($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveBlog(Blog $blog)
     {
         $data = array(
             'blog' => $blog->blog,
             'created'  => $blog->created,
         );

         $id = (int) $blog->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getBlog($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Blog id does not exist');
             }
         }
     }

     public function deleteBlog($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
}
?>