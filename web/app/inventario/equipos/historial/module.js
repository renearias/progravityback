"use strict";

angular.module('app.inventario.equipos.historial', ['ui.router'])
    .config(function ($stateProvider, $urlRouterProvider) {
            $urlRouterProvider.when('/equipos/historial/', '/equipos/historial');
            var rutas={create:'equipos_historial_create',
                        new:'equipos_historial_api_new',
                        edit:'equipos_historial_api_edit',
                        update:'equipos_historial_update',
                        list:'equipos_historial_api',
                        state_created:'app.inventario.equiposhistorial.show',
                        state_updated:'app.inventario.equiposhistorial.show'
                         };
            $stateProvider

                .state('app.inventario.equipos.historial', {
                    abstract: true,
                    data: {
                        title: 'Historial'
                    }
                })

                .state('app.inventario.equipos.historial.list', {
                    url: '/equipos/historial',
                    data: {
                        title: 'Equipos Historial'
                    },
                    views: {
                        "content@app": {
                            templateUrl: Routing.generate('equipos_historial_api')
                        }
                    }
                })
                .state('app.inventario.equiposhistorial.show', {
                    url: '/equipos/historial/{id:[0-9]{1,11}}',
                    data: {
                        title: 'Mostrando Equipo'
                    },
                    views: {
                        "content@app": {
                            templateUrl: function($stateParams){
                                return Routing.generate('equipos_historial_api_show',{id:$stateParams.id});
                            }
                        }
                    }
                })
                .state('app.inventario.equiposhistorial.new', {
                    url: '/equipos/historial/new',
                    params:{
                      submited:false,
                      formData:null
                    },
                    data: {
                        title: 'Nuevo Movimiento de Equipo'
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
                .state('app.inventario.equiposhistorial.edit', {
                    url: '/equipos/historial/{id:[0-9]{1,11}}/edit',
                    params:{
                        id:undefined,
                        submited:false,
                        formData:null
                    },
                    data: {
                        title: 'Editar Movimiento de Equipo'
                    },
                    views: {
                        "content@app": {
                             templateProvider:function($stateParams,FormsCrud){
                                      return FormsCrud.edit($stateParams,rutas);
                                 },
                            controller: 'FormsCrudCtrl',
                            
                        }
                    }
                })
        });

