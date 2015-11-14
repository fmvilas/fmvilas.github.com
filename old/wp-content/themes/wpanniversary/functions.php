<?php

/*******************************
 MENUS SUPPORT
********************************/
if ( function_exists( 'wp_nav_menu' ) ){
	if (function_exists('add_theme_support')) {
		add_theme_support('nav-menus');
		add_action( 'init', 'register_my_menus' );
		function register_my_menus() {
			register_nav_menus(
				array(
					'main-menu' => __( 'Top Menu' )
				)
			);
		}
	}
}
/* CallBack functions for menus in case of earlier than 3.0 Wordpress version or if no menu is set yet*/

function primarymenu(){ ?>
			<div id="mainNav">
				<ul><li>Go to "Admin > Appearance > Menus" to set up the menu. You need to run WP 3.0+ for custom menus to work.</li></ul>
			</div>
<?php }


/*******************************
 THUMBNAIL SUPPORT
********************************/

add_theme_support( 'post-thumbnails' );
//set_post_thumbnail_size( 155, 155, true );

/* Get the thumb original image full url | Important also for MultiSite installs!*/

function get_image_path ($post_id = null) {
	if ($post_id == null) {
		global $post;
		$post_id = $post->ID;
	}
	$theImageSrc = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
	global $blog_id;
	if (isset($blog_id) && $blog_id > 0) {
		$imageParts = explode('/files/', $theImageSrc);
		if (isset($imageParts[1])) {
			$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
		}
	}
	return $theImageSrc;
}

/*******************************
 EXCERPT LENGTH ADJUST
********************************/

function wpe_excerptlength_grid($length) {
    return 40;
}
function wpe_excerptlength_index($length) {
    return 70;
}

function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

/*******************************
 WIDGETS AREAS
********************************/

