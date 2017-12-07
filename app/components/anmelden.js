"use strict";

app.component("anmelden", {
    templateUrl: "components/anmelden.html",
    controller: "anmeldenController"
});

app.controller("anmeldenController", ['$http', function ($http) {
    this.starteAnmeldung = function () {
        $http.post("anmelden.php", {
            'username': this.benutzername,
            'passwort': this.passwort
        }).then(function (data) {

        });
    }
}]);
