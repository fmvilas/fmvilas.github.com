<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="keywords" content="<?php echo get_option('wpann_keywords'); ?>" />
<meta name="description" content="<?php echo get_option('wpann_description'); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	?></title>
<meta property="og:title" content="<?php wp_title( '·', true, 'right' ); bloginfo( 'name' ); ?>" />
<?php
	if ( is_singular() ) {
		$post_id = $_POST['post_id'];
		
	    //Query the post and set-up data
	    $post = get_post($post_id);
	    setup_postdata( $post );
?>
		<meta property="og:description" content="<?php echo get_the_excerpt(); ?>" />
<?php
	} else {
?>
		<meta property="og:description" content="<?php echo $site_description; ?>" />
<?php
	}
?>
<?php
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
	$url = $thumb['0'];
?>
<meta property="og:image" content="<?php echo $url; ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto.css" />
<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/icon.png">
<script language="JavaScript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.4.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.form.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cufon-yui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/twittercb.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/Vegur_400-Vegur_700.font.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.prettyPhoto.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
<?php if(get_option('wpann_cufon')!="no"):?>
<script type="text/javascript">
			Cufon.replace('a.more-link',{hover:true})('#sidebar h2')('#footer h2')('#mainNav ul li a', {hover:true})('#topLinksLeft a',{hover:true} )('#topLinksRight a',{hover:true} );
	</script>
<?php endif ?>
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	wp_head();
?>
<style type="text/css">
html {
	margin-top: 0 !important;
}
</style>
</head>
<body <?php if(get_option('wpann_ann_header')!='' && get_option('wpann_ann_header')=='off'):?>
	class="noAnniversary"
	<?php endif;?>
	>
<!-- BEGIN #mainWrapper -->
<div id="mainWrapper">
	<!-- BEGIN #wrapper -->
	<div id="wrapper">
		<!-- BEGIN #header -->
		<div id="header" style="
		<?php if(get_option('wpann_ann_header_img')!=''):?>background-image:url(<?php echo get_option('wpann_ann_header_img');?>);<?php endif;?><?php if(get_option('wpann_ann_header_img')!='' && get_option('wpann_header_h')!=''):?>height:<?php echo get_option('wpann_header_h');?>px;<?php endif;?>">
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_id' => 'mainNav', 'container_class' => 'topmenu', 'fallback_cb'=>'primarymenu') );?>
				<div id="topSocial">
					<ul>
						<?php if(get_option('wpann_twitter_user')!=""){ ?>
						<li>Twitter<br /><a href="http://www.twitter.com/<?php echo get_option('wpann_twitter_user'); ?>" target="_blank" class="twitter" title="Follow Me on Twitter!">Follow Us on Twitter!</a></li>
						<?php }?>
						<?php if(get_option('wpann_facebook_link')!=""){ ?>
						<li>Facebook<br /><a href="<?php echo get_option('wpann_facebook_link'); ?>" target="_blank" class="facebook" title="Join Me on Facebook!">Join Us on Facebook!</a></li>
						<?php }?>
						<li>Subscribe<br /><a href="http://feeds.feedburner.com/fmvilas" target="_blank" class="rss" title="Subscribe to my feed">Subscribe to my feed</a></li>
					</ul>
				</div>
				<div id="topSearch">
					<form id="searchform" action="" method="get">
						<input type="text" id="s" name="s" value="search" onfocus="this.value=''"/>
						<input type="submit" value="" id="searchsubmit" />
					</form>
				</div>
		</div>
		<!-- END #header -->
		<!-- BEGIN #content -->
		<div id="content" <?php if(get_option('wpann_sidebar_position')=="left"){?>class="left"<?php }?>>