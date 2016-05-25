define(['angularAMD','angularRoute','angularWebstorage','ngProgress','underscore'], function(angularAMD) {
  var app = angular.module("app", ['ngRoute','underscore','webStorageModule','ngProgress']);
  app.config(['$routeProvider','$locationProvider',
    function ($routeProvider,$locationProvider) {
    $routeProvider.
      when('/search', angularAMD.route({
        templateUrl: Drupal.settings.resourceBrowser.appPath + '/partial/resource_browser.html',
        controller: 'SearchCtrl'
      })).
      otherwise({redirectTo: '/search'});
  }]).run(['$rootScope','$location',function($rootScope, $location) {
    $rootScope.$on('$locationChangeSuccess', function(event, newurl, oldurl) {      
      _.forEach(angular.element('.menu.nav .dropdown-menu li'), function(li, lindex) {
        var href = angular.element(li)[0]['children'][0]['href'];        
        if(angular.element(li).hasClass('active')) {
          angular.element(li).removeClass('active');
        }
        if(newurl.indexOf(href) > -1) {
          angular.element(li).addClass('active');
        }
      });
    });
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
