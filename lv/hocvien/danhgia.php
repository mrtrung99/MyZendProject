
<!DOCTYPE html>
<html>
<head>
	<title>Đánh giá giảng viên</title>
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
    <h1 class="text-center">Phiếu đánh giá giảng viên</h1>
    <div class="container" id="infor">
    <table class="table table-striped">
    <tr><td>Môn Học: Anh văn trẻ em</td><td> <div class="progress-bar" role="progressbar" aria-valuenow="70"
  aria-valuemin="0" aria-valuemax="100" style="width:70%">
    Tiến độ 70%
  </div></td></tr>
    <tr><td>Nhóm: 1</td><td>Số câu phải hoàn thành : 15/20</td></tr>
    <tr><td>Khóa học: 1</td><td>Số câu đã hoàn thành: 0/20 </td></tr>
    <tr><td>Giảng viên: Mr A</td><td></td></tr>
        <tr><td>Đơn vị: Tổ Anh Văn</td><td></td></tr>
    </table>
    </div>
    <div class="container" name="bangcauhoi">
<table class="table table-hover" >
<?php
    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    $sql="select * from tieuchidanhgia";
    $sql1="select * from mucdodanhgia";
    $query=mysql_query($sql) or die("Khong the select");
    $query1=mysql_query($sql1) or die("Khong the select");
    if(mysql_num_rows($query) == 0){
        echo "Chua co du lieu";
    }
    else{
        while($row=mysql_fetch_array($query)){
            echo '<tr>';
            echo '<td>';
            echo $row['TenTC'] ." - ".$row['GhiChu']."<br />";
            echo '</td>';
            echo '<td>';
  /*          while($row1=mysql_fetch_array($query1)){
            echo $row1['MucDo']; echo '<br>';
            } */

            echo '<input type="radio" name="'.$row['TenTC'].'" value="ratkhonghailong"> Rất không hài lòng <br>
  <input type="radio" name="'.$row['TenTC'].'" value="khonghailong"> Không hài lòng <br>
  <input type="radio" name="'.$row['TenTC'].'" value="hailong"> Hài Lòng <br>
  <input type="radio" name="'.$row['TenTC'].'" value="rathailong"> Rất hài lòng <br>';
            echo '</td>';  
            echo '</tr>';
        }
    }
    mysql_close($conn);
?>
    <tr><td>Ý kiến khác</td>
        <td><textarea cols="30" rows="10"></textarea></td>
    </tr>
    
</table>
<input class="btn btn-success" type="submit" name="submit" value="Gửi phản hồi"> <a href="http://luanvan.local"><button class="btn btn-danger">Hủy</button></a>
    </div>
            <form action="down.php" method="post"> <input type=submit name="export_excel" value="Downexcel"></form>

</body>
</html>

