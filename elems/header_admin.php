<header class="p-3 text-bg-dark">
	<div class="container">
		<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
			<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
				<li><img src="img/logo.png" /></li>
			</ul>
			
			<div class="text-end">
				<?php
					if (isset($_COOKIE['admin'])):
				?>
				<button type="button" class="btn btn-outline-light me-2" onClick='location.href="logout.php"'>Вийти з панелі</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>