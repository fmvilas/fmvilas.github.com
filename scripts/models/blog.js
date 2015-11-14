/*global define*/

define([
	'underscore',
	'backbone'
], function (_, Backbone) {
	'use strict';

	var ArticleModel = Backbone.Model.extend({

		initialize: function() {

		},

		defaults: {
			title: 'No title',
			content: 'No content'
		}

	});

	return ArticleModel;
});
