"use strict";

app.component("listeSpiele", {
    templateUrl: "components/liste-spiele.html",
    bindings: {},
    controller: "listeSpieleController"
});


app.controller("listeSpieleController", function ($http) {
    var $ctrl = this;
    this.listClicked;
    this.lists=[];
    $ctrl.userId;
    this.games=[];
    this.$onInit = function () {
        $http.post("getUserId.php", {

        }).then(function(data){
            $ctrl.userId=data;
        });

      this.getLists();
    };



    this.getLists = function(){
        $http.post("database_get_lists_spiele.php", {

            },
            console.log("data request")
        ).then(function (data) {
            $ctrl.lists = data.data;

        });
    };

    this.output = function () {
        console.log(this.listClicked);
    };


    this.getGames = function(){
        $http.post("database_select.php", {
                'query':"select * from game join gPartOfGL on(Game_ID=G_ID) " +
                "where GList_ID = "+$ctrl.listClicked+";"
            },
            console.log("data request")
        ).then(function (data) {
            console.log(data);
            if(data.data=="{success: false}"){
                $ctrl.games.splice(0,$ctrl.games.length);
                $ctrl.hideRight = true;
            }else{
                $ctrl.games.splice(0,$ctrl.games.length);
                $ctrl.games = data.data;
                $ctrl.hideRight = false;
            }

        });
    }

    this.removeGame = function(gameId){
        $http.post("database_remove_list_spiele.php", {
            'state':"game",
            'gameId':gameId,
            'listId':$ctrl.listClicked
        }).then(function (data) {
            console.log(data);
        });
    };


    this.removeList = function(){
        $http.post("database_remove_list_spiele.php", {
            'state':"list",
            'gameId':null,
            'listId':$ctrl.listClicked
        }).then(function (data) {
            console.log(data);
        });
    };

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