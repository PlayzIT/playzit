"use strict";

app.component("bewertenSpiele", {
	templateUrl: "components/bewertenSpiele.html",
	controller: "BewertenSpiele"
});


app.controller("BewertenSpiele", ['$scope', '$http', function ($scope, $http) {
    this.$onInit = function () {
        this.bewertungSenden = function () {
            console.log(this.Kategorien);


            /*$http.post("sadf", { "data" : $scope.keywords}).
            then(function(data, status) {
                $scope.status = status;
                $scope.data = data;
                $scope.result = data;
            }, function(data, status) {
                $scope.data = data || "Request failed";
                $scope.status = status;
            });*/
        };
    };
}]);
