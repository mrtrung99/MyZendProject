<?php
session_start();
?>
<?php
error_reporting(0);
if(!$id){
  //   header('Location: http://mrt.local');
}
$title = 'Đây là giao diện menu chọn các chức năng của hệ thống';
//$this->headTitle($title);

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
<div class="container" id="content"><p>Chào admin <?php echo $_SESSION['id'] ?></p>
    <h1>Danh mục chức năng dành cho admin</h1>

    
                  <div class="row">
                        <div class="col-md-3">
                          <a href="http://luanvan.local/hocvien/info.php?mahv=<?php $mahv ="B1208838"; echo $mahv;?>&key=ad" class="thumbnail">
                            <p>Xem thông tin cá nhân</p>    
                            <img src="img/profile.png" alt="Xem thông tin cá nhân" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="http://mrt.local/menu" class="thumbnail">
                            <p>Cập nhật danh mục</p>    
                            <img src="img/chuongtrinhhoc.png" alt="Xem chương trình học" style="width:150px;height:150px">
                          </a>
                        </div>
                         <div class="col-md-3">
                          <a href="admin/tochucthi.php" class="thumbnail">
                            <p>Tổ chức thi</p>    
                            <img src="img/tochucthi.jpg" alt="Tổ chức thi" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="admin/lichkhaigiang.php" class="thumbnail">
                            <p>Lịch khai giảng</p>    
                            <img src="img/chuongtrinhhoc.png" alt="Xem chương trình học" style="width:150px;height:150px">
                          </a>
                        </div>
                          
                </div>
    
                <div class="row">
                        <div class="col-md-3">
                          <a href="admin/diemdanh1.php"  target="_blank" class="thumbnail">
                            <p>Chấm công giảng viên</p>    
                            <img src="img/chamcong.png" alt="Chấm công giảng viên" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="admin/thanhtoangioday.php" class="thumbnail">
                            <p>Thanh toán giờ dạy giảng viên</p>    
                            <img src="img/thanhtoan.png" alt="Thanh toán giờ dạy" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="admin/themgv.php" target="_blank" class="thumbnail">
                            <p>Thêm giảng viên mới</p>    
                            <img src="img/phanquyen.gif" alt="Phân quyền giảng viên nhập điểm" style="width:150px;height:150px">
                          </a>
                        </div>
                            <div class="col-md-3">
                          <a href="admin/themtieuchi.php" target="_blank" class="thumbnail">
                            <p>Thêm tiêu chí đánh giá</p>    
                            <img src="img/phanquyen.gif" alt="Phân quyền giảng viên nhập điểm" style="width:150px;height:150px">
                          </a>
                        </div>
                       
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-3">
                          <a href="lichthi.php" class="thumbnail">
                            <p>Phân công giảng viên coi thi</p>    
                            <img src="img/phanconggvcoithi.png" alt="Phân công giảng viên coi thi" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="admin/quanlydiemso.php" class="thumbnail">
                            <p>Quản lý điểm số học viên</p>    
                            <img src="img/quanlydiemso.png" alt="Quản lý điểm số" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="http://luanvan.local/chucnang17.php" target="_blank" class="thumbnail">
                            <p>Báo cáo tổng hợp chất lượng kết quả thi</p>    
                            <img src="img/baocaokqthi.png" alt="Báo cáo kết quả thi" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="http://luanvan.local/chucnang18.php" target="_blank" class="thumbnail">
                            <p>Báo cáo chất lượng giảng dạy Giảng viên dựa trên kết quả học viên</p>    
                            <img src="img/baocaochatluong.png" alt="Báo cáo chất lượng" style="width:150px;height:150px">
                          </a>
                        </div>
                      </div>
                    
                    
                      <hr>
                     
                          <div class="row">
                        <div class="col-md-3">
                          <a href="admin/xetcapcc.php" class="thumbnail">
                            <p>Xét kết quả cấp chứng chỉ</p>    
                            <img src="img/xetketqua.jpg" alt="Xét kết quả cấp chứng chỉ" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="admin/dscapcc.php" class="thumbnail">
                            <p>Quản lý danh sách công nhận cấp chứng chỉ</p>    
                            <img src="img/quanlyds.png" alt="Quản lý danh sách" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="admin/quanlyvanbang.php" class="thumbnail">
                            <p>Quản lý văn bằng chứng chỉ đã cấp</p>    
                            <img src="img/quanlyvanbang.png" alt="Quản lý văn bằng" style="width:150px;height:150px">
                          </a>
                        </div>
                        <div class="col-md-3">
                          <a href="admin/tracuu.php" class="thumbnail">
                            <p>Tra cứu hồ sơ đã cấp chứng chỉ</p>    
                            <img src="img/tracuu.png" alt="Tra cứu" style="width:150px;height:150px">
                          </a>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-3">
                          <a href="http://luanvan.local/chucnang35.php" target="_blank" class="thumbnail">
                            <p>Tổng hợp báo cáo số lượng chứng chỉ đã cấp theo từng loại</p>    
                            <img src="img/report.png" alt="Tổng hợp báo cáo" style="width:150px;height:150px">
                          </a>
                        </div>
                      </div> 
        <ol>
        <li><a href="http://mrt.local/menu" target="_blank">Cập nhật danh mục</a></li>
        <li><a href="admin/themtieuchi.php" target="_blank">Thêm tiêu chí đánh giá</a></li>
        <li><a href="admin/tochucthi.php" target="_blank">Tổ chức thi</a></li>
        <li><a href="admin/lichkhaigiang.php" target="_blank">Lịch khai giảng</a></li>
        <li><a href="http://luanvan.local/hocvien/info.php?mahv=<?php $mahv ="B1208838"; echo $mahv;?>&key=ad">Xem thông tin cá nhân</a></li>
        <li><a href="admin/themgv.php" target="_blank">Phân quyền, thêm giáo viên</a></li>
        <li><a href="admin/xetcapcc.php" target="_blank">Xét kết quả cấp chứng chỉ</a></li>
        <li><a href="admin/quanlyvanbang.php" target="_blank">Quản lý văn bằng chứng chỉ đã cấp</a></li>
        <li><a href="admin/tracuu.php" target="_blank">Tra cứu hồ sơ đã cấp chứng chỉ</a></li>
        <li><a href="chucnang35.php" target="_blank" >Tổng hợp báo cáo..</a></li>
        <li><a href="admin/quanlydiemso.php" target="_blank">Quản lý điểm số</a></li>
        <li><a href="admin/thanhtoangioday.php" target="_blank">Thanh toán giờ dạy</a></li>
        <li><a href="lichthi.php" target="_blank">Phân công giảng viên coi thi</a></li>
        <li><a href="admin/diemdanh1.php" target="_blank">Chấm công - điểm danh</a></li>
        <li><a href="chucnang18.php" target="_blank">Báo cáo chất lượng giảng dạy của giảng viên dựa trên kết quả học viên</a></li>
        <li><a href="chucnang17.php" target="_blank">Báo cáo tổng hợp chất lượng kết quả thi</a></li>
    </ol>
</div>
</body>
</html>


