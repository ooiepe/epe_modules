'use strict';
//need to figure out if there a way to dynamically add these services from drupal module
var resourceBrowserService = angular.module('resourceBrowserService',['ngResource']);

resourceBrowserService.factory('epeService', function($resource) {
  var factory = $resource(Drupal.settings.epe.base_path + 'api/resource/:resource_type', {resource_type: '@resource_type'}, {});
  return factory;
});
