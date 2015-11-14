/*global define*/

define([
	'jquery',
	'underscore',
	'backbone',
	'scripts/templates'
], function ($, _, Backbone, JST) {
	'use strict';

	var BackboneView = Backbone.View.extend({
		template: JST['app/scripts/templates/backbone.ejs'],

		initialize: function () {
			this.render();
		},

		render: function () {
			this.$el.html(this.template({}));
		}
	});

	return BackboneView;
});
