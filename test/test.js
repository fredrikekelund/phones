"use strict";

describe("Phones", function () {
	var viewModel;

	beforeEach(function () {
		var App = require("../js/app.js");
		viewModel = new App();
	});

	it("generate a URL to the API", function () {
		var phoneNumber = viewModel.cleanPhoneNumber("+4673 - 123 45 67"),
			apiUrl = "//" + location.hostname + ":8000/api/price/" + phoneNumber;

		expect(phoneNumber).to.equal("46731234567");
		expect(viewModel.getApiUrl(phoneNumber)).to.equal(apiUrl);
	});
});
