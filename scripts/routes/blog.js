/*global define*/

define([
	'jquery',
	'backbone',
	'highlightjs'
], function ($, Backbone, hljs) {
	'use strict';

	var $html = $('html'),
		$body = $('body'),
		$content = $('#s_content'),
		$menuItems = $('li', '.main-menu'),
		$comments = $('#s_comments');

	var _setActiveSection = function(section) {
		if( section ) {
			$menuItems.each(function() {
				var $this = $(this);

				if( $this.hasClass(section) ) {
					$this.addClass('active');
				} else {
					$this.removeClass('active');
				}
			});
		}
	};

	var _loadContent = function(url, section, comments) {
		var showComments = typeof comments === 'boolean' ? comments : true;

		$body.addClass('loading');
		$html.scrollTop(0);
		document.body.scrollTop = 0;
		ga('send', 'event', 'category', 'action', {'page': Backbone.history.location.hash});
		

		require(['text!'+url, 'text!content/comments.html'], function(html, comments) {
			$content.html(html);
			document.title = $('h1:first', $content).text() + ' - Francisco Mendez';
			_setActiveSection(section);
			$('pre code').each(function(i, e) {hljs.highlightBlock(e)});

			if( showComments ) {
				$comments.html(comments);
				require(['disqus'], function() {
				    if( typeof DISQUS !== 'undefined' ) {
						DISQUS.reset({
				            reload: true,
				            config: function () {
				            	this.page.identifier = Backbone.history.location.hash.substring(1);
				                this.page.url = Backbone.history.location.href;
				                this.page.title = document.title;
				                this.language = 'en';
				            }
				        });
					} else {
						console.log('DISQUS not loaded here');
					}
				});
			}

			$body.removeClass('loading');
		}, function(err) {
			require(['text!article-404.html'], function(html) {
				$content.html(html);
			});

			$body.removeClass('loading');
		});
	};

	var _loadCategory = function(url, section) {
		$body.addClass('loading');
		$html.scrollTop(0);
		document.body.scrollTop = 0;
		ga('send', 'event', 'category', 'action', {'page': Backbone.history.location.hash});

		require([url], function(category) {
			$body.removeClass('loading');
			$content.html(category.html);
			document.title = category.title + ' - Francisco Mendez Vilas';
			_setActiveSection(section);
			$comments.html('');
		}, function(err) {
			require(['text!article-404.html'], function(html) {
				$content.html(html);
			});

			$body.removeClass('loading');
		});
	};

	var _defaultRoute = function() {
		_loadCategory('content/home/index.js', 'home');
	};

	var _articlesRoute = function(name, params) {
		_loadCategory('content/articles/index.js', 'articles');
	};

	var _articleRoute = function(name, params) {
		_loadContent('content/articles/'+name, 'articles');
	};

	var _experimentsRoute = function(name, params) {
		_loadCategory('content/experiments/index.js', 'experiments');
	};

	var _experimentRoute = function(name, params) {
		_loadContent('content/experiments/'+name, 'experiments');
	};

	var _talksRoute = function(name, params) {
		_loadCategory('content/talks/index.js', 'talks');
	};

	var _talkRoute = function(name, params) {
		_loadContent('content/talks/'+name, 'talks');
	};

	var _aboutRoute = function(name, params) {
		_loadContent('content/about/index.html', 'about');
	};

	var _notfoundRoute = function(name, params) {
		_loadContent('404-article.html');
	};


	var BlogRouter = Backbone.Router.extend({
		routes: {
			'': _defaultRoute,
			'!': _defaultRoute,
			'!/': _defaultRoute,
			'!/articles': _articlesRoute,
			'!/article/*article': _articleRoute,
			'!/experiments': _experimentsRoute,
			'!/experiment/*experiment': _experimentRoute,
			'!/talks': _talksRoute,
			'!/talk/*talk': _talkRoute,
			'!/about': _aboutRoute,
			'*all': _notfoundRoute
		}
	});

	return BlogRouter;
});
