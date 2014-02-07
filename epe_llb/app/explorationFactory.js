'use strict';

var explorationFactory = angular.module('explorationFactory',[]);

explorationFactory.factory('explorationFactory', function($window, $rootScope) {
  var items = [];

  $window.addResources= function(resources) {
    angular.forEach(resources, function(resource) { items.push(resource) });
    $rootScope.$digest();
  }

  return {
    items: items,
  }
});

