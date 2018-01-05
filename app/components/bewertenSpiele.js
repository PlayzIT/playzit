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
    this.error=false;
    this.Kategorien = {};
    this.gameId;


    this.loggedIn = function(){
        $.post("isLoggedIn.php", {
        }).then(function (data) {
            if(data== "1"){
                return true
            }else{
                return false;
            }
        });
    };




    this.bewertungSenden = function () {

        if($ctrl.loggedIn()){
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
        }else{
            this.error = true;
        }




    }
});


