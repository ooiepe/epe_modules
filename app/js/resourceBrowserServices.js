'use strict';
//need to figure out if there a way to dynamically add these services from drupal module
var resourceBrowserService = angular.module('resourceBrowserService',['ngResource']);

resourceBrowserService.factory('epeService', function($resource) {
  var factory = $resource(Drupal.settings.epe.base_path + 'api/resource/:resource_type', {resource_type: '@resource_type'}, {});
  return factory;
});

resourceBrowserService.factory('epeServiceProvider', function($http) {
  var getData = function(param) {
    return $http({
      method: 'GET',
      url: Drupal.settings.epe.base_path + 'api/resource/' + param.resource_type,
      tracker: 'pizza'
    }).then(function(data) {
      return data;
    });
  }

  return {
    getData : getData
  }
});

resourceBrowserService.factory('srv', function($q,$http) {
  var queue=[];
  var execNext = function() {
    var task = queue[0];
    $http(task.c).then(function(data) {
      queue.shift();
      task.d.resolve(data);
      if (queue.length>0) execNext();
    }, function(err) {
      task.d.reject(err);
    })
    ;
  };
  return function(config) {
    var d = $q.defer();
    queue.push({c:config,d:d});
    if (queue.length===1) execNext();
    return d.promise;
  };
});
