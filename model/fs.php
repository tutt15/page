<?php

class FS 
{
	public function setContent($data)
	{
		$title = "{$data['title']}";
		$content = "<p>{$data['content']}</p>";
		return $this->bindContent($title,$content);
	}

	private function bindContent($data,$data1) {
		

		return '<!DOCTYPE html>
		<html lang="en">
		<head>
		  <meta charset="UTF-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1.0">
		  <meta http-equiv="X-UA-Compatible" content="ie=edge">
		  <title>'.$data.'.</title>
		  <link rel="icon" href="img/Fevicon.png" type="image/png">
		
		  <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
		  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
		  <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
		  <link rel="stylesheet" href="../vendors/linericon/style.css">
		  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
		  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
		  <link rel="stylesheet" href="../vendors/flat-icon/font/flaticon.css">
		  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
		
		  <link rel="stylesheet" href="../css/style.css">
		</head>
		<body class="bg-shape">
		
		  <!--================ Header Menu Area start =================-->
		  <header class="header_area">
			<div class="main_menu">
			  <nav class="navbar navbar-expand-lg navbar-light">
				<div class="container box_1620">
				  <a class="navbar-brand logo_h" href="index.html"><img src="../img/logo.png" alt=""></a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
		
				  <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
					<ul class="nav navbar-nav menu_nav justify-content-end">
					  <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li> 
					  <li class="nav-item"><a class="nav-link" href="about.html">About</a></li> 
					  <li class="nav-item"><a class="nav-link" href="package.html">Packages</a>
					  <li class="nav-item submenu dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
						  aria-expanded="false">Pages</a>
						<ul class="dropdown-menu">
						  <li class="nav-item"><a class="nav-link" href="amentities.html">Amentities</a>                 
						</ul>
					</li>
		
					  <li class="nav-item submenu dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
						  aria-expanded="false">Blog</a>
						<ul class="dropdown-menu">
						  <li class="nav-item"><a class="nav-link" href="index.html">Blog Single</a></li>
						  <li class="nav-item"><a class="nav-link" href="blog-details.html">Blog Details</a></li>
						</ul>
					  </li>
					  <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
					</ul>
				  </div> 
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
						<h4 class="text-center">'.$data.'.</h4>
					  </a>
					  <p>'. $data1 .' </p>
					</div>
				  </div>
				</div>
			</div>
		  </section>
		  <!-- ================ End footer Area ================= -->
		
		
		
		
		  <script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
		  <script src="../vendors/bootstrap/bootstrap.bundle.min.js"></script>
		  <script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
		  <script src="../vendors/nice-select/jquery.nice-select.min.js"></script>
		  <script src="../js/jquery.ajaxchimp.min.js"></script>
		  <script src="../js/mail-script.js"></script>
		  <script src="../js/skrollr.min.js"></script>
		  <script src="../js/main.js"></script>
		</body>
		</html>';
	}

// return '<!DOCTYPE html> 
// <html lang="en"> 
// <head> 
// 	<meta charset="UTF-8"> 
// 	<title>'.$data.'</title> 
// </head> 
// <body>
// 	'. $data1 .'
// </body> 
// </html>';
// 	}
}
