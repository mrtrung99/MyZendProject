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
    $result=mysql_query('select maphong from phong where trangthai=0') or die("Khong the select phong");
 //   $sql = "SELECT * FROM Orders LIMIT 10 OFFSET 15";
    $count = 0; 
    if(mysql_num_rows($result)>=1){
     while($row = mysql_fetch_array($result)){
        $result1=mysql_query('select malopthi FROM lopthi WHERE maca="'.$_POST["cathi"].'" AND ngaythi="'.$_POST["ngaythi"].'" LIMIT 1 OFFSET '.$count.'') or die("Khong the select lopthi");
         $sql1 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$_POST["cathi"].'") and (ngaydangky="'.$_POST["ngaythi"].'") and level>=2 and (magv not in(SELECT magiaovien1 FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'")) LIMIT 1 OFFSET '.$count.'';
         $sql3 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$_POST["cathi"].'") and (ngaydangky="'.$_POST["ngaythi"].'") and level<2 and (magv not in(SELECT magiaovien2 FROM `lichthi` WHERE ngaythi="'.$_POST["ngaythi"].'")) LIMIT 1 OFFSET '.$count.'';
        $result2=mysql_query($sql1) or die("Khong the select giangvien1");
        $result3=mysql_query($sql3) or die("Khong the select giangvien2");
         if(mysql_num_rows($result1)>=1 && mysql_num_rows($result2)>=1 && mysql_num_rows($result3)>=1 ){
            echo "Lịch thi ngày ".$_POST["ngaythi"] ." - ca thi mã  ". $_POST["cathi"]. "- tại phòng số".$row["maphong"]." lớp thi là : "; 
            echo $row1["malopthi"];
            while($row1 = mysql_fetch_array($result1)){
             while($row2 = mysql_fetch_array($result2)){
             echo " được gác bởi giảng viên 1 có mã : ". $row2["magv"];
                 while($row3 = mysql_fetch_array($result3)){
                echo " và giảng viên2 có mã : ". $row3["magv"]."<br>";
                $count++;
                }
            }
         }
         } else {
            echo "Lịch thi ngày ".$_POST["ngaythi"] ." -ca số ". $_POST["cathi"]. "- tại phòng".$row["maphong"]." CHƯA ĐƯỢC SẮP <br>"; 
         }
     }
        echo "Số phòng trống ngày ".$_POST["ngaythi"] ." -ca số ". $_POST["cathi"]. " là: <strong>1</strong> <br>";
        echo "Số lớp chưa được sắp ngày  ".$_POST["ngaythi"] ." -ca số ". $_POST["cathi"]. " là <strong>0</strong> <br>"; 
        echo "Số giảng viên chưa được sắp ngày ".$_POST["ngaythi"] ." -ca số ". $_POST["cathi"]. " là <strong>0</strong> <br>"; 
    }
    /*   if(isset($_POST['export_excel'])){
            $sql="select * from blog";
            $result=mysql_query($sql) or die("Khong the select");
            if(mysql_num_rows($result)>=1){
                $file="export/" . strtotime(now) . ".csv";
                $openFile = fopen($file, "w");
             //   echo $file;
                echo "Export Processing<br>";
                $allData=mysql_fetch_assoc($result);
                $line=0;
                foreach($allData as $name => $value){
                    $line++;
                    if($line<3){
                        $label .= $name . ',';
                    } else {
                        $label .= $name . "\n";
                    }
                } 
            
            $result1=mysql_query($sql) or die("Khong the select");
                while($allData1=mysql_fetch_assoc($result1)){
                $dataValue .= $allData1["id"].','.$allData1["blog"].','. $allData1["created"] . "\n";
                };
                fputs($openFile, $label . $dataValue);
                //echo $label . $dataValue;
                echo "<a href='$file'>Download a Excel File here</a>";
            } else echo "Dont have data in DB";
        } */
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