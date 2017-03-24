"use strict";

angular.module('app').directive('languageSelector', function(Language){
    return {
        restrict: "EA",
        replace: true,
        templateUrl: Routing.generate('language-selector'),
        scope: true
    }
});