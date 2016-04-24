<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Báo cáo tổng hợp chất lượng kết quả thi</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.ocean.js"></script>
</head>
<body>
<div id="form" class="text-center">
    <br>
    <form action="" method="post" enctype="multipart/form-data">
     Chọn khóa học: <input  name="khoahoc" list="khoahoc" required>
     <datalist id="khoahoc">
    <?php 
    require 'connect.php';
    $sql1 = 'select makh, tgbd from khoahoc';
    $result1 = mysql_query($sql1) or die("Không thể select khóa học");
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
        Chọn chứng chỉ: <input  name="chungchi" list="chungchi" required>
     <datalist id="chungchi">
    <?php 
   // require 'connect.php';
    $sql1 = 'select macc, tencc from chungchi';
    $result1 = mysql_query($sql1) or die("Không thể select chứng chỉ");
    if(mysql_num_rows($result1)>0){
        while($row1 = mysql_fetch_array($result1)){
            echo '<option value="'.$row1["macc"].'"> '.$row1["tencc"].' </option>';
        }
    } else {
        echo "Không có khóa học nào trong CSDL";
    }  
    ?>
     </datalist>
     <input type="submit" name="baocao1" id="baocao" value="Báo cáo">
    </form>
    <br>
    <hr>
    
</div>
    
<div id="inputbaocao" class="text-center">
 <br>
<?php 
if(isset($_POST["baocao1"])){
//require 'connect.php';
include("include/fusioncharts.php");
$kh = $_POST["khoahoc"];
$macc = $_POST["chungchi"];
$ngonngu = $_POST["ngonngu"];
//echo $kh."-".$macc."<br>";
$sql = 'select DISTINCT t.MaMH, t.TenMH from diemso d join monhoc t on d.mamh=t.MaMH where makh="'.$kh.'" and macc="'.$macc.'" and mann="'.$ngonngu.'"';
$result = mysql_query($sql) or die("Không thể select tiêu chí");
if(mysql_num_rows($result)>0){
    $count=1;
   
    echo '<div id ="chart-1" class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In báo cáo</button><p><h1>Báo cáo tổng hợp kết quả thi <br> Khóa học '.$kh.' - Ngôn ngữ '.$ngonngu.'  - Chứng chỉ '.$macc.'</h1></p>';
 //    echo '';
    while($row = mysql_fetch_array($result)){
   //     $count = 1;
        $sql1= 'SELECT diem, COUNT(mahv) as sohv FROM diemso WHERE mamh="'.$row["MaMH"].'" GROUP BY diem';
        $result1 = mysql_query($sql1);
        if(mysql_num_rows($result1)>0){
          //  echo "Tiêu chí ".$row["MaTC"] ." - ";
            echo "<div id='".$row["MaMH"]."'></div>";
            $arrData = array(
              "chart" => array
              (
              "caption" => $row["TenMH"],
                    "subcaption" => "Ký hiệu môn học: ".$row["MaMH"],
                    "startingangle" => "120",
                    "showlabels" =>  "0",
                    "showlegend" => "1",
                    "enablemultislicing" =>  "0",
                    "slicingdistance" => "15",
                    "showpercentvalues" => "1",
                    "showpercentintooltip" =>  "0",
                    "plottooltext" => 'Điểm : $label
            - Số lượng : $datavalue',
                    "theme" =>  "fint"
            ));
            $arrData["data"] = array();
            
            while($row1 = mysql_fetch_array($result1)){
                array_push($arrData["data"], array(   
                "label" => $row1["diem"],
                "value" => $row1["sohv"]
                )
                );
              //  echo "Mức độ " . $row1["MucDo"] . " có ".$row1["sohv"]." đánh giá <br>";
            }
            $jsonEncodedData = json_encode($arrData);
            $columnChart = new FusionCharts("pie3D", $count , 600, 300, $row["MaMH"], "json", $jsonEncodedData);
            $count++;
            $columnChart->render();
        } else {
            echo "Không có dữ liệu môn học";
        }
      //  echo $row["MaTC"] ." - ";
    }
        echo '<h4>Copyright MRT Group - '.date("Y").'</h4></div>';
} else {
    echo 'Báo cáo tổng hợp cho khóa học '.$kh.' - chứng chỉ '.$macc.' không tồn tại ';
}
    
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

/*
 Create an object for the column chart using the FusionCharts PHP class constructor. 
 Syntax for the constructor is 
 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
 Because we are using JSON data to render the chart, the data format will be `json`. 
 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
 and will be passed as the value for the data source parameter of the constructor.
*/

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
//    this.hide();
 //   $("#inputbaocao").hide();
    window.print();
}
function print(){
 /*   document.getElementById('form').style.visibility = 'hidden';
    document.getElementById('printbtn').style.visibility = 'hidden';
    window.print();
    */
       var newWindow = window.open();
        newWindow.document.write('<!DOCTYPE html><html><head>');
     //   newWindow.document.write();
        newWindow.document.write('<body><div align="center">');
        newWindow.document.write(document.getElementById("chart-1").innerHTML);
        newWindow.document.getElementById('printbtn').style.visibility = 'hidden';
      //  newWindow.document.write(document.getElementById("cthoadon").innerHTML);
        newWindow.document.write("</div></body></html>");
        newWindow.print();
       // window.print(); 
    }
</script>

</body> 
</html>

