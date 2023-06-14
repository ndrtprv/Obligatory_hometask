<?php
	if (isset($_COOKIE['user'])){
		setcookie('user',$_COOKIE['user'],time() - 3600 * 24,'/');
		header('Location: index.php');
	}
	if (isset($_COOKIE['admin'])){
		setcookie('admin',$_COOKIE['admin'],time() - 3600 * 24,'admin_panel.php');
		header('Location: index.php');
	}
?>