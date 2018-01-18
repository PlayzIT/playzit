"use strict";

app.component("suchleiste", {
    templateUrl: "components/suchleiste.html",
    controller: "sucheController",
    bindings: {
        typ: "@",
        gibAus: "&?"
    }
});


app.controller("sucheController", function ($http) {
    let $ctrl = this;

    $ctrl.$onInit = function(){
        $ctrl.suche = "";
        $ctrl.games = [];
        $ctrl.series = [];
        $ctrl.isSearchEmpty= false;
    };

    $ctrl.sucheInAction = function() {

        if($ctrl.suche.trim() === ""){
            $ctrl.isSearchEmpty = true;
            $ctrl.games = [];
            $ctrl.series = [];
        }else{
            $ctrl.isSearchEmpty = false;
            $ctrl.games = [];
            $ctrl.series = [];
            $http.post("suche.php", {"suche": $ctrl.convertToSearchable(), "typ"  : $ctrl.typ}
            ).then(function (data) {
                if(data.data === ""){
                    $ctrl.isSearchEmpty = true;
                    $ctrl.games = [];
                    $ctrl.series = [];
                }else {
                    $ctrl.isSearchEmpty = false;
                    console.log(data.data);
                    if($ctrl.typ === "game") {
                        $ctrl.games = data.data;
                        $ctrl.gibAus({"spiele": $ctrl.games});
                    }else {
                        $ctrl.series = data.data;
                        $ctrl.gibAus({"serien": $ctrl.series});
                    }
                }
            });
        }
    };

    $ctrl.fuegeZuListeHinzu = function(id, name){
        $ctrl.zuListeHinzufuegen({
            "id": id,
            "name": name
        });
    };

    $ctrl.convertToSearchable = function () {
        let result = "%";
        let array = $ctrl.suche.split(/[:\-;_+ ]/);

        for(let i = 0; i < array.length; i++){
            result +=  array[i] + "%";
        }

        return result;
    };
});
