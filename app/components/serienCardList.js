"use strict";

app.component("serienCardList", {
    templateUrl: "components/serien-card-list.html",
    bindings: {},
    controller: "serienCardListController"
});


app.controller("serienCardListController", function ($http) {
    var $ctrl = this;
    $ctrl.serien = [];

    this.$onInit = function () {

        $http.post("database_select.php", {
                'query': "SELECT * FROM series order by RAND() limit 15;",
            },
            console.log("data request")
        ).then(function (data) {

            $ctrl.serien = data.data;
            for(let i = 0; i < $ctrl.serien.length; i++){
                $ctrl.serien[i]['S_Images'] = $ctrl.serien[i]['S_Images'].replace("original" , "w500");
            }
            //console.log($ctrl.serien[0]['S_Images'].replace("original" , "w500"));
            //console.log($ctrl.serien);


        });


    }
});

