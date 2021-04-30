<?php session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style type="text/css">
            button{
                margin-right: 20px;
                padding: 5px;
            }
            form{
                width: 600px;
                margin: auto;
                text-align: center;
            }
            div.form-group{
                width: 90%;
                height: 24px;
                margin: 5px;
            }
            div.form-group input{
                float: right;
                height: 20px;
                width: 400px;
            }
            span{
                font: 18px bold;
                font-weight: bold;
                float: right;
                margin-right: 10px; 
            }
            h1{
                text-align: center;
            }
        </style>
</head>
<body>
	<?php
	include 'connect.php';
	$data = $_POST;
	$errors = [];
	$kq = "";
	$err_email = "";
	$err_pass = "";
	$err_name = "";
	$err_avatar = "";

	if(isset($_POST['post'])) {
		$demo = true;
        $email = $_POST['EMAIL'];
        $pass = $_POST['PASSWORD'];
        $name = $_POST['NAME'];
        $avatar = $_POST['AVATAR'];

		if(empty($_POST['EMAIL'])) {
            $err_ten = "vui long nhap email";
            $demo = false;
        }
        if(empty($_POST['PASSWORD'])) {
            $err_ten = "vui long nhap password";
            $demo = false;
        }
        if(empty($_POST['NAME'])) {
            $err_ten = "vui long nhap name";
            $demo = false;
        }
        if(empty($_POST['AVATAR'])) {
            $err_ten = "vui long nhap avatar";
            $demo = false;
        }
		if ($_POST['EMAIL'] != '' && 
            $_POST['PASSWORD'] != '' && 
            $_POST['NAME'] != '' && 
            $_POST['AVATAR'] != ''
           )  
		{	
				//Thêm mới cầu thủ
			    //Viết câu SQL lấy tất cả dữ liệu trong bảng user
			$sql = "INSERT INTO userlogin
			(EMAIL, PASSWORD, NAME, AVATAR) 
			VALUES ('".$data['EMAIL']."',
        			'".$data['PASSWORD']."',
        			'".$data['NAME']."',
        			'".$data['AVATAR']."');";
	            //Chạy câu SQL
			if ($result = $con->query($sql)) {
				echo "<h1>Thêm mới user thành công Click vào <a href='index.php'>đây</a> để về trang danh sách</h1>";
			}else{
				echo "<h1>Có lỗi xảy ra Click vào <a href='index.php'>đây</a> để về trang danh sách</h1>";
			}
		}
	}
?>
	<h2>ADD CAU THU</h2>
	<form id= "up" action="" method="POST" enctype="multipart/form-data">
		<h1>Thêm User</h1>
		<div class="form-group">
            <input type="text" name="EMAIL"><span>Email: </span>
        </div>
		<p><?php echo $err_email;?></p>
		<br>
		<div class="form-group">
            <input type="text" name="PASSWORD"><span>Password: </span>
        </div>
		<p><?php echo $err_pass;?></p>
		<br>
		<div class="form-group">
            <input type="text" name="NAME"><span>Name: </span>
        </div>
		<p><?php echo $err_name;?></p>
		<br>
		<div class="form-group">
            <input type="text" name="AVATAR"><span>Avatar: </span>
        </div>
		<p><?php echo $err_avatar;?></p>
		<br>
		<div class="form-group">
			<button type="submit" name="post">Thêm</button>
		</div>
		<p><?php echo $kq;?></p>
	</form> 
</body>
</html>