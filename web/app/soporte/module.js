"use strict";

angular.module('app.soporte', ['ui.router'])
       .config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when('/soporte/', '/soporte');
    var rutas={create:'soporte_create',
                new:'soporte_api_new',
                edit:'soporte_api_edit',
                update:'soporte_update',
                state_created:'app.soporte.show',
                state_updated:'app.soporte.show'
                 };
    $stateProvider
        .state('app.soporte', {
            abstract: true,
            data: {
                title: 'Soporte'
            }
        })

        .state('app.soporte.list', {
            url: '/soporte',
            data: {
                title: 'Soporte'
            },
            views: {
                "content@app": {
                    templateUrl: Routing.generate('soporte_api'),
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
        .state('app.soporte.show', {
            url: '/soporte/{id:[0-9]{1,11}}',
            data: {
                title: 'Ticket de Soporte'
            },
            views: {
                "content@app": {
                    templateProvider: function($http, $stateParams){
                        return $http.get(Routing.generate('soporte_api_show',{id:$stateParams.id}))
                                .then(function(response) {
                                          return response.data;
                                           });
                    },
                    //controller: 'ContactProfileCtrl',
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
        .state('app.soporte.new', {
            url: '/soporte/new',
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
        .state('app.soporte.edit', {
            url: '/soporte/{id:[0-9]{1,11}}/edit',
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

