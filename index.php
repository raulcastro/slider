<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// 	var_dump($_GET);

	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once $root.'/'.'backends/general.php';

	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
	
	require_once($root.'/Framework/Mysqli_Tool.php');
	require_once($root.'/Framework/sessionControl.php');
	require_once($root.'/Framework/Connection_Data.php');
	
	$db =  new Mysqli_Tool(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	$typesPages = array(1=>"dashboard/", 2=>"dashboard/");
	
	$control = new sessionControl($db,
			'users',
			'user',
			'password',
			'type',
			$typesPages,
			'index.php',
			0);

	$data 					= $backend->loadBackend('mainSection');
	
// 	var_dump($data);
	
	if (!$_GET['storeId'])
	{
		$title = $data['appInfo']['title'];
	}
	else 
	{
		$title = $data['storeInfo']['store'];
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title><?php echo $title; ?></title>

		
		<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" href="/favicon/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/favicon/manifest.json">
		<link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="/favicon/favicon.ico">
		<meta name="msapplication-config" content="/favicon/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
		
		<!-- Bootstrap -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet">
		<!-- Simple Line Icons -->
		<link href="/css/simple-line-icons/simple-line-icons.css" rel="stylesheet">
		<!-- google font -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
		<!-- owl-carousel -->
		<link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
		<!-- magnific-popup -->
		<link href="/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<!-- animate -->
		<link href="/css/animate/animate.css" rel="stylesheet">
		<!-- style -->
		<link href="/css/style.css" rel="stylesheet">
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="slider-background">
		
		<!-- Preloader 	-->
		<div id="preloader">
			<div id="status">&nbsp;</div>
		</div>
		<!-- ./Preloader -->
		
		<!-- pattern -->
		<div id="bg_pattern"></div>
		<!-- ./pattern -->
		
		<!-- scrollToTop -->	
		<a href="slider-background.html#" class="scrollToTop">
			<i class="fa fa-angle-up fa-2x"></i>
		</a>
		<!-- ./scrollToTop -->

		<!-- slider-banner -->	
		<section id="slider-banner" class="section wow fadeInUp">
			<div class="container">										
				<!-- slider -->	
				<div id="slider" class="owl-carousel">
					

				</div>	
				<!-- ./slider -->						
			</div>		
		</section>
		<!-- ./slider-banner -->
	
		
		<!-- footer -->
		<footer id="footer">
			<div class="container">
				<ul class="list-inline">
					<li><a href="slider-background.html#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="slider-background.html#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="slider-background.html#"><i class="fa fa-google"></i></a></li>
				</ul>
				<div class="copyright">&copy; <a href="#" target="_blank"><?php echo $data['appInfo']['title']; ?></a></div>
			</div>
		</footer>
		<!-- ./footer -->
		

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->		
		<script src="/js/jquery-1.11.3.min.js"></script>	
		<script src="/js/bootstrap.min.js"></script>
		
		<!-- smooth-scroll -->
		<script src="/plugins/smooth-scroll/smooth-scroll.js"></script>
		
		<!-- backstretch -->
		<script src="/plugins/backstretch/backstretch.min.js"></script>
		
		<!-- owl-carousel -->
		<script src="/plugins/owl-carousel/owl.carousel.js"></script>
		
		<!-- wow -->
		<script src="/plugins/wow/wow.js"></script>
		
		<!-- typed -->
		<script src="/plugins/typed/typed.min.js"></script>
						
		<!-- magnific-popup -->
		<script src="/plugins/magnific-popup/jquery.magnific-popup.js"></script>
		
		<!-- jqBootstrapValidation -->
		<script src="/plugins/jqBootstrapValidation/jqBootstrapValidation.js"></script>
		
		<!-- switcher -->
		<script type="text/javascript" src="/switcher/switcher.js"></script> 
					
		<!-- main js -->
		<script src="/js/main.js"></script>
		
		<script type="text/javascript">
//		SLIDER BACKGROUND  (BACKSTRETCH)
		
		jQuery(document).ready(function () {
			if($('.slider-background').length > 0){
				 $.backstretch([
					<?php 
					$i = 0;
					
					if ($data["sliders"])
					{
						foreach ($data['sliders'] as $slider)
						{
							$i++;
							?>
							"<?php 
							echo $data['appInfo']['url']."/images/sliders/original/".$slider['slider'];
							?>"
							<?php
							if (sizeof($data['sliders']) > $i)
							{
								echo ",";
							}
							
							
						}
					}
					else 
					{
						echo '"'.$data['appInfo']['url']."images/default/default_slider.jpg".'"';
					}
					?>
				  ], {duration: 7000, fade: 1000});
			}		
		});
		</script>
		
	</body>
</html>