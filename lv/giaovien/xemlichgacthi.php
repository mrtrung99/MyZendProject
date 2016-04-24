<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xem lịch gác thi theo tháng</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
  <div id="input" class="container text-center">
       <?php 
                        require 'connect.php';
        ?>   
        <h3> <a href="http://mrt.local"><button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-home"></span> Trang chủ
            </button></a></h3> <br><hr>
            <form action="" method="post" enctype="multipart/form-data" class="form-group">
                <h4>Xem lịch gác thi</h4><br><br>
                Chọn tháng xem lịch: <input type="month" name="thangnam">
                 <input class="btn btn-primary" type="submit" name="yes" value="Xem lịch có bạn">    
                <input class="btn btn-primary" type="submit" name="yes1" value="Xem tất cả"> 
                Chọn ngày xem lịch: <input type="date" name="ngay">
                <input class="btn btn-primary" type="submit" name="yes2" value="Xem lịch có bạn">
                <input class="btn btn-primary" type="submit" name="yes3" value="Xem tất cả"><br><br>
                <input class="btn btn-default" type="reset" name="reset" value="Reset">
             
                                      
                </form>
            
         <hr>
    </div>
    <div id="kq" class="container text-center">
<?php
if(isset($_POST["yes"])){
    $magv="PV10";
    $thang = date("m", strtotime($_POST["thangnam"]));
    $nam = date("Y", strtotime($_POST["thangnam"]));
   // $sql = 'select ngaythi, macathi, maphongthi, magiaovien1, magiaovien2 from lichthi where MONTH(ngaythi) = '.$thang.' and YEAR(ngaythi)='.$nam.' and (magiaovien1='.$magv.' or magiaovien2='.$magv.'  )order by ngaythi';
    $sql = 'select l.ngaythi, c.TenCa, l.maphongthi, l.magiaovien1, l.magiaovien2 from lichthi l join ca c on l.macathi=c.MaCa where MONTH(l.ngaythi) = '.$thang.' and YEAR(l.ngaythi)='.$nam.' AND (l.magiaovien1="'.$magv.'" OR l.magiaovien2="'.$magv.'") order by l.ngaythi';

    $result = mysql_query($sql) or die("Không thể select lịch gác thi theo tháng ");
    if(mysql_num_rows($result)>0){
        echo '<div class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In lịch gác thi</button></div>';
        echo "<hr><h4>Lịch gác thi giảng viên tháng ".$thang." năm ".$nam." </h4><br>";
        echo ' <table class="table table-bordered  text-center">
                              <tr>
                                <th>Ngày gác thi</th>
                                <th>Ca thi</th>
                                <th>Phòng thi</th>
                                <th>Gác thi 1</th>
                                <th>Gác thi 2</th>
                              </tr>
                            ';
        while($row = mysql_fetch_array($result)){
        //    echo  $row["MaGV"]." - ".$row["TenGV"]." - ".$row["NgaySinhGV"]. " - ".$row["socaday"]. "<br>";
            echo '<tr>';
                echo '<td>'; echo $row["ngaythi"];
                echo '</td>';
                echo '<td>'; echo $row["TenCa"];
                echo '</td>';  
                echo '<td>'; echo $row["maphongthi"];
                echo '</td>';  
                echo '<td>'; echo $row["magiaovien1"];
                echo '</td>';
                echo '<td>'; echo $row["magiaovien2"];
                echo '</td>';
            echo '</tr>';
        }
          echo '</table>';
    } else echo "Bạn không có lịch gác thi tháng ".$thang." năm ".$nam." <br>";
}
 if(isset($_POST["yes1"])){
    $thang = date("m", strtotime($_POST["thangnam"]));
    $nam = date("Y", strtotime($_POST["thangnam"]));
 //   $sql = 'select ngaythi, macathi, maphongthi, magiaovien1, magiaovien2 from lichthi where MONTH(ngaythi) = '.$thang.' and YEAR(ngaythi)='.$nam.' order by ngaythi';
    $sql = 'select l.ngaythi, c.TenCa, l.maphongthi, l.magiaovien1, l.magiaovien2 from lichthi l join ca c on l.macathi=c.MaCa where MONTH(l.ngaythi) = '.$thang.' and YEAR(l.ngaythi)='.$nam.' order by l.ngaythi';
    $result = mysql_query($sql) or die("Không thể select lịch gác thi theo tháng ");
    if(mysql_num_rows($result)>0){
        echo '<div class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In lịch gác thi</button></div>';
        echo "<hr><h4>Lịch gác thi giảng viên tháng ".$thang." năm ".$nam." </h4><br>";
        echo ' <table class="table table-bordered  text-center">
                              <tr>
                                <th>Ngày gác thi</th>
                                <th>Ca thi</th>
                                <th>Phòng thi</th>
                                <th>Gác thi 1</th>
                                <th>gác thi 2</th>
                              </tr>
                            ';
        while($row = mysql_fetch_array($result)){
        //    echo  $row["MaGV"]." - ".$row["TenGV"]." - ".$row["NgaySinhGV"]. " - ".$row["socaday"]. "<br>";
            echo '<tr>';
                echo '<td>'; echo $row["ngaythi"];
                echo '</td>';
                echo '<td>'; echo $row["TenCa"];
                echo '</td>';  
                echo '<td>'; echo $row["maphongthi"];
                echo '</td>';  
                echo '<td>'; echo $row["magiaovien1"];
                echo '</td>';
                echo '<td>'; echo $row["magiaovien2"];
                echo '</td>';
            echo '</tr>';
        }
          echo '</table>';
    } else echo "Không có lịch gác thi tháng ".$thang." năm ".$nam." <br>";
}
if(isset($_POST["yes3"])){
    $magv="PV10";
    $sql = 'select l.ngaythi, c.TenCa, l.maphongthi, l.magiaovien1, l.magiaovien2 from lichthi l join ca c on l.macathi=c.MaCa where ngaythi="'.$_POST["ngay"].'"  order by l.ngaythi';

    $result = mysql_query($sql) or die("Không thể select lịch gác thi theo ngày");
    if(mysql_num_rows($result)>0){
        echo '<div class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In lịch gác thi</button></div>';
        echo "<hr><h4>Lịch gác thi giảng viên ngày ".date("d-m-Y", strtotime($_POST["ngay"]))." </h4><br>";
        echo ' <table class="table table-bordered  text-center">
                              <tr>
                                <th>Ngày gác thi</th>
                                <th>Ca thi</th>
                                <th>Phòng thi</th>
                                <th>Gác thi 1</th>
                                <th>Gác thi 2</th>
                              </tr>
                            ';
        while($row = mysql_fetch_array($result)){
        //    echo  $row["MaGV"]." - ".$row["TenGV"]." - ".$row["NgaySinhGV"]. " - ".$row["socaday"]. "<br>";
            echo '<tr>';
                echo '<td>'; echo $row["ngaythi"];
                echo '</td>';
                echo '<td>'; echo $row["TenCa"];
                echo '</td>';  
                echo '<td>'; echo $row["maphongthi"];
                echo '</td>';  
                echo '<td>'; echo $row["magiaovien1"];
                echo '</td>';
                echo '<td>'; echo $row["magiaovien2"];
                echo '</td>';
            echo '</tr>';
        }
          echo '</table>';
    } else echo "Bạn không có lịch gác thi ngày ".date("d-m-Y", strtotime($_POST["ngay"]))." <br>";
}
if(isset($_POST["yes2"])){
    $magv="PV10";
    $sql = 'select l.ngaythi, c.TenCa, l.maphongthi, l.magiaovien1, l.magiaovien2 from lichthi l join ca c on l.macathi=c.MaCa where ngaythi="'.$_POST["ngay"].'" AND (l.magiaovien1="'.$magv.'" OR l.magiaovien2="'.$magv.'") order by l.ngaythi';

    $result = mysql_query($sql) or die("Không thể select lịch gác thi theo ngày");
    if(mysql_num_rows($result)>0){
        echo '<div class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In lịch gác thi</button></div>';
        echo "<hr><h4>Lịch gác thi giảng viên ngày ".date("d-m-Y", strtotime($_POST["ngay"]))." </h4><br>";
        echo ' <table class="table table-bordered  text-center">
                              <tr>
                                <th>Ngày gác thi</th>
                                <th>Ca thi</th>
                                <th>Phòng thi</th>
                                <th>Gác thi 1</th>
                                <th>Gác thi 2</th>
                              </tr>
                            ';
        while($row = mysql_fetch_array($result)){
        //    echo  $row["MaGV"]." - ".$row["TenGV"]." - ".$row["NgaySinhGV"]. " - ".$row["socaday"]. "<br>";
            echo '<tr>';
                echo '<td>'; echo $row["ngaythi"];
                echo '</td>';
                echo '<td>'; echo $row["TenCa"];
                echo '</td>';  
                echo '<td>'; echo $row["maphongthi"];
                echo '</td>';  
                echo '<td>'; echo $row["magiaovien1"];
                echo '</td>';
                echo '<td>'; echo $row["magiaovien2"];
                echo '</td>';
            echo '</tr>';
        }
          echo '</table>';
    } else echo "Bạn không có lịch gác thi ngày ".date("d-m-Y", strtotime($_POST["ngay"]))." <br>";
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

