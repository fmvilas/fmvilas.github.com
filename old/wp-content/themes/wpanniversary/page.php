<?php
get_header();
if(get_option('wpann_sidebar_position')=="" || get_option('wpann_sidebar_position')=="right"){?>
			<!-- BEGIN #mainCol -->
			<div id="mainCol">
		<?php }else{ 
		get_sidebar();?>
		<!-- BEGIN #mainCol -->
		<div id="mainCol" class="right">
		<?php }?>
		<h1><?php the_title(); ?></h1>	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php the_content(); ?>
		
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
			
			</div>
			<!-- End #mainCol -->
			
<?php if(get_option('wpann_sidebar_position')=="" || get_option('wpann_sidebar_position')=="right"):get_sidebar(); endif?>
<?php get_footer(); ?>