'use strict';

angular.module('resourceBrowserApp', ['ui.bootstrap','ngProgress','resourceBrowserService','resourceBrowserFilter','resourceBrowserDirective'])
  .config(function($routeProvider, $locationProvider) {
    $routeProvider
      .when('/', {
        controller:IndexController,
        templateUrl:Drupal.settings.epe.base_path + 'resource-browser/partial/index.html'
      })
      .when('/search', {
        controller:SearchController,
        templateUrl:Drupal.settings.epe.base_path + 'resource-browser/partial/search.html'
      })
      .when('/search/:term', {
        controller:SearchController,
        templateUrl:Drupal.settings.epe.base_path + 'resource-browser/partial/search.html'
      })
      .otherwise({redirecTo:'/'});

    //$locationProvider.html5Mode(true);
  });
