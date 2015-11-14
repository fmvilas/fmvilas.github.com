define([
	'mustache',
	'text!content/experiments/index.html',
	'text!content/experiments/ledify.html'
], function(mustache, html) {
	var args = [].slice.call(arguments, 2),
		output = {
			experiments: []
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

		output.experiments.push({
			title: title,
			url: url,
			content: _.clone(content)
		});
	}

	return {
		title: 'Experiments',
		html: mustache.render(html, output),
		tpl: html,
		posts: output
	};
});
