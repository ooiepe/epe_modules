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
        //quick way of grabbing query params  
        var queryparams = angular.element(li)[0]['children'][0]['href'].split('?')[1];
        if(queryparams != undefined) {
          queryparams = queryparams.split('&');
        }        
        if(angular.element(li).hasClass('active')) {
          angular.element(li).removeClass('active');
        }
        var newqueryparam = newurl.split('?')[1];
        //param with type & filter, this is for "my" resource url
        if(newqueryparam != undefined && queryparams != undefined && queryparams.length == 2 && newqueryparam.indexOf(queryparams[0]) > -1 && newqueryparam.indexOf(queryparams[1]) > -1) {
          angular.element(li).addClass('active');        
        } else if(newqueryparam != undefined && queryparams != undefined && queryparams.length == 1 && newqueryparam.indexOf(queryparams[0]) > -1 && newqueryparam.indexOf('filter=') < 0) { //just type, make sure filter is not in param, this is for browser resource url
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