function wpann_widgets_init() {
register_sidebar(array(
	'name' => 'sidebar',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

register_sidebar(array(
	'name' => 'footer',
	'before_widget' => '<div class="boxFooter">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="footerTitle">',
	'after_title' => '</h2>',
));

}
add_action( 'widgets_init', 'wpann_widgets_init' );

/*******************************
 LATEST TWEETS WIDGET
********************************/

/**
 * Add function to widgets_init that'll load the widget */
 
add_action( 'widgets_init', 'latest_tweet_widget' );

function latest_tweet_widget() {
	register_widget( 'Latest_Tweets' );
}
class Latest_Tweets extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Latest_Tweets() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'example', 'description' => __('Display a list of latest tweets', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latest-tweets-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'latest-tweets-widget', __('Latest Tweets', 'example'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets = $instance['no_of_tweets'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		if ( $title )
			echo '<h2 class="twitter">'. $title . $after_title;

		if ( $no_of_tweets )?>
				<div id="twitterBox">
							<ul id="twitter_update_list"></ul>
					<a href="http://twitter.com/<?php echo get_option('wpann_twitter_user'); ?>" class="action">Follow Me on Twitter! &raquo;</a>
				</div>
				<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo get_option('wpann_twitter_user'); ?>.json?callback=twitterCallback3&amp;count=<?php echo $no_of_tweets ?>">
				</script>
	<?php 

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Latest Tweets', 'example'), 'no_of_tweets' => '3' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>


		<!-- No of Tweets: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>"><?php _e('No. of Tweets:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php echo $instance['no_of_tweets']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
	
/*******************************
 PAGINATION
********************************
 * Retrieve or display pagination code.
 *
 * The defaults for overwriting are:
 * 'page' - Default is null (int). The current page. This function will
 *      automatically determine the value.
 * 'pages' - Default is null (int). The total number of pages. This function will
 *      automatically determine the value.
 * 'range' - Default is 3 (int). The number of page links to show before and after
 *      the current page.
 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 
 *      replaced with ellipses (...).
 * 'anchor' - Default is 1 (int). The number of links to always show at begining
 *      and end of pagination
 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text 
 *      to add before the pagination links.
 * 'after' - Default is '</div>' (string). The html or text to add after the
 *      pagination links.
 * 'title' - Default is '__('Pages:')' (string). The text to display before the
 *      pagination links.
 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 
 *      next page link.
 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 
 *      previous page link.
 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this
 *      to 0 (zero).
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @return string HTML content, if not displaying.
 */
 
function emm_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 3, 'gap' => 3, 'anchor' => 1,
		'before' => '<div class="emm-paginate">', 'after' => '</div>',
		'title' => __(''),
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {	
		$output .= "$before<span class='emm-title'>$title</span>";
		$ellipsis = "<span class='emm-gap'>...</span>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<a href='" . get_pagenum_link($page - 1) . "' class='emm-prev'>$previouspage</a>";
		}
		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= emm_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<a href='" . get_pagenum_link($page + 1) . "' class='emm-next'>$nextpage</a>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}

/**
 * Helper function for pagination which builds the page links.
 *
 * @access private
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param int $start The first link page.
 * @param int $max The last link page.
 * @return int $page Optional, default is 0. The current page.
 */
function emm_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<span class='emm-page emm-current'>$i</span>" 
			: "<a href='" . get_pagenum_link($i) . "' class='emm-page'>$i</a>";
	}
	return $output;
}

function post_is_in_descendant_category( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

/*******************************
 CUSTOM COMMENTS
********************************/

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
	 <?php echo get_avatar($comment,$size='38'); ?>
     <div id="comment-<?php comment_ID(); ?>">
	  <div class="comment-meta commentmetadata clearfix">
	    <?php printf(__('<strong>%s</strong>'), get_comment_author_link()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?> <span><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
	  </span>
	  </div>
	  
      <div class="text">
		  <?php comment_text() ?>
	  </div>
	  
	  <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php }

/*******************************
  THEME OPTIONS PAGE
********************************/

add_action('admin_menu', 'wpann_theme_page');
function wpann_theme_page ()
{
	if ( count($_POST) > 0 && isset($_POST['wpann_settings']) )
	{
		$options = array ('ann_header','style','ann_header_img','blog_name', 'posts_view','sidebar_position','contact_email','contact_text','cufon','twitter_user','latest_tweet','facebook_link','keywords','description','analytics');
		
		foreach ( $options as $opt )
		{
			delete_option ( 'wpann_'.$opt, $_POST[$opt] );
			add_option ( 'wpann_'.$opt, $_POST[$opt] );	
		}			
		 
	}
	add_menu_page(__('WP Anniversary Options'), __('WP Anniversary Options'), 'edit_themes', basename(__FILE__), 'wpann_settings');
	add_submenu_page(__('WP Anniversary Options'), __('WP Anniversary Options'), 'edit_themes', basename(__FILE__), 'wpann_settings');
}
function wpann_settings()
{?>
<div class="wrap">
	<h2>WP Anniversary Options Panel</h2>
	
<form method="post" action="">

	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>General Settings</strong></legend>
	<table class="form-table">
		<!-- General settings -->
		<tr valign="top">
			<th scope="row"><label for="style">WP Anniversary Header</label></th>
			<td>
				<select name="ann_header" id="ann_header">
					<option value="on" <?php if(get_option('wpann_ann_header') == 'on'){?>selected="selected"<?php }?>>On</option>		
					<option value="off" <?php if(get_option('wpann_ann_header') == 'off'){?>selected="selected"<?php }?>>Off</option>
				</select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="style">Change the Header Image:</label></th>
			<td>
			<input name="ann_header_img" type="text" id="ann_header_img" value="<?php echo get_option('wpann_ann_header_img'); ?>" class="regular-text" /><br />
			<em><small>You need to keep "WP Anniversary Header" ON. The default image will be change with yours. <br />Enter full URL to the image. Use transparent PNG for proper view.</small></em>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="blog_name">Your Blog's Name</label></th>
			<td>
				<input name="blog_name" type="text" id="blog_name" value="<?php echo get_option('wpann_blog_name'); ?>" class="regular-text" /><br />
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="posts_view">Way To Display Posts</label></th>
			<td>
				<select name="posts_view" id="posts_view">
					<option value="standard" <?php if(get_option('wpann_posts_view') == 'standard'){?>selected="selected"<?php }?>>Standard</option>		
					<option value="standardwthumb" <?php if(get_option('wpann_posts_view') == 'standardwthumb'){?>selected="selected"<?php }?>>Standard With Thumbnails</option>
					<option value="grid" <?php if(get_option('wpann_posts_view') == 'grid'){?>selected="selected"<?php }?>>Grid</option>		
					<option value="gridwthumb" <?php if(get_option('wpann_posts_view') == 'gridwthumb'){?>selected="selected"<?php }?>>Grid With Thumbnails</option>
				</select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="sidebar_position">Sidebar Position</label></th>
			<td>
				<select name="sidebar_position" id="sidebar_position">
					<option value="right" <?php if(get_option('wpann_sidebar_position') == 'right'){?>selected="selected"<?php }?>>Right Side</option>
					<option value="left" <?php if(get_option('wpann_sidebar_position') == 'left'){?>selected="selected"<?php }?>>Left Side</option>		
				</select>
			</td>
		</tr>
		
		 <tr valign="top">
			<th scope="row"><label for="cufon">Cufon Font Replacement</label></th>
			<td>
				<select name="cufon" id="cufon">
					<option value="yes" <?php if(get_option('wpann_cufon') == 'yes'){?>selected="selected"<?php }?>>Yes</option>		
					<option value="no" <?php if(get_option('wpann_cufon') == 'no'){?>selected="selected"<?php }?>>No</option>
				</select>
			</td>
		</tr>
		
		
	</table>
	</fieldset>
	
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="wpann_settings" value="save" style="display:none;" />
		</p>
	
	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Social Links</strong></legend>
		<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="twitter_user">Twitter Username</label></th>
			<td>
				<input name="twitter_user" type="text" id="twitter_user" value="<?php echo get_option('wpann_twitter_user'); ?>" class="regular-text" />
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="facebook_link">Facebook link</label></th>
			<td>
				<input name="facebook_link" type="text" id="facebook_link" value="<?php echo get_option('wpann_facebook_link'); ?>" class="regular-text" />
			</td>
		</tr>
        </table>
        </fieldset>
		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="wpann_settings" value="save" style="display:none;" />
		</p>
		
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Contact Page Settings</strong></legend>
		<table class="form-table">	
        <tr>
        	<td colspan="2"></td>
        </tr>
         <tr valign="top">
			<th scope="row"><label for="contact_text">Contact Page Text</label></th>
			<td>
				<textarea name="contact_text" id="contact_text" rows="7" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('wpann_contact_text')); ?></textarea>
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="contact_email">Email Address for Contact Form</label></th>
			<td>
				<input name="contact_email" type="text" id="contact_email" value="<?php echo get_option('wpann_contact_email'); ?>" class="regular-text" />
			</td>
		</tr>
        </table>
     </fieldset>
	 <p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="wpann_settings" value="save" style="display:none;" />
	</p>
	
        
      <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>SEO</strong></legend>
		<table class="form-table">
        <tr>
			<th><label for="keywords">Meta Keywords</label></th>
			<td>
				<textarea name="keywords" id="keywords" rows="7" cols="70" style="font-size:11px;"><?php echo get_option('wpann_keywords'); ?></textarea><br />
                <em>Keywords comma separated</em>
			</td>
		</tr>
        <tr>
			<th><label for="description">Meta Description</label></th>
			<td>
				<textarea name="description" id="description" rows="7" cols="70" style="font-size:11px;"><?php echo get_option('wpann_description'); ?></textarea>
			</td>
		</tr>
		<tr>
			<th><label for="ads">Google Analytics code:</label></th>
			<td>
				<textarea name="analytics" id="analytics" rows="7" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('wpann_analytics')); ?></textarea>
			</td>
		</tr>
		
	</table>
	</fieldset>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="wpann_settings" value="save" style="display:none;" />
	</p>
</form>
</div>
<?php }
/*******************************
  POSTS VIEWS
********************************/

function postviews(){
		if(get_option('wpann_posts_view') == "" || get_option('wpann_posts_view') == "standard"):
		if (have_posts()) : while (have_posts()) : the_post();?>
		<!-- Standard View -->
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
			<?php the_content(__('Read more >>')); ?>
		</div>
		<?php endwhile; ?>
		<?php else : ?>
				<p>Sorry, but you are looking for something that isn't here.</p>
			<?php endif; ?>
		<?php elseif(get_option('wpann_posts_view') == "standardwthumb"):
		if (have_posts()) : while (have_posts()) : the_post();?>
		<!-- Standard View W/ Thumbs -->
				<div class="blogPostThumb">
					<?php if ( has_post_thumbnail()):
						//the_post_thumbnail();?> 
						<a href="<?php the_permalink() ?>" ><img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_image_path($post->ID); ?>&h=155&w=155&zc=1" alt="<?php the_title(); ?>"></a>
					<?php else:?>
						<a href="<?php the_permalink() ?>" ><img src="<?php bloginfo('template_directory'); ?>/images/no_thumb.png" alt="No Thumbnail"  /></a>
					<?php endif; ?>
					<div class="text">
						<div class="meta"> By <?php the_author_posts_link(); ?>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<?php the_time('M j, Y') ?><br /><img src="<?php bloginfo('template_directory'); ?>/images/ico_comments.png" /><?php comments_popup_link('No Comments', '1 Comment ', '% Comments'); ?> </div>
						<h1><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h1>
						<?php  wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore') ?>
						<a href="<?php the_permalink() ?>" class="more-link">Read more</a>
					</div>
				</div>
		<?php endwhile; ?>
		<?php else : ?>
				<p>Sorry, but you are looking for something that isn't here.</p>
			<?php endif; ?>
		<?php elseif(get_option('wpann_posts_view') == "grid" || get_option('wpann_posts_view') == "gridwthumb" ):
		$postindex = 1;
		if (have_posts()) : while (have_posts()) : the_post();?>
				<!-- Grid View -->
				<div class="blogPostGrid <?php if(($postindex % 2) == 0){ echo 'last';}?>">
					<div class="meta">
						 <div class="date">
								<span class="day"><?php the_time('j') ?></span>
								<?php the_time('M') ?><br /><strong><?php the_time('Y') ?></strong>
						 </div>
						 <div class="metaRight">By <?php the_author_posts_link(); ?>  <br /><img src="<?php bloginfo('template_directory'); ?>/images/ico_comments.png" /><?php comments_popup_link('No Comments', '1 Comment ', '% Comments'); ?> 
						</div>
					</div>
					<?php if(get_option('wpann_posts_view') == "gridwthumb"):
								if ( has_post_thumbnail()):
								//the_post_thumbnail();?> 
								<a href="<?php the_permalink() ?>" ><img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_image_path($post->ID); ?>&h=90&w=300&zc=1" alt="<?php the_title(); ?>"></a>
								<?php else:?>
									<a href="<?php the_permalink() ?>" ><img src="<?php bloginfo('template_directory'); ?>/images/no_thumb_grid.png" alt="No Thumbnail"  /></a>
								<?php endif; ?>
					<?php endif; ?>
					<h1><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h1>
					<?php  wpe_excerpt('wpe_excerptlength_grid', 'wpe_excerptmore') ?>
				</div> 
				<?php if(($postindex % 2) == 0){ echo '<div class="separator"></div>';}?>
			<?php ++$postindex; endwhile; ?>
			<?php if(($postindex % 2) == 0){ echo '<div class="separator"></div>';}?>
			<?php else : ?>
				<p>Sorry, but you are looking for something that isn't here.</p>
			<?php endif; ?>
		<?php endif;?>
<?php }

/*******************************
  CONTACT FORM 
********************************/

 function hexstr($hexstr) {
  $hexstr = str_replace(' ', '', $hexstr);
  $hexstr = str_replace('\x', '', $hexstr);
  $retstr = pack('H*', $hexstr);
  return $retstr;
}

function strhex($string) {
  $hexstr = unpack('H*', $string);
  return array_shift($hexstr);
}
?>