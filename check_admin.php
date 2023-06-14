<?php
	include "db_conn.php";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (!empty($_POST['email']) && !empty($_POST['passwd'])) {
			$email = $_POST['email'];
			$passwd = $_POST['passwd'];
			$query = "SELECT COUNT(*) amount from admin where login_ad='$email' AND passwd_ad='$passwd'";
			$res = mysqli_query($conn, $query);
			$num = 0;
			while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
				$num = $row['amount'];
			}
			if ($num != 0) {
				setcookie('admin',$email,time() + 3600 * 24,'admin_panel.php');
				header('Location: admin_panel.php');
			} else {
				header('Location: log_admin.php?message=Неправильний логін/пароль!');
			}
		} else {
			header('Location: log_admin.php?message=Є незаповнені поля!');
		}
	}
?>