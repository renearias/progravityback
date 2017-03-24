'use strict';

angular.module('app.contratos', ['ui.router'])
       .config(function ($stateProvider,$urlRouterProvider) {
    $urlRouterProvider.when('/contratos/', '/contratos');
    $stateProvider
        .state('app.contratowiz', {
            url: '/contratos',
            data: {
                title: 'Contratos'
            },
            views: {
                "content@app": {
                    templateUrl: Routing.generate('contrato-wizard'),
                    controller: 'ContratoWizardCtrl',
                    resolve: {
                        provincias: function($http){
                            return  $http.get(Routing.generate('provincias'))
                                        .then(function(response){
                                            return response.data;
                                    });
                        },
                        planes: function($http){
                            return  $http.get(Routing.generate('find_planes'))
                                        .then(function(response){
                                            return response.data;
                                    });
                        },
                        equipos: function($http){
                            return  $http.get(Routing.generate('buscar_equipos_libres'))
                                        .then(function(response){
                                            return response.data;
                                    });
                        },
                        scripts: function(lazyScript){
                            return lazyScript.register([
                                "build/vendor.ui.js"
                            ]);
                        }

                    }
                }
            }
        })
        .state('app.cambiarequipo', {
            url: '/cambiarequipo',
            data: {
                title: 'Contratos'
            },
            views: {
                "content@app": {
                    templateUrl: Routing.generate('change_equipo'),
                    controller: 'CambiarEquipoWizardCtrl',
                    resolve: {
                        provincias: function($http){
                            return  $http.get(Routing.generate('provincias'))
                                        .then(function(response){
                                            return response.data;
                                    });
                        },
                        planes: function($http){
                            return  $http.get(Routing.generate('find_planes'))
                                        .then(function(response){
                                            return response.data;
                                    });
                        },
                        equipos: function($http){
                            return  $http.get(Routing.generate('buscar_equipos_libres'))
                                        .then(function(response){
                                            return response.data;
                                    });
                        },
                       scripts: function(lazyScript){
                            return lazyScript.register([
                                "build/vendor.ui.js"
                            ]);
                        }
                    }
                }
            }
        });

});
