
<!DOCTYPE html>
<html>
<head>
	<title>Các ngôn ngữ</title>
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
$ngonngu = mysql_query('select distinct c.MaLop,l.TenLop, c.MaMH, l.MaKH  from lophoc l join ctdaylop c on l.MaLop = c.MaLop where l.MaKH="'.$_POST["khoahoc"].'" and c.MaGV="'.$magv.'"') or die("Không thể tìm ngôn ngữ");
if(mysql_num_rows($ngonngu)>0){
    echo 'Danh sách các môn học giảng viên '.$magv.' dạy khóa '.$_POST["khoahoc"].' <table class="table table-bordered  text-center">
    <thead class="text-center">
      <tr>
        <th>Mã lớp</th>
        <th>Tên lớp</th>
        <th>Mã môn học</th>
        <th>Nhập điểm</th>
      </tr>
    </thead><tbody>';
    while($row = mysql_fetch_array($ngonngu)){
        echo '<tr>';
        echo "<td>".$row["MaLop"]." </td><td> " . $row["TenLop"]." </td><td> ". $row["MaMH"] . "</td>";
        echo '<td><a href="nhapdiem.php?malop='.$row["MaLop"].'&makh='.$_POST["khoahoc"].'&magv='.$magv.'&mamh='.$row["MaMH"].'" target="_blank"><button class="btn btn-primary">Nhập bằng file</button></a>
        <a href="nhapdiem1.php?malop='.$row["MaLop"].'&makh='.$_POST["khoahoc"].'&magv='.$magv.'&mamh='.$row["MaMH"].'" target="_blank"><button class="btn btn-success">Nhập trực tiếp</button></a>
</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
    
} else echo "Không có các khóa học trong csdl!";
                            
}
?>
    </div>
</body>


