<?php
	include "db_conn.php";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (!empty($_POST['email']) && !empty($_POST['passwd'])) {
			$email = $_POST['email'];
			$passwd = $_POST['passwd'];
			$query = "SELECT COUNT(*) amount from user where login='$email'";
			$res = mysqli_query($conn, $query);
			$num = 0;
			while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
				$num = $row['amount'];
			}
			if ($num == 0) {
				if (strlen($email) <= 50 && strlen($passwd) <= 35) {
					$query = "INSERT INTO user VALUES ('$email','$passwd')";
					$res = mysqli_query($conn, $query);
					setcookie('user',$email,time() + 3600 * 24,'/');
					header('Location: index.php');
				} else {
					header('Location: sign_up.php?message=Логін і/або пароль дуже довгий!');
				}
			} else {
				header('Location: sign_up.php?message=Такий користувач вже існує! Створіть іншого!');
			}
		} else {
			header('Location: sign_up.php?message=Є незаповнені поля!');
		}
	}
?>