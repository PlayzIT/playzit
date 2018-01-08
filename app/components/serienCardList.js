"use strict";

app.component("serienCardList", {
    templateUrl: "components/serien-card-list.html",
    bindings: {},
    controller: "serienCardListController"
});


app.controller("serienCardListController", function ($http) {
    var $ctrl = this;
    $ctrl.serien = [];

    this.$onInit = function () {

        $http.post("database_select.php", {
                'query': "SELECT * FROM series limit 1000;",
            },
            console.log("data request")
        ).then(function (data) {

            $ctrl.serien = data.data;

        });


    }
});

