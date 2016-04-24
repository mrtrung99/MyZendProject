
<?php


$title = 'Đây là giao diện menu chọn các chức năng của hệ thống';
//$this->headTitle($title);
session_start();
if (!isset($_SESSION['username'])) {
	// header('Location: http://luanvan.local/dangnhap.php');
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

   
  
<div class="container" id="menu">
    <div>
    </div>
</div> 
<?php
    $magv ="AV1";
 //   $mahv = ""
    $makh=1;
    $mahv ="B1208838";
?>
<div class="container" id="content"><p>Chào học viên <?php echo $_SESSION['id']; ?></p>
    <h1>Danh mục chức năng dành cho học viên</h1>
   
  
                       
                  <div class="row">
                        <div class="col-md-3">
                          <a href="http://luanvan.local/hocvien/info.php?mahv=<?php echo $mahv;?>&key=hv" class="thumbnail">
                            <p>Xem thông tin cá nhân</p>    
                            <img src="img/profile.png" alt="Xem thông tin cá nhân" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="http://luanvan.local/hocvien/danhgiabase.php?mahv=<?php echo $mahv;?>" class="thumbnail">
                            <p>Học viên đánh giá giảng viên</p>    
                            <img src="img/danhgia.png" alt="Đánh giá" style="width:150px;height:150px">
                          </a>
                        </div>
                      
                        <div class="col-md-3">
                          <a href="http://luanvan.local/hocvien/ketqua.php?mahv=<?php echo $mahv;?>" class="thumbnail">
                            <p>Xem kết quả học tập</p>    
                            <img src="img/ketquahoctap.jpg" alt="Xem kết quả học tập" style="width:150px;height:150px">
                          </a>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                            <div class="col-md-3">
                          <a href="http://luanvan.local/hocvien/xemlichhoc.php?mahv=<?php echo $mahv;?>" class="thumbnail">
                            <p>Xem lịch học</p>    
                            <img src="img/lichhoc.png" alt="Xem lịch học" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="http://luanvan.local/hocvien/xemlichthi.php?mahv=<?php echo $mahv;?>" class="thumbnail">
                            <p>Xem lịch thi</p>    
                            <img src="img/lichthi.png" alt="Xem lịch thi" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="pulpitrock.jpg" class="thumbnail">
                            <p>Xem danh mục lớp đào tạo</p>    
                            <img src="img/chuongtrinhhoc.png" alt="Xem chương trình học" style="width:150px;height:150px">
                          </a>
                        </div>
                      
                      </div>
   <ol>
        <li> Xem lịch học</li>
        <li> <a href="http://luanvan.local/hocvien/danhgiabase.php?mahv=<?php echo $mahv;?>">Đánh giá giảng viên</a></li>
        <li> <a href="hocvien/ketqua.php" target="_blank">Xem kết quả học tập</a></li>
        <li><a href="http://luanvan.local/hocvien/info.php?mahv=<?php echo $mahv;?>&key=hv">Xem thông tin cá nhân</a></li>
    </ol>                       
                      
</div>


</body>
</html>
    