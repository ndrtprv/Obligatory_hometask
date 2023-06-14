<?php
	include "db_conn.php";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['button3'])) {
			$item_id = $_POST['item_id'];
			$cat_id = $_POST['cat_id'];
			$item_name = $_POST['item_name'];
			$price = $_POST['price'];
			if (!empty(trim($item_id)) && !is_null($item_id) && !empty(trim($cat_id)) && !is_null($cat_id) &&
				!empty(trim($item_name)) && !is_null($item_name) && !empty(trim($price)) && !is_null($price)) {
				$query = "SELECT COUNT(*) amount from items where item_id=$item_id";
				$res = mysqli_query($conn, $query);
				$num = 0;
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					$num = $row['amount'];
				}
				if ($num == 0) {
					$query = "SELECT COUNT(*) amount from category where cat_id=$cat_id";
					$res = mysqli_query($conn, $query);
					while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
						$num = $row['amount'];
					}
					if ($num != 0) {
						$query = "SELECT COUNT(*) amount from items where item_name='$item_name'";
						$res = mysqli_query($conn, $query);
						while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							$num = $row['amount'];
						}
						if ($num == 0) {
							$item_size = $_POST['item_size'];
							$descr = $_POST['descr'];
							$img_file = $_POST['img_file'];
							if (strlen($item_name) <= 80 && strlen($item_size) <= 11) {
								$query = "INSERT INTO items VALUES($item_id,$cat_id,'$item_name','$item_size','$descr',$price,'$img_file')";
								$res = mysqli_query($conn, $query);
								header('Location: admin_panel.php');
							} else {
								header('Location: admin_panel.php?message=Назва товару/розмір задовгий!&source=item_oper');
							}
						} else {
							header('Location: admin_panel.php?message=Така назва товару існує!&source=item_oper');
						}
					} else {
						header('Location: admin_panel.php?message=Такої категорії не існує!&source=item_oper');
					}
				} else {
					header('Location: admin_panel.php?message=Такий номер товару існує!&source=item_oper');
				}
			} else {
				header('Location: admin_panel.php?message=Відсутні id товару і/або категорії, і/або назви товару, і/або ціни товару!&source=item_oper');
			}
		} else {
			$item_id = $_POST['item_id'];
			if (!empty(trim($item_id)) && !is_null($item_id)) {
				$query = "SELECT COUNT(*) amount from items WHERE item_id=$item_id";
				$res = mysqli_query($conn, $query);
				$num = 0;
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					$num = $row['amount'];
				}
				if ($num != 0) {
					$query = "DELETE from items where item_id=$item_id";
					$res = mysqli_query($conn, $query);
					header('Location: admin_panel.php');
				} else {
					header('Location: admin_panel.php?message=Такого товару не існує!&source=item_oper');
				}
			} else {
				header('Location: admin_panel.php?message=Відсутній id товару!&source=item_oper');
			}
		}
	}
?>