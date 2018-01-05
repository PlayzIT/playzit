"use strict";

app.component("anmelden", {
    templateUrl: "components/anmelden.html",
    controller: "anmeldenController"
});

app.controller("anmeldenController", ['$http', function ($http) {
    this.error=true;
    this.loggedIn = false;
    var $ctrl = this;

    this.$onInit = function(){
        $.post("isLoggedIn.php", {
        }).then(function (data) {
            if(data== "1"){
                var url = window.location.pathname;
                var filename = url.substring(url.lastIndexOf('/')+1);
                if(filename!=="start.html"){
                    window.location = "start.html";
                }

                $ctrl.loggedIn = true;
            }else{
                $ctrl.loggedIn = false;
            }
        })
    };


    this.starteAnmeldung = function () {
        $http.post("anmelden.php", {
            'username': this.benutzername,
            'passwort': this.passwort
        }).then(function (data) {
            console.log(data);

            if(data.data == "1"){
                console.log("logged in");
                $ctrl.loggedIn = true;
                $ctrl.error = true;
                window.location = "start.html";
            }else{
                //location.reload();
                $ctrl.loggedIn = false;
                $ctrl.error = false;
            }
        });
    };


    this.abmelden = function(){
        $.post("ausloggen.php", {

        }).then(function (data) {
            console.log("logged out");
        });
        this.loggedIn = false;

    }


}]);
