'use strict';

var IndexController = function($scope, $location, $routeParams) {
  $scope.resource_modules = [];
  $scope.radioModel = {};

  angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(module, index) {
    $scope.resource_modules.push({api:module.api,label:module.label});
  });

  $scope.search = function() {
    var params = {};
    if(typeof $routeParams['dialog'] != "undefined") {
      //$location.search({dialog:true});
      //params.push({dialog:true});
      params['dialog'] = true;
    }
    if(typeof $scope.radioModel.id != "undefined") {
      //$location.search({type:$scope.radioModel.id});
      //params.push({type:$scope.radioModel.id});
      params['type'] = $scope.radioModel.id;
    }
    $location.search(params);

    if(typeof $scope.term == "undefined") {
      $location.path('/search');
    } else {
      $location.path('/search/' + $scope.term);
    }
  }
}
