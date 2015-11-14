<!-- BEGIN #colRight -->
			<div id="sidebar"  <?php if(get_option('wpann_sidebar_position')=="left"):?>class="left"<?php endif?>>
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-7145324572552604";
			/* fmvilas blog aside */
			google_ad_slot = "9600675996";
			google_ad_width = 200;
			google_ad_height = 200;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
			<?php // Widgetized sidebar 
			if ( ! dynamic_sidebar( 'sidebar' ) ) :?>
				<h2>WIDGETS NEEDED!</h2>
				<p>Go ahead and add some widgets here! Admin > Appearance > Widgets</p>
				</div>
			<?php endif; ?>
			</div>
			<!-- END #colRight -->