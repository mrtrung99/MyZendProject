
<!DOCTYPE html>
<html>
<head>
	<title>Lịch khai giảng</title>
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
            </button></a><hr></h3> 
            <form action="" method="post" enctype="multipart/form-data" class="form-group">
                <div class="row">
                    <div class="col-sm-8">
                        <fieldset>
                          <legend><strong>Lập lịch khai giảng</strong></legend>
                             Khóa học: <input name="khoahoc" list="khoahoc" required autofocus>
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
                             Trụ sở đăng ký: <input name="truso" list="truso" required>
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
                            <br><br>
                            Ngày khai giảng: <input type="date" name="ngaykhaigiang" required>
                            Lớp ôn thi chứng chỉ Ngoại Ngữ: <input type="date" name="onthi">
                            <br>
                        </fieldset>
                      
                       <hr>
                         <input class="btn btn-primary" type="submit" name="yes" value="Lưu">
                         <input class="btn btn-default" type="reset" name="reset" value="Reset">
                    </div>
                    
                </div>
                <br><br>
                
                    
                </form>
            
         <hr>
<?php
if(isset($_POST["yes"])){
        $khoahoc = $_POST["khoahoc"];
        $truso = $_POST["truso"];
        $ngaykhaigiang = $_POST["ngaykhaigiang"];
        $onthi = $_POST["onthi"];

}
?>
    </div>
</body>


