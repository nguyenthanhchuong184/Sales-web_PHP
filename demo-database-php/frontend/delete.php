<?php
    //Kết nối databse
    include 'connect.php';
    
    //get id tren url
    $id = $_GET['id'];
    
    //Viết câu SQL lấy tất cả dữ liệu trong bảng players
    $sql = "DELETE FROM `product` WHERE `id`='".$id."'";
    // Chạy câu SQL
    if ($result = $con->query($sql)) {
        echo "<h1>Xóa product thành công Click vào <a href='myproduct.php'>đây</a> để về trang danh sách</h1>";
    }else{
        echo "<h1>Có lỗi xảy ra Click vào <a href='index.php'>đây</a> để về trang danh sách</h1>";
    }
?>