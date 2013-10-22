'use strict';

var app = angular.module('app', ['ui.sortable','ngSanitize','epe_llb_directive']);

app.factory('data', function($window, $rootScope) {
    var items = [];

    $window.addItem = function(item) {
      item.questions = [];
      var exists = false;
      angular.forEach(items, function(value) {
        if(!exists) {
          if(value['nid'] == item['nid']) { exists = true; }
        }
      });
      if(!exists) { items.push(item); }

      $rootScope.$digest();
    };

    return {
        items: items
    };
});

app.controller('main', function($scope, data) {
  //init
  $scope.fn = {};
  $scope.currentCopy = {};
  $scope.currentCopies = {};
  $scope.currentCopies.keys = [];
  $scope.currentCopies.items = [];

  $scope.items = data.items;

    $scope.removeDataSet = function(index) {
      $scope.items.splice(index,1);
    }

    $scope.fn.addQuestion = function(nid) {
      $scope.currentCopies.items[nid].questions.push({text:""});
    }

    $scope.fn.inItemEditArray = function(val) {
      var inarray = false;
      angular.forEach($scope.currentCopies.keys, function(value) { if(!inarray) {  if(value == val) { inarray = true; } } });

      return inarray;
    }

    $scope.fn.editItem = function(index) {
      //create deeplink copy separated from original scope
      var editCopy = angular.copy($scope.items[index]);
      $scope.currentCopies.keys.push(editCopy.nid);
      $scope.currentCopies.items[editCopy.nid] = editCopy;
    }

    $scope.fn.cancelItemEdit = function(nid) {
      var index = $scope.currentCopies.keys.indexOf(nid);
      if(index > -1) { $scope.currentCopies.keys.splice(index, 1); }
      delete $scope.currentCopies.items[nid];
    }

    $scope.fn.saveEditItem = function(nid) {
      var found = false;
      angular.forEach($scope.items, function(item, index) {
        //the only way i know how to break angular foreach
        if(!found) {
          if(item.nid == nid) {
            found = true;
            $scope.items[index] = angular.copy($scope.currentCopies.items[nid]);
            $scope.fn.cancelItemEdit(nid);
          }
        }
      })
    }

    $scope.fn.removeItemQuestion = function(nid, index) {
      $scope.currentCopies.items[nid].questions.splice(index, 1);
    }
});
