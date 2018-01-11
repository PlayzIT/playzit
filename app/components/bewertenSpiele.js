"use strict";

app.component("bewertenSpiele", {
    templateUrl: "components/bewertenSpiele.html",
    controller: "BewertenSpiele",
    bindings: {
        gameId: "<"
    }
});


app.controller("BewertenSpiele", function ($http) {
    var $ctrl = this;
    var that = this;
    this.error = false;
    this.Kategorien = {};
    $ctrl.logged = false;


    this.$onInit = function () {
          this.loggedIn();
    };

    this.loggedIn = function () {
            $http.post("isLoggedIn.php", function () {
        }).then(function (data) {
            $ctrl.logged = data.data == "1";
        });
    };


    this.bewertungSenden = function () {
        if ($ctrl.logged) {
            $http.post("database_send_bewertung_spiele.php", {
                'grafik': this.Kategorien.grafik,
                'gameplay': this.Kategorien.gameplay,
                'audio': this.Kategorien.audio,
                'steuerung': this.Kategorien.steuerung,
                'charaktere': this.Kategorien.charaktere,
                'story': this.Kategorien.story,
                'game': this.gameId

            }).then(function (data) {
                window.location = "master_spiele.html";
            });
        } else {
            this.error = true;
        }


    }
});


