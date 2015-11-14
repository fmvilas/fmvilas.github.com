define([
	'mustache',
	'text!content/home/index.html',
	'content/articles/index',
	'content/experiments/index',
	'content/talks/index'
], function(mustache, html, articles, experiments, talks) {
	var output = {
			articles: articles.posts.articles,
			experiments: experiments.posts.experiments,
			talks: talks.posts.talks
		};

	return {
		title: 'Home',
		html: mustache.render(html, output),
		tpl: html,
		posts: output
	};
});
