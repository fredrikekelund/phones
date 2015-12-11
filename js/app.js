"use strict";

var ko = require("knockout"),
	qwest = require("qwest"),
	url = require("url");

var App = module.exports = function () {
	var app = this;

	this.phoneNumber = ko.observable("");
	this.result = ko.observable();

	this.formattedResult = ko.computed(function () {
		if (typeof this.result() !== "object")
			return "";

		if (this.result().error)
			return this.result()._status === 404 ? "Hittade inga resultat..." : this.result().error;

		return this.result().operator + " för " + this.result().price + " kr/min";
	}, this);

	this.cleanPhoneNumber = function (phoneNumber) {
		return phoneNumber.replace(/\D/g, "");
	};

	this.getApiUrl = function (phoneNumber) {
		return url.format({
			hostname: location.hostname,
			port: 8000,
			pathname: "api/price/" + phoneNumber
		});
	};

	this.submitForm = function (phoneNumber) {
		var cleanedNumber = app.cleanPhoneNumber(phoneNumber);

		qwest.get(app.getApiUrl(cleanedNumber))
		.then(function (xhr, response) {
			app.result(response);
		})
		.catch(function (xhr, response, error) {
			app.result(response);
		});
	};
};

ko.applyBindings(new App(), document.querySelector("main"));
