"use strict";

app.component("gameCardList", {
    templateUrl: "components/game-card-list.html",
    bindings: {},
    controller: "gameCardListController"
});


app.controller("gameCardListController", function ($http) {
    var $ctrl = this;
    $ctrl.games = [];

    this.$onInit = function () {

        $http.post("database_select.php", {
                'query': "SELECT * FROM Game limit 15;",
            },
            console.log("data request")
        ).then(function (data) {

            $ctrl.games = data.data;

        });


    }
});

