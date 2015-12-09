"use strict";

describe("Phones", function () {
	var viewModel;

	beforeEach(function () {
		var App = require("../js/app.js");
		viewModel = new App();
	});

	it("generate a URL to the API", function () {
		var phoneNumber = viewModel.cleanPhoneNumber("073 - 123 45 67"),
			apiUrl = "//" + location.hostname + ":8000/price?phoneNumber=" + phoneNumber;

		expect(phoneNumber).to.equal("0731234567");
		expect(viewModel.getApiUrl({phoneNumber: phoneNumber})).to.equal(apiUrl);
	});
});
