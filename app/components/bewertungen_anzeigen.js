"use strict";

app.component("bewertung", {
    templateUrl: "components/bewertungen_anzeigen.html",
    controller: "bewertungController",
    bindings: {
        typ: "@",
        id: "@"
    }
});

app.controller("bewertungController", function ($http) {
    let $ctrl = this;

    $ctrl.result = [];

    $ctrl.$onInit = function(){
        $http.post("bewertungen.php", {"id": $ctrl.id, "typ": $ctrl.typ}).then(function(data){
            //console.log(data);
            $ctrl.splitUserReviews(data.data);
            //console.log(data.data);
            //$ctrl.result = data.data;
        });
    };

    $ctrl.splitUserReviews = function(array){
        if(array.length !== 0){
            let currentUser = array[0]['nickname'];
            let reviewsFromCurrentUser = [];

            for(let i = 0; i < array.length; i++){
                if(array[i]['nickname'] !== currentUser){
                    currentUser = array[i]['nickname'];
                    $ctrl.result.push(reviewsFromCurrentUser);
                    reviewsFromCurrentUser = [];
                    reviewsFromCurrentUser.push(array[i]);
                }else{
                    reviewsFromCurrentUser.push(array[i]);
                }
            }

            $ctrl.result.push(reviewsFromCurrentUser);
        }
    }

});