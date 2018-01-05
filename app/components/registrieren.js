"use strict";

app.component("registrieren", {
	templateUrl: "components/registrieren.html",
	controller: "registrierenController"
});


app.controller("registrierenController", ['$http', function ($http) {
	let $ctrl = this;
	$ctrl.benutzername = "";

	$ctrl.$onInit = function(){
		$ctrl.isPasswortSame = true;
	};

	$ctrl.starteRegistrierung = function () {
		if($ctrl.passwort1 !== $ctrl.passwort2){
			$ctrl.isPasswortSame = false;
		}else {
			$ctrl.isPasswortSame = true;

			console.log($ctrl.benutzername + " " + $ctrl.email);
			if($ctrl.benutzername !== "" && $ctrl.benutzername !== undefined && $ctrl.email !== "") {
				/*console.log($ctrl.benutzername);
				 console.log($ctrl.email);*/

				$http.post("registrieren.php", {
					'username': $ctrl.benutzername,
					'passwort': $ctrl.passwort1,
					'email': $ctrl.email
				}).then(function (data) {
					/*
					 console.log(data);
					 console.log(data.data);
					 console.log(data.data === "1");*/
					if (data.data === "1") {
						$ctrl.usernameAlreadyExists = false;
						window.location.href = "profilb.html";
						/*
						 WHAT TO DO
						 */

					} else {
						$ctrl.usernameAlreadyExists = true;

						/*
						 WHAT TO DO
						 */

					}
				});
			}
		}
	}
}]);