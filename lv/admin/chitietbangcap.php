
<!DOCTYPE html>
<html>
<head>
	<title>Chi tiết bằng cấp</title>
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
        max-height: 200px;
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
<div class="container text-center">
<?php
require 'connect.php';

$sql = 'SELECT * FROM bangcap where MaKH="'.$_GET["kh"].'" and MaNN="'.$_GET["nn"].'" and MaCC="'.$_GET["cc"].'" and MaHV="'.$_GET["mahv"].'"';
//echo $sql;
$result = mysql_query($sql) or die("Không thể select bằng cấp");
if(mysql_num_rows($result)>0){
    echo "<h3>Chi tiết bằng cấp chứng chỉ ".$_GET["cc"]." ngôn ngữ ".$_GET["nn"]." của học viên có mã ".$_GET["mahv"]." được cấp vào khóa ".$_GET["kh"]."</h3>";
    echo ' <table class="table table-bordered  text-center">
      <tr>
        <th>Mã bằng cấp</th>
        <th>Ngày ký</th>
        <th>Người ký</th>
        <th>Số hiệu bằng cấp</th>
        <th>Số vào sổ cấp chứng chỉ</th>
        <th>Xếp loại</th>
      </tr>
    ';
    while($row = mysql_fetch_array($result)){
        echo '<tr>';
        
        echo '<td>'; echo $row["MaBC"];
        echo '</td>';
        
        echo '<td>';echo date("d-m-Y", strtotime($row["NgayKy"]));
        echo '</td>';
        
        echo '<td>';echo $row["NguoiKy"];
        echo '</td>';
        
        echo '<td>';echo $row["SoHieu"];
        echo '</td>';
        echo '<td>';echo $row["SoVaoSoCapCC"];
        echo '</td>';
        
        echo '<td>';echo $row["XepLoai"];
        echo '</td>';
        
        echo '</tr>';
    } 
    echo '</table>';
} else echo "Không tìm thấy chi tiết bằng cấp";
?> 
</div>
</body>
</html>

