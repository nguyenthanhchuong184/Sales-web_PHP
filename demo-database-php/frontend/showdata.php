<?php session_start();
		include 'connect.php';

		$id = $_GET['getId'];

		$sql = "SELECT * FROM `product` WHERE `id`='".$id."'";

		$result = $con->query($sql);

		$data = [];
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
		}
		$image = $data[0]['image'];
		$price = $data[0]['price'];
		$title = $data[0]['title'];
		$id = $data[0]['id'];
		$qty = 1;

		$product = array('image' => $image,
			'price' => $price,
			'title' =>  $title,
			'qty' => $qty,
			'id' => $id);

		$dataQty = 1;
		if(!empty($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $key => $value) {
				//echo $key;
				//tang qty
				if ($id == $key) {
					//echo $_SESSION['cart'][$key]['qty'];
					$_SESSION['cart'][$key]['qty'] += 1;
					$dataQty = 0;
				}
			}
		}
		if($dataQty == 1){
			$_SESSION['cart'][$id] = $product;
		}
		//$_SESSION['cart'] = $data;
		echo "<pre>";
		var_dump($_SESSION['cart']);
		echo "</pre>";
	?>
	<!-- co id 
viet cau lenh  sql de lay all thong tin thang product co id

=> tao arr => ss -->
