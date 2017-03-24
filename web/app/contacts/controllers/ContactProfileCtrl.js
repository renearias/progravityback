angular.module('app.contacts').controller('ContactProfileCtrl', function($scope, $uibModal, $log/*, deps*/){

        $scope.openModal = function (uid) {
            
            var modalInstance = $uibModal.open({
                templateUrl: Routing.generate('clientes_change_equipo',{id:uid}),
                backdrop:true,
                //size:'lg',
                controller: function($scope, $uibModalInstance){
                    $scope.closeModal = function(){
                        $uibModalInstance.close();
                    }
                }//,
                /*resolve:{
                    deps:deps
                }*/
                
            });

            modalInstance.result.then(function () {
                $log.info('Modal closed at: ' + new Date());

            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });


        };
        
        $scope.urlContrato=function(id){
                return Routing.generate('imprimir_contrato',{id:id});
            };
         $scope.urlInstalacion=function(cedula){
                return Routing.generate('imprimir_instalacion',{id:cedula});
            };
         $scope.urlAnexo=function(cedula){
                return Routing.generate('imprimir_anexo',{id:cedula});
            };
         $scope.urlAdendumNormal=function(id){
                return Routing.generate('imprimir_adendum_normal',{id:id});
            };   
         $scope.urlAdendumCambioEquipo=function(cedula){
                return Routing.generate('imprimir_adendum_cambio_equipo',{id:cedula});
            };
         $scope.urlAdendumCambioPlan=function(cedula){
                return Routing.generate('imprimir_adendum_cambio_plan',{id:cedula});
            };      


    });
    