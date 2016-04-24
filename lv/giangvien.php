<?php
session_start();
$_SESSION['id']="AV1"
?>
<?php

$title = 'Đây là giao diện menu chọn các chức năng của hệ thống';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container" id="content"><p>Chào giảng viên <?php echo $_SESSION['id']; ?></p>
    <h1>Danh mục chức năng dành cho giảng viên</h1>
  

                      <hr>
                      <div class="row">
                        <div class="col-md-3">
                          <a href="http://luanvan.local/hocvien/info.php?mahv=<?php echo $_SESSION['id'];?>&key=gv" class="thumbnail">
                            <p>Xem thông tin cá nhân</p>    
                            <img src="img/profile.png" alt="Xem thông tin cá nhân" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="giaovien/diem1.php" class="thumbnail">
                            <p>Nhập điểm</p>    
                            <img src="img/quanlydiemso.png" alt="Quản lý điểm số" style="width:150px;height:150px">
                          </a>
                        </div>
                      <div class="col-md-3">
                          <a href="giaovien/ketquadanhgia.php" target="_blank" class="thumbnail">
                            <p>Xem báo cáo kết quả đánh giá học viên đối với giảng viên</p>    
                            <img src="img/baocaodanhgia.png" alt="Báo cáo đánh giá" style="width:150px;height:150px">
                          </a>
                        </div>
                      
                          <div class="col-md-3">
                          <a href="http://luanvan.local/giaovien/xemlichday.php?mahv=<?php echo $_SESSION['id'];?>" class="thumbnail">
                            <p>Xem lịch dạy</p>    
                            <img src="img/lichhoc.png" alt="Xem lịch học" style="width:150px;height:150px">
                          </a>
                        </div>
                      </div>
                 
                  <div class="row">
                       
                        
                        <div class="col-md-3">
                          <a href="http://luanvan.local/giaovien/xemlichgacthi.php?mahv=<?php echo $_SESSION['id'];?>" class="thumbnail">
                            <p>Xem lịch gác thi</p>    
                            <img src="img/lichthi.png" alt="Xem lịch thi" style="width:150px;height:150px">
                          </a>
                        </div>
                      <div class="col-md-3">
                          <a href="http://luanvan.local/giaovien/dangkycoithi.php?mahv=<?php echo $_SESSION['id'];?>" class="thumbnail">
                            <p>Đăng ký coi thi</p>    
                            <img src="img/lichthi.png" alt="Xem lịch thi" style="width:150px;height:150px">
                          </a>
                        </div>
                      </div>
                     
                     
                       
     <ol>
        <li>Xem lịch gác thi</li>
        <li>Đăng ký coi thi</li>
        <li><a href="giaovien/ketquadanhgia.php" target="_self">Báo cáo kết quả đánh giả học viên với giảng viên</a></li>
        <li><a href="giaovien/diem1.php" target="_self">Nhập điểm</a></li>
        <li><a href="http://luanvan.local/hocvien/info.php?mahv=<?php $mahv ="B1208838"; echo $mahv;?>&key=gv">Xem thông tin cá nhân</a></li>
    </ol>                 
</div>
      
</body>
</html>


