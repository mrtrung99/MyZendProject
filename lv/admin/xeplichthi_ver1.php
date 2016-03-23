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
    <script>
        /*
$(document).ready(function(){
    $("#khoa").click(function(){
        alert("The text has been changed.");
       // $("#ngay").disabled = false;
    });
    
});   */
        
    $(document).ready(function(){
 /*   $("button").click(function(){
       // $("#ngay").disabled = false;
        $("#ngay").prop('disabled', false);
    }); */
    $("input").change(function(){
       // $("#ngay").disabled = false;
        $("#ngay").prop('disabled', false);
    });    
        
    });

</script>
</head>
<body>
<!--
<h2>This is a heading</h2>

<p>This is a paragraph.</p>
<p id="test">This is another paragraph.</p>

<button>Click me</button>-->
    
 <form action="" method="post" enctype="multipart/form-data">
     Chọn ngày: <input type="date" name="ngaythi" required>
<!--     Chọn khóa thi: <select id="khoathi" name="khoathi" required>
        <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
     </select> -->
     Chọn ca thi: <select id="cathi" name="cathi" required>
        <option>S</option>
          <option>C</option>
          <option>T</option>
     </select>
     <input type=submit name="xeplichthi" value="Xếp lịch thi">
     <input type=submit name="test" value="Test">
     <input type=submit name="test1" value="Test1">

</form>
<?php // Dem so phong trong va giang vien, lop chua duoc sap vao ngày và ca cụ thể ok!!
 /*$conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    $sql = 'SELECT count(maphong) as dem from phong WHERE trangthai=0 and maphong NOT IN(SELECT p.maphong FROM phong p RIGHT JOIN lichthi l ON p.maphong=l.maphongthi WHERE l.malopthi!="NULL" AND l.ngaythi="2016-03-31" AND l.macathi="S")'; 
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
    echo "Số phòng còn trốg là : " . $row["dem"]."<br>";
}
     $sql1 = 'SELECT count(malopthi) as dem from lopthi where ngaythi="2016-03-31" AND maca="S" and malopthi NOT IN(SELECT p.malopthi FROM lopthi p RIGHT JOIN lichthi l ON p.malopthi=l.malopthi WHERE l.malopthi!="NULL" AND l.ngaythi="2016-03-31" AND l.macathi="S")'; 
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1)){
    echo "Số lớp chưa được sắp là: " . $row1["dem"]."<br>";
}
  /*   $sql2 = 'SELECT count(magv) as dem from dsdangkycoithi WHERE ngaydangky="2016-03-31" AND maca="S" and level>=2 and magv not in     (SELECT p.magv FROM giangvien p RIGHT JOIN lichthi l ON p.magv=l.magiaovien1 WHERE l.magiaovien1!="NULL" AND l.ngaythi="2016-03-31" AND l.macathi="S")'; */
/*    $sql2='SELECT count(magv) as dem from dsdangkycoithi WHERE ngaydangky="2016-03-31" AND maca="S" and magv not in(SELECT magiaovien1 FROM lichthi WHERE ngaythi="2016-03-31" AND macathi="S") and magv not in(SELECT magiaovien2 FROM lichthi WHERE ngaythi="2016-03-31" AND macathi="S")';
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($result2)){
    echo "Số giảng viên chưa được sắp là " . $row2["dem"];
} */
?>
<?php // day la test rang buoc khoa
/*    $date = date("Y-m-d");
   // echo $date;
    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    $result=mysql_query('select makh, tgbd from khoahoc where tgbd>"'.$date.'" ') or die("Khong the select phong");
    if(mysql_num_rows($result)>=1){
        echo 'Khóa học: <input list="khoa" required>
            <datalist id="khoa">';
        while($row = mysql_fetch_array($result)){
        echo '<option value="'.$row["makh"].'">' .$row["tgbd"].'</option>';
        }
        echo '</datalist>';
       
    }
    $result1=mysql_query('select maca, tenca from ca') or die("Khong the select phong");
    if(mysql_num_rows($result1)>=1){
        echo 'Ca thi: <input list="ca" required>
            <datalist id="ca">';
        while($row1 = mysql_fetch_array($result1)){
        echo '<option value="'.$row1["maca"].'">' .$row1["tenca"].'</option>';
        }
        echo '</datalist>';
    }
     echo 'Chọn ngày: <input id="ngay" name="ngay" type="date" min="'.$date.'" disabled required>';
 */
