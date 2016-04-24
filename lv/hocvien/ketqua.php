
<!DOCTYPE html>
<html>
<head>
	<title>Kết quả học tập theo khóa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style>
        body {
        background: #ffffff url("img/img.jpg") no-repeat;
        }
        .jumbotron { 
        background-color: #3399CC; /* Orange */
        color: #ffffff;
        heith: 200px;
        #tb1 {
        padding: 10px;
        border: 0px solid;
        margin: 20px;
        width:900px ;
        }
        #panel1{
            max-width: 60%; display: block;
        }
            
       #panel2{
            max-width: 40%; display: block;
             max-height: 50%; display: block;
        }
            
       #panel2{
             max-width: 40%; display: block;
             max-height: 50%; display: block;
        }
      <!--  #panel1 {width: 1000px;}  -->
      </style>
</head>
<body>

    <div id="dsngonngu" class="container text-center">
        
        <h3> <a href="http://mrt.local"><button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-home"></span> Trang chủ
            </button></a> <br><hr>
            <form action="" method="post" enctype="multipart/form-data" class="form-group">
                Chọn khóa học: <input name="khoahoc" list="khoahoc" required autofocus>
                    <datalist id="khoahoc">
                        <?php 
                        require 'connect.php';
                        $magv ="AV1";
                        $sql1 = 'select makh, tgbd from khoahoc';
                        $result1 = mysql_query($sql1) or die("Không thể select ngôn ngữ");
                        if(mysql_num_rows($result1)>0){
                            while($row1 = mysql_fetch_array($result1)){
                                echo '<option value="'.$row1["makh"].'"> '.$row1["tgbd"].' </option>';
                            }
                        } else {
                            echo "Không có khóa học nào trong CSDL";
                        }  
                        ?>
                 </datalist>
                 <input type="submit" name="yes" value="Chọn">
                </form>
            
        </h3> <hr>
<?php
    //require_once('../../conn.php');

if(isset($_POST["yes"])){
    
    $mahv=$_GET["mahv"];
    $lichthi=mysql_query('SELECT * FROM diemso WHERE makh="'.$_POST["khoahoc"].'" AND MaHV="'.$mahv.'"') or die("Không thể tìm lịch thi");
    if(mysql_num_rows($lichthi)>0){
        echo 'Kết quả học tập trong khóa '.$_POST["khoahoc"].'';
        echo '<table class="table table-bordered  text-center">
                <thead class="text-center">
                  <tr>
                    <th>Mã Ngôn ngữ</th>
                    <th>Mã Môn học</th>
                    <th>Mã chứng chỉ</th>
                    <th>Điểm</th>
                  </tr>
                </thead><tbody>';
        while($row = mysql_fetch_array($lichthi)){
             echo '<tr>';
                
                echo '<td>'.$row["mann"].'';echo '</td>';

                echo '<td>'.$row["mamh"].'';echo '</td>';
                
                
                echo '<td>'.$row["macc"].'';echo '</td>';
                
                echo '<td>'.$row["diem"].'';echo '</td>';
                
                echo '</tr>';
        }
          echo '</tbody></table>';
    
    } else echo "Không tìm thấy kết quả học tập của học viên ".$mahv." trong khóa ".$_POST["khoahoc"]."";
                            
}
?>
    </div>
</body>




