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
        if(!empty($_FILES["excelFile"]["tmp_name"])){
           $fileName = explode(".", $_FILES["excelFile"]["tmp_name"]);
    //        if($fileName[1] == "csv"){
                echo "Processing!!!";
          $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
            mysql_select_db("mrt",$conn); 
            mysql_query("set names 'utf8'",$conn);
                $file = $_FILES["excelFile"]["tmp_name"];
                $openFile =fopen($file, "r");
                $number=0; while($dataFile=fgetcsv($openFile, 3000, ";")){
                $number++;
                $mann=$dataFile[0];
                $tennn=$dataFile[1];
                echo $mann ." - ". $tennn;
                if($number!=1){
                    mysql_query("insert into ngonngu values('".$mann."','".$tennn."')");
                }
                }
         //   } else {
          //      echo "You must choose a csv file to import";
          //  }
        } else echo "You must choose a file!!!";
       // echo "clicked!";
    } 
?>
 <form action="" method="post" enctype="multipart/form-data"> 
     <input type="file" name="excelFile"><input type="submit" name="Import" value="Import Data from Excel">
     <input type=submit name="export_excel" value="Downexcel"></form>