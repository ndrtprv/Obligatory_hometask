<?php
	include "db_conn.php";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (!empty($_POST['email']) && !empty($_POST['passwd'])) {
			$email = $_POST['email'];
			$passwd = $_POST['passwd'];
			$query = "SELECT COUNT(*) amount from user where login='$email' AND passwd='$passwd'";
			$res = mysqli_query($conn, $query);
			$num = 0;
			while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
				$num = $row['amount'];
			}
			if ($num != 0) {
				setcookie('user',$email,time() + 3600 * 24,'/');
				header('Location: index.php');
			} else {
				header('Location: log_in.php?message=Неправильний логін/пароль!');
			}
		} else {
			header('Location: log_in.php?message=Є незаповнені поля!');
		}
	}
?>