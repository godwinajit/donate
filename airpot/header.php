<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title><?php echo get_bloginfo( 'name' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Exo:200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<?php wp_head(); ?>
	<script type='text/javascript'>
		(function (d, t) {
			var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
			bh.type = 'text/javascript';
			bh.src = '//www.bugherd.com/sidebarv2.js?apikey=8ridpryqv3des5vc3kabva';
			s.parentNode.insertBefore(bh, s);
		})(document, 'script');
	</script>
</head>

<?php $bodyclassname=is_front_page() ? "front" : "inner" ;?>
<body class="<?php echo $bodyclassname; ?>">
	<div id="wrapper">
		<header id="header">
			<div class="header-bar">
				<div class="container">
					<div class="holder">
						<div class="cart-info">
							<?php global $woocommerce;
							// get cart quantity
							$qty = $woocommerce->cart->get_cart_contents_count();
							if($qty>0) {
								$class="";
							 }else{
							 	$class='class="not-active"';
							}?>
                            <div <?php echo $qty ?  '' : 'onclick="alert(\'Cart is Empty\');"'; ?>>
							    <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" <?php echo $class;?>><i class="fa fa-shopping-cart"></i>RFQ CART - ( <?php echo $qty;?> )</a>
                            </div>
						</div>
						<ul class="links">
							<li><a href="<?php echo  get_home_url(); ?>/sign-up">SIGN UP</a></li>
							<li><a href="<?php echo  get_home_url(); ?>/sign-in">SIGN IN</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="header-block">
				<form method="get" role="search" action="<?php bloginfo('home'); ?>/" class="searchform collapse" id="searchform">
					<div class="container">
						<div class="holder">
							<input value="<?php echo esc_html($s); ?>" name="s" id="s" type="text" placeholder="Type search keyword and hit enter ...">

						</div>
					</div>
				</form>
				<div class="container">
					<div class="row">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
							<span class="sr-only">Menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="col-md-12 col-lg-5 ">
							<div class="logo"><a href="<?php echo  get_home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="432" height="85" alt="Airport Corp. CUTOMIZABLE, PRECISION PNEUMATIC CONTROL" class="img-responsive"></a></div>
						</div>
						<div class="col-md-12 col-lg-7 navbar-holder">
							<nav id="navbar" class="collapse navbar-collapse">
								<?php get_sidebar('header');?>
								<a href="#searchform" class="search-bottom collapsed" data-toggle="collapse">
									<span class="fa fa-times"></span>
									<span class="fa fa-search"></span>
								</a>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</header>