"use strict";

app.component("profilBearbeiten", {
	templateUrl: "components/profilBearbeiten.html",
	controller: "ProfilBearbeitenController"
});


app.controller("ProfilBearbeitenController", function ($http) {
	let $ctrl = this;
	$ctrl.isLoggedInError = false;
	$ctrl.isLoggedIn = false;
	$ctrl.dataAlreadyInUse = false;
	$ctrl.names = {};



	$ctrl.fillInput = function (str) {
		document.getElementById("updateInput").removeAttribute("disabled");
		document.getElementById("updateButton").removeAttribute("disabled");

		if (str === "nickname") {
			document.getElementById("updateInput").setAttribute("type", "text");
			document.getElementById("updateInput").focus();
			$ctrl.eingabe = $ctrl.names.nickname;
			$ctrl.toUpdate = "nickname";
		} else if (str === "email") {
			document.getElementById("updateInput").setAttribute("type", "email");
			document.getElementById("updateInput").focus();
			$ctrl.eingabe = $ctrl.names.email;
			$ctrl.toUpdate = "email";
		} else if (str === "passwort") {
			document.getElementById("updateInput").setAttribute("type", "password");
			document.getElementById("updateInput").focus();
			$ctrl.eingabe = "";
			$ctrl.toUpdate = "passwort";
			$ctrl.placeholder = "Neues Passwort eingeben!";
		}
	};

	$ctrl.updateNickname = function () {
		console.log($ctrl.eingabe + " " + $ctrl.toUpdate);

			$http.post("bearbeiten.php", {
				"eingabe": $ctrl.eingabe,
				"whatToUpdate": $ctrl.toUpdate
			}).then(function (data) {
				console.log(data);
				$ctrl.displayData();
				if (data.data == 1) {
					$ctrl.eingabe = "";
					$ctrl.toUpdate = null;
					$ctrl.dataAlreadyInUse = false;
				} else {
					$ctrl.dataAlreadyInUse = true;
				}
			});

	};

	$ctrl.displayData = function () {
		$http.post("anzeigen.php", {
		}).then(function (data) {
			if(data.data !== ""){
				$ctrl.isLoggedIn = true;
				$ctrl.isLoggedInError = false;
				$ctrl.names = data.data[0];
			}else{
				$ctrl.isLoggedIn = false;
				$ctrl.isLoggedInError = true;
			}
		});
	};
});