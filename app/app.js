'use strict';

var app = angular.module('app', ['ui.sortable','ngSanitize','epe_llb_directive']);

app.factory('dataset_data', function($window, $rootScope) {
    var items = [];

    $window.addDataSetItem = function(item,isnew) {
      if(isnew) item.questions = [];
      var exists = false;

      if(!exists) {
        var timestamp = new Date().getTime();
        item.key = '' + items.length + 1 + item.nid + timestamp;
        items.push(item);
      }

      $rootScope.$digest();
    };

    return {
        items: items
    };
});

app.factory('intro_data', function($window, $rootScope) {
    var items = [];

    $window.addIntroItem = function(item,isnew) {
      var timestamp = new Date().getTime();
      item.key = '' + items.length + 1 + item.nid + timestamp;
      items.push(item);

      $rootScope.$digest();
    };

    return {
        items: items
    };
});

app.factory('background_data', function($window, $rootScope) {
    var items = [];

    $window.addBackgroundSlideshowItem = function(item,isnew) {
      var timestamp = new Date().getTime();
      item.key = '' + items.length + 1 + item.nid + timestamp;
      items.push(item);

      $rootScope.$digest();
    };

    return {
        items: items
    };
});

app.factory('challenge_data', function($window, $rootScope) {
    var items = [];

    $window.addChallengeThumbnailItem = function(item,isnew) {
      if(items.length > 0) items.splice(0,1);
      var timestamp = new Date().getTime();
      item.key = '' + items.length + 1 + item.nid + timestamp;
      items.push(item);

      $rootScope.$digest();
    };

    return {
        items: items
    };
});

app.controller('dataset', function($window, $scope, dataset_data, $http) {
  //init
  $scope.fn = {};
  $scope.currentCopy = {};
  $scope.currentCopies = {};
  $scope.currentCopies.keys = [];
  $scope.currentCopies.items = [];

  $scope.items = dataset_data.items;

    $scope.removeDataSet = function(index) {
      $scope.items.splice(index,1);
    }

    $scope.fn.addQuestion = function(hashkey) {
      $scope.currentCopies.items[hashkey].questions.push({text:""});
    }

    $scope.fn.inItemEditArray = function(hashkey) {
      var inarray = false;
      angular.forEach($scope.currentCopies.keys, function(value) { if(!inarray) {  if(value == hashkey) { inarray = true; } } });

      return inarray;
    }

    $scope.fn.editItem = function(index) {
      //create deeplink copy separated from original scope
      var editCopy = angular.copy($scope.items[index]);
      /*
      $scope.currentCopies.keys.push(editCopy.nid);
      $scope.currentCopies.items[editCopy.nid] = editCopy;
      */
      $scope.currentCopies.keys.push(editCopy.key);
      $scope.currentCopies.items[editCopy.key] = editCopy;
      console.log($scope.currentCopies.keys);
      console.log($scope.currentCopies.items);
    }

    $scope.fn.cancelItemEdit = function(hashkey) {
      /*
      var index = $scope.currentCopies.keys.indexOf(nid);
      if(index > -1) { $scope.currentCopies.keys.splice(index, 1); }
      delete $scope.currentCopies.items[nid];
      */
      var index = $scope.currentCopies.keys.indexOf(hashkey);
      if(index > -1) { $scope.currentCopies.keys.splice(index, 1); }
      delete $scope.currentCopies.items[hashkey];
    }

    $scope.fn.saveEditItem = function(hashkey) {
      var found = false;
      angular.forEach($scope.items, function(item, index) {
        //the only way i know how to break angular foreach
        if(!found) {
          if(item.key == hashkey) {
            found = true;
            $scope.items[index] = angular.copy($scope.currentCopies.items[hashkey]);
            $scope.fn.cancelItemEdit(hashkey);
          }
        }
      })
    }

    $scope.fn.removeItemQuestion = function(hashkey, index) {
      $scope.currentCopies.items[hashkey].questions.splice(index, 1);
    }

    $window.saveDatasets = function() {
      angular.forEach($scope.currentCopies.keys, function(key, index) {
        $scope.fn.saveEditItem(key);
      });
      $scope.$digest();
    }
});

