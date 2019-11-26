<?php
	include dirname(__DIR__) . "/templates/page/header.php";
	include dirname(__DIR__) . "/controller/page.php";
	include dirname(__DIR__) . "/connect/ftpconect.php";
	include dirname(__DIR__) . "/controller/delete.php";
	include dirname(__DIR__) . "/controller/upload.php";

	ob_start();
	//Panigation
	if (isset($_GET['page']) && $_GET['page'] != "") {
		$page  = $_GET['page']; 
		$offset = ($page-1) * NUM_ROW;
	} 
	else{ 
		$page = 1;
		$offset = 0;
	} 
	
 ?>
 <body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a href="" class="btn btn-dark mt-3"><?php echo "Xin chào,".$_SESSION['username'];?></a>
				<a href="logout.php" class="btn btn-dark float-right mt-3">Logout</a>
				<h2 class=" text-center mt-3 mb-4">PAGE MANAGEMENT</h2>

				<div class="modal fade" id="empModal" role="dialog">
					<div class="modal-dialog modal-lg mw-100 w-75">
					
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Preview Page</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
							
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					
					</div>
				</div>
				<div class="card">

					<div class="card-header"><a href="create.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Add page</a></div>

					<div class="card-body">
						<div class="col-md-12">

							<form method="get">

								<div class="row">

									<div class="col-sm-2" style="margin-top: 35px">
										<span><strong class="text-danger" style="font-size:20px;margin-right:55px">Total:
										<?php 
											$record = $obj->listAllValueByClause("page", ["COUNT"]);
											$total = $record[0];
											echo $total;
										?>
										</strong>
									</div>
									<div class="col-sm-5">

										<div class="form-group">
											<label>&nbsp;</label>

											<input type="text" name="title" id="title" class="form-control" value="<?php $title = isset($_GET['title']) ? $_GET['title']:''?>" placeholder="Enter title">

										</div>
									</div>


									<div class="col-sm-5">

										<div class="form-group">

											<label>&nbsp;</label>

											<div>

												<button type="submit"  class="btn btn-primary" ><i class="fa fa-fw fa-search"></i> Search</button>

												<a href="list.php" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> Clear</a>

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
						<tr class="bg-primary text-white">
							<th>STT</th>
							<th>Title</th>
							<th>Create_date</th>
							<th class="text-center">Edit</th>
							<th class="text-center">Status</th>
							<th class="text-center">
								<input type="checkbox" id="select_all"/>
							</th>
							<th class="text-center">
								Preview
							</th>
						</tr>
						<?php   
							$list_all_page = $obj->listAllValue('page', [" title LIKE '%".$title."%' ORDER BY `create_date` DESC LIMIT $offset,".NUM_ROW ]);
							foreach ($list_all_page as $row) {
								$id = $row['id'];
						?>
						<tr>
							<td><?php echo $id; ?></td>
							<td>
								<?php 
									if($row['status'] == "3" || $row['status'] == "2" ){
									?>
										<a href="http://publocalpage.vn/<?php echo  $row['path'] != '' ? $row['path'] : $row['upload'] ?>" target="_blank" name="title" ><?php echo $row['title'];?></a>
									<?php
									}else{
										echo $row['title'];
									}
								?>
							</td>
							<td><?php echo $row["create_date"];?></td>
							<td class="text-center">
								<a href="update.php?id=<?php echo $row["id"]; ?>"><i class="far fa-edit"></i></a>
							</td>
							<td class="text-center">
								<p type="text"  name="status" value="" >
								<?php
									switch ($row['status']) {
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
								<input type="checkbox" class="checkbox"  name="checkbox[]" value="<?php echo $row["id"] ;?>">
							</td>
							<td class="text-center">
							<?php 
								if($row['status'] !== "3"  ){
								?>
									<button type="button" class="btn preview"  data-toggle="modal" data-id='<?php echo $id; ?>' data-target=".bd-example-modal-lg"><i class="material-icons">&#xe560;</i></button>
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
						<button class="btn btn-outline-danger float-right" type="submit" data-toggle="tooltip" title="Delete page" name="submitDel" onclick="return submitForm()"><i class="fa fa-trash"></i></button>
						<button class="btn btn-outline-success float-right" type="submit" data-toggle="tooltip" title="Upload page"   name="submit"    onclick="return submitForm()"><i class="fa fa-upload"></i></button>
					</div>
					<?php
						$result_db = $obj->listAllValueByClause('page', ['COUNT']);
						$total_records = $result_db[0];
						$adjacents = 2;
						$total_pages = ceil($total_records / NUM_ROW);
						if($total_pages <= (1+($adjacents * 2))) {
							$start = 1;
							$end   = $total_pages;
						  } else {
							if(($page - $adjacents) > 1) { 
							  if(($page + $adjacents) < $total_pages) { 
								$start = ($page - $adjacents);            
								$end   = ($page + $adjacents);         
							  } else {             
								$start = ($total_pages - (1+($adjacents*2)));  
								$end   = $total_pages;               
							  }
							} else {               
							  $start = 1;                                
							  $end   = (1+($adjacents * 2));             
							}
						  }
						// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						// $a = parse_url($actual_link, PHP_URL_QUERY);
						// parse_str($a, $arr);
						// $home = VIEW;
						// if ($actual_link !== $home) {
						// 	if($arr['page'] > $total_pages){
						// 		echo "Nothing";
						// 	}
						// }
						// $panigate = "<ul class='pagination'>";
						// for ($i=1; $i<=$total_pages; $i++) {
						// 	if ($total_pages == 1) {
						// 		break;
						// 	}
						// 	$panigate .= "<li class='page-item'><a class='page-link' href='list.php?page=".$i."'>".$i."</a></li>";	
						// }
						// echo $panigate . "</ul>";
						
					?>
						<?php if($total_pages > 1) { ?>
							<ul class="pagination pagination-sm justify-content-center">
								<!-- Trang đầu -->
								<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
								<a class='page-link' href='list.php?page=1'><<</a>
								</li>
								<!--Trang ké -->
								<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
								<a class='page-link' href='list.php?page=<?php ($page>1 ? print($page-1) : print 1)?>'><</a>
								</li>
								<!-- Hiển thị trang theo số page -->
								<?php for($i=$start; $i<=$end; $i++) { ?>
								<li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
								<a class='page-link' href='list.php?page=<?php echo $i;?>'><?php echo $i;?></a>
								</li>
								<?php } ?>
								<!-- Trang tiếp theo -->
								<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
								<a class='page-link' href='list.php?page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>></a>
								</li>
								<!-- Trang cuối -->
								<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>  
								<a class='page-link' href='list.php?page=<?php echo $total_pages;?>'>>></a>        
								</a>
								</li>
							</ul>
						<?php } ?>

				</form>
			</div>
		</div>
	</div>
 </body>
 <script type='text/javascript'>
	$(document).ready(function(){

		$('.preview').click(function(){
			
			var page_id = $(this).data('id');

			// AJAX request
			$.ajax({
				url: 'preview.php',
				type: 'post',
				data: {page_id: page_id},
				success: function(response){ 
					// Add response in Modal body
					$('.modal-body').html(response); 

					// Display Modal
					$('#empModal').modal('show');  
				}
			});
		});
	});
</script>
<script type="text/javascript" src="/asset/js/validate-checkbox.js"></script>
<?php include dirname(__DIR__)."/templates/page/footer.php";?>