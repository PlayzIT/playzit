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

        if($ctrl.logged){
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
                console.log(data);
                window.location = "master_serien.html";
            });
        }else{
            this.error = true;
        }




    }

});
