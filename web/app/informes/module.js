"use strict";

angular.module('app.informes', ['ui.router'])
    .config(function ($stateProvider) {

        $stateProvider
            .state('app.informes', {
                abstract: true,
                data: {
                    title: 'Informes'
                }
            });

    });
