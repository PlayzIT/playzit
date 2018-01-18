"use strict";

app.component("listeSerien", {
    templateUrl: "components/liste-serien.html",
    bindings: {},
    controller: "listeSpieleController"
});


app.controller("listeSpieleController", function ($http) {
    var $ctrl = this;
    this.listClicked = -1;
    this.lists=[];
    $ctrl.userId;
    this.serien=[];
    this.loading=true;
    this.$onInit = function () {
        $http.post("getUserId.php", {

        }).then(function(data){
            $ctrl.userId=data;
        });

        this.getLists();
    };



    this.getLists = function(){
        $http.post("database_get_lists_serien.php", {

            },
            //console.log("data request")
        ).then(function (data) {
            console.log(data);
            if(data.data != "") {
                $ctrl.lists = data.data;
                $ctrl.loading = false;
            }else{
                $ctrl.lists = [];
            }
        });
    };

    this.output = function () {
        //console.log(this.listClicked);
    };


    this.getSerien = function(){
        $http.post("database_select.php", {
                'query': "select * from series join sPartOfSL on(Series_ID=S_ID) " +
                "where SList_ID = " + $ctrl.listClicked + ";"
            },
            //console.log("data request")
        ).then(function (data) {
            //console.log(data);
            if (data.data == "{success: false}") {
                $ctrl.serien.splice(0, $ctrl.serien.length);
                $ctrl.hideRight = false;
            } else {
                $ctrl.serien.splice(0, $ctrl.serien.length);
                $ctrl.serien = data.data;
                //console.log(data.data);
                $ctrl.hideRight = false;
            }
            $ctrl.loading = false;
        });

    };

    /*this.insertSerien = function (id) {
        $http.post("database_insert_series_into_existing_list.php", {
            "listenID": $ctrl.listClicked,
            "serieID": id
        }).then(function (data) {
            console.log("insertSerien: " + data.data);
            $ctrl.loading=true;
            $ctrl.getSerien();
        });
    };*/

    this.removeSerien = function(serienId){
        $http.post("database_remove_list_serien.php", {
            'state':"series",
            'seriesId':serienId,
            'listId':$ctrl.listClicked
        }).then(function (data) {
            //console.log(data);
            $ctrl.loading=true;
            $ctrl.getSerien();
        });
    };


    this.removeList = function(listId) {
        if (confirm("Wollen Sie wirklich die Liste löschen? Alle Titel in der Liste werden aus Ihrer Liste entfernt und Ihre Liste wird gelöscht")) {
            $http.post("database_remove_list_serien.php", {
                'state': "list",
                'listId': listId
            }).then(function (data) {
                if (data.data == "1") {
                    $ctrl.loading = true;
                    $ctrl.getLists();
                    $ctrl.getSerien();
                } else if (data.data == "istFavorit") {
                    window.alert('Eine Favoritenliste kann nicht gelöscht werden!');
                }
            });
        }
    };

        this.goTo = function (id) {
            location.href = "serie-bewerten.php?id=" + id;
        }

});




/*

CREATE TABLE IF NOT EXISTS gamelist(
  GL_ID INT NOT NULL AUTO_INCREMENT,
  GListName VARCHAR(20),
  privat BOOL,
  descr VARCHAR(100),
  fk_user INT NOT NULL,
  favourite BOOL,
  PRIMARY KEY(GL_ID),
    CONSTRAINT FK_userConsGList FOREIGN KEY (fk_user)
    REFERENCES user(user_id)
);

CREATE TABLE IF NOT EXISTS gPartOfGL(
  Game_ID INT ,
  GList_ID INT,
  PRIMARY KEY(Game_ID,GList_ID),
    CONSTRAINT FK_game_idCons FOREIGN KEY (Game_ID)
    REFERENCES game(G_ID),
      CONSTRAINT FK_GList_IDCons FOREIGN KEY (GList_ID)
    REFERENCES gamelist(GL_ID)
);

CREATE TABLE IF NOT EXISTS game(
  G_ID INT NOT NULL ,
  G_Name VARCHAR(80),
  PRIMARY KEY(G_ID)
);
 */