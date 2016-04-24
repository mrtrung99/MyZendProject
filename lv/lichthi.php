<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phân công giáo viên coi thi</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="text-center">
    <h1>Xếp lịch thi </h1>
</div>
<div id="input" class="text-center">
    
 <br>
 <form action="" method="post" enctype="multipart/form-data" class="form-group">
 Chọn khóa học: <input name="khoahoc" list="khoahoc" required autofocus>
 <datalist id="khoahoc">
<?php 
require 'connect.php';

$sql1 = 'select makh, tgbd from khoahoc';
$result1 = mysql_query($sql1) or die("Không thể select ngôn ngữ");
if(mysql_num_rows($result1)>0){
    while($row1 = mysql_fetch_array($result1)){
        echo '<option value="'.$row1["makh"].'"> '.$row1["tgbd"].' </option>';
    }
} else {
    echo "Không có khóa học nào trong CSDL";
}  
?>
 </datalist>
 Chọn ngày thi: <input type="date" min="<?php echo date("Y-m-d")?>" name="ngaythi" >
 Chọn ca thi: <input class="text-center" name="cathi" list="cathi" required>
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
Chọn ngôn ngữ: <input class="text-center" name="ngonngu" list="ngonngu" required>
 <datalist id="ngonngu">
<?php 
$sql = 'select * from ngonngu';
$result = mysql_query($sql) or die("Không thể select ngôn ngữ");
if(mysql_num_rows($result)>0){
    while($row = mysql_fetch_array($result)){
        echo '<option value="'.$row["mann"].'"> '.$row["tennn"].' </option>';
    }
} else {
    echo "Không có ngôn ngữ nào trong CSDL";
}
?>
 </datalist>
 Chọn chứng chỉ: <input class="text-center" name="cc" list="cc" required>
 <datalist id="cc">
<?php 
$sql = 'select * from chungchi';
$result = mysql_query($sql) or die("Không thể select cc");
if(mysql_num_rows($result)>0){
    while($row = mysql_fetch_array($result)){
        echo '<option value="'.$row["macc"].'"> '.$row["tencc"].' </option>';
    }
} else {
    echo "Không có cc nào trong CSDL";
}
?>
 </datalist>
Chọn môn thi: <input class="text-center" name="monthi" list="monthi" required>
 <datalist id="monthi">
<?php 
$sql = 'select mamh, tenmh from monhoc';
$result = mysql_query($sql) or die("Không thể select môn học");
if(mysql_num_rows($result)>0){
    while($row = mysql_fetch_array($result)){
        echo '<option value="'.$row["mamh"].'"> '.$row["tenmh"].' </option>';
    }
} else {
    echo "Không có môn học nào trong CSDL";
}
?>
 </datalist>
     <br>
     <hr>
 <input type="submit" name="xeplich" id="xeplich" value="Xếp lịch thi học viên và giảng viên tự động" class="btn btn-success">
 <input type="reset" name="reset" id="reset" value="Reset" class="btn btn-primary">
 <input type="button" name="xemlichthi" id="xemlichthi" value="Xem lịch thi" class="btn btn-info">
 


<!-- <input type="submit" name="xeplichgv" id="xeplichgv" value="Xếp lịch giảng viên"> -->

 </form>
<br>
<hr>
</div>

