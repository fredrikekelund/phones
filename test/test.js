"use strict";

describe("Phones", function () {
	var viewModel,
		phoneNumber;

	beforeEach(function () {
		var App = require("../js/app.js");
		viewModel = new App();
	});

	it("should clean up a phone number", function () {
		phoneNumber = viewModel.cleanPhoneNumber("+4673 - 123 45 67");
		expect(phoneNumber).to.equal("46731234567");
	})

	it("should generate a URL to the API", function () {
		var apiUrl = "//" + location.hostname + ":" + location.port + "/api/price/" + phoneNumber;
		expect(viewModel.getApiUrl(phoneNumber)).to.equal(apiUrl);
	});

	it("should format 404 results correctly", function () {
		viewModel.result({
			_status: 404,
			error: new Error("rutsch")
		});

		expect(viewModel.formattedResult()).to.include("Hittade inga resultat");
	});

	it("should format good results correctly", function () {
		viewModel.result({
			operator: "Telia",
			prefix: "463",
			price: 0.8
		});

		expect(viewModel.formattedResult()).to.match(/telia.*0\.8.*kr/i);
	});
});
