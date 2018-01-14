"use strict";

app.component("kommentarlisteSpiele", {
    templateUrl: "components/kommentarliste-spiele.html",
    bindings: {
        gameId:"<",
    },
    controller: "kommentarlisteSpieleController"
});

app.controller("kommentarlisteSpieleController", function ($http) {
    this.kommentare = [];
    this.kommentar;
    var $ctrl = this;
    this.error=false;
    this.logged = false;

    this.loggedIn = function () {

        $http.post("isLoggedIn.php", function () {

        }).then(function (data) {
            $ctrl.logged = data.data == "1";
        });


    };





    this.$onInit = function () {
        $ctrl.loggedIn();

        $http.post("database_select.php", {
                'query': "SELECT gcommentID, nickname, content, fk_game, datum FROM gamecomment join user on (user_id=fk_user) where fk_game="+$ctrl.gameId+" order by datum desc;",
            },
            console.log("data request")
        ).then(function (data) {

            $ctrl.kommentare = data.data;
        });
    };

    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.replace(new RegExp(search, 'g'), replacement);
    };

    this.kommentarHinzufugen = function () {
        if($ctrl.logged){
            this.kommentar = this.kommentar.replaceAll("'", "\\'");
            this.kommentar= this.kommentar.replaceAll('"', '\\"');
            $http.post("database_send_kommentar_spiele.php", {
                'content': this.kommentar,
                'game': this.gameId
            }).then(function (data) {
                location.reload();
            });
        }else{
            this.error=true;
        }

    };




});