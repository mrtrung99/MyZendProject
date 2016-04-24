<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xem lịch thi</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="text-center">
    <h1>Xem lịch thi </h1>
</div>
<div id="input" class="text-center">
    
 <br>
 <form action="" method="post" enctype="multipart/form-data" class="form-group">
 Chọn khóa học: <input name="khoahoc" list="khoahoc" required autofocus>
 <datalist id="khoahoc">
<?php 
require 'connect.php';

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
Chọn ngôn ngữ: <input class="text-center" name="ngonngu" list="ngonngu" required>
 <datalist id="ngonngu">
<?php 
$sql = 'select * from ngonngu';
$result = mysql_query($sql) or die("Không thể select ngôn ngữ");
if(mysql_num_rows($result)>0){
    while($row = mysql_fetch_array($result)){
        echo '<option value="'.$row["mann"].'"> '.$row["tennn"].' </option>';
    }
} else {
    echo "Không có ngôn ngữ nào trong CSDL";
}
?>
 </datalist>
 Chọn chứng chỉ: <input class="text-center" name="cc" list="cc" required>
 <datalist id="cc">
<?php 
$sql = 'select * from chungchi';
$result = mysql_query($sql) or die("Không thể select cc");
if(mysql_num_rows($result)>0){
    while($row = mysql_fetch_array($result)){
        echo '<option value="'.$row["macc"].'"> '.$row["tencc"].' </option>';
    }
} else {
    echo "Không có cc nào trong CSDL";
}
?>
 </datalist>
     <br>
     <hr>
 <input type="submit" name="xemlichthi" id="xeplich" value="Xem lịch thi" class="btn btn-success">
 <input type="reset" name="reset" id="reset" value="Reset" class="btn btn-primary">

 


<!-- <input type="submit" name="xeplichgv" id="xeplichgv" value="Xếp lịch giảng viên"> -->

 </form>
<br>
<hr>
</div>

<div class="text-center container" id="lichthi">
<?php
if(isset($_POST["xemlichthi"])){
    
    //  $mahv=$_GET["mahv"];
    //--------------------------Tìm mã môn học---------------
    $lichthi=mysql_query('SELECT distinct MaMH FROM `lichthihv` WHERE MaKH="'.$_POST["khoahoc"].'" and mann="'.$_POST["ngonngu"].'" and MaCC="'.$_POST["cc"].'" ') or die("Không thể tìm Môn học");
    if(mysql_num_rows($lichthi)>0){
        echo "<h1>Lịch thi khóa ".$_POST["khoahoc"]." ngôn ngữ ".$_POST["ngonngu"]." chứng chỉ ".$_POST["cc"]."</h1>";
        while($row=mysql_fetch_array($lichthi)){
            echo '<hr><h2>Môn học '.$row["MaMH"]."</h2>";
        //------------------------------------------Tìm theo ngày
        $lichthi1=mysql_query('SELECT distinct Ngay FROM `lichthihv` WHERE MaKH="'.$_POST["khoahoc"].'" and mann="'.$_POST["ngonngu"].'" and MaCC="'.$_POST["cc"].'" and MaMH="'.$row["MaMH"].'"') or die("Không thể tìm Ngày");
         if(mysql_num_rows($lichthi1)>0){
                    while($row1=mysql_fetch_array($lichthi1)){
                    echo '<h3>Ngày '.$row1["Ngay"]."</h3>";
                    //------------------------------------------Tìm theo ca
                   $lichthi2=mysql_query('SELECT distinct MaCa FROM `lichthihv` WHERE MaKH="'.$_POST["khoahoc"].'" and mann="'.$_POST["ngonngu"].'" and MaCC="'.$_POST["cc"].'" and MaMH="'.$row["MaMH"].'" and Ngay="'.$row1["Ngay"].'"') or die("Không thể tìm Ca");
                    if(mysql_num_rows($lichthi2)>0){
                      while($row2=mysql_fetch_array($lichthi2)){
                        echo '<h4>Ca '.$row2["MaCa"]."</h4>";
                         //------------------------------------------Tìm theo phòng
                            $lichthi3=mysql_query('SELECT distinct MaPhong FROM `lichthihv` WHERE MaKH="'.$_POST["khoahoc"].'" and mann="'.$_POST["ngonngu"].'" and MaCC="'.$_POST["cc"].'" and MaMH="'.$row["MaMH"].'" and Ngay="'.$row1["Ngay"].'" and MaCa="'.$row2["MaCa"].'"') or die("Không thể tìm Phòng");
                              if(mysql_num_rows($lichthi3)>0){
                                    while($row3=mysql_fetch_array($lichthi3)){
                                        echo '<hr><h5><strong>Danh sách học viên thi môn '.$row["MaMH"].' ngày '.$row1["Ngay"].' ca '.$row2["MaCa"].' phòng '.$row3["MaPhong"]."</strong></h5>";
                                         $lichthi4=mysql_query('SELECT distinct h.MaHV, h.TenHV, h.NgaysinhHV FROM hocvien h join lichthihv l WHERE l.MaKH="'.$_POST["khoahoc"].'" and l.mann="'.$_POST["ngonngu"].'" and l.MaCC="'.$_POST["cc"].'" and l.MaMH="'.$row["MaMH"].'" and l.Ngay="'.$row1["Ngay"].'" and l.MaCa="'.$row2["MaCa"].'" and l.MaPhong="'.$row3["MaPhong"].'"') or die("Không thể tìm Phòng");
                                          if(mysql_num_rows($lichthi4)>0){
                                    
                                                 echo '<table class="table table-bordered  text-center">
                                                    <thead class="text-center">
                                                      <tr>
                                                        <th>STT</th>
                                                        <th>Mã học viên</th>
                                                        <th>Tên học viên</th>
                                                        <th>Ngày sinh</th>
                                                      </tr>
                                                    </thead><tbody>';
                                                        $count=1;
                                                while($row4=mysql_fetch_array($lichthi4)){
                                                         echo '<tr>';
                                                         echo '<td>'.$count.'';echo '</td>'; $count++;
                                                         echo '<td>'.$row4["MaHV"].'';echo '</td>';
                                                         echo '<td>'.$row4["TenHV"].'';echo '</td>';
                                                         echo '<td>'.$row4["NgaysinhHV"].'';echo '</td>';
                                                        echo '</tr>';
                                                }
                                                 echo '</tbody></table>'; 
                                          }
                                    }
                              }
                        }

                    } else echo "Không tìm dc";
                        
                }
                    //  echo 'Lịch thi của học viên';
           /*     echo '<table class="table table-bordered  text-center">
                        <thead class="text-center">
                          <tr>
                            <th>Ca thi</th>
                            <th>Ngày thi</th>
                            <th>Phòng thi</th>
                          </tr>
                        </thead><tbody>';
                while($row = mysql_fetch_array($lichthi1)){
                     echo '<tr>';

                        echo '<td>'.$row["MaCa"].'';echo '</td>';
                      echo '<td>'.$row["Ngay"].'';echo '</td>';
                              echo '<td>'.$row["MaPhong"].'';echo '</td>';

                        echo '</tr>';
                }
                  echo '</tbody></table>'; */
         
            }
        }
      
    } else echo "Không tìm thấy lịch thi của học viên ".$mahv." trong khóa ".$_POST["khoahoc"]."";
}
?>

    
</div>

</body> 
</html>