<div class="text-center" id="lichthi">
<?php
if(isset($_POST["xeplich"])){
       // echo $_POST["ngaythi"];
        //echo $_POST["cathi"];
        $monthi = $_POST["monthi"];
        $ngonngu = $_POST["ngonngu"];
        $kh = $_POST["khoahoc"];
        $ngaythi = $_POST["ngaythi"];
        $chungchi = $_POST["cc"];
        $cathi = $_POST["cathi"];
        $tenmon =""; $tenca ="";
       // $date = date_format($ngaythi,"d/m/Y H:i:s");
        switch ($cathi) {
            case "S":
                $tenca ="Sáng";
                break;
            case "C":
                $tenca ="Chiều";
                break;
            case "T":
                $tenca ="Tối";
                break;
            default:
                echo "Ca gì mà tôi không biết luôn ấy?";
        }
        switch ($monthi) {
            case "LI":
                $tenmon ="Listening";
                break;
            case "RE":
                $tenmon ="Reading";
                break;
            case "WR":
                $tenmon ="Writing";
                break;
            case "SP":
                $tenmon ="Speaking";
                break;
            default:
                echo "Môn gì mà tôi không biết luôn ấy?";
        }
        $t = 'LI';
        echo  "<b>Lịch môn: ".$tenmon." - Ngôn ngữ: ".$ngonngu." - Ngày: ".$ngaythi." - Ca: ".$tenca."</b><br><hr>";
//Xếp học viên vào phòng
      if($monthi != $t){  // neu mon thi khac Listening
         $dsphong= mysql_query('select maphong, succhua from phong where maphong not in(select maphong from phongban where ngayban="'.$_POST["ngaythi"].'" and caban="'.$_POST["cathi"].'") and maphong not in(select maphong from phong where trangthai=1) and maphong not in(select MaPhong from lichthihv where Ngay="'.$_POST["ngaythi"].'" and MaCa="'.$_POST["cathi"].'") ') or die("Không thể select phòng");
        if(mysql_num_rows($dsphong)>0){
            while($row = mysql_fetch_array($dsphong)){
                    $sql = 'select mahv from bienlaimon where ngaythi="'.$ngaythi.'" and mann="'.$ngonngu.'" and macc="'.$chungchi.'" and makh="'.$kh.'" and mamh="'.$monthi.'" and mahv not in(select MaHV from lichthihv where ngaythi="'.$ngaythi.'" and mann="'.$ngonngu.'" and macc="'.$chungchi.'" and makh="'.$kh.'" and mamh="'.$monthi.'") limit '.$row["succhua"].' ';
                    $dshv = mysql_query($sql) or die ('Không thể select học viên!!');
                     if(mysql_num_rows($dshv)>0){
                        echo "Phòng: " .$row["maphong"] . " có tối đa ".$row["succhua"]." học viên thi môn ".$tenmon." - Gồm các học viên <br>";
                        while($row1 = mysql_fetch_array($dshv)){
                             echo $row1["mahv"] . '<br>';
                            // echo 'insert into lichthihv values("'.$kh.'","'.$monthi.'","'.$row1["mahv"].'","'.$chungchi.'","'.$row["maphong"].'","'.$cathi.'","'.$ngaythi.'")';
                            $insert = mysql_query('insert into lichthihv values("'.$kh.'","'.$monthi.'","'.$row1["mahv"].'","'.$ngonngu.'","'.$chungchi.'","'.$row["maphong"].'","'.$cathi.'","'.$ngaythi.'")') or die ('Không thể thêm học viên');
                        }
                    } else echo "Phòng: " .$row["maphong"] . " có tối đa ".$row["succhua"]." học viên thi môn ".$tenmon." - Hiện tại chưa có học viên nào được sắp vào phòng thi này<br>";
            }

        } else echo "Số phòng cho ca thi ".$cathi." ngày ".$ngaythi." đã được sắp hết - Vui lòng chọn ca tiếp theo hoặc ngày tiếp theo"; 
        
        
    } 
    else { //neu mon thi la Listening
         $dsphong= mysql_query('select maphong from phong where maphong not in(select maphong from phongban where ngayban="'.$_POST["ngaythi"].'" and caban="'.$_POST["cathi"].'") and maphong not in(select maphong from phong where trangthai=1) and maphong not in(select MaPhong from lichthihv where Ngay="'.$_POST["ngaythi"].'" and MaCa="'.$_POST["cathi"].'") ') or die(" Không thể select phòng");
        if(mysql_num_rows($dsphong)>0){
                 //   $off = 0;
            while($row = mysql_fetch_array($dsphong)){
                
                    $sql = 'select mahv from bienlaimon where ngaythi="'.$ngaythi.'" and mann="'.$ngonngu.'" and macc="'.$chungchi.'" and makh="'.$kh.'" and mamh="LI" and mahv not in(select MaHV from lichthihv where ngaythi="'.$ngaythi.'" and mann="'.$ngonngu.'" and macc="'.$chungchi.'" and makh="'.$kh.'" and mamh="LI") limit 25';
                   // $off = $off + 25;
                    $dshv = mysql_query($sql) or die ('Không thể select học viên!!');
                     if(mysql_num_rows($dshv)>0){
                        echo "Phòng: " .$row["maphong"] . " có tối đa 25 học viên thi môn ".$tenmon." - Gồm các học viên <br>";
                        while($row1 = mysql_fetch_array($dshv)){
                               echo $row1["mahv"] . '<br>';
                               $insert = mysql_query('insert into lichthihv values("'.$kh.'","'.$monthi.'","'.$row1["mahv"].'","'.$ngonngu.'","'.$chungchi.'","'.$row["maphong"].'","'.$cathi.'","'.$ngaythi.'")') or die ('Không thể thêm học viên');
                        }
                    } else echo "Phòng: " .$row["maphong"] . " có tối đa 25 học viên thi môn ".$tenmon." - Hiện tại chưa có học viên nào được sắp vào phòng thi này<br>";
            }

        } else echo "Số phòng cho ca thi ".$cathi." ngày ".$ngaythi." đã được sắp hết - Vui lòng chọn ca tiếp theo hoặc ngày tiếp theo"; 
    }
    
    /*Xep lich gv*/
    
    $phong=mysql_query('select DISTINCT MaPhong from lichthihv where Ngay="'.$ngaythi.'" and MaKH="'.$kh.'" and MaCa="'.$cathi.'" and (MaPhong not in(SELECT maphongthi FROM `lichthi` WHERE ngaythi="'.$ngaythi.'" and macathi="'.$cathi.'"))') or die("Khong the select phòng đã sắp");
    $count = 0; 
      if(mysql_num_rows($phong)>0){
            echo "<br>Danh sách phòng đã được sắp giáo viên coi thi: <br>";
            while($phongthi = mysql_fetch_array($phong)){
              //  echo $phongthi["MaPhong"].'<br>';
                $sql1 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$cathi.'") and (ngaydangky="'.$ngaythi.'") and level>=2 and (magv not in(SELECT magiaovien1 FROM `lichthi` WHERE ngaythi="'.$ngaythi.'")) LIMIT 1 OFFSET '.$count.'';
                $sql3 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$cathi.'") and (ngaydangky="'.$ngaythi.'") and level<2 and (magv not in(SELECT magiaovien2 FROM `lichthi` WHERE ngaythi="'.$ngaythi.'")) LIMIT 1 OFFSET '.$count.'';
                $result2=mysql_query($sql1) or die("Khong the select giangvien1");
                $result3=mysql_query($sql3) or die("Khong the select giangvien2");
                if(mysql_num_rows($result2)>=1 && mysql_num_rows($result3)>=1 ){
                        while($row2 = mysql_fetch_array($result2)){
                            while($row3 = mysql_fetch_array($result3)){
                                    $save = 'INSERT INTO lichthi (ngaythi, macathi , maphongthi, magiaovien1, magiaovien2) VALUES ("'.$ngaythi.'", "'.$cathi.'", "'.$phongthi["MaPhong"].'", "'.$row2["magv"].'", "'.$row3["magv"].'")';
                                  //  echo $save . "<br><hr>";
                                    
                                    $ok = mysql_query($save) or die("Khong the insert to db");
                                    echo 'Phòng thi '.$phongthi["MaPhong"]. ' ngày '.$ngaythi. ' ca thi '.$cathi.' giáo viên 1: '.$row2["magv"].' giáo viên 2: '.$row3["magv"] . "<br><hr>";
                                 //$count++;
                            }
                        }
                    
                } else echo "Lịch thi ngày ".$ngaythi ." -ca số ". $cathi. "- tại phòng ".$phongthi["MaPhong"]." CHƯA ĐƯỢC SẮP vì không đủ giáo viên đăng ký!!! <br>"; 
            
            }   
      } else echo "<br>Không tìm thấy danh sách phòng cần sắp giáo viên vào";
}

