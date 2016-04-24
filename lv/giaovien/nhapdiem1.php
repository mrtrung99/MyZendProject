<?php

if(!isset($_GET["malop"])|| !isset($_GET["mamh"]) || !isset($_GET["magv"]) || !isset($_GET["makh"])){
    header ("Location: http://luanvan.local");
}else 
    echo $_GET["malop"]." - ".$_GET["mamh"]." - ".$_GET["magv"]." - ".$_GET["makh"];

?>
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
 <div class="container">
<?php
$conn=mysql_connect("localhost", "root", "") or die("can't connect database");
mysql_select_db("mrt",$conn); 
mysql_query("set names 'utf8'",$conn);
$dshv=mysql_query("select * from lichhochv l join hocvien h on l.mahv=h.MaHV where malop='".$_GET["malop"]."'",$conn);
if(mysql_num_rows($dshv)>0){
    echo '<form action="" method="post" enctype="multipart/form-data" class="form-group">
<table class="table table-hover text-center">
    <thead class="text-center">
      <tr>
        <th>Mã Học Viên</th>
        <th>Tên Học Viên</th>
        <th>Điểm</th>
      </tr>
    </thead><tbody>';
    while($row = mysql_fetch_array($dshv)){
        echo '<tr>';
        echo "<td>".$row["MaHV"]." </td><td> " . $row["TenHV"]." </td><td><input type='number' name='".$row["MaHV"]."' min=0 max=10 step='0.1'></td>";
        echo '</tr>';
    }
    echo '</tbody></table><input type="submit" name="save" value="Lưu" class="btn btn-success"><input type="reset" name="reset" value="Reset" class="btn btn-danger"></form>';
} else{
    echo "Không có học viên!";
}

    if(isset($_POST["save"])){
        echo "Điểm số là: <br>";
        $arr = $_POST;
        $str = 'save';
        foreach($arr as $key => $value){
            if($key != "save"){
                if( $value != ""){
                    echo $key .'-'.$value."<br>";
                } 
            }
        }
    }
?>
    </div>
</body>