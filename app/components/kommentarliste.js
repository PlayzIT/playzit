"use strict";

app.component("kommentarliste", {
    templateUrl: "components/kommentarliste.html",
    bindings: {

    },
    controller: "kommentarlisteController"
});

app.controller("kommentarlisteController", function ($scope) {

        $scope.comment = [];
        $scope.btn_add = function () {
            if ($scope.txtcomment != '') {
                $scope.comment.push($scope.txtcomment);
                $scope.txtcomment = "";
            }
        };

    $scope.remItem = function ($index) {
        $scope.comment.splice($index, 1);
        }
});