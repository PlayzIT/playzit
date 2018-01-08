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
    this.$onInit = function () {
        $http.post("database_select.php", {
                'query': "SELECT gcommentID, nickname, content, fk_game FROM gamecomment join user on (user_id=fk_user) where fk_game="+$ctrl.gameId+" order by datum desc;",
            },
            console.log("data request")
        ).then(function (data) {

            $ctrl.kommentare = data.data;
        });
    };


    this.kommentarHinzufugen = function () {
        $http.post("database_send_kommentar_spiele.php", {
            'content': this.kommentar,

            'game': this.gameId
        }).then(function (data) {
            location.reload();
        });
    };




});