"use strict";

app.component("suchleiste", {
	templateUrl: "components/suchleiste.html",
	controller: "sucheController",
	bindings: {
		suche: "@"
	}
});


app.controller("sucheController", function ($http) {

	this.sucheInAction = function() {
		console.log("versuche zu suchen");
		$http.post("suche.php", { "data" : this.suche}).
		then(function(data, status) {
			this.status = status;
			this.data = data;
			this.result = data;
		}, function(data, status) {
			this.data = data || "Request failed";
			this.status = status;
		});
	};
});