app.controller('intro', function($window, $scope, intro_data, $http) {
  //init
  $scope.fn = {};
  $scope.currentCopy = {};
  $scope.currentCopies = {};
  $scope.currentCopies.keys = [];
  $scope.currentCopies.items = [];

  $scope.items = intro_data.items;

    $scope.removeDataSet = function(index) {
      $scope.items.splice(index,1);
    }

    $scope.fn.inItemEditArray = function(hashkey) {
      var inarray = false;
      angular.forEach($scope.currentCopies.keys, function(value) { if(!inarray) {  if(value == hashkey) { inarray = true; } } });
      return inarray;
    }

    $scope.fn.editItem = function(index) {
      //create deeplink copy separated from original scope
      var editCopy = angular.copy($scope.items[index]);
      $scope.currentCopies.keys.push(editCopy.key);
      $scope.currentCopies.items[editCopy.key] = editCopy;
    }

    $scope.fn.cancelItemEdit = function(hashkey) {
      var index = $scope.currentCopies.keys.indexOf(hashkey);
      if(index > -1) { $scope.currentCopies.keys.splice(index, 1); }
      delete $scope.currentCopies.items[hashkey];
    }

    $scope.fn.saveEditItem = function(hashkey) {
      var found = false;
      angular.forEach($scope.items, function(item, index) {
        //the only way i know how to break angular foreach
        if(!found) {
          if(item.key == hashkey) {
            found = true;
            $scope.items[index] = angular.copy($scope.currentCopies.items[hashkey]);
            $scope.fn.cancelItemEdit(hashkey);
          }
        }
      })
    }

    $window.saveDatasets = function() {
      angular.forEach($scope.currentCopies.keys, function(key, index) {
        $scope.fn.saveEditItem(key);
      });
      $scope.$digest();
    }
});

app.controller('background', function($window, $scope, background_data, $http) {
  //init
  $scope.fn = {};
  $scope.currentCopy = {};
  $scope.currentCopies = {};
  $scope.currentCopies.keys = [];
  $scope.currentCopies.items = [];

  $scope.items = background_data.items;

    $scope.removeDataSet = function(index) {
      $scope.items.splice(index,1);
    }

    $scope.fn.inItemEditArray = function(hashkey) {
      var inarray = false;
      angular.forEach($scope.currentCopies.keys, function(value) { if(!inarray) {  if(value == hashkey) { inarray = true; } } });
      return inarray;
    }

    $scope.fn.editItem = function(index) {
      //create deeplink copy separated from original scope
      var editCopy = angular.copy($scope.items[index]);
      $scope.currentCopies.keys.push(editCopy.key);
      $scope.currentCopies.items[editCopy.key] = editCopy;
    }

    $scope.fn.cancelItemEdit = function(hashkey) {
      var index = $scope.currentCopies.keys.indexOf(hashkey);
      if(index > -1) { $scope.currentCopies.keys.splice(index, 1); }
      delete $scope.currentCopies.items[hashkey];
    }

    $scope.fn.saveEditItem = function(hashkey) {
      var found = false;
      angular.forEach($scope.items, function(item, index) {
        //the only way i know how to break angular foreach
        if(!found) {
          if(item.key == hashkey) {
            found = true;
            $scope.items[index] = angular.copy($scope.currentCopies.items[hashkey]);
            $scope.fn.cancelItemEdit(hashkey);
          }
        }
      })
    }

    $window.saveDatasets = function() {
      angular.forEach($scope.currentCopies.keys, function(key, index) {
        $scope.fn.saveEditItem(key);
      });
      $scope.$digest();
    }
});

app.controller('challenge', function($scope, challenge_data) {
  //init
  $scope.fn = {};
  $scope.currentCopy = {};
  $scope.currentCopies = {};
  $scope.currentCopies.keys = [];
  $scope.currentCopies.items = [];

  $scope.items = challenge_data.items;

  $scope.removeDataSet = function(index) {
    $scope.items.splice(index,1);
  }
});
