<?php
get_header();

the_post();

$imageUrl = get_post_meta($post->ID, 'poi-image', true);

$address = get_post_meta($post->ID, 'poi-address', true);
$postalCode = get_post_meta($post->ID, 'poi-postalcode', true);
$city = get_post_meta($post->ID, 'poi-city', true);

$phone = get_post_meta($post->ID, 'poi-phone', true);
?>

	<h1 id="content-headline"><?php the_title(); ?></h1>

	<aside>
		<img src="<?php echo $imageUrl; ?>" style="width: 100%;" />
		<ul>
			<?php if ($address !== null) : ?><li><?php echo $address; ?></li><?php endif; ?>
			<?php if ($city !== null) : ?>
				<li><?php echo $postalCode; ?> <?php echo $city; ?></li>
			<?php endif; ?>
			<?php if ($phone !== null) : ?><li>Tel: +46 <?php echo $phone; ?></li><?php endif; ?>
		</ul>
	</aside>

	<article>

		<div class="scroll-wrapper">
			<?php the_content(); ?>
		</div>

		<nav class="nav-scroll">
			<button class="btn btn-plain btn-prev pull-left"><i class="ion-chevron-up"></i> Upp</button>
			<button class="btn btn-plain btn-prev pull-right"><i class="ion-chevron-down"></i> Ner</button>
		</nav>
	</article>

<?php get_footer(); ?>