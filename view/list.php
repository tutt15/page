<?php
	include dirname(__DIR__) . "/templates/page/header.php";
	include dirname(__DIR__) . "/controller/page.php";
	include dirname(__DIR__) . "/connect/ftpconect.php";
	include dirname(__DIR__) . "/controller/delete.php";
	include dirname(__DIR__) . "/controller/upload.php";
	//Panigation

	$search = isset($_GET['search']) ?  trim(preg_replace('/\\s+/', ' ', $_GET['search'])) : '';
	$search_str = '';
	if ($search != '' ) {
		$search_str = "&search=";
	}
	if (isset($_GET['show'])) {
		$show_record = $_GET['show'];
	}
	$status = isset($_GET['status']);
	if (isset($_GET['status'])) {
		$status = $_GET['status'];
		if ($status == 'New') {
			$status = 1;
		} else if ($status == 'Update') {
			$status = 2;
		} else {
			$status = 3;
		}
	} else {
		echo "";
	}

	if (isset($_GET['page']) && $_GET['page'] != "") {
		$page  = ceil($_GET['page']);
		$offset = ($page - 1) * NUM_ROW;
	}else {
		$page = 1;
		$offset = 0;
	}
	if(isset($_GET['page']) && isset($_GET['show'])) {
		$page  = ceil($_GET['page']);
		$offset = ($page - 1) * $_GET['show'];
	}
 ?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<span  class="btn mt-3 float-right">
					<?php echo "Xin chào,".$_SESSION['username'];?>
					<a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
				</span>
				
				<h2 class=" text-center mt-3 mb-4" id="page-mana">PAGE MANAGEMENT</h2>
				<div class="container">
					<div class="row">
						<div class="col-3">
							<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal" style="margin-top: 33px">
								<i class="fa fa-fw fa-plus-circle"></i>Add page</button>
							<a href="list_template.php" class="btn btn-info btn-sm" style="margin-top: 33px;margin-left: 35px;"><i class="fa fa-fw fa-plus-circle"></i>Template</a>
						</div>

						<div class="col-9" style="margin-top: 31px">
							<form method="get" name="form1" id="frm-list">
								<div class="row">
									<div class="col-sm-2">
										<select class="custom-select" id="inputGroupSelect01" value="" name="status" >
											<option value="" disabled selected>--Status--</option>
											<option value="New">New</option>
											<option value="Update">Update</option>
											<option value="Public">Public</option>
										</select>
									</div>
									<div class="col-sm-2">
										<select class="custom-select" id="inputGroupSelectshow" value="" name="show" >
											<option value="" disabled selected>--Show--</option>
											<option value="5">5</option>
											<option value="10">10</option>
											<option value="15">15</option>
											<option value="20">20</option>
										</select>
									</div>
									<div class="col-sm-8">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group">
													<input type="text" name="search" id="search" class="form-control" value="<?php if($search) {echo $search ;}?>" placeholder="Enter title">
												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group">
													<div>
														<button type="submit" value="submit" class="btn btn-primary " id="btn-search"><i class="fa fa-fw fa-search"></i> Search</button>
														<a href="list.php" class="btn btn-danger" style="margin-left: 10px;"><i class="fa fa-fw fa-sync"></i> Clear</a>
													</div>
												</div>
											</div>
											<div class="col-sm-2" style="margin-top: 5px;padding: 0">
												<span>
													<strong class="text-danger" style="font-size:20px;">
														Total:
														<?php
														  if(isset($_GET['show']) && isset($_GET['status']) && isset($_GET['search']) ){
																$result_db = $obj->countPage("page WHERE status = '$status' and title LIKE '%" . $_GET['search'] . "%'  ORDER BY `create_date` DESC", ['COUNT']);
																$total = $result_db[0];
																echo $total;
															}
															else if (isset($_GET['status']) &&  isset($_GET['search']) ) {
																$result_db = $obj->countPage("page WHERE title LIKE '%" . $_GET['search'] . "%' and status = '$status' ORDER BY `create_date` DESC", ['COUNT']);
																$total = $result_db[0];
																echo $total;
															}
															else if(isset($_GET['show']) && isset($_GET['status']) ){
																$result_db = $obj->countPage("page WHERE status = '$status' ORDER BY `create_date` DESC", ['COUNT']);
																$total = $result_db[0];
																echo $total;
															}
															else if (isset($_GET['search'])) {
																$result_db = $obj->countPage("page WHERE title LIKE '%" . $search . "%' ORDER BY `create_date` DESC", ['COUNT']);
																$total = $result_db[0];
																echo $total;
															}
															else if (isset($_GET['status'])) {
																$result_db = $obj->countPage("page WHERE status = '$status' ORDER BY `create_date` DESC", ['COUNT']);
																$total = $result_db[0];
																echo $total;
															}
															else if(isset($_GET['show'])){
																$result_db = $obj->countPage("page ORDER BY `create_date` DESC", ['COUNT']);
																$total = $result_db[0];
																echo $total;
															}
															else {
																$record = $obj->listAllValueByClause("page", ["COUNT"]);
																$total = $record[0];
																echo $total;
															}
														?></strong>
												</span>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<hr>

				<form action="" method="POST" name="frmList" id="sbform" class="mt-1">
					<table class="table table-striped table-bordered">
						<tr class="bg-info text-white">
							<th class="text-center">
								<input type="checkbox" id="select_all" />
							</th>
							<th>Title</th>
							<th>Create_date</th>
							<th class="text-center">Status</th>
							<th class="text-center">Edit</th>
							<th class="text-center">
								Preview
							</th>
						</tr>
						<?php
							if(isset($_GET['status']) && isset($_GET['show']) && isset($_GET['search'])){
								$list_all_page = $obj->listAllValue('page', [" WHERE status = '$status' and title LIKE '%" . $search . "%' ORDER BY `create_date` DESC LIMIT $offset," . $_GET['show'] ]);
							}
							else if(isset($_GET['status']) && isset($_GET['search'])){
								$list_all_page = $obj->listAllValue('page', [" WHERE status = '$status' and title LIKE '%" . $search . "%' ORDER BY `create_date` DESC LIMIT $offset," . NUM_ROW ]);
							}
							else if(isset($_GET['status']) && isset($_GET['show'])){
								$list_all_page = $obj->listAllValue('page', [" WHERE status = '$status'  ORDER BY `create_date` DESC LIMIT $offset," . $_GET['show'] ]);
							}
							else if(isset($_GET['search']) && isset($_GET['show'])){
								$list_all_page = $obj->listAllValue('page', [" WHERE title LIKE '%" . $search . "%'  ORDER BY `create_date` DESC LIMIT $offset," . $_GET['show'] ]);
							}
							
							else if (isset($_GET['status'])) {
								$list_all_page = $obj->listAllValue('page', [" WHERE status = '$status' ORDER BY `create_date` DESC LIMIT $offset," . NUM_ROW ]);
							}
							else if (isset($_GET['search'])) {
								$list_all_page = $obj->listAllValue('page', [" WHERE title LIKE '%" . $search . "%' ORDER BY `create_date` DESC LIMIT $offset," . NUM_ROW ]);
							}
							else if(isset($_GET['show'])){
								$list_all_page = $obj->listAllValue('page', [" ORDER BY `create_date` DESC LIMIT $offset," . $_GET['show'] ]);
							}
							else {
								$list_all_page = $obj->listAllValue('page', [" ORDER BY `create_date` DESC LIMIT $offset," . NUM_ROW ]);
							}

							if(isset($_GET['show'])){
								$total_pages = ceil($total / $_GET['show']);
							}else{
								$total_pages = ceil($total / NUM_ROW);
							}

							if(isset($_GET['status'])){
								if(is_numeric($_GET['status'])){
									header('location: list.php');
								}
								if ($total == 0) {
									$search_msg = "Không có kết quả tìm kiếm!";
								} else {
									if ($total > 4) {
										if ($total_pages < $page) {
											header('location: list.php?status=' . $_GET['status']);
										}
										else if ($page <= 0) {
											header('location: list.php?status=' . $_GET['status']);
										}
									}
								}
							} 
							if(isset($_GET['page']) && isset($_GET['search'])){
								if ($total == 0) {
									$search_msg = "Không có kết quả tìm kiếm!";
								} else {
									if ($total > 4) {
										if ($total_pages < $page) {
											header('location: list.php?&search=' . $_GET['search']);
										}
										else if ($page <= 0) {
											header('location: list.php?search=' . $_GET['search']);
										}
									}
								}
							}
							if(isset($_GET['status']) && isset($_GET['search'])){
								//echo "aaaa";
								if ($total == 0) {
									$search_msg = "Không có kết quả tìm kiếm!";
								} else {
									if ($total > 4) {
										if ($total_pages < $page) {
											header('location: list.php?status='.$_GET['status'].'&search=' . $_GET['search']);
										}
										else if ($page <= 0) {
											header('location: list.php?status='.$_GET['status'].'&search=' . $_GET['search']);
										}
									}
								}
							}
							if (isset($_GET['search'])) {
								if ($total == 0) {
									$search_msg = "Không có kết quả tìm kiếm!";
								} else {
									if ($total > 4) {
										if ($total_pages < $page) {
											header('location: list.php?search=' . $_GET['search']);
										}
										else if ($page <= 0) {
											header('location: list.php?search=' . $_GET['search']);
										}
									}
								}
							}

							if (isset($_GET['show'])) {
								if(!filter_var($_GET['show'], FILTER_VALIDATE_INT) || $_GET['show'] < 0){
									header('location: list.php');
								}
							}

							if (isset($_GET['page'])) {
								if(!filter_var($_GET['page'], FILTER_VALIDATE_INT) || $_GET['page'] < 0){
									header('location: list.php');
								}
								if($_GET['page'] > $total_pages){
									header('location: list.php');
								}
							}

						?>
						<?php if (isset($search_msg)) { ?>
						<tr>
							<td colspan="7" class="text-center"><?php echo $search_msg ?></td>
						</tr>
						<?php } ?>
						<?php if (isset($message)) {?>
						<tr>
							<td colspan="7" class="text-center"><?php echo $message ?></td>
						</tr>
						<?php } ?>
						<?php foreach ($list_all_page as $row) {?>
						<tr>
							<td class="text-center">
								<input type="checkbox" class="checkbox" name="checkbox[]" value="<?php echo $row["id"]; ?>">
							</td>
							<td>
							<?php if ($row['status'] == "3" || $row['status'] == "2") { ?>
								<a href="http://publocalpage.vn/<?php echo  $row['path'] != '' ? $row['path'] : $row['upload'] ?>" target="_blank" name="title"><?php echo $row['title']; ?></a>
							<?php } else { echo $row['title']; } ?>
							</td>
							<td><?php echo $row["create_date"]; ?></td>
							<td class="text-center">
								<p type="text" name="status" value="">
									<?php
										switch ($row['status']) 
										{
											case 1:
												$status = STATUS_NEW;
												echo $status;
												break;
											case 2:
												$status = STATUS_UPDATE;
												echo $status;
												break;
											case 3:
												$status = STATUS_PUBLIC;
												echo $status;
												break;
										}
									?>
								</p>
							</td>
							<td class="text-center">
								<a href="update_page.php?id=<?php echo $row["id"]; ?>"><i class="far fa-edit"></i></a>
							</td>
							<td class="text-center">
								<?php
									if ($row['status'] !== "3") {
								?>
								<button type="button" class="btn preview" data-toggle="modal" data-id='<?php echo $row['id']; ?>' data-target=".bd-example-modal-lg"><i class="material-icons">&#xe560;</i></button>
								<?php
									}
								?>
							</td>
						</tr>
						<?php
							}
						?>
					</table>
					<div>
						<button class="float-right btn btn-info btn-sm ml-2 " type="submit" data-toggle="tooltip" title="Delete page" name="submitDel" onclick="return submitForm()"><i class="fa fa-trash"></i>Delete page</button>
						<button class="float-right btn btn-danger btn-sm ml-2" type="submit" data-toggle="tooltip" title="Upload page" name="submit" onclick="return submitForm()"><i class="fa fa-upload"></i>Upload page</button>
					</div>
					<?php if ($total_pages > 1) { ?>

						<ul class="pagination" style="display: -webkit-inline-box;">
							<?php if ($page > 1 ){ ?>
								<li class="prev">
									<?php  if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&status=<?php echo $status; ?>&<?php echo $search_str.$search ;?>
										&show=<?php echo $_GET['show']?>
											">Prev</a>
									<?php } else if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>">Prev</a>
									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>">Prev</a>
									<?php } else if (isset($_GET['search']) && isset($_GET['status'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&status=<?php echo $status; ?>&<?php echo $search_str.$search ;?>">Prev</a>
									<?php } else if (isset($_GET['search'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&search=<?php echo $search; ?>">Prev</a>
									<?php  } else if (isset($_GET['status'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&status=<?php echo $_GET['status'] ?>">Prev</a>
									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&show=<?php echo $_GET['show']; ?>">Prev</a>
									<?php } else {?>
										<a href="list.php?page=<?php echo $page - 1 ?>">Prev</a>
									<?php } ?>
								</li>
							<?php } ?>

							<?php if ($page > 3) { ?>
								<li class="start">
									<?php  if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) { ?>
										<a href="list.php?page=1&status=<?php echo $status ?><?php echo $search_str.$search ;?>&show=<?php echo $_GET['show'] ?>">1</a>
									<?php } else if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=1&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>">1</a>

									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) {?>
										<a href="list.php?page=1&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>">1</a>

									<?php } else if (isset($_GET['search']) && isset($_GET['status'])) { ?>
										<a href="list.php?page=1&status=<?php echo $status ?><?php echo $search_str.$search ;?>">1</a>

									<?php } else if (isset($_GET['search'])) { ?>
										<a href="list.php?page=1&search=<?php echo $search ?>">1</a>

									<?php } else if (isset($_GET['status'])) { ?>
										<a href="list.php?page=1&status=<?php echo $status ?>">1</a>


									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=1&show=<?php echo $_GET['show']; ?>">1</a>
									
									<?php } else { ?>
										<a href="list.php?page=1">1</a>
									<?php } ?>
								</li>
							<?php } ?>

							<?php if ($page - 2 > 0) { ?>
								<li class="page">
									<?php  if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) { ?>
										<a href="list.php?page=<?php echo $page - 2 ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>&show=<?php echo $_GET['show'] ?>"><?php echo $page - 2 ?></a>

									<?php } else if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page - 2 ?>&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>"><?php echo $page - 2 ?></a>
									
									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) {?>
										<a href="list.php?page=<?php echo $page - 2 ?>&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>"><?php echo $page - 2 ?></a>
									<?php } else if (isset($search) && isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page - 2 ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>"><?php echo $page - 2 ?></a>

									<?php } else if (isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $page - 2 ?>&search=<?php echo $search ?>"><?php echo $page - 2 ?></a>

									<?php } else if (isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page - 2 ?>&status=<?php echo $status ?>"><?php echo $page - 2 ?></a>
									
									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page - 2 ?>&show=<?php echo $_GET['show']; ?>"><?php echo $page - 2 ?></a>

									

									<?php } else { ?>
										<a href="list.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a>
									<?php } ?>
								</li>
							<?php } ?>

							<?php if ($page - 1 > 0) { ?>
								<li class="page">
									<?php  if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) { ?>
										<a href="list.php?page=1&status=<?php echo $status; ?><?php echo $search_str.$search ;?>&show=<?php echo $_GET['show'] ?>"><?php echo $page - 1 ?></a>

									<?php } else if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>"><?php echo $page - 1 ?></a>

									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>"><?php echo $page - 1 ?></a>

									<?php } else if (isset($search) && isset($_GET['status'])) { ?>
										<a href="list.php?page=1&status=<?php echo $status; ?><?php echo $search_str.$search ;?>"><?php echo $page - 1 ?></a>

									<?php } else if (isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $page - 1 ?>&search=<?php echo $search ?>"><?php echo $page - 1 ?></a>

									<?php } else  if (isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page - 1 ?>&status=<?php echo $status ?>"><?php echo $page - 1 ?></a>

									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page - 1 ?>&show=<?php echo $_GET['show']; ?>"><?php echo $page - 1 ?></a>

									<?php } else { ?>
										<a href="list.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a>
									<?php } ?>
								</li>
							<?php } ?>

							<li class="currentpage">
									<?php  if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) { ?>
										<a href="list.php?page=<?php echo $page ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>&show=<?php echo $_GET['show'] ?>"><?php echo $page ?></a>

									<?php } else if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page ?>&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>"><?php echo $page ?></a>

									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $page?>&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>"><?php echo $page ?></a>

									<?php } else if (isset($search) && isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>"><?php echo $page ?></a>
									
									<?php }else if (isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $page ?>&search=<?php echo $search ?>"><?php echo $page ?></a>

									<?php } else  if (isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page ?>&status=<?php echo $status ?>"><?php echo $page ?></a>

									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page?>&show=<?php echo $_GET['show']; ?>"><?php echo $page?></a>

									<?php } else { ?>
										<a href="list.php?page=<?php echo $page ?>"><?php echo $page ?></a>
									<?php } ?>
							</li>

							<?php if ($page + 1 < $total_pages + 1) { ?>
								<li class="page">
									<?php  if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>&show=<?php echo $_GET['show'] ?>"><?php echo $page + 1 ?></a>

									<?php } else if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page + 1 ?>&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>"><?php echo $page + 1 ?></a>

									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>"><?php echo $page + 1 ?></a>	

									<?php } else if (isset($_GET['search']) && isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>"><?php echo $page + 1 ?></a>

									<?php } else if (isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&search=<?php echo $search ?>"><?php echo $page + 1 ?></a>

									<?php } else if (isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&status=<?php echo $status ?>"><?php echo $page + 1 ?></a>

									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page + 1?>&show=<?php echo $_GET['show']; ?>"><?php echo $page + 1?></a>
									
									<?php } else { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a>
									<?php } ?>
								</li>
							<?php } ?>

							<?php if ($page + 2 < $total_pages + 1) { ?>
								<li class="page">
									<?php  if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) { ?>
										<a href="list.php?page=<?php echo $page + 2 ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>&show=<?php echo $_GET['show'] ?>"><?php echo $page + 2 ?></a>

									<?php } else if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page + 2 ?>&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>"><?php echo $page + 2 ?></a>

									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) {?>
										<a href="list.php?page=<?php echo $page + 2 ?>&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>"><?php echo $page + 2 ?></a>

									<?php } else if (isset($_GET['search']) && isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page + 2 ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>"><?php echo $page + 2 ?></a>

									<?php }else if (isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $page + 2 ?>&search=<?php echo $search ?>"><?php echo $page + 2 ?></a>

									<?php } else  if (isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page + 2 ?>&status=<?php echo $status ?>"><?php echo ceil($page) + 2 ?></a>
									
									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page + 2 ?>&show=<?php echo $_GET['show']; ?>"><?php echo $page + 2?></a>
									
									
									<?php } else { ?>
										<a href="list.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a>
									<?php } ?>

								</li>
							<?php } ?>

							<?php if ($page <  $total_pages - 2) { ?>
								<li class="end">
									<?php if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) { ?>
										<a href="list.php?page=<?php echo  $total_pages ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>&show=<?php echo $_GET['show']?>"><?php echo  $total_pages ?></a>

									<?php } else  if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $total_pages ?>&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>"><?php echo $total_pages ?></a>

									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) {?>
										<a href="list.php?page=<?php echo $total_pages ?>&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>"><?php echo $total_pages ?></a>

									<?php } else if (isset($search) && isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo  $total_pages ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>"><?php echo  $total_pages ?></a>

									<?php }else if (isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $total_pages ?>&search=<?php echo $search ?>"><?php echo $total_pages ?></a>

									<?php } else if (isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $total_pages ?>&status=<?php echo $status ?>"><?php echo $total_pages ?></a>

									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $total_pages ?>&show=<?php echo $_GET['show']; ?>"><?php echo $total_pages?></a>

									<?php } else { ?>
										<a href="list.php?page=<?php echo  $total_pages ?>"><?php echo  $total_pages ?></a>
									<?php } ?>
								</li>
							<?php } ?>

							<?php if ($page <  $total_pages) { ?>
								<li class="next">
									<?php  if (isset($_GET['search']) && isset($_GET['status']) && isset($_GET['show'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>&show=<?php echo $_GET['show'] ?>">Next</a>
									<?php } else if (isset($_GET['status']) && isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page + 1 ?>&status=<?php echo $status; ?>&show=<?php echo $_GET['show']; ?>">Next</a>
									<?php } else if (isset($_GET['show']) && isset($_GET['search'])) {?>
										<a href="list.php?page=<?php echo $page + 1 ?>&show=<?php echo $_GET['show']; ?>&<?php echo $search_str.$search ;?>">Next</a>
									<?php } else if (isset($_GET['search']) && isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&status=<?php echo $status; ?><?php echo $search_str.$search ;?>">Next</a>
									<?php }else if (isset($_GET['search'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&search=<?php echo $search ?>">Next</a>
									<?php } else if (isset($_GET['status'])) { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>&status=<?php echo $status ?>">Next</a>
									<?php } else if (isset($_GET['show'])) {?>
										<a href="list.php?page=<?php echo $page + 1 ?>&show=<?php echo $_GET['show']; ?>">Next</a>
									
									<?php } else { ?>
										<a href="list.php?page=<?php echo $page + 1 ?>">Next</a>
									<?php } ?>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
				</form>
			</div>
		</div>
	</div>
<?php
	include dirname(__DIR__) . "/templates/page/footer.php";
?>

