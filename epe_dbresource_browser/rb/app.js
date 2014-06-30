define(['angularAMD','angularRoute'], function(angularAMD) {
  var app = angular.module("app", ['ngRoute','underscore']);
  app.config(['$routeProvider','$locationProvider',
    function ($routeProvider,$locationProvider) {
    $routeProvider.
      when('/search', angularAMD.route({
        templateUrl: Drupal.settings.resourceBrowser.appPath + '/partial/resource_browser.html',
        controller: 'SearchCtrl'
      })).
      otherwise({redirectTo: '/search'});
  }]);


  require(['domReady!'], function(document) {
      try {
          // Wrap this call to try/catch
          angularAMD.bootstrap(app);
      }
      catch (e) {
          console.error(e.stack || e.message || e);
      }
  });

  return app;
});
