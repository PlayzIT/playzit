// Einziges Modul dieser App und seine Abhängigkeiten
var app = angular.module("playzit", [ "ngResource", "ngMessages", "ngSanitize",
    "ngAnimate", "ngMaterial", "ui.router" ]);

// Einstellungen für Debugging
app.config(function($logProvider, $compileProvider, $mdAriaProvider, $qProvider) {
    $logProvider.debugEnabled(true);
    $compileProvider.debugInfoEnabled(true);
    $mdAriaProvider.disableWarnings();
    $qProvider.errorOnUnhandledRejections(false);
});
