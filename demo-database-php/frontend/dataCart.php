<?php session_start();
		$id = $_GET['getId'];

		$status =  $_GET['status'];

		//kiem tra co id chua..neu co +1 	qty
		// echo var_dump($_SESSION['cart'][$id]);
		if (!empty($_SESSION['cart'][$id])) {
			if ($status == "1") {
				$_SESSION['cart'][$id]['qty'] += 1;
				echo ($_SESSION['cart'][$id]['qty']);
				exit;
			} 

			if ($status == "2") {
				$_SESSION['cart'][$id]['qty'] -= 1;
				echo ($_SESSION['cart'][$id]['qty']);
				if($_SESSION['cart'][$id]['qty'] < 1){
					unset($_SESSION['cart'][$id]);
				}
				exit;
			}

			if ($status == "3") {
				unset($_SESSION['cart'][$id]);
				echo ($_SESSION['cart']);
				//echo var_dump($_SESSION['cart']);
			}
		}
		echo "<pre>";
		echo var_dump($_SESSION['cart']);
		echo "</pre>";
?>