?> 
<?php 

//$connect = mysqli_connect("127.0.1.1", "root", "", "mrt") or die("Bla bla bla ");
//require_once 'connect.php';
error_reporting(0);
if(isset($_POST["xeplichthi"])){
    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    $result=mysql_query('select maphong from phong where trangthai=0 and (maphong not in(SELECT maphongthi FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'" and macathi="'.$_POST["cathi"].'"))') or die("Khong the select phong");
 //   $sql = "SELECT * FROM Orders LIMIT 10 OFFSET 15";
    $count = 0; 
    if(mysql_num_rows($result)>=1){
     while($row = mysql_fetch_array($result)){
        $result1=mysql_query('select malopthi FROM lopthi WHERE maca="'.$_POST["cathi"].'" AND ngaythi="'.$_POST["ngaythi"].'" and (malopthi not in(SELECT malopthi FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'" and macathi="'.$_POST["cathi"].'")) LIMIT 1 OFFSET '.$count.'') or die("Khong the select lopthi");
         $sql1 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$_POST["cathi"].'") and (ngaydangky="'.$_POST["ngaythi"].'") and level>=2 and (magv not in(SELECT magiaovien1 FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'")) LIMIT 1 OFFSET '.$count.'';
         $sql3 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$_POST["cathi"].'") and (ngaydangky="'.$_POST["ngaythi"].'") and level<2 and (magv not in(SELECT magiaovien2 FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'")) LIMIT 1 OFFSET '.$count.'';
        $result2=mysql_query($sql1) or die("Khong the select giangvien1");
        $result3=mysql_query($sql3) or die("Khong the select giangvien2");
         if(mysql_num_rows($result1)>=1 && mysql_num_rows($result2)>=1 && mysql_num_rows($result3)>=1 ){
         //   echo "Lịch thi ngày ".$_POST["ngaythi"] ." - ca thi mã  ". $_POST["cathi"]. "- tại phòng số".$row["maphong"]." lớp thi là : "; 
         //   echo $row1["malopthi"];
            while($row1 = mysql_fetch_array($result1)){
             while($row2 = mysql_fetch_array($result2)){
          //   echo " được gác bởi giảng viên 1 có mã : ". $row2["magv"];
                 while($row3 = mysql_fetch_array($result3)){
            //    echo " và giảng viên2 có mã : ". $row3["magv"]."<br>";
       /*              $save ='insert into lichthi(ngaythi, macathi, maphongthi, malopthi, magiaovien1, magiaovien2) values("'.$_POST["ngaythi"].'","'.$_POST["ngaythi"].'","'.$_POST["cathi"].'","'.$row["maphong"].'","'.$row1["malopthi"].'","'.$row2["magv"].'","'.$row3["magv"].'")'; */
                $save = 'INSERT INTO lichthi (ngaythi, macathi , maphongthi, malopthi, magiaovien1, magiaovien2) VALUES ("'.$_POST["ngaythi"].'", "'.$_POST["cathi"].'", "'.$row["maphong"].'", "'.$row1["malopthi"].'", "'.$row2["magv"].'", "'.$row3["magv"].'")';
               echo $save . "<br><hr>";
               $ok = mysql_query($save) or die("Khong the insert to db");
            //    $count++;
                }
            }
         }
         } else {
            echo "Lịch thi ngày ".$_POST["ngaythi"] ." -ca số ". $_POST["cathi"]. "- tại phòng".$row["maphong"]." CHƯA ĐƯỢC SẮP <br>"; 
         }
     }
         $sql = 'SELECT count(maphong) as dem from phong WHERE trangthai=0 and maphong NOT IN(SELECT p.maphong FROM phong p RIGHT JOIN lichthi l ON p.maphong=l.maphongthi WHERE l.malopthi!="NULL" AND l.ngaythi="'.$_POST["ngaythi"].'" AND l.macathi="'.$_POST["cathi"].'")'; 
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
    echo "Số phòng còn trốg là : <strong> " . $row["dem"]."</strong><br>";
}
     $sql1 = 'SELECT count(malopthi) as dem from lopthi where ngaythi="'.$_POST["ngaythi"].'" AND maca="'.$_POST["cathi"].'" and malopthi NOT IN(SELECT p.malopthi FROM lopthi p RIGHT JOIN lichthi l ON p.malopthi=l.malopthi WHERE l.malopthi!="NULL" AND l.ngaythi="'.$_POST["ngaythi"].'" AND l.macathi="'.$_POST["cathi"].'")'; 
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1)){
    echo "Số lớp chưa được sắp là: <strong> " . $row1["dem"]."</strong><br>";
}
  /*   $sql2 = 'SELECT count(magv) as dem from dsdangkycoithi WHERE ngaydangky="2016-03-31" AND maca="S" and level>=2 and magv not in     (SELECT p.magv FROM giangvien p RIGHT JOIN lichthi l ON p.magv=l.magiaovien1 WHERE l.magiaovien1!="NULL" AND l.ngaythi="2016-03-31" AND l.macathi="S")'; */
    $sql2='SELECT count(magv) as dem from dsdangkycoithi WHERE ngaydangky="'.$_POST["ngaythi"].'" AND maca="'.$_POST["cathi"].'" and magv not in(SELECT magiaovien1 FROM lichthi WHERE ngaythi="'.$_POST["ngaythi"].'" AND macathi="'.$_POST["cathi"].'") and magv not in(SELECT magiaovien2 FROM lichthi WHERE ngaythi="'.$_POST["ngaythi"].'" AND macathi="'.$_POST["cathi"].'")';
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($result2)){
    echo "Số giảng viên chưa được sắp là <strong>" . $row2["dem"]."</strong>"; 
} 
    } 
}

