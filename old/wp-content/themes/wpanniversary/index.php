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
			<?php if(is_month()) { ?>
				<div id="archive-title">
				Archive from <strong><?php the_time('F, Y') ?></strong>
				</div>
				<?php } ?>
				<?php if(is_category()) { ?>
				<div id="archive-title">
				Browsing Category "<strong><?php $current_category = single_cat_title("", true); ?></strong>"
				</div>
				<?php } ?>
				<?php if(is_tag()) { ?>
				<div id="archive-title">
				Tagged with "<strong><?php wp_title('',true,''); ?></strong>"
				</div>
				<?php } ?>
				<?php if(is_author()) { ?>
				<div id="archive-title">
				Articles by "<strong><?php wp_title('',true,''); ?></strong>"
				</div>
			<?php }?>
			<?php postviews();?>
		<div style="clear:both;"></div>
			<?php if (function_exists("emm_paginate")) {
				emm_paginate();
			} ?>
			</div>
			<!-- END #mainCol -->
		<?php if(get_option('wpann_sidebar_position')=="" || get_option('wpann_sidebar_position')=="right"):get_sidebar(); endif?>
<?php get_footer(); ?>
