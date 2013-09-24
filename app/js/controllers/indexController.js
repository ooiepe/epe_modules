'use strict';

var IndexController = function($scope, $location, $routeParams) {
  $scope.resource_modules = [];
  $scope.radioModel = {};

  angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(module, index) {
    $scope.resource_modules.push({api:module.api,label:module.label});
  });

  $scope.search = function() {
    if(typeof $routeParams['dialog'] != "undefined") { $location.search({dialog:true}); }
    if(typeof $scope.radioModel.id != "undefined") { $location.search({type:$scope.radioModel.id}); }

    if(typeof $scope.term == "undefined") {
      $location.path('/search');
    } else {
      $location.path('/search/' + $scope.term);
    }
  }
}
