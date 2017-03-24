'use strict';

angular.module('app.contratos').controller('ContratoWizardCtrl', ['$scope','$http','provincias','planes','equipos', function($scope,$http,provincias,planes,equipos){

        
        $scope.cliente={
                            id:'no def',
                            legalcli:false,
                            codcn:'GP'
                        };
        $scope.saved=false;
        $scope.codcnChange=function(legalcli){
                                        if (legalcli)
                                        $scope.cliente.codcn='GR';
                                        else
                                        $scope.cliente.codcn='GP';
                                };
        $scope.provincias=provincias;
        $scope.planes=planes;
        $scope.equipos=equipos;
        $scope.getIp=function(plan){
                        $scope.cliente.planip=null;
                        return  $http.get(Routing.generate('set_ip',{plan:plan}))
                                            .then(function(response){
                                                $scope.cliente.planip=response.data.ip;
                                                return response.data;
                                        });
        };
        $scope.wizard1CompleteCallback = function(wizardData){
            console.log('wizard1CompleteCallback', wizardData);
            $http({
                    url:Routing.generate('nuevo_usuario'),
                    method: 'POST',
                    data:wizardData
                   }).then(function(response){
                                                
                                                //$scope.cliente.id=2095;
                                                $scope.cliente.id=response.data.id;
                                                $scope.saved=true;
                                                $scope.messageFinal="El cliente ha sido registrado exitosamente"
                                                $.smallBox({
                                                    title: "Felcitaciones! El contacto ha sido enviado",
                                                    content: "<i class='fa fa-clock-o'></i> <i>1 segundo atras...</i>",
                                                    color: "#5F895F",
                                                    iconSmall: "fa fa-check bounce animated",
                                                    timeout: 4000
                                                });
                                               return response.data;
                                        });
            
        };
        $scope.messageFinal="De click en Siguiente para enviar los datos del cliente";
        $scope.urlContrato=function(){
                return Routing.generate('imprimir_contrato',{id:$scope.cliente.id})
            };
        $scope.imprimirContrato = function (elem) {
            angular.element(".printable").html(angular.element("#remoteModalContrato .modal-content").html())
         };   
         $scope.urlInstalacion=function(){
                return Routing.generate('imprimir_instalacion',{id:$scope.cliente.id})
            };
        $scope.imprimirInstalacion = function (elem) {
            angular.element(".printable").html(angular.element("#remoteModalInstalacion .modal-content").html())
         };   
         $scope.urlAnexo=function(){
                return Routing.generate('imprimir_anexo',{id:$scope.cliente.id})
            };
        $scope.imprimirAnexo = function (elem) {
            angular.element(".printable").html(angular.element("#remoteModalAnexo .modal-content").html())
         };
         $scope.urlAdendum=function(){
                return Routing.generate('imprimir_adendum_normal',{id:$scope.cliente.id})
            };
        $scope.imprimirAdendum = function (elem) {
            angular.element(".printable").html(angular.element("#remoteModalAdendum .modal-content").html())
         };
        /* $scope.urlAdendum=function(){
                return Routing.generate('imprimir_adendum_nuevo',{cedula:$scope.cliente.uid})
            };
        $scope.imprimirAnexo = function (elem) {
            angular.element(".printable").html(angular.element("#remoteModalAdendum .modal-content").html())
         };  */
        

    }]);