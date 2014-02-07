var explorationController = function($scope, explorationFactory) {
  $scope.items = explorationFactory.items;

  console.log($scope.items);

  //$scope.output = 'test';
}

window.addResources([{title:'test1'},{title:'test2'}]);
