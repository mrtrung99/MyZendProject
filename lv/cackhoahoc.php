
<!DOCTYPE html>
<html>
<head>
	<title>Danh sách các lớp học</title>
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
<?php 
require 'connect.php'; 
?>
    <div class="container text-center" id="input">
        <form action="" method="post" enctype="multipart/form-data">
            <br>
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
            <input class="btn btn-primary" type="submit" name="yes" value="Xem">
       
        </form>
        <hr>
    </div>
    <div id="danhmuclop" class="container text-center">
        
  
<?php

if(isset($_POST["yes"])){
 $mann=$_POST["ngonngu"];
 //----------------Tìm danh sách lớp đào tạo
    $lop=mysql_query('SELECT distinct l.malop, l.tenlop FROM lopdaotao l join lopdaotao_ct l1 on l.malop=l1.malop where l1.mann="'.$mann.'" ') or die("Không thể tìm lịch thi");
    if(mysql_num_rows($lop)>0){
        echo '<h4>Danh mục lớp đào tạo<br></h4>';
         while($row = mysql_fetch_array($lop)){
              echo "<hr><h5>".$row["malop"]."-".$row["tenlop"]."</h5><br>";
   //-----------------------Tìm danh sách các lớp đào tạo chi tiết          
               $lop1=mysql_query('SELECT * FROM lopdaotao_ct where malop="'.$row["malop"].'" and mann="'.$mann.'"') or die("Không thể tìm lịch thi");
                if(mysql_num_rows($lop1)>0){
                    echo '<table class="table table-bordered  text-center">
                    <thead class="text-center">
                      <tr>
                        <th>Mã lớp</th>
                        <th>Tên Lớp</th>
                        <th>Chi tiết đào tạo</th>
                      </tr>
                    </thead><tbody>';
                     while($row1 = mysql_fetch_array($lop1)){
                       // echo "<h4>".$row1["macc"]."-".$row1["tenlop"]."</h4><br>";
                        echo '<tr>';
                
                        echo '<td>'.$row1["macc"].'';echo '</td>';

                        echo '<td>'.$row1["tenlop"].'';echo '</td>';
                         
                        echo '<td>';
                         $lop2=mysql_query('SELECT * FROM lopdaotao_caplop where malop="'.$row["malop"].'" and mann="'.$mann.'" and macc="'.$row1["macc"].'"') or die("Không thể tìm lịch thi");
                         if(mysql_num_rows($lop2)>0){
                            while($row2 = mysql_fetch_array($lop2)){
                                echo "Cấp độ ".$row2["macaplop"]." - học trong ".$row2["thoigiandaotao"]."<br>";
                            }
                         }
                         
                        echo '</td>';

                        echo '</tr>';
                    }
                     echo '</tbody></table>';
                }
        }
    
    } else echo "Không tìm thấy khác khóa học với ngôn ngữ bạn chọn";
}
?>
    </div>
     <div id="danhmuclop1" class="container text-center">
        
  
<?php
   //---------------Select ds ngôn ngữ
     $dsngonngu=mysql_query('SELECT mann,tennn from ngonngu') or die("Không thể tìm lịch thi");
    if(mysql_num_rows($dsngonngu)>0){
        echo "<h4>Danh mục các lớp học ứng với từng ngôn ngữ hiện Trung Tâm có đào tạo</h4><br>Để tìm khóa học theo ngôn ngữ vui lòng chọn ngôn ngữ cần tìm và nhấn vào chữ Xem<hr>";
         while($ngonngu = mysql_fetch_array($dsngonngu)){
           //  echo "<h3>".$ngonngu["tennn"]."<h3><br>";
             $mann=$ngonngu["mann"];
             //------------Tìm các khóa học ứng với từng ngôn ngữ
             //----------------Tìm danh sách lớp đào tạo
                $lop=mysql_query('SELECT distinct l.malop, l.tenlop FROM lopdaotao l join lopdaotao_ct l1 on l.malop=l1.malop where l1.mann="'.$mann.'" ') or die("Không thể tìm lịch thi");
                if(mysql_num_rows($lop)>0){
                    echo "<h3>".$ngonngu["tennn"]."<h3><br>";
                    echo '<h4>Danh mục lớp đào tạo<br></h4>';
                     while($row = mysql_fetch_array($lop)){
                          echo "<hr><h5>".$row["malop"]."-".$row["tenlop"]."</h5><br>";
               //-----------------------Tìm danh sách các lớp đào tạo chi tiết          
                           $lop1=mysql_query('SELECT * FROM lopdaotao_ct where malop="'.$row["malop"].'" and mann="'.$mann.'"') or die("Không thể tìm lịch thi");
                            if(mysql_num_rows($lop1)>0){
                                echo '<table class="table table-bordered  text-center">
                                <thead class="text-center">
                                  <tr>
                                    <th>Mã lớp</th>
                                    <th>Tên Lớp</th>
                                    <th>Chi tiết đào tạo</th>
                                  </tr>
                                </thead><tbody>';
                                 while($row1 = mysql_fetch_array($lop1)){
                                   // echo "<h4>".$row1["macc"]."-".$row1["tenlop"]."</h4><br>";
                                    echo '<tr>';

                                    echo '<td>'.$row1["macc"].'';echo '</td>';

                                    echo '<td>'.$row1["tenlop"].'';echo '</td>';

                                    echo '<td>';
                                     $lop2=mysql_query('SELECT * FROM lopdaotao_caplop where malop="'.$row["malop"].'" and mann="'.$mann.'" and macc="'.$row1["macc"].'"') or die("Không thể tìm lịch thi");
                                     if(mysql_num_rows($lop2)>0){
                                        while($row2 = mysql_fetch_array($lop2)){
                                            echo "Cấp độ ".$row2["macaplop"]." - học trong ".$row2["thoigiandaotao"]."<br>";
                                        }
                                     }

                                    echo '</td>';

                                    echo '</tr>';
                                }
                                 echo '</tbody></table>';
                            }
                    }

                } //else echo "<h3>".$ngonngu["tennn"]." hiện chưa có lớp học nào<h3><br>";
                //else echo "Không tìm thấy khác khóa học với ngôn ngữ bạn chọn";
                ////Kết thúc tìm danh sách lớp ứng với ngôn ngữ
             
         }
    }

?>
    </div>
</body>


