'use strict';

angular.module('app.forms').controller('FormsCrudCtrl', function ($scope,$http,$state,$stateParams) {

                        $scope.state=$stateParams;
                        $scope.formData={};
                        // process the form
                         $scope.processForm = function(e,formulario) {
                            e.preventDefault();
                            var dataForm;
                            dataForm =new FormData(document.getElementsByName(formulario)[0]);
                            $state.go($state.$current,{submited:true,formData:dataForm},{reload:true});
                        };
                    });




