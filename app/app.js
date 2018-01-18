// Einziges Modul dieser App und seine Abhängigkeiten
var app = angular.module("playzit", [ "ngResource", "ngMessages", "ngSanitize",
    "ngAnimate", "ngMaterial", "ui.router" ]);

app.controller('masterSerienSeiteController', function($scope) {

    $scope.getSerienFromSearch = function (data) {
        $scope.serien = data;
    };

    $scope.deleteSearch = function () {
        $scope.serien = null;
    };

});

app.controller('masterSpieleSeiteController', function($scope) {

    $scope.getSerienFromSearch = function (data) {
        $scope.spiele = data;
    };

    $scope.deleteSearch = function () {
        $scope.spiele = null;
    };
});

// Einstellungen für Debugging
app.config(function($logProvider, $compileProvider, $mdAriaProvider, $qProvider) {
    $logProvider.debugEnabled(true);
    $compileProvider.debugInfoEnabled(true);
    $mdAriaProvider.disableWarnings();
    $qProvider.errorOnUnhandledRejections(false);
});
