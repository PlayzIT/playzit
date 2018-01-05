"use strict";

app.component("bewertenSerien", {
	templateUrl: "components/bewertenSerien.html",
	controller: "BewertenSerien",
	bindings:{
		serienId:"<"
	}
});


app.controller("BewertenSerien", function ($http) {
    var $ctrl = this;
    var that = this;
    this.error=false;
    this.Kategorien = {};
    this.serienId;


    this.loggedIn = function(){
        var logged=false;
        $.post("isLoggedIn.php", {
        }).then(function (data) {
            if(data== "1"){

                logged= true;

            }else{

                logged= false;
            }
        });
        return logged;
    };


    this.bewertungSenden = function () {

        if($ctrl.loggedIn()){
            $http.post("database_send_bewertung_serien.php",{
                'schnitt':this.Kategorien.schnitt,
				'kamera':this.Kategorien.kamera,
				'darsteller':this.Kategorien.darsteller,
				'story':this.Kategorien.story,
				'effekte':this.Kategorien.effekte,
				'audio':this.Kategorien.audio,
				'genre':this.Kategorien.genre,

                'serie' : this.serienId

            }).then(function (data){
                window.location = "master_serien.html";
            });
        }else{
            this.error = true;
        }




    }

});
