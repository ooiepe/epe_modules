'use strict';

angular.module('resourceBrowserApp', ['ui.bootstrap','resourceBrowserService','resourceBrowserFilter','resourceBrowserDirective'])
  .config(function($routeProvider, $locationProvider) {
    $routeProvider
      .when('/', {
        controller:IndexController,
        templateUrl:'/resource-browser/partial/index.html'
      })
      .when('/search', {
        controller:SearchController,
        templateUrl:'/resource-browser/partial/search.html'
      })
      .when('/search/:term', {
        controller:SearchController,
        templateUrl:'/resource-browser/partial/search.html'
      })
      .otherwise({redirecTo:'/'});

    //$locationProvider.html5Mode(true);
  });
