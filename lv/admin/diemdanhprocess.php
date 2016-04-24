<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″/>
   <!-- <script src="jquery-1.11.3.min.js"></script> -->
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
</head>
<body>

 <!--nua se chen cai nay vao iframe-->

<?php
if(isset($_GET["magv"])){
   // echo "Vào đây rồi ";
    echo $_GET["magv"]." - ";
    echo $_GET["malop"]." - ";
    echo $_GET["ca"];
    //$ca = 'T';
   // $malop = 'AV1';
    $date = date("Y-m-d");
    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    $result=mysql_query('insert into diemdanhgv values("'.$_GET["magv"].'","'. $_GET["malop"].'","'. $_GET["ca"].'","'.$date.'")
    ') or die("Không thể điểm danh mã giáo viên này");
    echo " đã được điểm danh thành công!!!";
    
}
/*require 'conn.php';
if(isset($_GET["manv"])){
  //  echo "Vào đây rồi";
 //   echo $_POST["manv"];
   
mysql_query("SET NAMES utf8");
mysql_query("SET character_set_client=utf8", $conn);

$sql = "select * from nhanvien where manv='".$_GET["manv"]."'";

$kq = mysql_query($sql, $conn) or die("Could not do query");
//action='suanhanvien.php'
echo  "<form id='form' enctype='multipart/form-data'  method='post' action='updatestaff.php'>";

while($row = mysql_fetch_array($kq)){
  echo "<pre>
    <img src=xemnvimg.php?manv=" . $row["manv"] . ">
    Mã NV:          <input type='text' name='manv' size='10'  autofocus required  value='".$row["manv"] ."'>
    
    Họ Tên:         <input type='text' name='hoten' size='30' required value='".$row["hoten"] ."'>
    
    Năm Sinh:       <input type='date' name='namsinh' size='10' required value='".$row["namsinh"] ."'>
    
    Giới Tính:      <input type='radio' name='sex' value='Nam' checked> Nam <input type='radio' name='sex' value='Nu'> Nữ    
    
    Địa chỉ:        <input type='text' name='diachi' size='30' required value='".$row["diachi"] ."'>
    
    Số điện thoại:  <input type='text' name='sdt' size='10' required value='".$row["sdt"] ."'> 
    
    Chức vụ:        <input type='text' name='chucvu' size='30' value='".$row["chucvu"] ."'>
    
    Lương:          <input type='text' name='luong' size='30' min='1000' required value='".$row["luong"] ."'> &#40;nghìn VND&#41;
    
    Bộ phận :       <input list='bophan' name = 'bophan' onchange='document.getElementById('form')' required><datalist id='bophan'> ";

            $result = mysql_query("select * from bophan", $conn);

            while($row = mysql_fetch_array($result)){
               echo "<option value =". $row["mabp"].">" . $row["tenbp"] ."</option>";
            } echo "</datalist>
            
    Kho :           <input list='kho' name = 'kho' onchange='document.getElementById('form')' required><datalist id='kho'> ";
                    $result = mysql_query("select * from kho", $conn);
                    while($row = mysql_fetch_array($result)){
                       echo "<option value =". $row["makho"].">" . $row["tenkho"] ."</option>";
                    } echo "</datalist>
                    <input type='hidden' name='MAX_FILE_SIZE' value='1000000'>
    Hình ảnh:       <input name='imgname' type='file'><br><br>
             <button value='".$row["manv"] ."' onclick= 'update(this.value)'> Xác nhận </button><input type='reset' name ='reset' value='Reset'> ";
   echo "</pre> ";
} /*rut dc 1 bai hoc la nen can than, luong de sau 1 truy suat csdl khac nen se k co du lieu */
/*   
echo "</form>";
}


function a(){
            $conn = mysql_connect("localhost", "root", "vertrigo") or die("Khong the ket noi: ".mysql_error());
            $db = mysql_select_db("milk", $conn) or die ("Khong the chon CSDL");
            mysql_query("SET NAMES utf8");
            $resultbp = mysql_query("select * from bophan", $conn);
            $resultkho = mysql_query("select * from kho", $conn);

    
            echo "Bộ phận : ";
            echo "<input id='bophan' name='bophan' list='bophan1' onchange='document.getElementById('bophan')'>";
            echo "  <datalist id='bophan1' name = 'bophan1' > ";
    
            while($row = mysql_fetch_array($resultbp)){
                echo "<option name=".$row["mabp"].">" . $row["tenbp"]."</option>";
            }

            echo  "</datalist>";
            echo "Kho : ";
            echo "<input id='kho' name='kho' list='kho1' onchange='document.getElementById('kho')'>";
            echo "<datalist id='kho1' name = 'kho1'> ";
                    
    
            while($row = mysql_fetch_array($resultkho)){
            echo "<option name =". $row["makho"].">" . $row["tenkho"] ."</option>";
            }

            echo "</datalist> " ;

}

*/
?>

</body>
</html>


