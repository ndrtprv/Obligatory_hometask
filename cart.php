<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Кошик</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<style>
			.mn {
				margin-top: 15px;
				margin-bottom: 15px;
			}
			.row {
				padding-top: 10px;
				padding-bottom: 10px;
			}
		</style>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	</head>
	<body>
		<?php
			if (!isset($_COOKIE['user'])) {
				header('Location: log_in.php');
			}
		?>
		<?php require "elems/header.php"?>
		<div class="container mn">
			<h4 class="text-left">Видалити з кошика</h4>
			<?php
				if (isset($_GET['message'])):
			?>
			<h6 style="color: red; font-weight: bold;"><?php echo $_GET['message'];?></h6>
			<?php endif; ?>
			<form action="add_del_item.php" class="form-horizontal" method="post">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">ID товару</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="item_id" />
							</div>
						</div>
					</div>
				</div>
				
				<input type="hidden" name="source" value="cart" />
				<input type="hidden" name="login" value="<?php echo $_COOKIE['user'];?>" />

				<div class="text-center">
					<button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-submit" name="button1">Видалити</button>
				</div>
			</form>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12 mb-3 mb-lg-5">
					<div class="overflow-hidden card table-nowrap table-card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Кошик</h5>
						</div>
						<div class="table-responsive">
							<table class="table mb-0">
								<thead class="small text-uppercase bg-body text-muted">
									<tr>
										<th>ID</th>
										<th>Назва</th>
										<th>Категорія</th>
										<th>Розмір</th>
										<th>Ціна (у грн.)</th>
										<th>Кількість</th>
										<th>Вартість</th>
									</tr>
								</thead>
								<tbody>
									<?php
										include "db_conn.php";
										$user_inf = $_COOKIE['user'];
										$query="SELECT COUNT(*) amount from basket where login='$user_inf'";
										$res=mysqli_query($conn, $query);
										$n = 0;
										while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
											$n = $row['amount'];
										}
										$array = array();
										$query="SELECT item_id from basket where login='$user_inf'";
										$res=mysqli_query($conn, $query);
										while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
											array_push($array, $row['item_id']);
										}
										for($i = 0; $i < $n; $i++):
											$query="SELECT b.item_id, i.item_name, c.cat_name, i.item_size, i.price, b.amount, i.price * b.amount final_sum from basket b JOIN items i ON i.item_id = b.item_id JOIN category c ON c.cat_id = i.cat_id WHERE b.item_id=$array[$i] AND b.login='$user_inf'";
											$res=mysqli_query($conn, $query);
											$id = 0;
											$item = '';
											$category = '';
											$siz = '';
											$price = 0;
											$amount = 0;
											$fin_sum = 0;
											while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
												$id = $row['item_id'];
												$item = $row['item_name'];
												$category = $row['cat_name'];
												$siz = $row['item_size'];
												$price = $row['price'];
												$amount = $row['amount'];
												$fin_sum = $row['final_sum'];
											}
									?>
									<tr class="align-middle">
										<td>
											<div class="d-flex align-items-center">
												<div>
													<div class="h6 mb-0 lh-1"><?php echo "$id";?></div>
												</div>
											</div>
										</td>
										<td><?php echo "$item";?></td>
										<td> <span class="d-inline-block align-middle"><?php echo "$category";?></span></td>
										<td><span><?php echo "$siz";?></span></td>
										<td><?php echo "$price";?></td>
										<td><?php echo "$amount";?></td>
										<td><?php echo "$fin_sum";?></td>
									</tr>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require "elems/footer.php"?>
	</body>
</html>