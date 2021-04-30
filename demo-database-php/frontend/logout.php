<?php session_start(); 
 
if (isset($_SESSION['user'])){
    unset($_SESSION['user']); // xóa session login
    header("Location: http://localhost/php/demo-database-php/frontend/index.php");
}
?>
<!-- <a href="index.php">HOME</a> -->
