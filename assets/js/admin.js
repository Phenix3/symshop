
import './../scss/admin.scss';
import '../bootstrap';

import $ from 'jquery';
// import Vue from 'vue';
window.Popper = require('popper.js').default;
require('bootstrap');

(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function (event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function (event) {
		event.preventDefault();
		if (!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	// $("[data-toggle='tooltip']").tooltip();

})();

// window.Vue = Vue;

// Vue.component('new-setting', require('./Components/Admin/Setting/New.vue').default);

// const vm2 = new Vue({
// 	el: '#app'
// });
