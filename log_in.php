<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Увійти</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	</head>
	<body class="log_body">
		<main class="main">
			<?php
				if (isset($_GET['message'])):
			?>
			<h6 style="color: red; font-weight: bold;"><?php echo $_GET['message'];?></h6>
			<?php endif; ?>
			<button type="button" class="btn btn-primary btn-block mb-4" onClick='location.href="index.php"'>На головну</button>
			<form method="post" class="log_form" action="check_login.php">
				<center>
					<div class="form-outline mb-4">
						<input type="email" id="email" name="email" class="form-control" />
						<label class="form-label" for="form2Example1">Email адреса</label>
					</div>

					<div class="form-outline mb-4">
						<input type="password" id="passwd" name="passwd" class="form-control" />
						<label class="form-label" for="form2Example2">Пароль</label>
					</div>

					<input type="submit" class="btn btn-primary btn-block mb-4" value="Увійти" /><br>
					<button type="button" class="btn btn-link btn-block mb-4" onClick='location.href="sign_up.php"'>Зареєструватися</button>
				</center>
			</form>
		</main>
		<?php require "elems/footer.php"?>
	</body>
</html>