<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Панель адміна</title>
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
			if (!isset($_COOKIE['admin'])) {
				header('Location: log_admin.php');
			}
		?>
		<?php require "elems/header_admin.php"?>
		<div class="container mn">
			<h4 class="text-left">Додати/видалити користувача</h4>
			<?php
				if (isset($_GET['message']) && isset($_GET['source']) && $_GET['source'] === 'user_oper') :
			?>
			<h6 style="color: red; font-weight: bold;"><?php echo $_GET['message'];?></h6>
			<?php endif; ?>
			<form action="user_oper.php" class="form-horizontal" method="post">
				
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">Email</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" name="email" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">Пароль</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="passwd" />
							</div>
						</div>
					</div>
				</div>

				<div class="text-center">
					<button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-submit" name="button1">Додати</button>
					<button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-submit" name="button2">Видалити</button>
				</div>
			</form>
		</div>
		<div class="container mn">
			<h4 class="text-left">Додати/видалити товар</h4>
			<?php
				if (isset($_GET['message']) && isset($_GET['source']) && $_GET['source'] === 'item_oper'):
			?>
			<h6 style="color: red; font-weight: bold;"><?php echo $_GET['message'];?></h6>
			<?php endif; ?>
			<form action="item_oper.php" class="form-horizontal" method="post">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">ID товару</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="item_id" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">ID категорії</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="cat_id" />
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">Назва товару</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="item_name" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">Розмір</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="item_size" />
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
						<label class="control-label col-sm-2">Опис</label>
						<div class="col-sm-10">
							<textarea type="text" class="form-control" rows="2" name="descr"></textarea>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">Ціна</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="price" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-sm-4">Фото</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="img_file" />
							</div>
						</div>
					</div>
				</div>

				<div class="text-center">
					<button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-submit" name="button3">Додати</button>
					<button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-submit" name="button4">Видалити</button>
				</div>
			</form>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12 mb-3 mb-lg-5">
					<div class="overflow-hidden card table-nowrap table-card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Користувачі</h5>
						</div>
						<div class="table-responsive">
							<table class="table mb-0">
								<thead class="small text-uppercase bg-body text-muted">
									<tr>
										<th>№</th>
										<th>Email</th>
									</tr>
								</thead>
								<tbody>
									<?php
										include "db_conn.php";
										$query="SELECT COUNT(*) amount from user";
										$res=mysqli_query($conn, $query);
										$n = 0;
										while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
											$n = $row['amount'];
										}
										for($i = 0; $i < $n; $i++):
											$query="SELECT login from user LIMIT 1 OFFSET $i";
											$res=mysqli_query($conn, $query);
											$login = '';
											while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
												$login=$row['login'];
											}
									?>
									<tr class="align-middle">
										<td>
											<div class="d-flex align-items-center">
												<div>
													<div class="h6 mb-0 lh-1"><?php echo ($i+1);?></div>
												</div>
											</div>
										</td>
										<td><?php echo "$login";?></td>
									</tr>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mb-3 mb-lg-5">
					<div class="overflow-hidden card table-nowrap table-card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Товари</h5>
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
									</tr>
								</thead>
								<tbody>
									<?php
										include "db_conn.php";
										$query="SELECT COUNT(*) amount from items";
										$res=mysqli_query($conn, $query);
										$n = 0;
										while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
											$n = $row['amount'];
										}
										$array = array();
										$query="SELECT item_id from items";
										$res=mysqli_query($conn, $query);
										while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
											array_push($array, $row['item_id']);
										}
										for($i = 0; $i < $n; $i++):
											$query="SELECT i.item_id, i.item_name, c.cat_name, i.item_size, i.price from items i JOIN category c ON c.cat_id = i.cat_id WHERE i.item_id=$array[$i]";
											$res=mysqli_query($conn, $query);
											$id = 0;
											$item = '';
											$category = '';
											$siz = '';
											$price = 0;
											while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
												$id = $row['item_id'];
												$item = $row['item_name'];
												$category = $row['cat_name'];
												$siz = $row['item_size'];
												$price = $row['price'];
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
									</tr>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mb-3 mb-lg-5">
					<div class="overflow-hidden card table-nowrap table-card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Категорії</h5>
						</div>
						<div class="table-responsive">
							<table class="table mb-0">
								<thead class="small text-uppercase bg-body text-muted">
									<tr>
										<th>ID</th>
										<th>Назва</th>
									</tr>
								</thead>
								<tbody>
									<?php
										include "db_conn.php";
										$query="SELECT COUNT(*) amount from category";
										$res=mysqli_query($conn, $query);
										$n = 0;
										while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
											$n = $row['amount'];
										}
										for($i = 0; $i < $n; $i++):
											$query="SELECT cat_id, cat_name from category WHERE cat_id=$i+1";
											$res=mysqli_query($conn, $query);
											$id = 0;
											$category = '';
											while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
												$id = $row['cat_id'];
												$category = $row['cat_name'];
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
										<td><?php echo "$category";?></td>
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