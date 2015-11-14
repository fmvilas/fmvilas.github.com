define([
	'mustache',
	'text!content/articles/index.html',
	'text!content/articles/importance-open-source-web-applications.html',
	'text!content/articles/dealing-with-design-patterns.html',
	'text!content/articles/fixing-swig-template-inheritance.html'
], function(mustache, html) {
	var args = [].slice.call(arguments, 2),
		output = {
			articles: []
		},
		$aux = $('<div>'),
		$auxTitle,
		title,
		content,
		url;

	for(var i = 0, len = args.length; i < len; i++) {
		$aux.html(args[i]);
		$auxTitle = $('h1:first', $aux);

		title = $auxTitle.text();
		url = $auxTitle.data('url');

		content = [];
		$('.readmore', $aux).each(function() {
			content.push( $(this).html() );
		});

		output.articles.push({
			title: title,
			url: url,
			content: _.clone(content)
		});
	}

	return {
		title: 'Articles',
		html: mustache.render(html, output),
		tpl: html,
		posts: output
	};
});
