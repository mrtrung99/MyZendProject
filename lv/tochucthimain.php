
<!DOCTYPE html>
<html>
<head>
	<title>Tổ chức thi</title>
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
        max-height: 200px;
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
    
    <div class="container text-center">
        <h4>Kế hoạch tổ chức thi dự kiến theo từng khóa</h4><br><hr>
        <div class="text-left"><strong>1. Danh sách khóa thi</strong> <br> <br></div>    
<?php 
require 'connect.php';
$sql = 'SELECT DISTINCT makhoathi FROM tochucthi';
$result = mysql_query($sql) or die("Không thể select khóa thi");
if(mysql_num_rows($result)>0){
   // echo "<h4>Kế hoạch tổ chức thi dự kiến theo từng khóa</h4><br><hr> 1. Danh sách khóa thi <br> <br>";
    echo ' <table class="table table-bordered  text-center">
      <tr>
        <th>Khóa thi</th>
        <th>Các chứng chỉ thi trong khóa</th>
        <th>Thời gian đăng ký</th>
        <th>Thời gian thi</th>
        <th>Thời gian nhận chứng chỉ</th>
        <th>Địa điểm liên hệ</th>
      </tr>
    ';
    while($row = mysql_fetch_array($result)){
   // echo "".$row["makhoathi"]. '<br>';
        $result1 = mysql_query('select * from tochucthi t join truso s on t.truso=s.MaTS where t.makhoathi="'.$row["makhoathi"].'" ') or die("Không thể select thông tin khóa thi!");
        $result2 = mysql_query('select distinct c.macc from tochucthi t join chungchi_khoathi c on t.makhoathi=c.makhoathi  where t.makhoathi="'.$row["makhoathi"].'" ') or die("Không thể select các chứng chỉ của khóa");
        if(mysql_num_rows($result1)>0){
            if(mysql_num_rows($result2)>0){
                while($row1=mysql_fetch_array($result1)){
                echo '<tr>';

                echo '<td>';echo $row1["makhoathi"];
                echo '</td>';

                echo '<td>';
                    while($row2=mysql_fetch_array($result2)){
                        echo $row2["macc"]." &nbsp&nbsp&nbsp";
                    }
                echo '</td>';

                echo '<td>';echo "Từ ".date("d-m-Y", strtotime($row1["tgbddk"]))." đến ".date("d-m-Y", strtotime($row1["tgktdk"]));
                echo '</td>';

                echo '<td>';echo "Từ ".date("d-m-Y", strtotime($row1["ngaybdthi"]))." đến ".date("d-m-Y", strtotime($row1["ngayktthi"]));
                echo '</td>';

                echo '<td>';echo "Từ ".date("d-m-Y", strtotime($row1["bdphatcc"]))." đến ".date("d-m-Y", strtotime($row1["ktphatcc"]));
                echo '</td>';

                echo '<td>';echo $row1["TenTS"];
                echo '</td>';

                echo '</tr>';
                }
            }
        }
    } 
    echo '</table>';
} else echo "Không có khóa học nào trong CSDL";
     
?>
        <hr>
    <div class="text-left">
        <strong> 2. Hồ sơ đăng ký kiểm tra </strong><br>
         Ngoài các hồ sơ yêu cầu thì ứng viên còn phải điền vào <a href="dondk.pdf" target="_blank">mẫu đơn đăng ký</a>.
   <!-- <a href="hoso.php" target="_blank">Nhấp vào đây để xem danh sách hồ sơ theo từng loại chứng chỉ</a> <br> -->
    <div class=text-center>
<?php
    $result = mysql_query('select distinct c.macc, c.tencc from hoso_cc h join chungchi c on h.macc=c.macc') or die("Không thể select chứng chỉ");
    if(mysql_num_rows($result)>0){
            while($row=mysql_fetch_array($result)){
                 echo "".$row["macc"] ." - ".$row["tencc"]."<br>";
                 $result1 = mysql_query('select distinct h.TenHS, c.soluonghs from hoso h join hoso_cc c on h.MaHS=c.mahs where c.macc="'.$row["macc"].'"') or die("Không thể select hồ sơ");
                if(mysql_num_rows($result1)>0){
                    echo ' <table class="table table-bordered  text-center">
                          <tr>
                            <th>Hồ sơ</th>
                            <th>Số lượng</th>
                          </tr>
                        ';
                    while($row1=mysql_fetch_array($result1)){
                        echo '<tr>';
                        echo '<td>';echo $row1["TenHS"];
                        echo '</td>';
                        echo '<td>';echo $row1["soluonghs"];
                        echo '</td>';
                        echo '</tr>';

                    }
                    echo '</table>';
                }
            }
    }
?>
        </div>
        <hr>
        <strong> 3. Lệ phí thi</strong> <br>
        Lệ phí thi được quy định trong file sau: <br>
    </div>
        <div id="pdf" class="container text-center">
        <embed src="test.pdf" width="90%" height="800" type='application/pdf'>

        </div> 
     <hr>
        <div class="text-left"><strong>  4. Thời gian làm việc </strong><br>
    -    Sáng: từ 7:30 đến 10:30 <br>

    -    Chiều: từ 13:30 đến 16:30  <br>
     <hr>
            <strong> 5. Lưu ý</strong> <br>
    -  Sau khi thí sinh đăng ký dự kiểm tra, Trung tâm không giải quyết chuyển ngày kiểm tra hoặc hoàn trả lệ phí dự kiểm tra cho thí sinh.<br>

-   Khi đăng ký dự kiểm tra, Trung tâm Ngoại ngữ đề nghị thí sinh:<br>

+ Đọc kỹ các thông tin trong phiếu báo dự thi và điều chỉnh sai sót (nếu có).<br>

+ Nắm rõ qui chế về việc kiểm tra và cấp Chứng chỉ Ngoại ngữ hiện hành của Trung tâm Ngoại ngữ Trường Đại học Cần Thơ (<a href="quychetochuc.pdf" target="_blank">Quy chế tổ chức thi</a>)<br>

- Sinh viên được miễn các học phần Anh văn căn bản nếu có Chứng chỉ Ngoại ngữ do Trung tâm Ngoại ngữ Trường ĐHCT cấp (<a href="quydinh.pdf" target="_blank">Quy định</a>)
      </div>
      <br>
</div>
</body>
</html>

