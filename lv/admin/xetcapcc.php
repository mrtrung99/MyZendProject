<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xét cấp chứng chỉ</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
  <div id="dsngonngu" class="container text-center">
        
        <h3> <a href="http://mrt.local"><button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-home"></span> Trang chủ
            </button></a></h3> <br><hr>
            <form action="" method="post" enctype="multipart/form-data" class="form-group">
                Chọn khóa học: <input name="khoahoc" list="khoahoc" required autofocus>
                    <datalist id="khoahoc">
                        <?php 
                        require 'connect.php';
                        $magv ="AV1";
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
                             </datalist>
                Chọn chứng chỉ: <input name="cc" list="cc" required autofocus>
                    <datalist id="cc">
                        <?php 
            
                        $sql1 = 'select * from chungchi';
                        $result1 = mysql_query($sql1) or die("Không thể select chứng chỉ");
                        if(mysql_num_rows($result1)>0){
                            while($row1 = mysql_fetch_array($result1)){
                                echo '<option value="'.$row1["macc"].'"> '.$row1["tencc"].' </option>';
                            }
                        } else {
                            echo "Không có chứng chỉ nào trong CSDL";
                        }  
                        ?>
                 </datalist>
                 <input type="submit" name="yes" value="Chọn">
                </form>
            
         <hr>
    </div>
    <div id="kq" class="container text-center">
<?php
     if(isset($_POST["yes"])){
         $kh = $_POST["khoahoc"];
         $cc = $_POST["cc"];
         $ngonngu= $_POST["ngonngu"];
          echo '<div class="text-center"><button class="btn btn-success" onclick="window.print();" id="printbtn">In báo cáo</button></div>';
          echo "<h4>Kết quả thi chứng chỉ ".$cc." khóa ".$kh." </h4><br>";
        //ds sinh vien dau
         $dshv = mysql_query('select d.mahv, h.TenHV,  h.NgaySinhHV, AVG(diem) as diemtb  from diemso d join hocvien h on d.mahv=h.MaHV where makh="'.$kh.'" and macc="'.$cc.'" and mann="'.$ngonngu.'" and diem>=5 group by mahv having count(mamh)=4 order by d.mahv' ) or die("Không thể học viên");
                        if(mysql_num_rows($dshv)>0){
                            
                                
                            echo "Danh sách học viên đậu";
                             echo ' <table class="table table-bordered  text-center">
                              <tr>
                                <th>Mã Học Viên</th>
                                <th>Tên Học Viên</th>
                                <th>Ngày sinh</th>
                                <th>Điểm môn 1</th>
                                <th>Điểm môn 2</th>
                                <th>Điểm môn 3</th>
                                <th>Điểm môn 4</th>
                                <th>Điểm Trung Bình</th>
                                <th>Xếp loại</th>
                              </tr>
                            ';
                            
                            while($row = mysql_fetch_array($dshv)){
                                    $diemct = mysql_query('select mamh, diem from diemso where makh="'.$kh.'" and mann="'.$ngonngu.'" and macc="'.$cc.'" and mahv="'.$row["mahv"].'" order by mamh') or die("Không thể học viên");
                                    echo '<tr>';
        
                                    echo '<td>'; echo $row["mahv"];
                                    echo '</td>';

                                    echo '<td>';echo $row["TenHV"];
                                    echo '</td>';

                                    echo '<td>';echo date("d-m-Y", strtotime($row["NgaySinhHV"]));
                                    echo '</td>';
                                    while($row1 = mysql_fetch_array($diemct)){
                                        echo '<td>';echo $row1["mamh"] ." - ". $row1["diem"];
                                        echo '</td>';
                                    }
                                    echo '<td>';echo $row["diemtb"];
                                    echo '</td>';
                                
                                    echo '<td>';
                                    if($row["diemtb"]>=5 && $row["diemtb"]<6.5){
                                        echo "Trung Bình";
                                    } else if($row["diemtb"]>=6.5 && $row["diemtb"]< 8 ){
                                        echo "Khá";
                                    } else echo "Giỏi";
                                    echo '</td>';

                                    echo '</tr>';
                            }
                            echo '</table>';

                        } else echo " Chứng chỉ bạn chọn khóa này không có học viên nào đậu";
      // Danh sach sinh vien rot                  
             $dshv1 = mysql_query('select distinct d.mahv, h.TenHV, h.NgaySinhHV from diemso d join hocvien h on d.mahv=h.MaHV where d.makh="'.$kh.'" and mann="'.$ngonngu.'" and d.macc="'.$cc.'" and d.mahv not in(select mahv from diemso where makh="'.$kh.'" and mann="'.$ngonngu.'" and macc="'.$cc.'" and diem>5 group by mahv having count(mamh)=4 ) order by mahv') or die("Không thể học viên");
             if(mysql_num_rows($dshv1)>0){  
                    echo "Danh sách học viên không đậu <br>";
                    echo ' <table class="table table-bordered  text-center">
                              <tr>
                                <th>Mã Học Viên</th>
                                <th>Tên Học Viên</th>
                                <th>Ngày sinh</th>
                                <th>Điểm môn 1</th>
                                <th>Điểm môn 2</th>
                                <th>Điểm môn 3</th>
                                <th>Điểm môn 4</th>
                              </tr>
                            ';
                    while($row = mysql_fetch_array($dshv1)){
                        // echo $row["mahv"]."-".$row["TenHV"]."<br>";
                        $diemct = mysql_query('select mamh, diem from diemso where makh="'.$kh.'" and mann="'.$ngonngu.'" and macc="'.$cc.'" and mahv="'.$row["mahv"].'" order by mamh') or die("Không thể học viên");
                                    echo '<tr>';
        
                                    echo '<td>'; echo $row["mahv"];
                                    echo '</td>';

                                    echo '<td>';echo $row["TenHV"];
                                    echo '</td>';

                                    echo '<td>';echo date("d-m-Y", strtotime($row["NgaySinhHV"]));
                                    echo '</td>';
                                    while($row1 = mysql_fetch_array($diemct)){
                                        echo '<td>';echo $row1["mamh"] ." - ". $row1["diem"];
                                        echo '</td>';
                                    }
                                    echo '</tr>';
                        
                    }
                    echo '</table>';
             }

     }   
?>
    </div>
<script>

function myFunction() {
    document.getElementById('inputbaocao').style.visibility = 'hidden';
    document.getElementById('printbtn').style.visibility = 'hidden';
//    this.hide();
 //   $("#inputbaocao").hide();
    window.print();
}
function print(){
        var newWindow = window.open();
        newWindow.document.write('<!DOCTYPE html><html><head>');
        newWindow.document.write('<body><div align="center">');
        newWindow.document.write(document.getElementById("kq").innerHTML);
        newWindow.document.getElementById('printbtn').style.visibility = 'hidden';
        newWindow.document.write("</div></body></html>");
        newWindow.print(); 
    }
</script>
</body> 
</html>

