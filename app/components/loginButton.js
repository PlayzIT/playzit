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
            console.log(data);
            $ctrl.username = data.data.substring(1,data.data.length-1);
            console.log($ctrl.username);
        });
    };
});