/*global require*/
'use strict';

require.config({
	baseUrl: './',
	shim: {
		bootstrap: {
			deps: ['jquery'],
			exports: 'jquery'
		},
		highlightjs: {
			exports: 'hljs'
		},
		disqus: {
			deps: ['backbone']
		}
	},
	paths: {
        text: 'bower_components/requirejs-text/text',
		jquery: 'bower_components/jquery/dist/jquery',
		backbone: 'bower_components/backbone/backbone',
		underscore: 'bower_components/underscore/underscore',
		bootstrap: 'bower_components/sass-bootstrap/dist/js/bootstrap',
		highlightjs: 'bower_components/highlightjs/highlight.pack',
		mustache: 'bower_components/mustache.js/mustache',
		disqus: 'http://fmvilas.disqus.com/embed.js'
	}
});

require([
	'backbone',
	'jquery',
	'scripts/routes/blog'
], function (Backbone, $, Router) {
	var router = new Router(),
		$menuItems = $('#menu-panel a'),
		$btnMenu = $('#tblcontents'),
		$body = $('body'),
		$html = $('html');

	Backbone.history.start();

	$btnMenu.on('click', function() {
		$html.scrollTop(0);
		document.body.scrollTop = 0;
		$body.toggleClass('closed');
	});

	$menuItems.on('click', function() {
		if( $html.hasClass('touch') ) {
			$body.removeClass('closed');
		}
	});

	/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	window.disqus_shortname = 'fmvilas';
	window.disqus_identifier = Backbone.history.location.hash.substring(1);
	window.disqus_url = Backbone.history.location.href;
	window.disqus_config = function () {
		this.language = "en";
	};
});
