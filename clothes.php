<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Одяг</title>
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
				$array = array();
				$query="SELECT COUNT(*) amount from items where cat_id=1";
				$res=mysqli_query($conn, $query);
				$n = 0;
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					$n = $row['amount'];
				}
				$query="SELECT item_id from items where cat_id=1";
				$res=mysqli_query($conn, $query);
				while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
					array_push($array, $row['item_id']);
				}
				for($i = 0; $i < $n; $i++):
					$query="SELECT item_id, item_name, img_file, price from items where item_id=$array[$i]";
					$res=mysqli_query($conn, $query);
					$desc = '';
					$file_name = '';
					$price = 0;
					$bck = '';
					$num = 0;
					while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
						$desc=$row['item_name'];
						$file_name = $row['img_file'];
						$price = $row['price'];
						$num = $row['item_id'];
					}
					if (empty(trim($file_name)) || $file_name == 'null' || $file_name == 'NULL' || is_null($file_name)) {
						$bck = "img/men_default.jpg";
					} else {
						$bck = "$file_name";
					}
			?>
			<div class="card mb-4 shadow-sm">
				<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" style="<?php echo "$bck";?>"><title><?php echo "$desc";?></title><rect width="100%" height="100%" fill="#55595c"></rect><image width="100%" height="100%" href="<?php echo "$bck";?>"/></svg>
				<div class="card-body">
					<p class="card-text"><?php echo "$desc";?></p>
					<div class="d-flex justify-content-between align-items-center">
						<div class="btn-group">
							<form action="item.php" method="post">
								<input type="hidden" id="vl" name="vl" value=<?php echo "$num";?>>
								<input type="submit" class="btn btn-sm btn-outline-secondary" value="Переглянути" />
							</form>
						</div>
						<h4 class="text-body-secondary"><?php echo "$price";?> грн</h4>
					</div>
				</div>
			</div>
			<?php endfor; ?>
			</div>
		</div>
		<?php require "elems/footer.php"?>
	</body>
</html>