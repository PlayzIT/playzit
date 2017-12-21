"use strict";

app.component("bewertenSpiele", {
	templateUrl: "components/bewertenSpiele.html",
	controller: "BewertenSpiele",
    bindings: {
	    gameId: "<"
    }
});


app.controller("BewertenSpiele", function ($http) {

    var that = this;
    this.Kategorien = {};
    this.gameId;
    this.$onInit = function(){
        this.userId=0;

    }

    this.bewertungSenden = function () {
        $http.post("database_send_bewertung_spiele.php",{
            'grafik' : this.Kategorien.grafik,
            'gameplay' : this.Kategorien.gameplay,
            'audio' : this.Kategorien.audio,
            'steuerung' : this.Kategorien.steuerung,
            'charaktere' : this.Kategorien.charaktere,
            'story' : this.Kategorien.story,
            'game' : this.gameId

        }).then(function (data){
            window.location = "master_spiele.html";
        });




    }
});


