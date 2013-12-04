'use strict';

var SearchController = function($scope, $routeParams, $location, $filter, epeServiceProvider, ngProgress) {
  //model init
  $scope.fn = {};
  $scope.resources = {};
  $scope.resources.imageResource = {};
  $scope.resources.imageResource.data = [];
  $scope.resources.imageResource.data_filtered = [];
  $scope.resources.documentResource = {};
  $scope.resources.documentResource.data = [];
  $scope.resources.documentResource.data_filtered = [];
  $scope.resources.multimediaResource = {};
  $scope.resources.multimediaResource.data = [];
  $scope.resources.multimediaResource.data_filtered = [];
  $scope.panes = {};
  $scope.panes.table = [];
  $scope.panes.active = '';
  $scope.panes.rb_type_selector = true;
  $scope.resource = {};
  $scope.filter = {};
  $scope.resource.view_types = [
    {filter:'',label:'All Resources'}
  ];
  $scope.view_templates = {};
  $scope.view_templates.list = Drupal.settings.epe.base_path + "resource-browser/partial/search-list.html";
  $scope.view_templates.grid = Drupal.settings.epe.base_path + "resource-browser/partial/search-grid.html";
  $scope.resources.modules = [];

  //add my resource option if user is logged in
  if(Drupal.settings.epe_dbresource_browser.userid) {
    //$scope.resource.view_types.push({userid:Drupal.settings.epe_dbresource_browser.userid,label:'My Resources'});
    $scope.resource.view_types.push({filter:'author',label:'My Resources'});
  }
  //set default resource type
  var applyFilter = false;
  //set default filter
  if(typeof $location.search()['filter'] != 'undefined') {
    angular.forEach($scope.resource.view_types, function(view_type, index) {
      if(view_type.filter == $location.search()['filter'] && !applyFilter) {
        applyFilter = true;
        $scope.filter.view_type = $scope.resource.view_types[index];
      }
    });
    if(!applyFilter) $scope.filter.view_type = $scope.resource.view_types[0];
  } else { $scope.filter.view_type = $scope.resource.view_types[0]; }
  //console.log($location.search()['filter']);
  //$scope.filter.view_type = $scope.resource.view_types[0];

  if(typeof $routeParams['dialog'] != "undefined") {
    $scope.panes.rb_type_selector = false;
    if(typeof $routeParams['type'] != "undefined") {
      angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(module, index) {
        if(module.api === $routeParams['type']) $scope.resources.modules.push(module);
      });
    }
  } else {
    $scope.resources.modules = Drupal.settings.epe_dbresource_browser.modules;
  }

  //console.log($scope.resources.modules);

  $scope.term = $routeParams['term'];
  $scope.search = function() {
    var params = {};
    if(typeof $routeParams['dialog'] != "undefined") {
      //$location.search({dialog:true});
      //params.push({dialog:true});
      params['dialog'] = true;
    }

/*    if(typeof $routeParams['filter'] != "undefined" || typeof $scope.filter.view_type.filter == "undefined") {
      //$location.search({dialog:true});
      //params.push({dialog:true});
      params['filter'] = $routeParams['filter'];
    } else if ( $scope.filter.view_type.filter != '' ) {
      params['filter'] = $scope.filter.view_type.filter;
    }*/
    if($scope.filter.view_type.filter != '') {
      params['filter'] = $scope.filter.view_type.filter;
    }

    if(typeof $routeParams['type'] != "undefined" && $scope.panes.active == '') {
      //$location.search({type:$scope.radioModel.id});
      //params.push({type:$scope.radioModel.id});
      params['type'] = $routeParams['type'];
    } else if ($scope.panes.active != '') {
      params['type'] = $scope.panes.active;
    }
    //console.log(params)
    $location.search(params);

    if(typeof $scope.term == "undefined") {
      $location.path('/search');
    } else {
      $location.path('/search/' + $scope.term);
    }
  }

  //default sort, default view
  $scope.sort = "title";
  $scope.radioModel = "list";

  $scope.fn.sortPane = function(a,b) {
    return ((a.weight < b.weight) ? -1 : ((a.weight > b.weight) ? 1 : 0));
  }

  $scope.fn.activeTab = function(tab) {
    angular.forEach($scope.panes.table, function(pane, index) {
      if(pane.api != tab.api) {
        pane.activeClass = '';
        $scope.panes.table[index].showad = false;
      } else {
        pane.activeClass = 'active';
        $scope.panes.table[index].active = true;
        $scope.panes.table[index].showad = true;
      }
    });
    //set active pane indicator for search function
    $scope.panes.active = tab.api;
  }

  $scope.panes.table = [];
  //angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(pane, index) {
  angular.forEach($scope.resources.modules, function(pane, index) {
    var tab = {
      type:pane.label,
      data:[],
      active:pane.default,
      weight:pane.weight,
      api:pane.api,
      activeClass: '',
      showad: false,
      adurl: pane.adurl,
      hasrecord: false,
      show_checkbox:typeof Drupal.settings.epe_dbresource_browser_modal === 'undefined' ? false : Drupal.settings.epe_dbresource_browser_modal.checkbox
    };

    if(typeof $location.search()['dialog'] == 'undefined' || ( (typeof $location.search()['dialog'] != 'undefined') && (typeof $location.search()['type'] != 'undefined') && $location.search()['type'] == pane.api)) {
      $scope.panes.table.push(tab);
    }
  });
  $scope.panes.table.sort($scope.fn.sortPane);

  //encapsulate init load into function
  $scope.fn.loadBrowser = function() {
    //set default tab
    if(typeof $location.search()['type'] != 'undefined') {
      var found = false;
      angular.forEach($scope.panes.table, function(pane, index) {
          if(pane.api == $location.search()['type']) {
            found = true;
            $scope.panes.table[index].active = true;
          } else {
            $scope.panes.table[index].active = false;
          }
      });
      if(!found) $scope.panes.table[0].active = true;
    } else { $scope.panes.table[0].active = true; }

    var searchterm = {};
    if(typeof $routeParams['term'] != "undefined") searchterm = {search:$routeParams['term']};

    $scope.fn.serviceParams = {};
  ngProgress.height('10px');
    var progress = 0;
    ngProgress.start();
    //angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(module, index) {
    angular.forEach($scope.resources.modules, function(module, index) {
      $scope.fn.serviceParams['resource_type'] = module.api;
      if(typeof $routeParams['term'] != "undefined") $scope.fn.serviceParams['search'] = $routeParams['term'];
      $scope.resources[module.api] = {};
      $scope.resources[module.api].data = [];
      $scope.resources[module.api].data_filtered = {};

      /*var tempData = epeService.get($scope.fn.serviceParams, function() {
        angular.forEach(tempData.nodes, function(node) {
          $scope.resources[module.api].data.push(node.node);
        });
        angular.forEach($scope.panes.table, function(pane, index) {
          if($scope.resources[pane.api].data.length > 0) pane.hasrecord = true;
          if(pane.type === module.label) {
            if(applyFilter) {
              pane.data = $filter("resourceFilter")($scope.resources[pane.api].data, $scope.filter.view_type.filter);
            } else { pane.data = $scope.resources[module.api].data; }
            //if(typeof $location.search()['filter'] != 'undefined' && $location.search()['filter'] != '')
          }
        });
      });*/

      epeServiceProvider.getData($scope.fn.serviceParams).then(function(res) {
        var nodes = res.data.nodes;
        angular.forEach(nodes, function(node) {
          $scope.resources[module.api].data.push(node.node);
        });
        angular.forEach($scope.panes.table, function(pane, index) {
          if($scope.resources[pane.api].data.length > 0) pane.hasrecord = true;
          if(pane.type === module.label) {
            if(applyFilter) {
              pane.data = $filter("resourceFilter")($scope.resources[pane.api].data, $scope.filter.view_type.filter);
            } else { pane.data = $scope.resources[module.api].data; }
          }
        });
        if((index + 1) == $scope.resources.modules.length) ngProgress.complete();
      });
    });

  } //loadresource

  $scope.fn.loadBrowser();


  //watch type change and filter data
  $scope.$watch("filter.view_type", function(view_type) {
    angular.forEach($scope.panes.table, function(pane, index) {
      pane.data = $filter("resourceFilter")($scope.resources[pane.api].data, view_type.filter);
    });
  });
}
