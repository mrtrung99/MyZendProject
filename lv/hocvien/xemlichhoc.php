
<!DOCTYPE html>
<html>
<head>
	<title>Xem lịch học</title>
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
    
    $magv=$_GET["mahv"];
    //$magv="B1208838";
//$ngonngu = mysql_query('select distinct c.MaLop,l.TenLop, m.mamh, m.tenmh, l.MaKH  from lophoc l join ctdaylop c on l.MaLop = c.MaLop join monhoc m on c.MaMH=m.mamh where l.MaKH="'.$_POST["khoahoc"].'" and c.MaGV="'.$magv.'"') or die("Không thể tìm ngôn ngữ");
$ngonngu = mysql_query('select distinct c.MaLop,l.TenLop from lichhochv l1 join lophoc l on l1.malop=l.MaLop join ctdaylop c on l.MaLop = c.MaLop where l.MaKH="'.$_POST["khoahoc"].'" and l1.mahv="'.$magv.'"') or die("Không thể tìm ngôn ngữ");
if(mysql_num_rows($ngonngu)>0){
     echo "<h4>Lịch học của học viên ".$magv." trong khóa ".$_POST["khoahoc"]." </h4>";
     $count = 1;
    while($row = mysql_fetch_array($ngonngu)){
        echo "<hr> Lớp ".$count." - Mã lớp ".$row["MaLop"]." - Tên lớp ".$row["TenLop"].""; $count++;
        $monhoc = mysql_query('select distinct m.mamh, m.tenmh, c.Thu, c1.TenCa, c.MaPhong from ca c1 join ctdaylop c on c1.maca=c.maca join monhoc m on c.MaMH=m.mamh where c.MaLop="'.$row["MaLop"].'"') or die("Không thể tìm danh sách môn học");
        if(mysql_num_rows($monhoc)>0){
            echo '<table class="table table-bordered  text-center">
                <thead class="text-center">
                  <tr>
                    <th>Mã Môn Học</th>
                    <th>Tên Môn Học</th>
                    <th>Thứ</th>
                    <th>Ca</th>
                    <th>Phòng</th>
                  </tr>
                </thead><tbody>';
            while($row = mysql_fetch_array($monhoc)){
                echo '<tr>';
                
                echo '<td>'.$row["mamh"].'';echo '</td>';
                
                echo '<td>'.$row["tenmh"].'';echo '</td>';
                
                echo '<td>'.$row["Thu"].'';echo '</td>';
                
                echo '<td>'.$row["TenCa"].'';echo '</td>';
                
                echo '<td>'.$row["MaPhong"].'';echo '</td>';
                
                echo '</tr>';
            }
            echo '</tbody></table>';
            }
    }
    
} else echo "Không tìm thấy lịch dạy của giảng viên ".$magv." trong khóa ".$_POST["khoahoc"]."";
                            
}
?>
    </div>
</body>


