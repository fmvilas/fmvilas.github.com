/*global define*/

define([
	'jquery',
	'underscore',
	'backbone',
	'templates',
	'models/blog'
], function ($, _, Backbone, JST, ArticleModel) {
	'use strict';

	var ArticleView = Backbone.View.extend({
		template: JST['app/scripts/templates/article.ejs'],

		id: 'content',

		initialize: function () {
			this.model = ArticleModel;
			this.render();
		},

		render: function () {
			this.$el.html(this.template());
		}
	});

	return ArticleView;
});
