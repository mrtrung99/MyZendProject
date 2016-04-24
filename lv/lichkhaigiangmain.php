
<!DOCTYPE html>
<html>
<head>
	<title>Lịch khai giảng</title>
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
        <h3> <a href="http://mrt.local"><button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-home"></span> Trang chủ
            </button></a><hr></h3>
        <h4>Kế hoạch khai giảng dự kiến theo từng khóa</h4><br><hr>
        <div class="text-left"><strong>1. Kế hoạch khai giảng</strong> <br> <br></div>    
<?php 
require 'connect.php';
$sql = 'SELECT * FROM lichkhaigiang l join truso ts on l.mats=ts.MaTS';
$result = mysql_query($sql) or die("Không thể select khóa thi");
if(mysql_num_rows($result)>0){
   // echo "<h4>Kế hoạch tổ chức thi dự kiến theo từng khóa</h4><br><hr> 1. Danh sách khóa thi <br> <br>";
    echo ' <table class="table table-bordered  text-center">
      <tr>
        <th>Khóa học</th>
        <th>Địa điểm liên hệ</th>
        <th>Ngày khai giảng</th>
        <th>Ngày mở các lớp ôn thi chứng chỉ</th>
      </tr>
    ';
    while($row = mysql_fetch_array($result)){
        echo '<tr>';
        
        echo '<td>'; echo $row["makh"];
        echo '</td>';
        
        echo '<td>';echo $row["TenTS"]." - ".$row["DiaChi"];
        echo '</td>';
        
        echo '<td>';echo date("d-m-Y", strtotime($row["ngaykhaigiang"]));
        echo '</td>';
        
        echo '<td>';echo date("d-m-Y", strtotime($row["loponthi"]));
        echo '</td>';
        
        echo '</tr>';
    } 
    echo '</table>';
} else echo "Không có khóa học nào trong CSDL";
     
?>
        <hr>
    <div class="text-left">
        <strong> 2. Danh mục lớp và học phí </strong><br>
   <!-- <a href="hoso.php" target="_blank">Nhấp vào đây để xem danh sách hồ sơ theo từng loại chứng chỉ</a> <br> -->
        <a href="http://mrt.local/menu/ct" target="_blank">Xem tại đây</a>
        <hr>
        <strong> 3. Chương trình ưu đãi</strong> <br>
        <img alt="khuyen_mai" src="img/khuyenmai.png" width="90%" height="800">
        <br>
        
    </div>
        
     <hr>
        <div class="text-left"><strong>  4. Liên hệ </strong><br>
            Văn phòng Trung tâm Ngoại ngữ, <a href="http://mrt.local/#contact" target="_blank">xem địa chỉ tại đây </a><br>
    -    Sáng: từ 7:30 đến 10:30 <br>

    -    Chiều: từ 13:30 đến 16:30  <br>
     <hr>
            <strong> 5. Thời gian thông báo thời khóa biểu</strong> <br>
    - Văn phòng Trung tâm Ngoại ngữ Trụ sở 1, Trụ sở 2 <br>

- Website: <a href="http://mrt.local" target="_blank"> http://mrt.local</a>
      </div>
      <br>
</div>
</body>
</html>

