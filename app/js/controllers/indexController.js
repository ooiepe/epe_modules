'use strict';

var IndexController = function($scope, $location) {
  $scope.search = function() {
    if(typeof $scope.radioModel != "undefined") { $location.search({type:$scope.radioModel}); }

    if(typeof $scope.term == "undefined") {
      $location.path('/search');
    } else {
      $location.path('/search/' + $scope.term);
    }
  }
}
