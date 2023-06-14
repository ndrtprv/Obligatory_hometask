<?php
	include "db_conn.php";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['button1'])) {
			$email = $_POST['email'];
			$passwd = $_POST['passwd'];
			if (!empty(trim($email)) && !is_null($email) && !empty(trim($passwd)) && !is_null($passwd)) {
				$query = "SELECT COUNT(*) amount from user where login='$email'";
				$res = mysqli_query($conn, $query);
				$num = 0;
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					$num = $row['amount'];
				}
				if ($num == 0) {
					if (strlen($email) <= 50 && strlen($passwd) <= 35) {
						$query = "INSERT INTO user VALUES('$email','$passwd')";
						$res = mysqli_query($conn, $query);
						header('Location: admin_panel.php');
					} else {
						header('Location: admin_panel.php?message=Email і/або пароль задовгий!&source=user_oper');
					}
				} else {
					header('Location: admin_panel.php?message=Такий користувач існує!&source=user_oper');
				}
			} else {
				header('Location: admin_panel.php?message=Відсутні email і/або пароль!&source=user_oper');
			}
		} else {
			$email = $_POST['email'];
			if (!empty(trim($email)) && !is_null($email)) {
				$query = "SELECT COUNT(*) amount from user where login='$email'";
				$res = mysqli_query($conn, $query);
				$num = 0;
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					$num = $row['amount'];
				}
				if ($num != 0) {
					$query = "DELETE from user where login='$email'";
					$res = mysqli_query($conn, $query);
					header('Location: admin_panel.php');
				} else {
					header('Location: admin_panel.php?message=Такого користувача не існує!&source=user_oper');
				}
			} else {
				header('Location: admin_panel.php?message=Відсутній email користувача для видалення!&source=user_oper');
			}
		}
	}
?>