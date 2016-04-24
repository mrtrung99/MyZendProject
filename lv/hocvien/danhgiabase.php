
<!DOCTYPE html>
<html>
<head>
	<title>Các môn học bạn học</title>
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
$mahv = $_GET["mahv"];
    
$dslop = mysql_query('select distinct l1.MaLop from lichhochv l join lophoc l1 on l.malop=l1.MaLop  where l1.MaKH="'.$_POST["khoahoc"].'" and l.mahv="'.$mahv.'"') or die("Không thể tìm danh sách lịch học");
if(mysql_num_rows($dslop)>0){
    while($row = mysql_fetch_array($dslop)){
        echo  "Lớp có mã là ".$row["MaLop"]."<br>";
        $dsgv = mysql_query('select distinct l1.MaGV, l1.MaMH, m.tenmh  from lophoc l join ctdaylop l1 on l.MaLop=l1.MaLop join monhoc m on l1.MaMH=m.mamh where l1.MaLop="'.$row["MaLop"].'" and l1.MaGV not in(select distinct MaGV from danhgia where MaLop="'.$row["MaLop"].'")  ') or die("Không thể tìm danh sách giáo viên dạy lớp này");
        if(mysql_num_rows($dsgv)>0){
            echo "Danh sách các môn học của lớp này<br>";
            echo '<table class="table table-bordered  text-center">
                <thead class="text-center">
                  <tr>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Mã GV</th>
                    <th>Đánh giá</th>
                  </tr>
                </thead><tbody>';
            while($row1 = mysql_fetch_array($dsgv)){
              //  echo  $row1["MaGV"]." - ".$row1["MaMH"]." - ".$row1["tenmh"]."<br>";
                echo '<tr>';
                echo "<td>".$row1["MaMH"]." </td><td> " . $row1["tenmh"]." </td><td> ". $row1["MaGV"] . "</td>";
                echo '<td><a href="danhgia.php?mahv='.$mahv.'&makh='.$_POST["khoahoc"].'&magv='.$row1["MaGV"].'&mamh='.$row1["MaMH"].'&malop='.$row["MaLop"].'" target="_blank"><button class="btn btn-primary">Đánh giá</button></a>
        </td>';
            }
             echo '</tbody></table>';
        } else echo "Không tìm thấy giảng viên cần đánh giá cho lớp này!<br>";
        echo "<hr>";

    } 
} else echo "Không tìm thấy lớp với khóa học bạn đã chọn";
                            
}
?>
    </div>
</body>


