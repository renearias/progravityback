"use strict";

angular.module('app.contacts', ['ui.router'])
       .config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when('/clientes/', '/clientes');
    var rutas={create:'clientes_create',
                new:'clientes_api_new',
                edit:'clientes_api_edit',
                update:'clientes_update',
                state_created:'app.contacts.profile',
                state_updated:'app.contacts.profile'
                 };
    $stateProvider
        .state('app.contacts', {
            abstract: true,
            data: {
                title: 'Clientes'
            }
        })

        .state('app.contacts.list', {
            url: '/clientes',
            data: {
                title: 'Clientes'
            },
            views: {
                "content@app": {
                    templateUrl: Routing.generate('clientes_api'),
                    resolve: {
                            scripts: function(lazyScript){
                                return lazyScript.register([
                                    'build/vendor.datatables.js'
                                ]);
                            }
                        }
                }
            }
                    

        })
        .state('app.contacts.activos', {
            url: '/clientesactivos',
            data: {
                title: 'Clientes Activos'
            },
            views: {
                "content@app": {
                    templateUrl: Routing.generate('clientes_activos_api'),
                    resolve: {
                            scripts: function(lazyScript){
                                return lazyScript.register([
                                    'build/vendor.datatables.js'
                                ]);
                            }
                        }
                  
                }
            }
        })
         .state('app.contacts.suspendidos', {
            url: '/clientessuspendidos',
            data: {
                title: 'Clientes Suspendidos'
            },
            views: {
                "content@app": {
                    templateUrl: Routing.generate('clientes_suspendidos_api'),
                    resolve: {
                            scripts: function(lazyScript){
                                return lazyScript.register([
                                    'build/vendor.datatables.js'
                                ]);
                            }
                        }
                  
                }
            }
        })
        .state('app.contacts.retirados', {
            url: '/clientesretirados',
            data: {
                title: 'Clientes Retirados'
            },
            views: {
                "content@app": {
                    templateUrl: Routing.generate('clientes_retirados_api'),
                    resolve: {
                            scripts: function(lazyScript){
                                return lazyScript.register([
                                    'build/vendor.datatables.js'
                                ]);
                            }
                        }
                  
                }
            }
        })
        .state('app.contacts.profile', {
            url: '/clientes/{id:[0-9]{1,11}}',
            data: {
                title: 'Perfil Cliente'
            },
            views: {
                "content@app": {
                    templateProvider: function($http, $stateParams){
                        return $http.get(Routing.generate('clientes_api_show',{id:$stateParams.id}))
                                .then(function(response) {
                                          return response.data;
                                           });
                    },
                    controller: 'ContactProfileCtrl',
                    resolve: {
                            scripts: function(lazyScript){
                                return lazyScript.register([
                                    'build/vendor.ui.js'
                                ]);
                            }
                        }
                    
                }
            }
        })
        .state('app.contacts.new', {
            url: '/clientes/new',
            params:{
              submited:false,
              formData:null
            },
            data: {
                title: 'Nuevo'
            },
            views: {
                "content@app": {
                     templateProvider:function($stateParams,FormsCrud){
                              return FormsCrud.nuevo($stateParams,rutas);
                         },
                    controller: 'FormsCrudCtrl'
                   
                }
            }
        })
        .state('app.contacts.edit', {
            url: '/clientes/{id:[0-9]{1,11}}/edit',
            params:{
                id:undefined,
                submited:false,
                formData:null
            },
            data: {
                title: 'Editar'
            },
            views: {
                "content@app": {
                     templateProvider:function($stateParams,FormsCrud){
                              return FormsCrud.edit($stateParams,rutas);
                         },
                    controller: 'FormsCrudCtrl'
                    
                }
            }
        })
});

