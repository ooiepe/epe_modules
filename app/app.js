'use strict';

/*angular.module('llbResourceBrowser', ['ui.bootstrap','explorationFactory'])
  .config(function($routeProvider) {
    $routeProvider
      .when('/', {
        controller:explorationController,
        templateUrl:'/resource/llb/partial/index.html'
      })
      .otherwise({redirecTo:'/'});

    //$locationProvider.html5Mode(true);
  });*/

var app = angular.module('app', ['ui.sortable','ngSanitize','epe_llb_directive']);

app.factory('data', function($window, $rootScope) {
    var items = [];
    var copies = [];

    $window.addItem = function(item) {
      item.questions = [];
      items.push(item);
      $rootScope.$digest();
    };

    return {
        items: items
    };
});

app.controller('main', function($scope, data) {
    $scope.fn = {};
    $scope.currentCopy = {};
    $scope.currentCopies = {};
    $scope.currentCopies.keys = [];
    $scope.currentCopies.items = [];
    $scope.addnewquestion = false;
    $scope.newquestion = {};
    $scope.newquestion.text = '';
    $scope.editableItem = -1;

    $scope.items = data.items;

    $scope.removeDataSet = function(index) {
      $scope.items.splice(index,1);
    }

    $scope.fn.addQuestion = function(nid) {
      console.log(nid);
      //$scope.addnewquestion = true;
      //$scope.currentCopy = angular.copy($scope.items[index]);
      //$scope.items[index].questions.push({text:""});
      //$scope.currentCopy.questions.push({text:""});
      $scope.currentCopies.items[nid].questions.push({text:""});
    }

    $scope.fn.inItemEditArray = function(val) {
      var inarray = false;
      angular.forEach($scope.currentCopies.keys, function(value) { if(!inarray) {  if(value == val) { inarray = true; } } });

      return inarray;
    }

    $scope.fn.editItem = function(index) {
      //console.log($scope.items[index]);
      //$scope.editableItem = index;
      var editCopy = angular.copy($scope.items[index]);
      $scope.currentCopies.keys.push(editCopy.nid);
      $scope.currentCopies.items[editCopy.nid] = editCopy;
console.log($scope.currentCopies.keys);
console.log($scope.currentCopies.items);
//console.log($.inArray(21,$scope.currentCopies.keys));
    }

    $scope.fn.cancelItemEdit = function(nid) {
      var index = $scope.currentCopies.keys.indexOf(nid);
      if(index > -1) { $scope.currentCopies.keys.splice(index, 1); }
      delete $scope.currentCopies.items[nid];
    }

    $scope.fn.saveEditItem = function(nid) {
      var found = false;
      angular.forEach($scope.items, function(item, index) {
        if(!found) {
          if(item.nid == nid) {
          console.log($scope.currentCopies.items[nid]);
          console.log(item);
            found = true;
            $scope.items[index] = angular.copy($scope.currentCopies.items[nid]);
            $scope.fn.cancelItemEdit(nid);
      /*var index = $scope.currentCopies.keys.indexOf(nid);
      if(index > -1) { $scope.currentCopies.keys.splice(index, 1); }
      delete $scope.currentCopies.items[nid];*/
          }
        }
      })
    }

    $scope.fn.removeItemQuestion = function(nid, index) {
      $scope.currentCopies.items[nid].questions.splice(index, 1);
    }

    $scope.fn.cancelNewQuestion = function() {
      $scope.addnewquestion = false;
      $scope.currentCopy = {};
    }

    $scope.fn.saveNewQuestion = function(index) {
      $scope.currentCopy.questions.push($scope.newquestion);
      $scope.items[index] = angular.copy($scope.currentCopy);
      $scope.addnewquestion = false;
      //clear newquestion scope
      $scope.newquestion.text = '';
      $scope.currentCopy = {};
    }

    $scope.fn.removeQuestion = function(parent,index) {
      $scope.items[parent].questions.splice(index,1);
    }

    $scope.fn.reloadDataSet = function(index) {
      //$scope.items[index] = angular.copy($scope.copies[index]);
    }

    //$scope.editable = false;
    //$scope.items_json = angular.toJson(data.items);
});
