"use strict";

angular.module('app.inventario.equipos', ['ui.router'])
    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/equipos/', '/equipos');
        var rutas={create:'equipos_create',
                    new:'equipos_api_new',
                    edit:'equipos_api_edit',
                    update:'equipos_update',
                    list:'equipos_api',
                    state_created:'app.inventario.equipos.show',
                    state_updated:'app.inventario.equipos.show'
                     };
                     
        var rutasdetipos={create:'tiposdeequipo_create',
                    new:'tiposdeequipo_new',
                    edit:'tiposdeequipo_edit',
                    update:'tiposdeequipo_update',
                    show:'tiposdeequipo_show',
                    list:'tiposdeequipo',
                    state_created:'app.inventario.tiposdeequipo.show',
                    state_updated:'app.inventario.tiposdeequipo.show'
                     };             
        $stateProvider

            .state('app.inventario.equipos', {
                abstract: true,
                data: {
                    title: 'Equipos'
                }
            })
            
            .state('app.inventario.tiposdeequipo', {
                abstract: true,
                data: {
                    title: 'Tipo de Equipos'
                }
            })

            .state('app.inventario.equipos.list', {
                url: '/equipos',
                data: {
                    title: 'Equipos'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('equipos_api'),
                        
                    }
                }
            })
            .state('app.inventario.equipos.show', {
                url: '/equipos/{id:[0-9]{1,11}}',
                data: {
                    title: 'Mostrando Equipo'
                },
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate('equipos_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('app.inventario.equipos.new', {
                url: '/equipos/new',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                    title: 'Nuevo Equipo'
                },
                views: {
                    "content@app": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.nuevo($stateParams,rutas);
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
            
            .state('app.inventario.tiposdeequipo.list', {
                url: '/equipos/tipos',
                data: {
                    title: 'Tipos de Equipo'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('tiposdeequipo'),
                        
                    }
                }
            })
                .state('app.inventario.tiposdeequipo.show', {
                    url: '/tiposdeequipo/{id:[0-9]{1,11}}',
                    data: {
                        title: 'Mostrando Tipos de Equipo'
                    },
                    views: {
                        "content@app": {
                            templateUrl: function($stateParams){
                                return Routing.generate(rutasdetipos.show,{id:$stateParams.id});
                            }
                        }
                    }
                })
            .state('app.inventario.tiposdeequipo.new', {
                url: '/equipos/nuevotipo',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                    title: 'Nuevo Tipo de Equipo'
                },
                views: {
                    "content@app": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.nuevo($stateParams,rutasdetipos);
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
            .state('app.inventario.tiposdeequipo.edit', {
                url: '/equipos/tipos/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                    title: 'Editar Tipo de Equipo'
                },
                views: {
                    "content@app": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.edit($stateParams,rutasdetipos);
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
            .state('app.inventario.equipos.edit', {
                url: '/equipos/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                    title: 'Editar Equipo'
                },
                views: {
                    "content@app": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.edit($stateParams,rutas);
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            });
});
