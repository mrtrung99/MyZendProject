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
    
    
    //--------------------------------------------------------------------------------
    
/* 
   The following 4 code lines contain the database connection information. 
   Alternatively, you can move these code lines to a separate 
   file and include the file here. 
   You can also modify this code based on your database connection. 
 */

$hostdb = "localhost";  // MySQl host
$userdb = "root";  // MySQL username
$passdb = "";  // MySQL password
$namedb = "mrt";  // MySQL database name

// Establish a connection to the database

$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

/*
  Render an error message, 
  to avoid abrupt failure, 
  if the database connection parameters are incorrect 
*/

if ($dbhandle->connect_error) {
exit("Có lỗi trong khi connect: ".$dbhandle->connect_error);
}

// Form the SQL query that returns the top 10 most populous countries
    $makh = $_POST["khoahoc"];
    if($mamh != " " ){
        $strQuery = 'SELECT MaCC, COUNT(MaHV) as soluongccduoccap FROM `dscapcc` where MaNN="'.$_POST["ngonngu"].'" and MaKH="'.$_POST["khoahoc"].'" GROUP BY MaCC';
    } else {
            $strQuery = 'SELECT MaCC, COUNT(MaHV) as soluongccduoccap FROM `dscapcc` where MaNN="'.$_POST["ngonngu"].'" GROUP BY MaCC';
    }
  /*  if(isset($_POST["khoahoc"])){
        $strQuery = 'SELECT MaCC, COUNT(MaHV) as soluongccduoccap FROM `dscapcc` where MaNN="'.$_POST["ngonngu"].'" and MaKH="'.$_POST["khoahoc"].'" GROUP BY MaCC';
    } */
// Execute the query, or else return the error message.

$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

// If the query returns a valid response, prepare the JSON strin

if ($result) {
    echo '<div id ="chart-2" class="text-center"><button class="btn btn-success" onclick="print1()" id="printbtn">In báo cáo</button>';
    echo     '<div class="text-center" id="chart-1">Báo cáo sẽ được tải ở đây</div>';

$snn = 'select tennn from ngonngu where mann="'.$_POST["ngonngu"].'"';
$rnn = mysql_query($snn) or die("Không thể select ngôn ngữ");
if(mysql_num_rows($rnn)>0){
    while($row = mysql_fetch_array($rnn)){
        $nn = $row["tennn"];
    }
} 
// The `$arrData` array holds the chart attributes and data
//$nn = "Tiếng Anh";
$arrData = array(
  "chart" => array
  (
  /*  "caption" => "Báo cáo chứng chỉ đã cấp theo từng loại", 
    "subcaption" => $nn,
    "startingangle" => "120",
    "showlabels" => "0",
    "showlegend" =>  "1",
    "enablemultislicing" => "0",
    "slicingdistance" => "15",
    "showpercentvalues" => "1",
    "showpercentintooltip" => "0",
    "plottooltext" => "Loại chứng chỉ : $label Total visit : $datavalue",
    "theme" => "ocean" */
    "caption" => 'Báo cáo số lượng chứng chỉ đã cấp theo từng loại <br> Ngôn ngữ: '.$nn.' - Khóa học: '.$_POST["khoahoc"].'',
    "paletteColors" => "#0075c2",
    "bgColor" => "#ffffff",
    "borderAlpha"=> "20",
    "canvasBorderAlpha"=> "0",
    "usePlotGradientColor"=> "0",
    "plotBorderAlpha"=> "10",
    "showXAxisLine"=> "1",
    "xAxisLineColor" => "#999999",
    "showValues" => "0",
    "divlineColor" => "#999999",
    "divLineIsDashed" => "1",
    "showAlternateHGridColor" => "0",
    "exportEnabled" => "1",
 //   "exportAtClientSide" => "1"

  )
);

$arrData["data"] = array();

// Push the data into the array

while($row = mysqli_fetch_array($result)) {
   // echo $row["MaCC"] ."--". $row["soluongccduoccap"];
    array_push($arrData["data"], array(   
        "label" => $row["MaCC"],
        "value" => $row["soluongccduoccap"]
    )
    );
    
   
}
/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

$jsonEncodedData = json_encode($arrData);
//$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);
$columnChart = new FusionCharts("column2D", 1 , 600, 300, "chart-1", "json", $jsonEncodedData);

// Render the chart

$columnChart->render();
//echo '<div class="text-center"></div>';
  //   echo '<h4>Copyright MRT Group - '.date("Y").'</h4></div>';

} else {
    echo "Không tìm thấy dữ liệu";
}
// Close the database connection

$dbhandle->close();
/*Biểu đồ tròn từ đây-----
    
    -----------------------
        
        ------------------------------
        
        
            ------------------------------- */
    echo "<br><hr><h4>Tỉ lệ học viên đậu tính trên tổng học viên đăng ký thi chứng chỉ</h4>";

$sql = 'SELECT MaCC, COUNT(MaHV) as soluongccduoccap FROM `dscapcc` where MaNN="'.$_POST["ngonngu"].'" and MaKH="'.$_POST["khoahoc"].'" GROUP BY MaCC';
    $kq = mysql_query($sql) or die("Lỗi select!");
    if(mysql_num_rows($kq)>0){
     $count=2;
        //echo '<div id ="chart-2" class="text-center"><button class="btn btn-success" onclick="print1()" id="printbtn">In báo cáo</button><p><h1>Báo cáo tỉ lệ đậu và rớt</h1></p>';
        while($row=mysql_fetch_array($kq)){
           // echo $row["MaCC"]." - ".$row["soluongccduoccap"];
            $sql1 = 'select count(sobienlai) as tonghv from bienlaimon where mann="'.$_POST["ngonngu"].'" and makh="'.$_POST["khoahoc"].'"  and macc="'.$row["MaCC"].'" AND mahv not IN (SELECT DISTINCT MaHV FROM dscapcc where mann="'.$_POST["ngonngu"].'" and makh="'.$_POST["khoahoc"].'"  and macc="'.$row["MaCC"].'" )';
            $kq1 = mysql_query($sql1) or die("Không thể các chứng chỉ");
            if(mysql_num_rows($kq1)>0){
            echo "<div class='text-center' id='".$row["MaCC"]."'></div>";
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
       
    } else echo "Không thấy chứng chỉ!";
}
?>
<!--<button class="text-center" onclick="window.print();" id="printbtn">In báo cáo</button> -->
<script>

function myFunction() {
    document.getElementById('inputbaocao').style.visibility = 'hidden';
    document.getElementById('printbtn').style.visibility = 'hidden';
//    this.hide();
 //   $("#inputbaocao").hide();
    window.print();
}
function print1(){
   var newWindow = window.open();
        newWindow.document.write('<!DOCTYPE html><html><head>');
        newWindow.document.write('<body><div align="center">');
        newWindow.document.write(document.getElementById("chart-2").innerHTML);
        newWindow.document.getElementById('printbtn').style.visibility = 'hidden';
        newWindow.document.write("</div></body></html>");
        newWindow.print(); 
    
    
    }
</script>

</body> 
</html>

