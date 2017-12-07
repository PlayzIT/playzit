"use strict";

app.component("bewertenFeld", {
	templateUrl: "components/bewertenFeld.html",
	controller: "bewertenFeldController",
	bindings: {
		text: "@?",
		img: "@?",
		slider: "@",
		ausgang: "&"
	}
});

app.controller("bewertenFeldController", function () {

	this.$onInit = function () {
		this.wert = 1;
		this.wertVeraendert();
	};

	this.wertVeraendert = function () {
		this.ausgang({"wert": this.wert});
	};
});