/**
 * Created with JetBrains PhpStorm.
 * User: huuthanh3108
 * Date: 8/22/13
 * Time: 2:03 PM
 * To change this template use File | Settings | File Templates.
 */
var app = angular.module('app',['ngResource','ngRoute','flash','app.localeTranslation','ui.bootstrap','infinite-scroll']).config(['$routeProvider','$httpProvider','$locationProvider', function($routeProvider,$httpProvider,$locationProvider) {
    $routeProvider
        .when('/thanhlap', {templateUrl: Core.baseUrl+'/tpl/thanhlap/index.html', controller: 'ThanhlapCtrl'})
        .when('/caydonvi', {templateUrl: Core.baseUrl+'/tpl/caydonvi/list.html', controller: 'CaydonviCtrl'})
        .when('/tochuc', {templateUrl: Core.baseUrl+'/tpl/tochuc/list.html', controller: 'TochucCtrl'});
        //.otherwise({redirectTo: '/home'});
    $httpProvider.defaults.transformRequest = function (data) {
        var str = [];
        for (var p in data) {
            data[p] !== undefined && str.push(encodeURIComponent(p) + '=' + encodeURIComponent(data[p]));
        }
        return str.join('&');
    };
    $httpProvider.defaults.headers.put['Content-Type'] = $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    //$locationProvider.html5Mode(false);
   // $locationProvider.html5Mode(true).hashPrefix('!');
}]);
app.run(['$location', '$rootScope', function($location, $rootScope) {

}]);