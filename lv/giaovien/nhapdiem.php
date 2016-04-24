<meta charset="utf-8">
<?php

if(!isset($_GET["malop"])|| !isset($_GET["mamh"]) || !isset($_GET["magv"]) || !isset($_GET["makh"])){
    header ("Location: http://luanvan.local");
}else 
    echo $_GET["malop"]." - ".$_GET["mamh"]." - ".$_GET["magv"]." - ".$_GET["makh"];

?>
<?php 
//$connect = mysqli_connect("127.0.1.1", "root", "", "mrt") or die("Bla bla bla ");
//require_once 'connect.php';
error_reporting(0);
if(isset($_POST["export_excel"])){
    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
 //   $sql="select * from blog";
//    $query=mysql_query($sql) or die("Khong the select");
        if(isset($_POST['export_excel'])){
            $sql="select * from blog";
            $result=mysql_query($sql) or die("Khong the select");
            if(mysql_num_rows($result)>=1){
                $file="export/" . strtotime(now) . ".csv";
                $openFile = fopen($file, "w");
             //   echo $file;
                echo "Export Processing<br>";
                $allData=mysql_fetch_assoc($result);
                $line=0;
                foreach($allData as $name => $value){
                    $line++;
                    if($line<3){
                        $label .= $name . ',';
                    } else {
                        $label .= $name . "\n";
                    }
                } 
            
            $result1=mysql_query($sql) or die("Khong the select");
                while($allData1=mysql_fetch_assoc($result1)){
                $dataValue .= $allData1["id"].','.$allData1["blog"].','. $allData1["created"] . "\n";
                };
                fputs($openFile, $label . $dataValue);
                //echo $label . $dataValue;
                echo "<a href='$file'>Download a Excel File here</a>";
        /*        foreach($allData as $name => $value){
                $line++;
                    if($line<3){
                        $label .= $name . ",";
                    } else {
                        $label .= $name . "\n";
                    }
                }       
                $result1=mysql_query("select * from blog") or die("Khong the select");
                while ($allData2 = mysql_fetch_array($result1)){
                    $dataValue = $allData2["id"] .",". $allData2["blog"] .",". $allData2["created"];
                }
                fputs ($openFile, $label . $dataValue); */
            } else echo "Dont have data in DB";
        }
}
?>
<?php 
    if(isset($_POST["Import"])){
        $magv ='PV1';
        $mamh='LI';
        $makh ='8';
        $macc='A';
        $date = date("Y-m-d");
        
        if(!empty($_FILES["excelFile"]["tmp_name"])){
            $tenfile = $_FILES["excelFile"]["name"];
           // echo $tenfile;
            $fileName = explode('.',$tenfile);
          //  $fileName = explode(".", strtolower($_FILES['excelFile']['name']));
        //   $fileName = explode(".", $_FILES["excelFile"]["tmp_name"]);
         //   echo $fileName[1];
           if($fileName[1] == "csv"){
                echo "Processing!!!";
          $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
            mysql_select_db("mrt",$conn); 
            mysql_query("set names 'utf8'",$conn);
            echo "Mã giáo viên: ".$magv . "<br>";
            echo "Mã môn học: ".$mamh . "<br>";
            echo "Mã khóa học: ".$makh . "<br>";
            echo "Mã chứng chỉ: ".$macc . "<br>";
            echo "Ngày : ".$date . "<br>";
                $file = $_FILES["excelFile"]["tmp_name"];
                $openFile =fopen($file, "r");
                $number=0; while($dataFile=fgetcsv($openFile, 3000, ";")){
                $number++;
                $mahv=$dataFile[0];
                $tenhv=$dataFile[1];
                $diemso=$dataFile[2];
               
                if($number!=1){
                 //    echo $mahv ." - ". $tenhv." - ". $diemso;
                     mysql_query("insert into diemso values('".$magv."','".$mamh."','".$makh."','".$mahv."','".$macc."','".$date."','".$diemso."')");
                }
                } echo 'Đã nhập điểm từ file thành công!';
            } else {
                echo "Bạn phải chọn file csv để nhập điểm vào";
            }
        } else echo "Bạn phải chọn một file để nhập điểm vào";
       // echo "clicked!";
    } 
?>
 <form action="" method="post" enctype="multipart/form-data"> 
     <input type="file" name="excelFile"><input type="submit" name="Import" value="Nhập điểm">
     <input type=submit name="export_excel" value="Tải dữ liệu excel của bảng"></form>
     <a href="maunhapdiem.csv">Tải mẫu nhập điểm tại đây</a>