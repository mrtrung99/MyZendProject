<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán giờ dạy</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
  <div id="input" class="container text-center">
        
        <h3> <a href="http://mrt.local"><button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-home"></span> Trang chủ
            </button></a></h3> <br><hr>
            <form action="" method="post" enctype="multipart/form-data" class="form-group">
                Chọn tháng và năm tính giờ dạy: <input type="month" name="thangnam">
                        <?php 
                        require 'connect.php';
                       ?>
                <input class="btn btn-primary" type="submit" name="yes" value="Thanh toán">
                <input class="btn btn-default" type="reset" name="reset" value="Reset">

                </form>
            
         <hr>
    </div>
    <div id="kq" class="container text-center">
<?php
if(isset($_POST["yes"])){
    $thang = date("m", strtotime($_POST["thangnam"]));
    $nam = date("Y", strtotime($_POST["thangnam"]));
   // echo date("m", strtotime($_POST["thangnam"]));
   // echo date("Y", strtotime($_POST["thangnam"]));
    $sql = 'select d.MaGV,g.TenGV, g.NgaySinhGV, count(d.Ngay) as socaday from diemdanhgv d join giangvien g on d.MaGV = g.magv where MONTH(d.Ngay) = '.$thang.' and YEAR(d.Ngay) = '.$nam.' group by d.MaGV';
    $result = mysql_query($sql) or die("Không thể ngày");
    if(mysql_num_rows($result)>0){
        echo '<div class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In báo cáo</button></div>';
        echo "<hr><h4>Thanh toán giờ dạy giảng viên tháng ".$thang." năm ".$nam." </h4><br>";
        echo ' <table class="table table-bordered  text-center">
                              <tr>
                                <th>Mã giảng viên</th>
                                <th>Tên giảng viên</th>
                                <th>Ngày sinh</th>
                                <th>Tổng ca dạy</th>
                              </tr>
                            ';
        while($row = mysql_fetch_array($result)){
        //    echo  $row["MaGV"]." - ".$row["TenGV"]." - ".$row["NgaySinhGV"]. " - ".$row["socaday"]. "<br>";
            echo '<tr>';
                echo '<td>'; echo $row["MaGV"];
                echo '</td>';
                echo '<td>'; echo $row["TenGV"];
                echo '</td>';  
                echo '<td>'; echo $row["NgaySinhGV"];
                echo '</td>';  
                echo '<td>'; echo $row["socaday"];
                echo '</td>';  
            echo '</tr>';
        }
          echo '</table>';
    } else echo "Không có giảng viên dạy tháng ".$thang." năm ".$nam." <br>";
    
    $sql1 ='select distinct d.magvdaythe, g.TenGV, g.NgaySinhGV, count(d.ngay) as socaday from daythe d join giangvien g on d.magvdaythe = g.magv where MONTH(d.ngay) = '.$thang.' and YEAR(d.ngay) = '.$nam.' group by d.magvdaythe ORDER by magvdaythe';
    $result1 = mysql_query($sql1) or die("Không thể select ngày");
    if(mysql_num_rows($result1)>0){
        echo "<hr><h4>Thanh toán giờ dạy giảng viên dạy thế tháng ".$thang." năm ".$nam." </h4><br>";
        echo ' <table class="table table-bordered  text-center">
                              <tr>
                                <th>Mã giảng viên dạy thế</th>
                                <th>Tên giảng viên</th>
                                <th>Ngày sinh</th>
                                <th>Chi tiết dạy thế</th>
                                <th>Tổng ca dạy thế</th>
                              </tr>
                            ';
        while($row1 = mysql_fetch_array($result1)){
        //    echo  $row["MaGV"]." - ".$row["TenGV"]." - ".$row["NgaySinhGV"]. " - ".$row["socaday"]. "<br>";
            echo '<tr>';
                echo '<td>'; echo $row1["magvdaythe"];
                echo '</td>';
                echo '<td>'; echo $row1["TenGV"];
                echo '</td>';  
                echo '<td>'; echo $row1["NgaySinhGV"];
                echo '</td>';  
            
                echo '<td>'; 
               $sql2 ='SELECT d.magv, g.magv, g.TenGV, g.NgaysinhGV, COUNT(d.maca) AS solanday from daythe d join giangvien g on d.magv=g.magv where MONTH(d.ngay) = "'.$thang.'" and YEAR(d.ngay) = "'.$nam.'" AND d.magvdaythe="'.$row1["magvdaythe"].'" GROUP BY d.magv ORDER BY d.magv';
                 $result2 = mysql_query($sql2) or die("Không thể select chi tiết dạy thế");
                if(mysql_num_rows($result2)>0){
                     while($row2 = mysql_fetch_array($result2)){
                      //  echo $row2["magv"]." - ".$row2["TenGV"]." - ".$row2["NgaysinhGV"]." - ".$row2["solanday"]."<hr>";
                         echo " Dạy thế cho ".$row2["TenGV"]." (".$row2["magv"].") ".$row2["solanday"]." lần <hr>";
                     }
                } 
                echo '</td>'; 
            
                echo '<td>'; echo $row1["socaday"];
                echo '</td>';  
            echo '</tr>';
        }
          echo '</table>';
    } else echo "Không có dạy thế tháng ".$thang." năm ".$nam." <br>";
}
        
?>
    </div>
<script>

function myFunction() {
    document.getElementById('inputbaocao').style.visibility = 'hidden';
    document.getElementById('printbtn').style.visibility = 'hidden';
//    this.hide();
 //   $("#inputbaocao").hide();
    window.print();
}
function print(){
     var newWindow = window.open();
        newWindow.document.write('<!DOCTYPE html><html><head>');
        newWindow.document.write('<body><div align="center">');
        newWindow.document.write(document.getElementById("kq").innerHTML);
        newWindow.document.getElementById('printbtn').style.visibility = 'hidden';
        newWindow.document.write("</div></body></html>");
        newWindow.print(); 
    }
</script>
</body> 
</html>

