<!DOCTYPE html>
<html>
<head>
	<title>Điểm danh giảng viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("p").click(function(){
                $(this).hide();
            });
        });
     /*   $(document).ready(function(){
            $("#diemdanh").click(function(){
                $(this).hide();
            });
        }); */
         $(document).ready(function(){
            $("button").click(function(){
                $(this).hide();
            });
        });
    </script>
</head>
<body>
<div id="chonca" class="text-center container">
<h3>Điểm danh giảng viên đi dạy</h3> <br>
<form action="" method="post" enctype="multipart/form-data">
    Chọn ca: <input  name="ca" list="ca" required>
     <datalist id="ca">
<?php
$conn=mysql_connect("localhost", "root", "") or die("can't connect database");
mysql_select_db("mrt",$conn); 
mysql_query("set names 'utf8'",$conn);
$result = mysql_query('select * from ca') or die("Không thể select ca");
if(mysql_num_rows($result)>0){
    while($row=mysql_fetch_array($result)){
                    echo '<option value="'.$row["maca"].'"> '.$row["TenCa"].' </option>';
    }
} else echo "CSDL không có mức độ nào!"
?>
    </datalist>
<input class="btn btn-success" type="submit" value="Go" name="go">
            <br><hr>
    <p id="nv"></p>

</form>
</div>
<!--    
<p>If you click on me, I will disappear.</p>
<p>Click me away!</p>
<p>Click me too!</p> -->
<?php 
if(isset($_POST["go"])){
   // $dayweek = date("l");
    $ca = $_POST["ca"];
  //  $malop = 'AV1';
    $date = date("Y-m-d");
    $dayweek ="Friday";
    echo '<div class="text-center"><br><br>';
    switch ($dayweek) {
    case "Monday":
        echo "Xin chào, hôm nay là Thứ Hai - Đầu tuần vui vẻ<br><hr>";
        break;
    case "Tuesday":
        echo "Xin chào, hôm nay là Thứ Ba - Làm việc vui vẻ<br><hr>";
        break;
    case "Wednesday":
        echo "Xin chào, hôm nay là Thứ Tư - Làm việc vui vẻ<br><hr>";
        break;
    case "Thursday":
        echo "Xin chào, hôm nay là Thứ Năm - Còn hôm nay với ngày mai nữa là được nghỉ<br><hr>";
        break;
    case "Friday":
        echo "Xin chào, hôm nay là Thứ Sáu - Cố lên sắp cuối tuần rồi<br><hr>";
        break;
    case "Saturday":
        echo "Xin chào, hôm nay là Thứ Bảy - Cuối tuần vui vẻ<br><hr>";
        break;
    case "Sunday":
        echo "Xin chào, hôm nay là Chủ nhật - Nghỉ ngơi thôi dưỡng sức mai đi làm nhé<br><hr>";
        break;
    default:
        echo "Hôm nay là cái ngày gì mà không phải là 1 trong 7 ngày trong tuần nhỉ?";
    }

    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    $result=mysql_query('select distinct g.magv, g.tengv, m.tenmh, c.MaLop from monhoc m join ctdaylop c on m.mamh=c.MaMH join giangvien g on c.magv = g.magv where thu="'.$dayweek.'" and c.MaCa="'.$ca.'" and g.magv not in(select magv FROM diemdanhgv WHERE Ngay="'.$date.'" AND MaCa="'.$ca.'")') or die("Không thể tìm giảng viên");
    if(mysql_num_rows($result)>0){
        echo "Danh sách giáo viên hôm nay có lịch dạy là: <br><hr>";
        echo '<div class="container text-center">';
        echo '<table class="table table-striped">';
        echo '<tr><th>Mã giảng viên</th><th>Tên giảng viên</th><th>Lớp học</th><th>Môn học</th><th>Điểm danh</th><th>Dạy thế</th></tr>';
        while($row = mysql_fetch_array($result)){
            echo "<tr>";
            echo "<td>";
            echo $row["magv"]."<br>";
            echo "</td>";
            echo "<td>";
            echo $row["tengv"]."<br>";
            echo "</td>";
            echo "<td>";
            echo $row["MaLop"]."<br>";
            echo "</td>";
            echo "<td>";
            echo $row["tenmh"]."<br>";
            echo "</td>";
            echo "<td>";
     //       echo '<button id="diemdanh" value="'.$row["magv"] .'" onclick="diemdanh(this.value)" class="btn btn-success"> Điểm danh </button><button onclick="xoanv(01)" class="btn btn-danger"> Xóa </button>';
            echo '<button id="diemdanh" value="'.$row["magv"] .'" onclick="diemdanh(this.value,\''.$row["MaLop"].'\',\''.$ca.'\' )" class="btn btn-success"> Điểm danh </button>';
            echo "</td>";
            echo "<td>";
          //  echo '<button value="'.$row["magv"] .'" onclick="daythe(this.value)" class="btn btn-primary"> Dạy thế </button>';
           // echo '<button id="daythe" value="'.$row["magv"] .'" onclick="diemdanh1(this.value, \''.$ca.'\' )" class="btn btn-primary"> Dạy thế </button>';
            echo '<a href="daythe.php?magv='.$row["magv"].'&ca='.$ca.'" target="_blank"><button class="btn btn-primary"> Dạy thế </button></a>';
            echo "</td>";
            echo "/<tr>";
        }
        echo "</table> "?>
<?php
    echo "</div>";
    } else echo "Hôm nay vào ca ".$ca." không có giáo viên nào có lịch dạy";
}
?>
<script>
  function xoanv(manv) {
    
       // "00" + 
    var x = manv;
    if (confirm("Press a button!") == true) {
        $("div").append(x);
       /* var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("nv").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("GET", "delnv.php?manv=" + x, true);
        xmlhttp.send(); */
       

    }   else {
        alert("You pressed cancel")
    }
   //document.getElementById("hienthi").innerHTML = x;
    }
    function diemdanh1(manv, ca) {
         //alert(manv + ca);
        var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("nv").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("GET", "daythe.php?magv=" + manv+"&ca="+ca, true);
        xmlhttp.send();
       
  /*  }
    
    else {
        alert("You pressed cancel")
    }*/
   //document.getElementById("hienthi").innerHTML = x;
    }
    
    function diemdanh(manv, malop, ca) {
    
       // "00" + 
    var x = manv + ' đã được diểm danh <br>';
  //  if (confirm("Press a button!") == true) {
        //$("div").append(x);
        var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("nv").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("GET", "diemdanhprocess.php?magv=" + manv+ "&malop="+malop+ "&ca="+ca, true);
        xmlhttp.send();
       
  /*  }
    
    else {
        alert("You pressed cancel")
    }*/
   //document.getElementById("hienthi").innerHTML = x;
    }
    
    function createXHR() {
        if (window.XMLHttpRequest)
        return new XMLHttpRequest();
        else
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
</script>
 <!--   <button onclick="xoanv(01)">Test</button> <br> -->
    
</body>
</html>