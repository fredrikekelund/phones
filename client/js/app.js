"use strict";

var ko = require("knockout"),
	qwest = require("qwest"),
	url = require("url");

var App = module.exports = function () {
	this.phoneNumber = ko.observable("");

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
			// Make some useful actions
		})
		.catch(function (xhr, response, e) {
			// Process the error
		});
	};
};

ko.applyBindings(new App(), document.querySelector("main"));
