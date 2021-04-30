<?php session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
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
    $id = $_GET['id'];
    $sql="SELECT * FROM `product` WHERE `id`= ".$id;
    $result = $con->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $info = $data[0];
    $errors = [];
    $kq = "";
    $err_title = "";
    $err_price = "";
    $err_image = "";
    if(isset($_POST['POST'])) {
        $demo = true;
        $title = $_POST['title'];
        $price = $_POST['price'];

        if(empty($_POST['title'])) {
            $err_title = "vui long nhap title";
            $demo = false;
        }
        if(empty($_POST['price'])) {
            $err_price = "vui long nhap price";
            $demo = false;
        }
        if(empty($_POST['image'])) {
            $err_image = "vui long chon image";
            $demo = false;
        }
        if (!empty($_FILES['image']['name']))
        {
            if ($_FILES['image']['error'] > 0)
            {
                $err_image = 'File Upload Bị Lỗi';
                $demo = false;
            }
            else{
                if ($_FILES['image']['size'] > 1048576 ) {
                    $err_image = 'File Upload Lớn hơn 1mb.';
                    $demo = false;
                }

                $mang_tam = explode('.', $_FILES['image']['name']); 
                
                $kt = array('jpg','png','jpeg','JPG','PNG','JPEG');
                
                if (!in_array($mang_tam[1], $kt))
                {
                    $err_image =  "File khong dung dinh dang";
                    $demo = false;
                }
            }
        } else {
            $err_image = "vui long chon anh";
            $demo = false;
        }
        if ($demo == true) {   

            $sql = "UPDATE `product` SET 
            `title` ='".$_POST['title']."', 
            `price` ='".$_POST['price']."',
            `image` ='".$_FILES['image']['name']."'
             WHERE `id` = ".$_GET['id'];

            if ($result = $con->query($sql)) {
                move_uploaded_file($_FILES['image']['tmp_name'], './upload/'.$_FILES['image']['name']);

                $kq = "<h1>Chỉnh sửa thông tin product thành công Click vào <a href='myproduct.php'>đây</a> để về trang danh sách</h1>";
            }else{
                $kq = "<h1>Có lỗi xảy ra Click vào <a href='myproduct.php'>đây</a> để về trang danh sách</h1>";
            }
        }
    }
    ?>
        <form action="" method="POST">
            <h1>Edit Product</h1>
            <div class="form-group">
                <input type="text" name="title" value=<?php echo $info['title'] ?>><span>Title: </span>
                <p><?php echo $err_title;?></p>
            </div>
            <div class="form-group">
                <input type="text" name="price" value=<?php echo $info['price'] ?>><span>Price: </span>
                <p><?php echo $err_price;?></p>
            </div>
            <div class="form-group">
                <input id="image" type="file" name="image" value=<?php echo $info['image'] ?>><span>Image: </span>
                <p><?php echo $err_image;?></p>
            </div><br>
            <div class="form-group">
                <button type="submit" name="POST">Cập nhật</button>
                <!-- <button type="reset">Reset</button> -->
                <a href="myproduct.php"><button type="button">Cancle</button></a>
            </div>
            <p><?php echo $kq;?></p>
        </form>
    </body>
</html>