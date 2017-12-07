"use strict";

app.component("registrieren", {
    templateUrl: "components/registrieren.html",
    controller: "registrierenController"
});


app.controller("registrierenController", ['$http', function ($http) {
    this.$onInit = function(){
        this.isPasswortSame = true;
	};

	this.starteRegistrierung = function () {
	    if(this.passwort1 !== this.passwort2){
            this.isPasswortSame = false;
        }else {
			this.isPasswortSame = true;

			$http.post("registrieren.php", {
				'username': this.benutzername,
				'passwort': this.passwort1,
                'email': this.email
			}).then(function (data) {
				if(data.success){
				    console.log("Erfolgreich inserted!");
                }else{
				    console.log("Benutzername oder Email existieren schon!");
                }
			});
		}
	}
}]);