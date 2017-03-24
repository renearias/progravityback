"use strict";
angular.module('app.informes.supertel', ['ui.router'])
    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/informes/supertel/', '/informes/supertel');
        
        $stateProvider
           
            .state('app.informes.supertel', {
                abstract: true,
                data: {
                    title: 'SuperTel'
                },
                resolve: {
                            scripts: function(lazyScript){
                                return lazyScript.register([
                                    'build/vendor.datatables.js'
                                ]);
                            }
                        }
            })
            
            .state('app.informes.supertel.calidad', {
                abstract: true,
                data: {
                    title: 'Calidad'
                }
            })
            .state('app.informes.supertel.tarifa', {
                abstract: true,
                data: {
                    title: 'Tarifa'
                }
            })
            .state('app.informes.supertel.usuario', {
                abstract: true,
                data: {
                    title: 'Usuario'
                }
            })
            .state('app.informes.supertel.calidad.relacionclientes', {
                url: '/informes/supertel/calidad/relacionclientes',
                data: {
                    title: 'Relacion Clientes'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('inf_relacionclientes'),
                        
                    }
                }
            })
            .state('app.informes.supertel.calidad.reclamosgeneralesprocedentes', {
                url: '/informes/supertel/calidad/reclamosgeneralesprocedentes',
                data: {
                    title: 'Reclamos Generales Procedentes'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('inf_reclamosgeneralesprocedentes')
                    }
                }
            })
            .state('app.informes.supertel.calidad.reclamosfacturacion', {
                url: '/informes/supertel/calidad/reclamosfacturacion',
                data: {
                    title: 'Reclamos Facturacion'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('inf_reclamosfacturacion')
                    }
                }
            })
            .state('app.informes.supertel.calidad.promedioreparacionaverias', {
                url: '/informes/supertel/calidad/promedioreparacionaverias',
                data: {
                    title: 'Promedio de Reparacion de Averias'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('inf_promedioreparacionaverias'),
                        
                    }
                }
            })
            .state('app.informes.supertel.calidad.reclamoscapacidadcontratada', {
                url: '/informes/supertel/calidad/reclamoscapacidadcontratada',
                data: {
                    title: 'Reclamos Capacidad Contratada'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('inf_reclamoscapacidadcontratada')
                    }
                }
            })
            .state('app.informes.supertel.calidad.capacidadcontratada', {
                url: '/informes/supertel/calidad/capacidadcontratada',
                data: {
                    title: 'Capacidad Contratada'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('inf_capacidadcontratada'),
                        
                    }
                }
            })
            .state('app.informes.supertel.tarifa.conmutada', {
                url: '/informes/supertel/tarifa/conmutada',
                data: {
                    title: 'Tarifa Conmutada'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('inf_tarifas'),
                        
                    }
                }
            })
            .state('app.informes.supertel.usuario.lineasdedicadas', {
                url: '/informes/supertel/usuario/lineasdedicadas',
                data: {
                    title: 'Lineas Dedicadas'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('inf_lineasdedicadas'),
                    }
                }
            })
    
    });