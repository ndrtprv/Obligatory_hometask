<header class="p-3 text-bg-dark">
	<div class="container">
		<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
			<a href="http://localhost/ex_files/OHT/index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
				<img src="img/logo.png" />
			</a>

			<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
				<li><a href="http://localhost/ex_files/OHT/index.php" class="nav-link px-2 text-secondary">Головна</a></li>
				<li class="nav-item dropdown">
					<a id="dr" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" onClick='clickMen()'>Каталог</a>
					<ul id="myUl" class="dropdown-menu">
						<?php
							include "db_conn.php";
							$query="SELECT COUNT(*) amount from Category";
							$res=mysqli_query($conn, $query);
							$n = 0;
							while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
								$n = $row['amount'];
							}
							for($i = 0; $i < $n; $i++):
								$query="SELECT cat_name from Category where cat_id=$i + 1";
								$res=mysqli_query($conn, $query);
								$desc = '';
								$loc = 'location.href=""';
								while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
									$desc=$row['cat_name'];
								}
								if ($i + 1 == 1) {
									$loc = "http://localhost/ex_files/OHT/clothes.php";
								} else if ($i + 1 == 2) {
									$loc = "http://localhost/ex_files/OHT/shoes.php";
								} else {
									$loc = "http://localhost/ex_files/OHT/accessories.php";
								}
						?>
						<li><a class="dropdown-item" href=<?php echo "$loc";?>><?php echo "$desc";?></a></li>
						<?php endfor; ?>
						<script src="js/script.js"></script>
					</ul>
				</li>
				<li><a href="http://localhost/ex_files/OHT/contact.php" class="nav-link px-2 text-white">Контакти</a></li>
			</ul>

			<div class="text-end">
				<?php
					if (isset($_COOKIE['user'])):
				?>
				<button type="button" class="btn btn-outline-light me-2" onClick='location.href="cart.php"'>Кошик</button>
				<button type="button" class="btn btn-outline-light me-2" onClick='location.href="logout.php"'>Вийти</button>
				<?php else: ?>
				<button type="button" class="btn btn-outline-light me-2" onClick='location.href="log_admin.php"'>Увійти як адмін</button>
				<button type="button" class="btn btn-outline-light me-2" onClick='location.href="log_in.php"'>Увійти</button>
				<button type="button" class="btn btn-warning" onClick='location.href="sign_up.php"'>Зареєструватися</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>