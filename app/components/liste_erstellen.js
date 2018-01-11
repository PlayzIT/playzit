"use strict";

app.component("liste", {
    templateUrl: "components/liste_erstellen.html",
    controller: "ListeController"
});

app.controller("ListeController", function($http) {

    let $ctrl = this;

    $ctrl.beschreibung = "";
    $ctrl.privat = true;

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
        $ctrl.aktuelleListe.push({"id": id, "name": name});
        console.log($ctrl.aktuelleListe);
    };

    $ctrl.loescheAusListe = function(object){
        var index = $ctrl.aktuelleListe.indexOf(object);
        $ctrl.aktuelleListe.splice(index, 1);
    };

    $ctrl.starteInsert = function () {

        if($ctrl.aktuelleListe !== "") {
            $http.post("insert_liste.php", {
                "aktuelleListe": $ctrl.aktuelleListe,
                "name": $ctrl.listenname,
                "beschreibung": $ctrl.beschreibung,
                "privat": $ctrl.privat,
                "favourite": false
            }).then(function (data) {
                if(data.data == "1"){
                    console.log("yes perfekt");
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