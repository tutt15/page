<?php

class FS 
{
	public function setContent($data)
	{
		$title = "{$data['title']}";
		$content = "<span>{$data['create_date']}</span><p>{$data['content']}</p>";
		return $this->bindContent($title,$content);
	}

	private function bindContent($data,$data1) {
		
		return '<!DOCTYPE html>
		<html lang="en">
		<head>
		  <meta charset="UTF-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1.0">
		  <meta http-equiv="X-UA-Compatible" content="ie=edge">
		  <title>'.$data.'</title>
		  <link rel="icon" href="/asset/img/Fevicon.png" type="image/png">
		
		  <link rel="stylesheet" href="/asset/vendors/bootstrap/bootstrap.min.css">
		  <link rel="stylesheet" href="/asset/vendors/fontawesome/css/all.min.css">
		  <link rel="stylesheet" href="/asset/vendors/themify-icons/themify-icons.css">
		  <link rel="stylesheet" href="/asset/vendors/linericon/style.css">
		  <link rel="stylesheet" href="/asset/vendors/owl-carousel/owl.theme.default.min.css">
		  <link rel="stylesheet" href="/asset/vendors/owl-carousel/owl.carousel.min.css">
		  <link rel="stylesheet" href="/asset/vendors/flat-icon/font/flaticon.css">
		  <link rel="stylesheet" href="/asset/vendors/nice-select/nice-select.css">
		
		  <link rel="stylesheet" href="/asset/css/style.css">
		</head>
		<body class="bg-shape">
		
		  <!--================ Header Menu Area start =================-->
		  <header class="header_area">
			<div class="main_menu">
			  <nav class="navbar navbar-expand-lg navbar-light">
				<div class="container box_1620">
				  <a class="navbar-brand logo_h" href="index.html"><img src="/asset/img/logo.png" alt=""></a>
				</div>
			  </nav>
			</div>
		  </header>
		
		  <section class="section-padding bg-gray">
			<div class="container">
		
			  <div class="row">
				<div class="col-md-12  mb-4 mb-lg-0">
				  <div class="blog">
					<div class="">
					  <a href="#">
						<h4 class="text-center">'.$data.'</h4>
					  </a>
					  <p>'. $data1 .' </p>
					</div>
				  </div>
				</div>
			</div>
		  </section>
		  <!-- ================ End footer Area ================= -->

		  <script src="/asset/vendors/jquery/jquery-3.2.1.min.js"></script>
		  <script src="/asset/vendors/bootstrap/bootstrap.bundle.min.js"></script>
		  <script src="/asset/vendors/owl-carousel/owl.carousel.min.js"></script>
		  <script src="/asset/vendors/nice-select/jquery.nice-select.min.js"></script>
		  <script src="/asset/js/jquery.ajaxchimp.min.js"></script>
		  <script src="/asset/js/mail-script.js"></script>
		  <script src="/asset/js/skrollr.min.js"></script>
		  <script src="/asset/js/main.js"></script>
		</body>
		</html>';
	}
}
