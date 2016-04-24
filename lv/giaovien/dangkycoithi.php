<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký coi thi</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="text-center">
    <h1>Đăng ký coi thi</h1>
</div>
<div id="input" class="text-center">
    
 <br>
 <form action="" method="post" enctype="multipart/form-data" class="form-group">
<?php 
require 'connect.php'; 
?>
 </datalist>
 Chọn ngày đăng ký gác thi: <input type="date" min="<?php echo date("Y-m-d")?>" name="ngaythi" >
 Chọn ca đăng ký gác thi: <input class="text-center" name="cathi" list="cathi" required>
 <datalist id="cathi">
<?php 
$sql = 'select * from ca';
$result = mysql_query($sql) or die("Không thể select ca");
if(mysql_num_rows($result)>0){
    while($row = mysql_fetch_array($result)){
        echo '<option value="'.$row["maca"].'"> '.$row["TenCa"].' </option>';
    }
} else {
    echo "Không có ca nào trong CSDL";
}
?>
 </datalist> <br> <br>
 <input type="submit" name="yes" id="yes" value="Đăng ký" class="btn btn-success">
 <input type="reset" name="reset" id="reset" value="Reset" class="btn btn-primary">
 


<!-- <input type="submit" name="xeplichgv" id="xeplichgv" value="Xếp lịch giảng viên"> -->

 </form>
<br>
<hr>
</div>
<div class="text-center" id="lichthi">
<?php
if(isset($_POST["yes"])){
    $magv ="AV1";
    $result = mysql_query('select level, TenGV from giangvien where magv="'.$magv.'"') or die("Không thể selec level");
        if(mysql_num_rows($result)>0){
            while($row = mysql_fetch_array($result)){
                    echo "Giảng viên ".$row["TenGV"]." cấp bậc ".$row["level"]." đăng ký gác thi ngày ".date("d-m-Y", strtotime($_POST["ngaythi"]))." ca thi ".$_POST["cathi"]." thành công!!!";
            }
        } else {
            echo "Không có giảng viên!";
        }
}
?>

    
</div>

</body> 
</html>

