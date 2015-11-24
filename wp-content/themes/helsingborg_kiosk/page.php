<?php get_header(); ?> 

<div style="height: 220px;"></div>

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 
 	<aside>

		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" style="width: 100%;">
		<ul>
		<li>Kontakt: 042-10 50 00</li>	
		</ul>
	</aside>

	<article>

		<div class="scroll-wrapper">
			<main>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</main>
		</div>

		<nav class="nav-scroll" style="display: block;">
			<button class="btn btn-plain btn-prev pull-left" data-action="scroll-up" data-selector=".scroll-wrapper"><i class="ion-chevron-up"></i> Upp</button>
			<button class="btn btn-plain btn-prev pull-right" data-action="scroll-down" data-selector=".scroll-wrapper"><i class="ion-chevron-down"></i> Ner</button>
		</nav>

	</article>
	
 <?php endwhile; endif; ?>

<?php get_footer(); ?>