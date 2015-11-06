<?php
global $post;

?><!DOCTYPE html>
<!--[if lt IE 8]> <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >

    <?php echo '<title>' . get_bloginfo('name') . " - " .get_bloginfo('description') . '</title>'; ?>

    <!-- Settings, Safari Viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="format-detection" content = "telephone=yes">
	<meta name="HandheldFriendly" content="true" />

	<!--[if lt IE 9]>
	<script type="text/javascript">
		document.createElement('header');
		document.createElement('nav');
		document.createElement('section');
		document.createElement('article');
		document.createElement('aside');
		document.createElement('footer');
		document.createElement('hgroup');
	</script>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->

	<!-- Noscript -->
	<noscript>
		<style>
			.visible-noscript {display: block !important;}
		</style>
	</noscript>

	<!-- Wp head -->
	<?php wp_head(); ?>

</head>
<body class="<?php echo body_class(); ?>">

	<header class="main-header">

        <span class="brand text-left pull-left">
            <span class="logo animated fadeIn">
	            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/helsingborg.svg" alt="Helsingborg Stad">
            </span>
        </span>

        <div class="clock text-right pull-right animated fadeIn">
	        <span class="time">&nbsp;</span>
	        <span class="date"><?php echo date("j F Y"); ?></span>
        </div>

	</header>

	<section id="hero" class="animated fadeIn <?php if ( is_single($post->ID) ) { ?>map-area<?php } ?>" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg');">

		<div class="stripe animated slideInLeft">
		    <div></div>
		    <div></div>
		    <div></div>
		    <div></div>
		    <div></div>
		</div>

		<?php if ( is_single($post->ID) ) { ?>
			<div id="map-canvas" data-adress="Stortorget 8, Helsingborg, Sweden" class="map-canvas"></div>
		<?php } ?>

	</section>

	<section id="content">
