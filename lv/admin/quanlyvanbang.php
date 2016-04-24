
<!DOCTYPE html>
<html>
<head>
	<title>Quản lý văn bằng chứng chỉ đã cấp</title>
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
        heith: 200px;
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

    <div id="input" class="container text-left">
        
        <h3> <a href="http://mrt.local"><button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-home"></span> Trang chủ
            </button></a><hr></h3> 
            <form action="" method="post" enctype="multipart/form-data" class="form-group">
                <div class="row">
                    <fieldset>
                        <legend><strong>Thông tin bằng cấp</strong></legend>
                    <div class="col-sm-6">
                        
                             Mã bằng cấp : <input name="mabc" type="text" required autofocus><br><br>
                             Ngày ký: <input type="date" name="ngayky"> <br><br>
                             Mã nhân viên ký : <input name="nguoiky" list="nguoiky" required>
                            <datalist id="nguoiky">
                                <?php                      
                                require 'connect.php';
                                $sql1 = 'select MaNV, TenNV from nhanvien';
                                $result1 = mysql_query($sql1) or die("Không thể select nhân viên");
                                if(mysql_num_rows($result1)>0){
                                    while($row1 = mysql_fetch_array($result1)){
                                        echo '<option value="'.$row1["MaNV"].'"> '.$row1["TenNV"].' </option>';
                                    }
                                } else {
                                    echo "Không có Học Viên nào trong CSDL";
                                }  
                                ?>
                            </datalist><br><br>
                             Khóa học: <input name="khoahoc" list="khoahoc" required >
                            <datalist id="khoahoc">
                                <?php 
                                
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
                            </datalist><br><br>
                             Học viên: <input name="hocvien" list="hocvien" required>
                            <datalist id="hocvien">
                                <?php                                 
                                $sql1 = 'select MaHV, TenHV from hocvien';
                                $result1 = mysql_query($sql1) or die("Không thể select học viên");
                                if(mysql_num_rows($result1)>0){
                                    while($row1 = mysql_fetch_array($result1)){
                                        echo '<option value="'.$row1["MaHV"].'"> '.$row1["TenHV"].' </option>';
                                    }
                                } else {
                                    echo "Không có Học Viên nào trong CSDL";
                                }  
                                ?>
                            </datalist>
                            <br><hr>
                         <input class="btn btn-primary" type="submit" name="yes" value="Lưu">
                         <input class="btn btn-default" type="reset" name="reset" value="Reset">
                    </div>
                    <div class="col-sm-6">
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
                             </datalist><br><br>
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
                             </datalist><br><br>
                            Số hiệu: <input type="text" name="sohieu" required><br><br>
                             Số vào sổ cấp chứng chỉ: <input type="text" name="sovaoso" required><br><br>
                             Xếp loại: <input class="text-center" name="xeploai" list="xeploai" required>
                             <datalist id="xeploai">
                                 <option value='Giỏi'></option>
                                 <option value='Khá'></option>
                                 <option value='Trung bình'></option>
                             </datalist> <br><hr>
                    </div>
                     </fieldset>
                </div>
                <br><br>
                
                    
                </form>
            
         
<?php
if(isset($_POST["yes"])){
       $mabc = $_POST["mabc"];
       $ngayky = $_POST["ngayky"];
        $nguoiky = $_POST["nguoiky"];
       $hocvien = $_POST["hocvien"];
       $khoahoc = $_POST["khoahoc"];
       $ngonngu = $_POST["ngonngu"];
        $chungchi = $_POST["cc"];
        $sohieu = $_POST["sohieu"];
      $sovaoso = $_POST["sovaoso"];
       $xeploai = $_POST["xeploai"];
    
    $sql = 'INSERT INTO `bangcap` (`MaBC`, `NgayKy`, `NguoiKy`, `MaHV`, `MaKH`, `MaCC`, `MaNN`, `SoHieu`, `SoVaoSoCapCC`, `XepLoai`) VALUES ("'.$mabc.'", "'.$ngayky.'", "'.$nguoiky.'", "'.$hocvien.'","'.$khoahoc.'", "'.$chungchi.'", "'.$ngonngu.'", "'.$sohieu.'", "'.$sovaoso.'", "'.$xeploai.'")';
  //  echo $sql;
    $result = mysql_query($sql) or die("Không thể thêm dữ liệu!");
    echo "Đã thêm thành công!";
                            
}
?>
    </div>
</body>


