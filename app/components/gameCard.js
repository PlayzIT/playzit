"use strict";

app.component("gameCard", {
    templateUrl: "components/game-card.html",
    controller: "SpieleCardController",
    bindings:{

        name:"<",
        description:"<",
        id:"<",

    }
});

app.controller("SpieleCardController", function ($http) {
    let $ctrl = this;

    $ctrl.lists = [];

    $ctrl.$onInit = function () {
        $http.post("getUserId.php", {

        }).then(function(data){
            $ctrl.userID = data.data == "null" ? "" : data.data;
            //console.log($ctrl.userID);
            $ctrl.getLists();
        });
    };

    $ctrl.getLists = function () {
        if($ctrl.userID) {
            $http.post("database_get_lists_spiele.php", {},
            ).then(function (data) {
                if (data.data != "") {
                    $ctrl.lists = data.data;

                } else {
                    $ctrl.lists = [];
                }
            });
        }
    };

    $ctrl.addeZurListe = function () {
        $http.post("database_insert_game_into_existing_list.php", {
            "listenID": $ctrl.liste,
            "gameID": $ctrl.id
        }).then(function (data) {
            if(data.data == "bereits in liste"){
                window.alert("Dieser Titel befindet sich bereits in der von Ihnen ausgewählten Liste!");
            }else if(data.data == ""){
                window.alert("Es ist ein Fehler aufgetreten, versuchen Sie sich anzumelden/registrieren oder die Seite neu zu laden.");
            }
            $ctrl.liste = "";
        });
    };

});

