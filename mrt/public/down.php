<?php 
//$connect = mysqli_connect("127.0.1.1", "root", "", "mrt") or die("Bla bla bla ");
//require_once 'connect.php';
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;

$adapter = new Zend\Db\Adapter\Adapter(array(
    'driver' => 'Mysqli',
    'database' => 'mrt',
    'username' => 'root',
    'password' => ''
 ));

$output = '';
        if(isset($_POST['export_excel'])){
     //       $sql = "SELECT * FROM blog ORDER BY id DESC";
      //      $result = mysqli_query($connect, $sql) or die ("Khong the ket noi csdl");
            $sql = new Sql($adapter);
            $select = $sql->select();
            $select->from('blog');
            //$select->where(array('id' => 2));
            $statement = $sql->prepareStatementForSqlObject($select);

            $result = $statement->execute();
            if(mysqli_num_rows($result)>0){
                $output .= '
                    <table class="table" bordered="1">
                        <tr>
                            <th>ID</th>
                            <th>Blog</th>
                            <th>Created</th>
                        </tr>
                ';
                while($row = mysqli_fetch_array($result)){
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
        }
?>