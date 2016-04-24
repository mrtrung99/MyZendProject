<!DOCTYPE html>
<html>
<head>
	<title>Đánh giá giảng viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

</head>
<body>
<div class="container text-center">
    <br>
    <h2>Dạy thế</h2> <br><hr>
    <form action="" method="post" enctype="multipart/form-data">
    
<?php
    echo' Dạy thế cho giảng viên có mã: <input type="text" name="gv1" value='.$_GET["magv"].' readonly>';
    echo' Ca dạy: <input type="text" name="ca" value='.$_GET["ca"].' readonly>';
?>  
    Mã giảng viên dạy thế: <input type="text" name="gv2"><br><hr>
    <input class="btn btn-primary" type="submit" name="submit" value="Lưu">
    <button class="btn btn-danger" name="huy" onclick="window.close()">Hủy</button>
    </form>
<?php 
    if(isset($_POST["submit"])){
        $date = date("Y-m-d");
        echo "Giảng viên có mã ".$_POST["gv2"]." dạy thế cho giảng viên có mã ".$_POST["gv1"]." vào ca ".$_POST["ca"]." ngày ".$date."";
    }
?>
</div>
</body>
</html>