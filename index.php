<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>ОДЗ</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	</head>
	<body>
		<?php require "elems/header.php"?>
		<div class="container mt-5">
			<div class="d-flex flex-wrap">
			<?php
				include "db_conn.php";
				$query="SELECT COUNT(*) amount from Category";
				$res=mysqli_query($conn, $query);
				$n = 0;
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					$n = $row['amount'];
				}
				for($i = 0; $i < $n; $i++):
					$query="SELECT cat_name, img_file from Category where cat_id=$i + 1";
					$res=mysqli_query($conn, $query);
					$desc = '';
					$file_name = '';
					$bck = '';
					$loc = 'location.href=""';
					while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
						$desc=$row['cat_name'];
						$file_name = $row['img_file'];
					}
					if (empty(trim($file_name)) || $file_name == 'null' || $file_name == 'NULL' || is_null($file_name)) {
						$bck = "img/men_default.jpg";
					} else {
						$bck = "$file_name";
					}
					if ($i + 1 == 1) {
						$loc = 'location.href="clothes.php"';
					} else if ($i + 1 == 2) {
						$loc = 'location.href="shoes.php"';
					} else {
						$loc = 'location.href="accessories.php"';
					}
			?>
			<div class="card mb-4 shadow-sm">
				<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" style="<?php echo "$bck";?>"><title><?php echo "$desc";?></title><rect width="100%" height="100%" fill="#55595c"></rect><image width="100%" height="100%" href="<?php echo "$bck";?>"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"><?php echo "$desc";?></text></svg>
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<div class="btn-group">
							<button type="button" class="btn btn-sm btn-outline-secondary" onClick=<?php echo "$loc";?>>Переглянути</button>
						</div>
					</div>
				</div>
			</div>
			<?php endfor; ?>
			</div>
		</div>
		<?php require "elems/footer.php"?>
	</body>
</html>