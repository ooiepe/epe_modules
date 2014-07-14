'use strict';

var resourceBrowserApp = angular.module('resourceBrowserApp', ['ngRoute','ui.bootstrap','ngProgress','rbcontroller','resourceBrowserService','resourceBrowserFilter','resourceBrowserDirective']);
resourceBrowserApp.config(['$routeProvider','$locationProvider',
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
      .otherwise({redirecTo:'/'});

    //$locationProvider.html5Mode(true);
  }]);
