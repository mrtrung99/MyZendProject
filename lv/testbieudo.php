<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo cáo số lượng chứng chỉ đã cấp theo từng loại</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.ocean.js"></script>
</head>
<body>
<div id="inputbaocao" class="text-center">
    
 <br>
 <form action="" method="post" enctype="multipart/form-data">
     Chọn khóa học: <input class="text-center" name="khoahoc" list="khoahoc" required>
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
 Chọn ngôn ngữ: <input class="text-center" name="ngonngu" list="ngonngu" required>
 <datalist id="ngonngu">
<?php 
$sql = 'select mann, tennn from ngonngu';
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
 
 <input type="submit" name="baocao" id="baocao" value="Báo cáo">
 </form>
<br>
<hr>
</div>
<?php

if(isset($_POST["baocao"])){
/* Include the `fusioncharts.php` file that contains functions  to embed the charts. */

include("include/fusioncharts.php");
error_reporting(0);
    
    $sql = 'SELECT MaCC, COUNT(MaHV) as soluongccduoccap FROM `dscapcc` where MaNN="'.$_POST["ngonngu"].'" and MaKH="'.$_POST["khoahoc"].'" GROUP BY MaCC';
    $kq = mysql_query($sql) or die("Lỗi select!");
    if(mysql_num_rows($kq)>0){
     $count=1;
    echo '<div id ="chart-1" class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In báo cáo</button><p><h1>Báo cáo kết quả đánh giá học viên <br> Giảng viên - Khóa học  - Môn học </h1></p>';
        while($row=mysql_fetch_array($kq)){
           // echo $row["MaCC"]." - ".$row["soluongccduoccap"];
            $sql1 = 'select count(sobienlai) as tonghv from bienlaimon where mann="'.$_POST["ngonngu"].'" and makh="'.$_POST["khoahoc"].'"  and macc="'.$row["MaCC"].'" AND mahv not IN (SELECT DISTINCT MaHV FROM dscapcc where mann="'.$_POST["ngonngu"].'" and makh="'.$_POST["khoahoc"].'"  and macc="'.$row["MaCC"].'" )';
            $kq1 = mysql_query($sql1) or die("Không thể các chứng chỉ");
            if(mysql_num_rows($kq1)>0){
            echo "<div id='".$row["MaCC"]."'></div>";
            $arrData = array(
              "chart" => array
              (
                    "caption" => $row["MaCC"],
                    "subcaption" => "Chi tiết chứng chỉ ".$row["MaCC"],
                    "startingangle" => "120",
                    "showlabels" =>  "0",
                    "showlegend" => "1",
                    "enablemultislicing" =>  "0",
                    "slicingdistance" => "15",
                    "showpercentvalues" => "1",
                    "showpercentintooltip" =>  "0",
                    "plottooltext" => 'Mức độ : $label
            - Số người đánh giá : $datavalue',
                    "theme" =>  "fint"
            ));
                
            $arrData["data"] = array();
                
            array_push($arrData["data"], array(   
                    "label" => "Đậu",
                    "value" =>  $row["soluongccduoccap"]
                    )
                    );
                while($row1 = mysql_fetch_array($kq1)){
                   // echo $row1["tonghv"];
                    array_push($arrData["data"], array(   
                    "label" => "Rớt",
                    "value" => $row1["tonghv"]
                    )
                    );
                    
                }
                
                $jsonEncodedData = json_encode($arrData);
                $columnChart = new FusionCharts("pie3D", $count , 600, 300, $row["MaCC"], "json", $jsonEncodedData);
                $count++;
                $columnChart->render();
            }  
       }
        echo '<h4>Copyright MRT Group - '.date("Y").'</h4></div>';
    } else echo "Không thấy chứng chỉ!";
}
?>

</body> 
</html>