/* đây là test xếp gv vào phòng học
if(isset($_POST["xeplichgv"])){
  //Xếp giáo viên vào phòng thi
     $monthi = $_POST["monthi"];
        $kh = $_POST["khoahoc"];
        $ngaythi = $_POST["ngaythi"];
        $chungchi = $_POST["cc"];
        $cathi = $_POST["cathi"];
        $phong=mysql_query('select DISTINCT MaPhong from lichthihv where Ngay="'.$ngaythi.'" and MaKH="'.$kh.'" and MaCa="'.$cathi.'" and (MaPhong not in(SELECT maphongthi FROM `lichthi` WHERE ngaythi="'.$ngaythi.'" and macathi="'.$cathi.'"))') or die("Khong the select phòng đã sắp");
    $count = 0; 
      if(mysql_num_rows($phong)>0){
            echo "<br>Danh sách phòng đã được sắp: <br>";
            while($phongthi = mysql_fetch_array($phong)){
              //  echo $phongthi["MaPhong"].'<br>';
                $sql1 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$cathi.'") and (ngaydangky="'.$ngaythi.'") and level>=2 and (magv not in(SELECT magiaovien1 FROM `lichthi` WHERE ngaythi="'.$ngaythi.'" and macathi="'.$cathi.'")) LIMIT 1 OFFSET '.$count.'';
                $sql3 = 'SELECT magv FROM dsdangkycoithi where (maca="'.$cathi.'") and (ngaydangky="'.$ngaythi.'") and level<2 and (magv not in(SELECT magiaovien2 FROM `lichthi` WHERE ngaythi="'.$ngaythi.'" and macathi="'.$cathi.'")) LIMIT 1 OFFSET '.$count.'';
                $result2=mysql_query($sql1) or die("Khong the select giangvien1");
                $result3=mysql_query($sql3) or die("Khong the select giangvien2");
                if(mysql_num_rows($result2)>=1 && mysql_num_rows($result3)>=1 ){
                        while($row2 = mysql_fetch_array($result2)){
                            while($row3 = mysql_fetch_array($result3)){
                                    $save = 'INSERT INTO lichthi (ngaythi, macathi , maphongthi, magiaovien1, magiaovien2) VALUES ("'.$ngaythi.'", "'.$cathi.'", "'.$phongthi["MaPhong"].'", "'.$row2["magv"].'", "'.$row3["magv"].'")';
                                  //  echo $save . "<br><hr>";
                                    
                                    $ok = mysql_query($save) or die("Khong the insert to db");
                                    echo 'Phòng thi '.$phongthi["MaPhong"]. ' ngày '.$ngaythi. ' ca thi '.$cathi.' giáo viên 1: '.$row2["magv"].' giáo viên 2: '.$row3["magv"] . "<br><hr>";
                                 //$count++;
                            }
                        }
                    
                } else echo "Lịch thi ngày ".$ngaythi ." -ca số ". $cathi. "- tại phòng".$phongthi["MaPhong"]." CHƯA ĐƯỢC SẮP vì không đủ giáo viên đăng ký!!! <br>"; 
            
            }   
      } else echo "Dữ liệu chưa cập nhật";
}  */
?>

    
</div>

</body> 
</html>

