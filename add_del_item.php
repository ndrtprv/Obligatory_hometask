<?php
	if (!isset($_COOKIE['user'])) {
		header('Location: log_in.php');
	}
	include "db_conn.php";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$vl = $_POST['vl'];
		if (isset($_POST['source']) && $_POST['source'] === 'item') {
			$login = $_POST['login'];
			$item_id = $_POST['item_id'];
			$amount = $_POST['amount'];
			if (!empty(trim($amount)) && !is_null($amount)) {
				$query = "SELECT COUNT(*) amount from basket WHERE item_id=$item_id AND login='$login'";
				$res = mysqli_query($conn, $query);
				$num = 0;
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					$num = $row['amount'];
				}
				if ($num == 0) {
					if ($amount > 0) {
						$query = "INSERT INTO basket VALUES ('$login',$item_id,$amount)";
						$res = mysqli_query($conn, $query);
						header("Location: item.php?message=Товар успішно додано до кошика!&code=0&vl=$vl");
					} else {
						header("Location: item.php?message=К-ть товару має бути додатною!&code=1&vl=$vl");
					}
				} else {
					if ($amount > 0) {
						$query = "SELECT amount from basket WHERE item_id=$item_id AND login='$login'";
						$res = mysqli_query($conn, $query);
						$prev_am = 0;
						while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
							$prev_am = $row['amount'];
						}
						if ($amount != $prev_am) {
							$query = "UPDATE basket SET amount = $amount WHERE login='$login' AND item_id=$item_id";
							$res = mysqli_query($conn, $query);
							header("Location: item.php?message=К-ть товару оновлено в кошику!&code=0&vl=$vl");
						} else {
							header("Location: item.php?message=Таку к-ть товару вже установлено в кошику!&code=1&vl=$vl");
						}
					} else {
						header("Location: item.php?message=К-ть товару має бути додатною!&code=1&vl=$vl");
					}
				}
			} else {
				header("Location: item.php?message=Відсутня к-ть товару!&code=1&vl=$vl");
			}
		} else {
			$item_id = $_POST['item_id'];
			$login = $_POST['login'];
			if (!empty(trim($item_id)) && !is_null($item_id)) {
				$query = "SELECT COUNT(*) amount from basket WHERE item_id=$item_id AND login='$login'";
				$res = mysqli_query($conn, $query);
				$num = 0;
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					$num = $row['amount'];
				}
				if ($num != 0) {
					$query = "DELETE from basket where item_id=$item_id AND login='$login'";
					$res = mysqli_query($conn, $query);
					header('Location: cart.php');
				} else {
					header('Location: cart.php?message=Такого товару в кошику не існує!');
				}
			} else {
				header('Location: cart.php?message=Відсутній id товару!');
			}
		}
	}
?>