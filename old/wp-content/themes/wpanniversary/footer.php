</div>
		<!-- END #content -->
	</div>
	<!-- END #wrapper -->
	<!-- BEGIN #footer -->
	<div id="footer">
		<div id="footerInner">
		<?php // Widgetized footer
			if ( ! dynamic_sidebar( 'footer' ) ) :?>
			<?php endif; ?>
		</div>
	</div>
	<!-- END #footer -->
	<!-- BEGIN #copyright -->
	<div id="copyright">
		<a id="ftz" href="http://www.ftzcollective.com" target="_blank" title="FTZ Collective">FTZ Collective</a>
	</div>
	<!-- END #copyright -->
</div>
<!-- END #mainWrapper -->
<script language="javascript">
	Cufon.now();
</script>
<?php
	if (get_option(' wpann_analytics') <> "") { 
		echo stripslashes(stripslashes(get_option('wpann_analytics'))); 
	}

	wp_footer();
?>
	
</body>
</html>
