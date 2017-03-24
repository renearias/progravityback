"use strict";


angular.module('app.layout', ['ui.router'])

.config(function ($stateProvider, $urlRouterProvider) {


    $stateProvider
        .state('app', {
            abstract: true,
            views: {
                root: {
                    templateUrl: Routing.generate('layout',{_format:'html'})
                }
            }
        });
    $urlRouterProvider.otherwise('/inicio');

})

