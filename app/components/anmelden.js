"use strict";

app.component("anmelden", {
    templateUrl: "components/anmelden.html",
    controller: "anmeldenController"
});

app.controller("anmeldenController", ['$http', function ($http) {
    var $ctrl = this;
    $ctrl.error=true;
    $ctrl.loggedIn = false;

    $ctrl.$onInit = function(){
        $http.post("isLoggedIn.php", {
        }).then(function (data) {
            //console.log("isLoggedIn: " + data.data);
            if(data.data == "1"){
                $ctrl.loggedIn = true;
            }else{
                $ctrl.loggedIn = false;
            }
        });
    };


    $ctrl.starteAnmeldung = function () {
        $http.post("anmelden.php", {
            'username': $ctrl.benutzername,
            'passwort': $ctrl.passwort
        }).then(function (data) {
            //console.log(data);

            if(data.data == "1"){
                console.log("logged in");
                $ctrl.loggedIn = true;
                $ctrl.error = true;
                window.location = "start.html";
                //window.location = "start.html";
            }else{
                //location.reload();
                $ctrl.loggedIn = false;
                $ctrl.error = false;
            }
        });
    };


    $ctrl.abmelden = function(){
        $http.post("ausloggen.php", {

        }).then(function (data) {
            //console.log("logged out");
            $ctrl.loggedIn = false;
            window.location = "start.html";
        });

        //console.log("abmelden: " +$ctrl.loggedIn);
    };


}]);
