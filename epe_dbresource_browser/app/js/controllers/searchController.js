'use strict';

rbcontroller.controller('SearchController',['$scope', '$routeParams', '$location', '$filter', 'epeServiceProvider', 'ngProgress', '_',
  function($scope, $routeParams, $location, $filter, epeServiceProvider, ngProgress, _) {
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
  $scope.panes.dialogmode = false;
  $scope.panes.showtabs = true;
  $scope.resource = {};
  $scope.filter = {};
  $scope.resource.view_types = [
    {filter:'',label:'All Resources'},
    {filter:'featured',label:'Featured Resources'}
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
/*  if(typeof $location.search()['filter'] != 'undefined') {
    angular.forEach($scope.resource.view_types, function(view_type, index) {
      if(view_type.filter == $location.search()['filter'] && !applyFilter) {
        applyFilter = true;
        $scope.filter.view_type = $scope.resource.view_types[index];
      }
    });
    if(!applyFilter) $scope.filter.view_type = $scope.resource.view_types[0];
  } else { $scope.filter.view_type = $scope.resource.view_types[0]; }*/

  if(typeof $routeParams['dialog'] != "undefined") {
    $scope.panes.dialogmode = true;
/*    if($routeParams['dialog'] != true) {
      angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(module, index) {
        if(module.api === $routeParams['dialog']) $scope.resources.modules.push(module);
      });
    } else {
      $scope.resources.modules = Drupal.settings.epe_dbresource_browser.modules;
    }*/
    angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(module, index) {
      if(module.api === $routeParams['dialog']) {
        $scope.panes.showtabs = false;
        $scope.resources.modules.push(module);
      }
    });

    if($scope.resources.modules.length == 0) $scope.resources.modules = Drupal.settings.epe_dbresource_browser.modules;

    //if(typeof $routeParams['type'] != "undefined") {
    //  angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(module, index) {
    //    if(module.api === $routeParams['dialog']) $scope.resources.modules.push(module);
    //  });
    //}
  } else {
    $scope.resources.modules = Drupal.settings.epe_dbresource_browser.modules;
  }

  $scope.term = $routeParams['term'];
  $scope.search = function() {
    var params = {};
    if(typeof $routeParams['dialog'] != "undefined") {
      params['dialog'] = true;
    }

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
  //$scope.sort = "title";
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
      //$scope.panes.active = tab.api;
      //$location.search()['type'] = tab.api
    var queryParams = {};
    queryParams['type'] = tab.api;
    var current_pane = _.find($scope.panes.table, function (pane) { return pane.type === tab.type });
    queryParams['page'] = current_pane.currentPage + 1;
    $location.search(queryParams);
  };

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
      currentPage: 0,
      pageSize: 15,
      adurl: pane.adurl,
      hasrecord: false,
      recordcount: 0,
      show_checkbox:typeof Drupal.settings.epe_dbresource_browser_modal === 'undefined' ? false : Drupal.settings.epe_dbresource_browser_modal.checkbox
    };

    //tab.numberOfPages = function() { return Math.ceil(tab.data.length/tab.pageSize); }

    if(typeof $location.search()['dialog'] == 'undefined' || (typeof $location.search()['dialog'] && ($location.search()['dialog'] == pane.api || $location.search()['dialog'] == true)) ) {
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

      epeServiceProvider.getPager($scope.fn.serviceParams,true).then(function(res) {
        var current_pane = _.find($scope.panes.table, function (pane) { return pane.type === module.label });
        current_pane.recordcount = res.data.total_rows;
        current_pane.total_pages = res.data.total_pages;
      });

      epeServiceProvider.getData($scope.fn.serviceParams).then(function(res) {
        var nodes = res.data.nodes;
        angular.forEach(nodes, function(node) {
          $scope.resources[module.api].data.push(node.node);
        });
        angular.forEach($scope.panes.table, function(pane, index) {
          if($scope.resources[pane.api].data.length > 0) pane.hasrecord = true;
          if(pane.type === module.label) {
            //if(applyFilter) {
            //  pane.data = $filter("resourceFilter")($scope.resources[pane.api].data, $scope.filter.view_type.filter);
            //} else { pane.data = $scope.resources[module.api].data; }
            pane.data = $scope.resources[module.api].data;
          }
        });
        if((index + 1) == $scope.resources.modules.length) ngProgress.complete();
      });
    });

  } //loadresource

  $scope.fn.loadBrowser();

  $scope.fn.toPrevPage = function(pane) {
    ngProgress.height('10px');
    var progress = 0;
    ngProgress.start();

    pane.currentPage=pane.currentPage-1
    var queryParams = {"type":$location.search()['type']};
    queryParams['page'] = pane.currentPage + 1;
    $location.search(queryParams);

    $scope.fn.serviceParams['resource_type'] = pane.api;
    if(typeof $routeParams['term'] != "undefined") $scope.fn.serviceParams['search'] = $routeParams['term'];
    $scope.fn.serviceParams['page'] = pane.currentPage;
    console.log($scope.resources[pane.api].data);
    epeServiceProvider.getData($scope.fn.serviceParams).then(function(res) {
      var nodes = res.data.nodes;
      var results = [];
      angular.forEach(nodes, function(node) {
        results.push(node.node);
      });
      pane.data = results;
      ngProgress.complete();
    });
  }

  $scope.fn.toNextPage = function(pane) {
    ngProgress.height('10px');
    var progress = 0;
    ngProgress.start();

    pane.currentPage=pane.currentPage+1
    var queryParams = {"type":$location.search()['type']};
    queryParams['page'] = pane.currentPage + 1;
    console.log(queryParams);
    $location.search(queryParams);

    $scope.fn.serviceParams['resource_type'] = pane.api;
    if(typeof $routeParams['term'] != "undefined") $scope.fn.serviceParams['search'] = $routeParams['term'];
    $scope.fn.serviceParams['page'] = pane.currentPage;
    epeServiceProvider.getData($scope.fn.serviceParams).then(function(res) {
      var nodes = res.data.nodes;
      var results = [];
      angular.forEach(nodes, function(node) {
        results.push(node.node);
      });
      pane.data = results;
      ngProgress.complete();
    });
  }

  $scope.fn.changeViewType = function() {
    ngProgress.height('10px');
    var progress = 0;
    ngProgress.start();

    angular.forEach($scope.panes.table, function(pane, index) {
      var queryParams = {"type":$location.search()['type']};
      if($location.search()['page'] !== 'undefined') queryParams['page'] = $location.search()['page'];
      if($scope.filter.view_type.filter !== '') {
        queryParams['view_type'] = $scope.filter.view_type.filter;
      }
      $location.search(queryParams);

      $scope.fn.serviceParams['resource_type'] = pane.api;
      if(typeof $routeParams['term'] != "undefined") $scope.fn.serviceParams['search'] = $routeParams['term'];
      $scope.fn.serviceParams['page'] = 0;

      epeServiceProvider.getData($scope.fn.serviceParams).then(function(res) {
        var nodes = res.data.nodes;
        var results = [];
        angular.forEach(nodes, function(node) {
          results.push(node.node);
        });
        pane.data = results;
        if((index + 1) == $scope.panes.table.length) ngProgress.complete();
      });
    });
  }

  //watch type change and filter data
/*  $scope.$watch("filter.view_type", function(view_type) {
    //angular.forEach($scope.panes.table, function(pane, index) {
    //  pane.data = $filter("resourceFilter")($scope.resources[pane.api].data, view_type.filter);
    //});

    angular.forEach($scope.panes.table, function(pane, index) {
      var queryParams = {"type":$location.search()['type']};
      if($location.search()['page'] !== 'undefined') queryParams['page'] = $location.search()['page'];
      if(view_type.filter !== '') {
        queryParams['view_type'] = view_type.filter;
      }
      $location.search(queryParams);

      $scope.fn.serviceParams['resource_type'] = pane.api;
      if(typeof $routeParams['term'] != "undefined") $scope.fn.serviceParams['search'] = $routeParams['term'];
      $scope.fn.serviceParams['page'] = 0;

      epeServiceProvider.getData($scope.fn.serviceParams).then(function(res) {
        var nodes = res.data.nodes;
        var results = [];
        angular.forEach(nodes, function(node) {
          results.push(node.node);
        });
        pane.data = results;
      });
    });
  });*/
}]);
