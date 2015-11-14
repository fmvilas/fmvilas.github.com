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
		<?php //if(get_option('journal_box_model')!="normal"){?>
			<!--<h1>Search results for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('"'); echo $key; _e('"'); wp_reset_query(); ?></h1>-->
		<?php //}else{?>
			<div id="archive-title">
			Search results for <strong><?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('"'); echo $key; _e('"'); wp_reset_query(); ?></strong>
			</div>
		<?php //}?>
		<?php $postindex = 1; ?>		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php //if(get_option('journal_box_model')!="normal"){?>
			<!--<div class="postBox <?php if(($postindex % 2) == 0){ echo 'lastBox';}?>">
				<div class="postBoxInner">
					<?php
					if ( has_post_thumbnail()) {
						//the_post_thumbnail();?> 
						<img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_image_path($post->ID); ?>&h=90&w=255&zc=1" alt="<?php the_title(); ?>">
					<?php } else {?>
						<img src="<?php bloginfo('template_directory'); ?>/images/nothumb.jpg" alt="No Thumbnail"  />
					<?php } ?>
					<h2><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h2>
					<div class="excerpt"><?php  wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore') ?></div>
					<div class="meta"> <?php the_time('M j, Y') ?> &nbsp;&nbsp;&nbsp;<img src="<?php bloginfo('template_directory'); ?>/images/ico_post_comments.png" alt="" /> <?php comments_popup_link('No Comments', '1 Comment ', '% Comments'); ?></div>
				</div>
				<a href="<?php the_permalink() ?>" class="readMore">Read More</a>
			</div>-->
			<?php ++$postindex; ?>
			<?php //}else{?>
				<div class="blogPostNormal">
						<div class="meta">
							 <div class="date">
									<span class="day"><?php the_time('j') ?></span>
									<?php the_time('M') ?><br /><strong><?php the_time('Y') ?></strong>
							 </div>
							 <div class="metaRight">Posted in: <?php the_category(', ') ?>  <br /><img src="<?php bloginfo('template_directory'); ?>/images/ico_comments.png" /><?php comments_popup_link('No Comments', '1 Comment ', '% Comments'); ?> 
							&nbsp;&nbsp;&nbsp;<?php the_tags('Tags: ', ', '); ?> 
							</div>
						</div>
						<h1><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h1>
						<?php the_excerpt(); ?>
				</div>
			<?php //}?>
		<?php endwhile; ?>

	<?php else : ?>
		<p>Sorry, but you are looking for something that isn't here.</p>
	<?php endif; ?>
	<div style="clear:both;"></div>
			<?php if (function_exists("emm_paginate")) {
				emm_paginate();
			} ?>
		</div>
		<!-- End #mainCol -->

<?php if(get_option('wpann_sidebar_position')=="" || get_option('wpann_sidebar_position')=="right"):get_sidebar(); endif?>
<?php get_footer(); ?>
