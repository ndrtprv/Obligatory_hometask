<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Товар</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	</head>
	<body>
		<?php require "elems/header.php"?>
		<?php
			$vl = 0;
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$vl = $_POST['vl'];
			} else {
				$vl = $_GET['vl'];
			}
			include "db_conn.php";
			$query="SELECT item_id, item_name, img_file, price, descr, item_size from items where item_id=$vl";
			$res=mysqli_query($conn, $query);
			$item_id = 0;
			$item_name = '';
			$file_name = '';
			$price = 0;
			$descr = '';
			$bck = '';
			$item_size = '';
			while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
				$item_id = $row['item_id'];
				$item_name = $row['item_name'];
				$file_name = $row['img_file'];
				$price = $row['price'];
				$descr = $row['descr'];
				$item_size = $row['item_size'];
			}
			if (empty(trim($file_name)) || $file_name == 'null' || $file_name == 'NULL' || is_null($file_name)) {
				$bck = "img/men_default.jpg";
			} else {
				$bck = "$file_name";
			}
		?>
		<section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src=<?php echo "$file_name";?> alt="..."></div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder"><?php echo "$item_name";?></h1>
						<?php
							if (!empty(trim($item_size)) && $item_size != 'null' && $item_size != 'NULL' && !is_null($item_size)) :
						?>
						<span style="font-size: 24px;"><?php echo "Розмір: $item_size";?></span>
						<?php endif; ?>
                        <div class="fs-5 mb-5">
                            <span style="font-size: 30px;"><?php echo "$price";?> грн</span>
                        </div>
                        <p class="lead"><?php echo "$descr";?></p>
						<?php
							if (isset($_COOKIE['user'])):
						?>
                        <div class="d-flex">
							<form action="add_del_item.php" method="post">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="hidden" name="vl" value="<?php echo $vl;?>" />
											<input type="hidden" name="source" value="item" />
											<input type="hidden" name="login" value="<?php echo $_COOKIE['user'];?>" />
											<input type="hidden" name="item_id" value=<?php echo "$item_id";?> />
											<input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" name="amount" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<button class="btn btn-sm btn-outline-secondary" type="submit">
												Додати до кошика
											</button>
										</div>
									</div>
									<?php
										if (isset($_GET['message'])) :
											if (isset($_GET['code']) && $_GET['code'] == 0) :
									?>
									<div class="col-sm-6">
										<div class="form-group">
											<h6 style="color: green; font-weight: bold;"><?php echo $_GET['message'];?></h6>
										</div>
									</div>
									<?php
											else:
									?>
									<div class="col-sm-6">
										<div class="form-group">
											<h6 style="color: red; font-weight: bold;"><?php echo $_GET['message'];?></h6>
										</div>
									</div>
									<?php
											endif;
										endif;
									?>
								</div>
							</form>
                        </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
		<?php require "elems/footer.php"?>
	</body>
</html>