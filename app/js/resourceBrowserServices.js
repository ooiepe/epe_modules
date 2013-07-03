'use strict';
//need to figure out if there a way to dynamically add these services from drupal module
var resourceBrowserService = angular.module('resourceBrowserService',['ngResource']);

resourceBrowserService.factory('imageService', function($resource) {
  var factory = $resource('/api/resource/image',
      {},{}
    );

  return factory;
});

resourceBrowserService.factory('documentService', function($resource) {
  var factory = $resource('/api/resource/document',
      {},{}
    );

  return factory;
});

resourceBrowserService.factory('multimediaService', function($resource) {
  var factory = $resource('/api/resource/multimedia',
      {},{}
    );

  return factory;
});
