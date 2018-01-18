"use strict";

app.component("liste", {
    templateUrl: "components/liste_erstellen.html",
    controller: "ListeController",
    bindings: {
        typ: "@?"
    }
});

app.controller("ListeController", function($http, $scope) {

    let $ctrl = this;

    $ctrl.beschreibung = "";
    $ctrl.privat = true;

    $ctrl.$onInit = function () {
        $ctrl.typ = $ctrl.typ == undefined ? "game" : $ctrl.typ;
        console.log($ctrl.typ);
    };

    document.getElementsByClassName("oeffentlich")[0].addEventListener("mouseover", function() {
        this.style.cursor = "pointer";
    });

    $ctrl.items = [{
        name: "Listenname",
        editing: false
    }];

    $ctrl.editItem = function (item) {
        item.editing = true;
    };

    $ctrl.doneEditing = function (item) {
        item.editing = false;
        //dong some background ajax calling for persistence...
    };

    $ctrl.aktuelleListe = [];
    $ctrl.listenname = "Meine Liste";

    $ctrl.fuegeHinzu = function (id, name) {
       if(!$ctrl.containsObject({"id": id, "name": name}, $ctrl.aktuelleListe)) {
            $ctrl.aktuelleListe.push({"id": id, "name": name});
        }
        //console.log($ctrl.aktuelleListe);
    };

    $ctrl.loescheAusListe = function(object){
        var index = $ctrl.aktuelleListe.indexOf(object);
        $ctrl.aktuelleListe.splice(index, 1);
    };

    $ctrl.containsObject = function(obj, list) {
        for (let i = 0; i < list.length; i++) {
            if (list[i].id === obj.id && list[i].name === obj.name ) {
                return true;
            }
        }

        return false;
    };

    $ctrl.starteInsert = function () {

        if($ctrl.aktuelleListe !== "") {
            $http.post("insert_liste.php", {
                "typ": $ctrl.typ,
                "aktuelleListe": $ctrl.aktuelleListe,
                "name": $ctrl.listenname,
                "beschreibung": $ctrl.beschreibung,
                "privat": $ctrl.privat,
                "favourite": false
            }).then(function (data) {
                console.log(data);
                if(data.data == "1"){
                    console.log("yes perfekt");
                    window.location = $ctrl.typ == 'game'? "spiel-listen.php":"serie-listen.php";
                }else{
                    console.log("fehler");
                }
            });
        }

    };





    /**
     $http.post("insert_liste.php", {
        'gamelistname': this.listenname,
        'privat': this.privat,
        'description': this.desc,
        'favourite': this.favourite

    }).then(function (data) {
        if (data.success) {
            console.log("Erfolgreich inserted!");
        } else {
            console.log("Liste konnte nicht angelegt werden!");
        }
    });**/
});