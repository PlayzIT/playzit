"use strict";

app.component("loginButton", {
    templateUrl: "components/login-button.html",
    controller: "loginButtonController",
    bindings: {
        
    }
});


app.controller("loginButtonController", function ($http) {

    var $ctrl = this;
    $ctrl.username;
    this.$onInit = function () {
        $http.post("getUserName.php", function(){

        }).then(function (data) {
            console.log("LoginButton: " + data.data);
            $ctrl.username = data.data;
        });
    };

    this.abmelden = function(){
        $.post("ausloggen.php", {

        }).then(function (data) {
            //console.log("logged out");
            location.href ="start.html";
        });

    }
});