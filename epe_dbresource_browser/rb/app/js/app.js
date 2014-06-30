var underscore = angular.module('underscore', []);
underscore.factory('_', function() {
  return window._; // assumes underscore has already been loaded on the page
});

var rbapp = angular.module('rbapp', ['ngRoute','ui.bootstrap','ngProgress','underscore']);
rbapp.config(['$routeProvider','$locationProvider',
  function($routeProvider, $locationProvider) {
    $routeProvider
      .when('/', {
        controller:'IndexController',
        templateUrl:Drupal.settings.epe.base_path + 'resource-browser/partial/index.html'
      })
      .when('/search', {
        controller:'SearchController',
        templateUrl:Drupal.settings.epe.base_path + 'resource-browser/partial/search.html',
        reloadOnSearch: false
      })
      .when('/search/:term', {
        controller:'SearchController',
        templateUrl:Drupal.settings.epe.base_path + 'resource-browser/partial/search.html',
        reloadOnSearch: false
      })
      .when('/dialog/search', {
        controller:'DialogSearchController',
        templateUrl:Drupal.settings.epe.base_path + 'resource-browser/partial/search.html'
      })
      .when('/dialog/search/:term', {
        controller:'DialogSearchController',
        templateUrl:Drupal.settings.epe.base_path + 'resource-browser/partial/search.html'
      })
      .otherwise({redirecTo:'/search'});

    //$locationProvider.html5Mode(true);
  }]);
