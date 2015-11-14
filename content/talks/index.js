define([
	'mustache',
	'text!content/talks/index.html',
	'text!content/talks/mastering-javascript/prototypal-inheritance.html',
	'text!content/talks/classical-inheritance-vs-modular-patterns.html'
], function(mustache, html) {
	var args = [].slice.call(arguments, 2),
		output = {
			talks: []
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

		output.talks.push({
			title: title,
			url: url,
			content: _.clone(content)
		});
	}

	return {
		title: 'Talks',
		html: mustache.render(html, output),
		tpl: html,
		posts: output
	};
});
