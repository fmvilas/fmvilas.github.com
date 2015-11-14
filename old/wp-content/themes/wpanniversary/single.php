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
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
				<div class="blogPostNormal">
						<div class="meta">
							 <div class="date">
									<span class="day"><?php the_time('j') ?></span>
									<?php the_time('M') ?><br /><strong><?php the_time('Y') ?></strong>
							 </div>
							 <div class="metaRight">
							 By <?php the_author_posts_link(); ?> <br /><img src="<?php bloginfo('template_directory'); ?>/images/ico_comments.png" /><?php comments_popup_link('No Comments', '1 Comment ', '% Comments'); ?> 
							</div>
						</div>
						<h1><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h1>
						<?php the_content(); ?>
						<div class="postTags"><?php the_tags(); ?></div>
						<div style="margin-top:20px;">
						<?php if(function_exists('kc_add_social_share')) kc_add_social_share(); ?>
						</div>
				</div>
				<?php comments_template(); ?>
		<?php endwhile; ?>

		<?php else : ?>

		<p>Sorry, but you are looking for something that isn't here.</p>

		<?php endif; ?>
		</div>
<!-- END #mainCol -->
<?php if(get_option('wpann_sidebar_position')=="" || get_option('wpann_sidebar_position')=="right"):get_sidebar(); endif?>
<?php get_footer(); ?>