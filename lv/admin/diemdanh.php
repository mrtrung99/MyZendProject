<!DOCTYPE html>
<html>
<head>
	<title>Điểm danh giảng viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
    $("p").click(function(){
        $(this).hide();
    });
    });
        /*
$(document).ready(function(){
    $("#khoa").click(function(){
        alert("The text has been changed.");
       // $("#ngay").disabled = false;
    });
    
});   */
        
    $(document).ready(function(){
 /*   $("button").click(function(){
       // $("#ngay").disabled = false;
        $("#ngay").prop('disabled', false);
    }); */
    $("input").change(function(){
       // $("#ngay").disabled = false;
        $("#ngay").prop('disabled', false);
    });    
     $(document).ready(function(){
    $("button").click(function(){
       // $("#ngay").disabled = false;
        $("#diemdanh").prop('disabled', true);
    });   
    });

</script>
</head>
<body>
<p>If you click on me, I will disappear.</p>
<p>Click me away!</p>
<p>Click me too!</p>

<?php 
    $dayweek = date("l");
  //  $dayweek ="Sunday";
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
    echo '</div>';

    $conn=mysql_connect("localhost", "root", "") or die("can't connect database");
    mysql_select_db("mrt",$conn); 
    mysql_query("set names 'utf8'",$conn);
    $result=mysql_query('select g.magv, g.tengv from ctdaylop c join giangvien g on c.magv = g.magv where thu="'.$dayweek.'"') or die("Khong the select phong");
    if(mysql_num_rows($result)>0){
      //  echo "Danh sách giáo viên hôm nay có lịch dạy là: <br><hr>";
        echo '<div class="container">';
        echo '<table class="table table-striped">';
        echo '<tr><th>Mã giảng viên</th><th>Tên giảng viên</th><th>Điểm danh</th><th>Dạy thế</th></tr>';
        while($row = mysql_fetch_array($result)){
            echo "<tr>";
            echo "<td>";
            echo $row["magv"]."<br>";
            echo "</td>";
            echo "<td>";
            echo $row["tengv"]."<br>";
            echo "</td>";
            echo "<td>";
            echo '<button id="diemdanh" value="'.$row["magv"] .'" onclick="diemdanh(this.value)" class="btn btn-success"> Điểm danh </button><button onclick= "xoanv( ' . $row["magv"] . ')" class="btn btn-danger"> Xóa </button>';
            echo "</td>";
            echo "<td>";
            echo '<button value="'.$row["magv"] .'" onclick="daythe(this.value)" class="btn btn-primary"> Dạy thế </button>';
            echo "</td>";
            echo "/<tr>";
        }
        echo "</table> "?>
<?php
    echo "</div>";
    } else echo "Hôm nay không có giáo viên nào có lịch dạy";
?>
    
<script>
    function diemdanh(magv) {
    
       // "00" + 
    var x = manv;
    if (confirm("Press a button!") == true) {
        $("div").append(x);
        var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("nv").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("GET", "delnv.php?manv=" + x, true);
        xmlhttp.send();
       

    }
    
    else {
        alert("You pressed cancel")
    }
   //document.getElementById("hienthi").innerHTML = x;
    }
    
    function xoanv(manv) {
    
       // "00" + 
    var x = manv;
    if (confirm("Press a button!") == true) {
        $("div").append(x);
        var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("nv").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("GET", "delnv.php?manv=" + x, true);
        xmlhttp.send();
       

    }
    
    else {
        alert("You pressed cancel")
    }
   //document.getElementById("hienthi").innerHTML = x;
    }
    
    
    function suanv(manv) {
    
       // "00" + 
    //var x = manv;
    if (confirm("Press a button!") == true) {
       // $("div").append(x);
        var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("nv").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("GET", "suanv.php?manv=" + manv, true);
        xmlhttp.send();
       
    }
    
    else {
        alert("You pressed cancel")
    }
   //document.getElementById("hienthi").innerHTML = x;
    }
      function update(manv) {

        var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("demo").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("GET", "updatestaff.php?manv=" + manv, true);
        xmlhttp.send();

    }
    
    
    
    function del_nv(manv){
        $("table").hide();
        var x =  manv;
        var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("demo").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("POST", "delnv.php?manv=" + manv, true);
        xmlhttp.send();
    }

     function createXHR() {
        if (window.XMLHttpRequest)
        return new XMLHttpRequest();
        else
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
</script>
    <p id="demo">
    </p>
</body>
</html>