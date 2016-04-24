
<!DOCTYPE html>
<html>
<head>
	<title>Thông tin cá nhân</title>
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
    <h1 class="text-center">
        <a href="http://mrt.local/menu/hocvien">Trang chủ</a> <br>
        Thông tin cá nhân
    </h1>
    <h5 class="text-center">Mọi nhu cầu chỉnh sửa thông tin cá nhân vui lòng liên hệ <a href="http://mrt.local/">Văn Phòng Trung Tâm Ngoại Ngữ</a></h5>
    <br>
    <hr>
    <div class="container" name="infor">
<table class="table table-striped" >
<?php
    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
   // echo $_GET["mahv"];
    $sql='SELECT * FROM `hocvien` WHERE MaHV="'. $_GET["mahv"].'"';
   // $sql1="select * from mucdodanhgia";
    $query=mysql_query($sql) or die("Không tìm thấy học viên");
  //  $query1=mysql_query($sql1) or die("Khong the select");
    if(mysql_num_rows($query) == 0){
        echo "Chua co du lieu";
    }
    else{
        while($row=mysql_fetch_array($query)){
            $gt ="";
            if($row["GioiTinhHV"] == 1){
                $gt = "Nam";
            } else $gt = "Nữ";
            echo '<tr><th>Mã học viên</th> <td>'.$row["MaHV"].'</td></tr>';
            echo '<tr><th>Tên học viên</th> <td>'.$row["TenHV"].'</td></tr>';
            echo '<tr><th>Ngày sinh</th> <td>'.$row["NgaysinhHV"].'</td></tr>';
            echo '<tr><th>Giới tính</th> <td>'.$gt.'</td></tr>';
            echo '<tr><th>Địa chỉ</th> <td>'.$row["DiaChiHV"].'</td></tr>';
            echo '<tr><th>Số điện thoại</th> <td>'.$row["SDTHV"].'</td></tr>';
        }
    }
    mysql_close($conn);
?>

</table>

    </div>
</body>
</html>