if(isset($_POST["test"])){
    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    echo $_POST["ngaythi"];
 //        $sql1 = 'SELECT g1.magv FROM giangvien g1 where g1.magv not in(select g.magv from giangvien g join lichthi l on g.magv = l.magiaovien1 where ngaythi='.$_POST["ngaythi"].')';
        $sql = 'SELECT magiaovien1 FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'"';
        $result=mysql_query($sql) or die("Khong the select giangvien"); 
        if(mysql_num_rows($result)>0){
              while($row1 = mysql_fetch_array($result)){
             echo $row1["magiaovien1"];
         }
        } else echo"Khong tim thay";
    
}

if(isset($_POST["test1"])){
    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    echo $_POST["ngaythi"];
    $result=mysql_query('select maphong from phong where trangthai=0') or die("Khong the select phong");
    $result1=mysql_query('select malopthi FROM lopthi WHERE maca="'.$_POST["cathi"].'" AND ngaythi="'.$_POST["ngaythi"].'"') or die("Khong the select lopthi");
         $sql1 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$_POST["cathi"].'") and (ngaydangky="'.$_POST["ngaythi"].'") and level>=2 and (magv not in(SELECT magiaovien1 FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'"))';
         $sql3 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$_POST["cathi"].'") and (ngaydangky="'.$_POST["ngaythi"].'") and level<2 and (magv not in(SELECT magiaovien2 FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'")) ';

        $result2=mysql_query($sql1) or die("Khong the select giangvien1");
        $result3=mysql_query($sql3) or die("Khong the select giangvien2");
         while($r1 = mysql_fetch_array($result)){
             echo " Phòng thi  : ". $r1["maphong"]."<br>";
            }
          while($r1 = mysql_fetch_array($result1)){
             echo " Lớp thi  : ". $r1["malopthi"]."<br>";
            }
         while($r2 = mysql_fetch_array($result2)){
             echo " Giảng viên 1 ". $r2["magv"]."<br>";
            }
         while($r3 = mysql_fetch_array($result3)){
             echo " Giảng viên 2 ". $r3["magv"]."<br>";
            }
    
}
?>
</body>
</html>