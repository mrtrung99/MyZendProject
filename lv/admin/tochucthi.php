
<!DOCTYPE html>
<html>
<head>
	<title>Tổ chức thi</title>
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

    <div id="dsngonngu" class="container text-left">
        
        <h3> <a href="http://mrt.local"><button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-home"></span> Trang chủ
            </button></a><hr><strong>Lập kế hoạch thi dự kiến</strong></h3>  <br><hr>
            <form action="" method="post" enctype="multipart/form-data" class="form-group">
                <div class="row">
                    <div class="col-sm-8">
                        <fieldset>
                          <legend>Thông tin cơ bản</legend>
                             Khóa thi: <input name="khoahoc" list="khoahoc" required autofocus>
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
                             Trụ sở liên hệ: <input name="truso" list="truso" required>
                             <datalist id="truso">
                                <?php 
                                $sql1 = 'select MaTS, TenTS from truso';
                                $result1 = mysql_query($sql1) or die("Không thể select trụ sở");
                                if(mysql_num_rows($result1)>0){
                                    while($row1 = mysql_fetch_array($result1)){
                                        echo '<option value="'.$row1["MaTS"].'"> '.$row1["TenTS"].' </option>';
                                    }
                                } else {
                                    echo "Không có trụ sở nào trong CSDL";
                                }  
                                ?>
                            </datalist>
                            <br>
                            Chủ tịch hội đồng thi: <input type="text" name="chutich" required>
                            Thư ký hội đồng thi: <input type="text" name="thuky" required>                     
                           
        <br>
                            Ngày bắt đầu đăng ký thi: <input type="date" name="tgbddk" required>
                            Ngày kết thúc đăng ký thi: <input type="date" name="tgktdk" required>
                            <br><hr>
                        </fieldset>
                        <fieldset>
                          <legend>Thời gian thi</legend>
                            Ngày bắt đầu thi dự kiến: <input type="date" name="ngaybdthi" required>
                            Ngày bắt đầu thi dự kiến: <input type="date" name="ngayktthi" required> <br><hr>
                        </fieldset>
                        <fieldset>
                          <legend>Thời gian phát chứng chỉ</legend>
                            Ngày bắt đầu phát chứng chỉ: <input type="date" name="bdphatcc" required>
                            Ngày kết thúc phát chứng chỉ: <input type="date" name="ktphatcc" required>
                        </fieldset>
                       <hr> <br><br>
                         <input class="btn btn-primary" type="submit" name="yes" value="Lưu">
                         <input class="btn btn-default" type="reset" name="reset" value="Reset">
                    </div>
                    <div class="col-sm-4">
                        <fieldset>
                            <legend>Các chứng chỉ thi khóa này</legend>
                            <?php
                                $result = mysql_query('select * from chungchi') or die("Không thể select chứng chỉ");
                                if(mysql_num_rows($result)>0){
                                    while($row=mysql_fetch_array($result)){
                                        echo '<input type="checkbox" value="'.$row["macc"].'" name="'.$row["macc"].'"> '.$row["tencc"].'<br>';
                                    }
                                } else echo "CSDL không có mức độ nào!";
                            ?>
                        </fieldset>
                    </div>
                </div>
                <br><br>
                
                    
                </form>
            
         <hr>
<?php
if(isset($_POST["yes"])){
        $khoahoc = $_POST["khoahoc"];
        $truso = $_POST["truso"];
        $chutich = $_POST["chutich"];
        $thuky = $_POST["thuky"];
        $tgbddk = $_POST["tgbddk"];
        $tgktdk = $_POST["tgktdk"];
        $ngaybdthi = $_POST["ngaybdthi"];
        $ngayktthi = $_POST["ngayktthi"];
        $bdphatcc = $_POST["bdphatcc"];
        $ktphatcc = $_POST["ktphatcc"];
        
        $sql='INSERT INTO `tochucthi` (`makh`, `truso`, `chutich`, `thuky`, `tgbddk`, `tgktdk`, `ngaybdthi`, `ngayktthi`, `bdphatcc`, `ktphatcc`) VALUES ("'.$khoahoc.'", "'.$truso.'", "'.$chutich.'", "'.$thuky.'", "'.$tgbddk.'", "'.$tgktdk.'", "'.$ngaybdthi.'", "'.$ngayktthi.'", "'.$bdphatcc.'", "'.$ktphatcc.'")';
       // echo $sql."<br>";
        $luu = mysql_query($sql) or die("Không thể save kế hoạch này!");
        $arr = $_POST;
        foreach($arr as $key => $value){
            if($key != "yes" && $key != "khoahoc" && $key != "truso" && $key != "chutich" && $key != "thuky" && $key != "tgbddk" && $key != "tgktdk" && $key != "ngaybdthi" && $key != "ngayktthi" && $key != "bdphatcc" && $key != "ktphatcc"){
                if( $value != ""){
                    $sql1='INSERT INTO `chungchi_khoathi`(`macc`, `makhoathi`) VALUES ("'. $value.'", "'.$khoahoc.'")';
                    $luu1 = mysql_query($sql1) or die("Không thể Danh sách chứng chỉ");
                } 
            }
        }
        echo "Lưu kế hoạch tổ chức thi thành công!";
}
?>
    </div>
</body>


