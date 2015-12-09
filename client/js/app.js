"use strict";

var ko = require("knockout"),
	qwest = require("qwest"),
	url = require("url");

var App = module.exports = function () {
	var app = this;

	this.phoneNumber = ko.observable("");
	this.operators = ko.observableArray([]);

	this.cleanPhoneNumber = function (phoneNumber) {
		return phoneNumber.replace(/\D/g, "");
	};

	this.getApiUrl = function (query) {
		return url.format({
			hostname: location.hostname,
			port: 8000,
			pathname: "/price",
			query: query
		});
	};

	this.submitForm = function (data) {
		qwest.get(getApiUrl({phoneNumber: phoneNumber}))
		.then(function (xhr, response) {
			response.forEach(app.operators.push, app.operators);
		})
		.catch(function (xhr, response, error) {
			// Process the error
		});
	};
};

ko.applyBindings(new App(), document.querySelector("main"));
