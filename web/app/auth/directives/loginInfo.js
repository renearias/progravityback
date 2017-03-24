"use strict";

angular.module('app.auth').directive('loginInfo', function(User){

    return {
        restrict: 'A',
        templateUrl: Routing.generate('logininfo'),
        link: function(scope, element){
            User.initialized.then(function(){
                scope.user = User
            });
        }
    }
})
