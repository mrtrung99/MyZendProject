<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm tiêu chí mới</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container text-left" id="nhaptc">
    <h3>Thêm tiêu chí đánh giá mới</h3><br>
<form action="" method="post" enctype="multipart/form-data">
Mã tiêu chí: <input type="text" name="matc" required> &nbsp;
Tên tiêu chí: <input type="text" name="tentc" required>
Ghi chú: <textarea name="ghichu" cols="20" rows="5" required></textarea>
    
<br><hr>
<?php
$conn=mysql_connect("localhost", "root", "") or die("can't connect database");
mysql_select_db("mrt",$conn); 
mysql_query("set names 'utf8'",$conn);
$result = mysql_query('select * from mucdodanhgia') or die("Không thể select mức độ đánh giá");
if(mysql_num_rows($result)>0){
    echo "<strong>Lưu ý: Chọn các mức độ cho tiêu chí bạn nhập, bằng việc nhập vào số thứ tự ưu tiên cho mức độ nghĩa là bạn chọn mức độ đó!</strong> <br><hr>";
    while($row=mysql_fetch_array($result)){
        echo $row["mucdo"]." - "." thứ tự <input type='number' name=".$row["mamucdo"]." min=0 step=1> <br><br>";
    }
} else echo "CSDL không có mức độ nào!"
?>
<input class="btn btn-success" type="submit" value="Lưu tiêu chí" name="savetc">
<input class="btn btn-default" type="reset" value="Reset" name="reset">
</form>
</div>  
<div class="container text-left" id="kq">
<?php
if(isset($_POST["savetc"])){
     $arr = $_POST;
    //    $str = 'savetc';
    $matc = $_POST["matc"];
    $tentc = $_POST["tentc"];
    $ghichu = $_POST["ghichu"];
    $result = mysql_query('INSERT INTO `tieuchidanhgia` VALUES ("'.$matc.'", "'.$tentc.'", "'.$ghichu.'")') or die("Không thể lưu tiêu chí mức độ đánh giá");
    echo " Tiêu chí mới có mã ".$matc." tên ".$tentc." ghi chú là ". $ghichu." đã được lưu thành công gồm các mức độ sau: <br>";
        foreach($arr as $key => $value){
          //  $matc=""; $tentc="";
       /*     if($key =="matc"){
              //  echo "Mã tiêu chí ". $key .'-'.$value."<br>";
                $matc = $value;
            }
            if($key =="tentc"){
              //  echo "Tên tiêu chí ". $key .'-'.$value."<br>";
                $tentc = $value;
               // echo "Tên tiêu chí " . $tentc;
            } */
          //  echo " Tiêu chí có mã : ". $matc. " - ".$tentc;
            if($key != "savetc" && $key != "matc" && $key != "tentc" && $key != "ghichu"){
                if( $value != ""){
                    $result = mysql_query('INSERT INTO `tieuchi_mucdo` VALUES ("'.$matc.'", "'.$key.'", "'.$value.'")') or die("Không thể lưu tiêu chí mức độ đánh giá");
                    echo $matc." - ".$tentc." - ".$key .'-'.$value."<br>";  
                } 
            }
        }
}
?>
</div>
</body> 
</html>

