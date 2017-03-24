"use strict";

angular.module('app.inventario', ['ui.router'])
    .config(function ($stateProvider) {

        $stateProvider
            .state('app.inventario', {
                abstract: true,
                data: {
                    title: 'Inventario'
                },
                resolve: {
                            scripts: function(lazyScript){
                                return lazyScript.register([
                                    'build/vendor.datatables.js'
                                ]);
                            }
                        }
            });

    });

