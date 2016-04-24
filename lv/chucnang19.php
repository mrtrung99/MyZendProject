<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo cáo kết quả đánh giá học viên với giảng viên</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.ocean.js"></script>
</head>
<body>
<div id="inputbaocao" class="container text-center">
 <br>
<?php 
require 'connect.php';
include("include/fusioncharts.php");

$gv = $_GET["magv"];
$kh =$_GET["makh"];;
$mh ="Listening";
$malop = $_GET["malop"];;
$mamh= $_GET["mamh"];;
//----------------Báo cáo tổng quan-----------

$sql1 = 'select DISTINCT d.MucDo, t.mucdo, count(d.MaHV) as soluong from danhgia d join mucdodanhgia t on d.MucDo=t.mamucdo WHERE d.MaGV="'.$gv.'" AND d.MaKH='.$kh.' AND d.malop="'.$malop.'" AND d.MaMH="'.$mamh.'" and d.MaTC !="Other" group by d.MucDo';

$result1 = mysql_query($sql1) or die("Không thể select mức độ");
if(mysql_num_rows($result1)>0){
    echo '<div id ="chart-1" class="text-left"><button class="btn btn-success" onclick="window.print();" id="printbtn">In báo cáo</button><p><h1>Báo cáo kết quả đánh giá học viên <br> Giảng viên '.$gv.' - Khóa học '.$kh.' - Môn học '.$mh.'</h1></p><hr>';
    echo "<h4>Báo cáo sơ lược</h4>";
    echo "<div id='tongquan'></div>";
            $arrData = array(
              "chart" => array
              (
              "caption" => "Tổng Quan",
                    "subcaption" => "Lớp đánh giá <br> ".$malop,
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
    
            while($row1 = mysql_fetch_array($result1)){
                array_push($arrData["data"], array(   
                "label" => $row1["mucdo"],
                "value" => $row1["soluong"]
                )
                );
              //  echo "Mức độ " . $row1["MucDo"] . " có ".$row1["sohv"]." đánh giá <br>";
            }
            $jsonEncodedData = json_encode($arrData);
            $columnChart = new FusionCharts("pie3D", 1 , 600, 300, "tongquan", "json", $jsonEncodedData);
          //  $count++;
            $columnChart->render();
   
} 

 echo '<br><hr><h4>Ý kiến khác</h4>';

//---------------------------Các ý kiến khác-----------------------------------
$sql2 = 'select DISTINCT ykienkhac from danhgia WHERE MaGV="'.$gv.'" AND MaKH='.$kh.' AND malop="'.$malop.'" AND MaMH="'.$mamh.'" and MaTC="Other"';

$result2 = mysql_query($sql2) or die("Không thể select mức độ");
if(mysql_num_rows($result2)>0){
    echo '<ol>';
     while($row = mysql_fetch_array($result2)){

         echo '<li>'.$row["ykienkhac"]."</li>";
     }
    echo '</ol>';
} else echo "Không có các ý kiến khác";










 echo '<br><hr><h4>Chi tiết báo cáo<h4>';
//Chi tiết báo cáo--------------------------------------------------
    
$sql = 'select DISTINCT t.MaTC, t.TenTC, t.GhiChu from danhgia d join tieuchidanhgia t on d.MaTC=t.MaTC WHERE d.MaGV="'.$gv.'" AND d.MaKH='.$kh.' AND d.malop="'.$malop.'" AND d.MaMH="'.$mamh.'"';

$result = mysql_query($sql) or die("Không thể select tiêu chí");
if(mysql_num_rows($result)>0){
    $count=2;
 //   echo '';
    while($row = mysql_fetch_array($result)){
   //     $count = 1;
        $sql1= 'SELECT m.mucdo, COUNT(MaHV) as sohv FROM danhgia d join mucdodanhgia m on d.MucDo=m.mamucdo WHERE MaTC="'.$row["MaTC"].'" GROUP BY MucDo';
        $result1 = mysql_query($sql1);
        if(mysql_num_rows($result1)>0){
          //  echo "Tiêu chí ".$row["MaTC"] ." - ";
            echo "<div id='".$row["MaTC"]."'></div>";
            $arrData = array(
              "chart" => array
              (
              "caption" => $row["TenTC"],
                    "subcaption" => "Chi tiết tiêu chí <br> ".$row["GhiChu"],
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
            
            while($row1 = mysql_fetch_array($result1)){
                array_push($arrData["data"], array(   
                "label" => $row1["mucdo"],
                "value" => $row1["sohv"]
                )
                );
              //  echo "Mức độ " . $row1["MucDo"] . " có ".$row1["sohv"]." đánh giá <br>";
            }
            $jsonEncodedData = json_encode($arrData);
            $columnChart = new FusionCharts("pie3D", $count , 600, 300, $row["MaTC"], "json", $jsonEncodedData);
            $count++;
            $columnChart->render();
        } else {
            echo "Không thấy các mức độ ứng với tiêu chí trên";
        }
      //  echo $row["MaTC"] ." - ";
    }
    echo '<h4>Copyright MRT Group - '.date("Y").'</h4></div>';
} else {
    echo "Kết quả báo cáo hiện chưa có!";
}
?>

<br>
<hr>
</div>
<?php

if(isset($_POST["baocao"])){
    
/* Include the `fusioncharts.php` file that contains functions  to embed the charts. */

include("include/fusioncharts.php");
error_reporting(0);
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
  "caption" => "Age profile of website visitors",
        "subcaption" => "Last Year",
        "startingangle" => "120",
        "showlabels" =>  "0",
        "showlegend" => "1",
        "enablemultislicing" =>  "0",
        "slicingdistance" => "15",
        "showpercentvalues" => "1",
        "showpercentintooltip" =>  "0",
        "plottooltext" => 'Age group : $label
Total visit : $datavalue',
        "theme" =>  "fint"
  ),
    "data" => array(
        array(
            "label" => "Teenage",
            "value" =>  "1250400"
        ),
        array(
            "label" => "Adult",
            "value" => "1463300"
        ),
        array(
            "label" => "Mid-age",
            "value" => "1050700"
        ),
        array(
            "label" => "Senior",
            "value" => "491000"
        )
    )
);

//$arrData["data"] = array();

// Push the data into the array

/*while($row = mysqli_fetch_array($result)) {
   // echo $row["MaCC"] ."--". $row["soluongccduoccap"];
    array_push($arrData["data"], array(   
        "label" => $row["MaCC"],
        "value" => $row["soluongccduoccap"]
    )
    );
} */

/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
$jsonEncodedData = json_encode($arrData);
$columnChart = new FusionCharts("pie3D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

// Render the chart

$columnChart->render();
echo '<div class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In báo cáo</button></div>';
} else {
    echo "Không tìm thấy dữ liệu";
}
// Close the database connection

$dbhandle->close();
}
?>
 <!--   
<div class="text-center" id="chart-1">Báo cáo sẽ được tải ở đây</div>
<button class="text-center" onclick="window.print();" id="printbtn">In báo cáo</button> -->
<script>

function myFunction() {
    document.getElementById('inputbaocao').style.visibility = 'hidden';
    document.getElementById('printbtn').style.visibility = 'hidden';
    window.print();
}
function print(){
        var newWindow = window.open();
        newWindow.document.write('<!DOCTYPE html><html><head>');
        newWindow.document.write('<body><div align="center">');
        newWindow.document.write(document.getElementById("chart-1").innerHTML);
        newWindow.document.getElementById('printbtn').style.visibility = 'hidden';
        newWindow.document.write("</div></body></html>");
        newWindow.print(); 
    }
</script>

</body> 
</html>

