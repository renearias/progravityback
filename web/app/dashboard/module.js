'use strict';

angular.module('app.dashboard', [
    'ui.router',
    'ngResource'
])

.config(function ($stateProvider) {
    $stateProvider
        .state('app.dashboard', {
            url: '/inicio',
            views: {
                "content@app": {
                    controller: 'DashboardCtrl',
                    templateUrl: Routing.generate('dashboard',{_format:'html'})
                }
            },
            data:{
                title: 'Dashboard'
            }
        })
        .state('app.dashboard-social', {
            url: '/dashboard-social',
            views: {
                "content@app": {
                    templateUrl: 'app/dashboard/social-wall.html'
                }
            },
            data:{
                title: 'Dashboard Social'
            }
        });
});
