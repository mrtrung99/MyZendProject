<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Trang đăng nhập</title>
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
<?php

	//Gọi file connection.php ở bài trước
	
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["dangnhap"])) {
        require("connect.php");
        $username= mysql_real_escape_string($_POST['username']);
        $password=mysql_real_escape_string($_POST['password']);
        $sql = "select * from taikhoan where taikhoan= '".$username."' and matkhau='". $password."'";
        $result = mysql_query($sql, $conn) or die("Không thể select tài khoản");
        $num_rows = mysql_num_rows($result);
        if ($num_rows==0){
            echo '<script type="text/javascript">';
            echo 'alert("Tên đăng nhập hoặc mật khẩu không đúng!")';  //not showing an alert box.
            echo '</script>';
        }else {
				while($row = mysql_fetch_array($result)){
                     $_SESSION['username'] = $username;
                     $_SESSION['id'] = $row["id"];
                    if($row["level"] == 0){
                        header('Location: http://luanvan.local/admin.php');
                    } else if($row["level"] == 1){
                        header('Location: http://luanvan.local/giangvien.php');
                    } else header('Location: http://luanvan.local/hocvien.php');  
            }        
        }    
	}
?> 
    <div class="container">
      <div id="panel" class="panel-group">
        <table width='50%'  align="center">
           <tr>
             <td>
                <div id ="panel1"class="panel panel-primary text-center">
                    <div class="panel-heading">Đăng nhập để vào hệ thống quản lý</div>
                    <div class="panel-body">
                        <form method="POST">

                        Username:   <input type="text" name="username" size="30" required> <br> <br>

                        Password:   <input type="password" name="password" size="30" required> <br> <br>

                            <button class="btn btn-default btn-md" type="submit" name="dangnhap" value="Đăng nhập">Đăng nhập</button>
                        </form>
                    </div>
                </div>
             </td>
            </tr>
        </table>
      </div>
    </div>

</body>
</html>

 
