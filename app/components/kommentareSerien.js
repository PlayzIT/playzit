"use strict";

app.component("kommentarlisteSerien", {
    templateUrl: "components/kommentarliste-serien.html",
    bindings: {
        seriesId:"<",
    },
    controller: "kommentarlisteSerienController"
});

app.controller("kommentarlisteSerienController", function ($http) {
    this.kommentare = [];
    this.kommentar;
    var $ctrl = this;
    this.error=false;
    $ctrl.logged = false;

    this.loggedIn = function () {

        $http.post("isLoggedIn.php", function () {

        }).then(function (data) {
            $ctrl.logged = data.data == "1";
        });

    };



    this.$onInit = function () {

        this.loggedIn();
        $http.post("database_select.php", {
                'query': "SELECT scommentID, nickname, content, fk_serie, datum FROM seriescomment join user on (user_id=fk_user) where fk_serie="+$ctrl.seriesId+" order by datum desc;"
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
        this.kommentar = this.kommentar.replaceAll("'", "\\'");
        this.kommentar= this.kommentar.replaceAll('"', '\\"');
        if($ctrl.logged){
            $http.post("database_send_kommentar_serien.php", {
                'content': this.kommentar,
                'series': this.seriesId

            }).then(function (data) {
                location.reload();
            });
        }else{
            this.error=true;
        }

    };




});
/*
CREATE TABLE IF NOT EXISTS seriescomment(
    scommentID INT AUTO_INCREMENT NOT NULL,
    fk_user INT,
    fk_antwort INT,
    content VARCHAR(1000),
    fk_serie INT,
    datum DATETIME,
    PRIMARY KEY(scommentID),
    CONSTRAINT FK_userConsSComm FOREIGN KEY (fk_user)
REFERENCES user(user_id),
    CONSTRAINT FK_antwortConsSComm FOREIGN KEY (fk_antwort)
REFERENCES seriescomment(scommentID),
    CONSTRAINT FK_seriesConsSComm FOREIGN KEY (fk_serie)
REFERENCES series(S_ID)
)*/