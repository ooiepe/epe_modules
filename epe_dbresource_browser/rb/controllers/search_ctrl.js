define(['app','ngload!services/dataServices'], function(app) {
  app.controller('SearchCtrl', ['$scope','$routeParams', '$location', '$filter', '_','epeDataService',
    function($scope,$routeParams,$location,$filter,_,epeDataService) {
      //console.log('SearchCtrl');
//console.log(_.find([1, 2, 3, 4, 5, 6], function(num){ return num % 2 == 0; }));
      $scope.fn = {};
      $scope.resources = {};
      $scope.panes = {};
      $scope.panes.table = [];
      $scope.panes.active = '';
      $scope.panes.dialogmode = false;
      $scope.panes.showtabs = true;
      $scope.browser = {};
      $scope.browser.resource_filters = JSON.parse(Drupal.settings.resourceBrowser.resource_filter);
      $scope.browser.resource_filter = '';
      $scope.browser.modules = JSON.parse(Drupal.settings.resourceBrowser.epe_modules);
      $scope.browser.enabled_modules = [];
      $scope.browser.selected_module = {};
      $scope.search = {};

      $scope.search.term = $routeParams['term'];

      //set additional settings for each module view
      angular.forEach($scope.browser.modules, function(module, index) {
        var module_config = {
          type:module.label,
          data:[],
          active:module.default,
          weight:module.weight,
          api:module.api,
          active: false,
          activeClass: '',
          showad: false,
          currentPage: 0,
          pageSize: Drupal.settings.resourceBrowser.page_size,
          adurl: module.adurl,
          adimagepath: module.adimagepath,
          hasrecord: false,
          recordcount: module.total_rows,
          //show_checkbox:typeof Drupal.settings.epe_dbresource_browser_modal === 'undefined' ? false : Drupal.settings.epe_dbresource_browser_modal.checkbox
          queryParams: {}
        };

        $scope.browser.enabled_modules.push(module_config);

        //tab.numberOfPages = function() { return Math.ceil(tab.data.length/tab.pageSize); }

        /*if(typeof $location.search()['dialog'] == 'undefined' || (typeof $location.search()['dialog'] && ($location.search()['dialog'] == pane.api || $location.search()['dialog'] == true)) ) {
          $scope.panes.table.push(tab);
        }*/
      });

      //define init function
      $scope.fn.init = function() {
        //set active module tab icon
        if(typeof $routeParams['type'] != "undefined" && $routeParams['type'] != '') {
          //console.log('huh');
          //$scope.browser.selected_module = _.find($scope.browser.enabled_modules, function(module) { return module.api = $routeParams['type']; });
          _.each($scope.browser.enabled_modules, function(module) {
            if(module.api == $routeParams['type']) {
              module.active = true;
              module.activeClass = 'active';
              $scope.browser.selected_module  = module;
            } else {
              module.active = false;
              module.activeClass = '';
            }
          });
        } else {
          $scope.browser.enabled_modules[0].active = true;
          $scope.browser.enabled_modules[0].activeClass = 'active';
          $scope.browser.selected_module  = $scope.browser.enabled_modules[0];
        }
        $scope.fn.serviceParams = {};
        $scope.fn.serviceParams['resource_type'] = $scope.browser.selected_module.api;
        epeDataService.getPager($scope.fn.serviceParams,true).then(function(res) {
          /*var current_pane = _.find($scope.panes.table, function (pane) { return pane.type === module.label });
          current_pane.recordcount = res.data.total_rows;
          current_pane.total_pages = res.data.total_pages;*/
        });

        epeDataService.getData($scope.fn.serviceParams).then(function(res) {
          var nodes = res.data.nodes;
          /*angular.forEach(nodes, function(node) {
            $scope.resources[module.api].data.push(node.node);
          });*/
          /*angular.forEach($scope.panes.table, function(pane, index) {
            if($scope.resources[pane.api].data.length > 0) pane.hasrecord = true;
            if(pane.type === module.label) {
              //if(applyFilter) {
              //  pane.data = $filter("resourceFilter")($scope.resources[pane.api].data, $scope.filter.view_type.filter);
              //} else { pane.data = $scope.resources[module.api].data; }
              pane.data = $scope.resources[module.api].data;
            }
          });*/
          //if((index + 1) == $scope.resources.modules.length) ngProgress.complete();
        });
        /*$scope.browser.selected_module.active = true;
        $scope.browser.selected_module.activeClass = 'active';
        console.log($scope.browser.modules);
        console.log($scope.browser.selected_module);*/
      }

      //execute init function
      $scope.fn.init();

      //set click action on resource tab icon
      $scope.fn.setActiveModule = function(module) {

      } //end setActiveModule function
    }]); //end controller function
}); //end define
