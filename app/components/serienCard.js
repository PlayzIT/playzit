"use strict";

app.component("serienCard", {
    templateUrl: "components/serien-card.html",
    controller: "SerienCardController",
    bindings:{

        name:"<",
        description: "<?",
        image:"<",
        id:"<"

    }
});

app.controller("SerienCardController", function ($http) {
    let $ctrl = this;

    $ctrl.lists = [];

    $ctrl.$onInit = function () {
        $http.post("getUserId.php", {

        }).then(function(data){
            $ctrl.userID = data == null ? "" : data;
            $ctrl.getLists();
        });
    };

    $ctrl.getLists = function () {
        if($ctrl.userID) {
            $http.post("database_get_lists_serien.php", {},
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
        $http.post("database_insert_series_into_existing_list.php", {
            "listenID": $ctrl.liste,
            "serieID": $ctrl.id
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

