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
            <a class="logo animated fadeIn" href="/">
	            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/helsingborg.svg" alt="Helsingborg Stad">
            </a>
        </span>

        <div class="clock text-right pull-right animated fadeIn">
	        <span class="time">&nbsp;</span>
	        <span class="date"><?php echo date("j F Y"); ?></span>
        </div>

	</header>

	<section id="hero" class="animated fadeIn <?php if ( is_object( $post ) && is_single($post->ID) ) { ?>map-area<?php } ?> <?php if ( is_archive() ) { ?>no-gradient<?php } ?>" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg');">

		<div class="stripe animated slideInLeft">
		    <div></div>
		    <div></div>
		    <div></div>
		    <div></div>
		    <div></div>
		</div>

		<?php
		if (is_object($post) && is_single($post->ID)) :
			$address = get_post_meta($post->ID, 'poi-address', true);
			$city = get_post_meta($post->ID, 'poi-city', true);
		?>
			<div id="map-canvas" data-adress="<?php echo $address; ?>, <?php echo $city; ?>, Sweden" class="map-canvas"></div>
		<?php endif; ?>

		<?php
		if (is_archive()) :
			$background = get_field('poi-category-bg', 'category_' . $cat);
    		$icon = get_field('poi-category-icon', 'category_' . $cat);
    		$iconSvg = file_get_contents($icon['url']);
		?>
			<div class="metro-grid-item metro-grid-color-2">
				<div class="metro-grid-item-image" style="background-image:url('<?php echo $background['url']; ?>');"></div>
	            <div class="metro-grid-item-content">
	                <?php echo $iconSvg; ?>
	                <?php single_cat_title('', true); ?>
	            </div>
			</div>
		<?php endif; ?>

		<?php if (is_page_template( 'selfie.php')) : ?>
			<div id="my_camera" style="width:320px; height:240px;"></div>
		    <div id="my_result"></div>
		<?php endif; ?>

	</section>

	<section id="content">
