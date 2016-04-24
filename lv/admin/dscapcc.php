
<!DOCTYPE html>
<html>
<head>
	<title>Quản lý danh sách cấp chứng chỉ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style>
        body {
        background: #ffffff url("img/img.jpg") no-repeat;
        }
        .jumbotron { 
        background-color: #3399CC; /* Orange */
        color: #ffffff;
        heith: 200px;
        #tb1 {
        padding: 10px;
        border: 0px solid;
        margin: 20px;
        width:900px ;
        }
        #panel1{
            max-width: 60%; display: block;
        }
            
       #panel2{
            max-width: 40%; display: block;
             max-height: 50%; display: block;
        }
            
       #panel2{
             max-width: 40%; display: block;
             max-height: 50%; display: block;
        }
      <!--  #panel1 {width: 1000px;}  -->
      </style>
</head>
<body>

    <div id="input" class="container text-left">
        <h3> <a href="http://luanvan.local/admin.php"><button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-home"></span> Trang chủ
            </button></a><hr></h3> 
            <form action="" method="post" enctype="multipart/form-data" class="form-group">
            
                <div class="row text-center">
                    <fieldset>
                        <legend><strong>Tìm danh sách cấp chứng chỉ theo khóa, ngôn ngữ, chứng chỉ</strong></legend>
                    <div class="col-sm-4">
            
                             Khóa học: <input name="khoahoc" list="khoahoc"  >
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
                            </datalist><br><br>
                           
                            <br>
                        
                    </div>
                    <div class="col-sm-4">
                         Chọn ngôn ngữ: <input class="text-center" name="ngonngu" list="ngonngu" >
                             <datalist id="ngonngu">
                            <?php 
                            $sql = 'select * from ngonngu';
                            $result = mysql_query($sql) or die("Không thể select ngôn ngữ");
                            if(mysql_num_rows($result)>0){
                                while($row = mysql_fetch_array($result)){
                                    echo '<option value="'.$row["mann"].'"> '.$row["tennn"].' </option>';
                                }
                            } else {
                                echo "Không có ngôn ngữ nào trong CSDL";
                            }
                            ?>
                             </datalist><br><br><input class="btn btn-primary" type="submit" name="yes" value="Tìm kiếm">
                         <input class="btn btn-default" type="reset" name="reset" value="Reset">
                            
                    
                    </div>
                        <div class="col-sm-4">
                
                             Chọn chứng chỉ: <input class="text-center" name="cc" list="cc" >
                             <datalist id="cc">
                            <?php 
                            $sql = 'select * from chungchi';
                            $result = mysql_query($sql) or die("Không thể select cc");
                            if(mysql_num_rows($result)>0){
                                while($row = mysql_fetch_array($result)){
                                    echo '<option value="'.$row["macc"].'"> '.$row["tencc"].' </option>';
                                }
                            } else {
                                echo "Không có cc nào trong CSDL";
                            }
                            ?>
                             </datalist> <br><br>
                    
                    </div>
                     </fieldset>
                </div>
                <br><br>
                
                    
                </form>
    </div>
    <div class="container text-left"  id="kq" >  
        <div id="nv" class="container text-center"></div>
<?php
if(isset($_POST["yes"])){
    $khoahoc = $_POST["khoahoc"];
    $ngonngu = $_POST["ngonngu"];
    $chungchi = $_POST["cc"];
    $sql = 'select d.MaHV, h.TenHV, h.NgaysinhHV, h.GioiTinhHV, h.DiaChiHV, h.SDTHV from dscapcc d join hocvien h on d.MaHV=h.MaHV where d.MaKH="'. $khoahoc.'" and d.MaNN="'.$ngonngu.'" and d.MaCC="'.$chungchi.'"';
  //  echo $sql;
    $result = mysql_query($sql) or die("Không thể select dữ liệu");
    if(mysql_num_rows($result)>0){
        echo '<h3 class=text-center> Các học viên được cấp chứng chỉ '.$chungchi.' ngôn ngữ '.$ngonngu.' khóa học '.$khoahoc.'</h3> <br>';
        echo ' <table class="table table-bordered  text-center">
          <tr>
            <th>Mã học viên</th>
            <th>Tên học viên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Chi tiết bằng cấp</th>
          </tr>
        ';
        while($row = mysql_fetch_array($result)){
          //  echo '<option value="'.$row["MaHV"].'"> '.$row["TenHV"].' </option>';
            echo '<tr>';
        
            echo '<td>'; echo $row["MaHV"];
            echo '</td>';

            echo '<td>';echo $row["TenHV"];
            echo '</td>';

            echo '<td>';echo date("d-m-Y", strtotime($row["NgaysinhHV"]));
            echo '</td>';

            echo '<td>';if($row["GioiTinhHV"]==1){echo "Nam";} else echo"Nữ";
            echo '</td>';
            
            echo '<td>';echo $row["DiaChiHV"];
            echo '</td>';

            echo '<td>';echo $row["SDTHV"];
            echo '</td>';

            echo '<td>';//echo '<a href="chitietbangcap.php?kh='.$khoahoc.'&nn='.$ngonngu.'&cc='.$chungchi.'&mahv='.$row["MaHV"].'" target="_blank"><button class="btn btn-info">Xem chi tiết bằng cấp</button></a>';
            echo '<button id="diemdanh" value="'.$row["MaHV"] .'" onclick="diemdanh1(this.value, \''.$khoahoc.'\',\''.$ngonngu.'\',\''.$chungchi.'\' )" class="btn btn-success"> Chi tiết</button>';
            echo '</td>';

            echo '</tr>';
        }
        echo '</table>';
    } else echo "Không tìn thấy thông tin!";
                          
                            
}

?>
<script>
    function diemdanh1(mahv, makh, mann, macc) {
    
       // "00" + 
    var x = mahv + ' mã kh ' + makh +'mã nn'+mann+' mã cc' + macc;
  //  if (confirm("Press a button!") == true) {
       // $("div").append(x);
        var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("nv").innerHTML = xmlhttp.responseText;
             }
        }
       // xmlhttp.open("GET", "testajax.php?mahv=" + mahv + "&makh="+makh+ "&mann="+mann+ "&macc="+macc, true);
        xmlhttp.open("GET", "chitietbangcap.php?mahv=" + mahv + "&kh="+makh+ "&nn="+mann+ "&cc="+macc, true);
        xmlhttp.send();
       
   }
  
  function diemdanh(makh, mann, macc, mahv) {
    
       // "00" + 
      var x = kh + ' đã được diểm danh <br>';
    if (confirm("Press a button!") == true) {
        $("div").append(x);
     /*   var xmlhttp = createXHR();
        xmlhttp.onreadystatechange = function() { 
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("nv").innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.open("GET", "chitietbangcap.php?kh="+makh+"&nn="+mann+"&cc="+macc+"&mahv="+mahv, true);
        xmlhttp.send(); */
    }

    }
    
    function createXHR() {
        if (window.XMLHttpRequest)
        return new XMLHttpRequest();
        else
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
</script>
</body>


