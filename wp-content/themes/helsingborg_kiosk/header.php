<?php

	//Globals
	global $post;

	//Default tabindex 
	$tabindex = 0;

	//Get image for header 
	$header_image = get_field('front_page_header_image','options');
	if ( is_array( $header_image ) && !empty( $header_image ) ) {
		$header_image = isset($header_image['url']) ? $header_image['url'] : ""; 
	}
	
	//Fallback 
	if (filter_var($header_image, FILTER_VALIDATE_URL) === false) { 
		$header_image = get_template_directory_uri() ."/assets/images/header.jpg"; 
	}
	
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

	<!-- Analythics -->
	<script>
	  
	  	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	 	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  	ga('create', 'UA-16679007-10', 'auto');
	  	ga('send', 'pageview');
	
	</script>

</head>
<body <?php echo body_class(); ?>>

	<header class="main-header">

        <span class="brand text-left pull-left">
            <a class="logo animated fadeIn" href="/" tabindex="-1">
	            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/helsingborg.svg" alt="Helsingborg Stad">
            </a>
        </span>

        <div class="clock text-right pull-right animated fadeIn">
	        <span class="time">&nbsp;</span>
	        <span class="date"><?php echo date("j F Y"); ?></span>
        </div>

	</header>

	<section id="hero" class="animated fadeIn <?php if ( is_object( $post ) && is_single($post->ID) ) { ?>map-area<?php } ?> <?php if ( is_archive() ) { ?>no-gradient<?php } ?>" style="background-image: url('<?php echo $header_image; ?>');">

		<div class="stripe animated slideInLeft">
		    <div></div>
		    <div></div>
		    <div></div>
		    <div></div>
		    <div></div>
		</div>

		<?php

			//Single page map
			if (is_object($post) && is_single($post->ID)) {

				$latitude 		= get_post_meta($post->ID, 'poi-latitude', true);
				$longitude		= get_post_meta($post->ID, 'poi-longitude', true);

				echo '<div id="map-canvas" data-latitude="' . $latitude . '" data-longitude="' . $longitude . '" class="map-canvas"></div>';

			}

			//Archive page visual representation
			if ( is_archive() ) {

				if (preg_match('/archive-hbgkioskevent.php/', get_post_type_archive_template()) == true) {
					$cat = get_cat_id('evenemang');
				}

				$background 	= get_field('poi-category-bg', 'category_' . $cat);
				$icon 			= get_field('poi-category-icon', 'category_' . $cat);
				$iconSvg 		= isset( $icon['url'] ) ? file_get_contents($icon['url']) : "";

				echo '<div class="metro-grid-item metro-grid-color-2">';
				if (isset($background['url'])) {
					echo '	<div class="metro-grid-item-image" style="background-image:url(\'' . $background['url'] . '\');"></div>';
				} else {
					echo '	<div class="metro-grid-item-image"></div>';
				}
		        echo '    <div class="metro-grid-item-content">';
		        echo '       	'. $iconSvg;
		        echo '        	'. get_cat_name($cat);
		        echo '    </div>';
				echo '</div>';

			}

		?>

	</section>

	<section id="content">
