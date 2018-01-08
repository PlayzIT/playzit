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
    this.$onInit = function () {
        $http.post("database_select.php", {
                'query': "SELECT scommentID, nickname, content, fk_serie FROM seriescomment join user on (user_id=fk_user) where fk_serie="+$ctrl.seriesId+" order by datum desc;",
            },
            console.log("data request")
        ).then(function (data) {

            $ctrl.kommentare = data.data;
        });
    };


    this.kommentarHinzufugen = function () {
        $http.post("database_send_kommentar_serien.php", {
            'content': this.kommentar,
            'series': this.seriesId

        }).then(function (data) {
            location.reload();
        });
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