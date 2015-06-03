define(['app','ngload!services/dataServices','directives/tabularData','ngload!filters/range','ngProgress'], function(app) {
  app.controller('SearchCtrl', ['$scope','$routeParams', '$location', '$filter', '_','epeDataService', 'webStorage', 'ngProgress',
    function($scope,$routeParams,$location,$filter,_,epeDataService,webStorage,ngProgress) {
      //init scope params
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
      $scope.browser.queryparams = {};
      $scope.browser.data = [];
      $scope.search = {};
      $scope.browser.assets_path = Drupal.settings.epe.base_path + 'sites/all/modules/epe_modules/epe_dbresource_browser/images';
      $scope.browser.messages = {};
      $scope.browser.messages.show_progress_bar = true;
      $scope.browser.messages.show_messages = true;
      $scope.browser.messages.messages = "Loading Resources";
      $scope.browser.date_sort = 'last_updated';

      //set additional settings for each module view
      angular.forEach($scope.browser.modules, function(module, index) {
        var module_config = {
          type:module.label,
          data:[],
          active:module.default,
          weight:module.weight,
          label:module.label,
          api:module.api,
          active: false,
          activeClass: '',
          showad: false,
          currentPage: 0,
          pageSize: Drupal.settings.resourceBrowser.page_size,
          adurl: module.adurl,
          adimagepath: module.adimagepath,
          hasrecord: false,
          total_rows: 0,
          numberofpages: 0,
          editmode: Drupal.settings.resourceBrowser.editmode,
          queryParams: {}
        };

        if(typeof $routeParams['exclude'] != 'undefined' && $routeParams['exclude'] == 'true') {
          if($routeParams['type'] == module_config.api) {
            $scope.browser.enabled_modules.push(module_config);
          }
        } else {
          $scope.browser.enabled_modules.push(module_config);
        }
      });

      //define init function
      $scope.fn.init = function() {
        //filter enabled modules and load ony module that's allowed in resource browser
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
        //loading parameters to pass to data query
        $scope.fn.serviceParams = {};
        $scope.fn.serviceParams['resource_type'] = $scope.browser.selected_module.api;
        if(typeof $routeParams['page'] != 'undefined') {
          $scope.fn.serviceParams['page'] = $routeParams['page'] - 1;
        }
        if(typeof $routeParams['search'] != 'undefined') {
          $scope.fn.serviceParams['search'] = $routeParams['search'];
        }
        if(typeof $routeParams['filter'] != 'undefined') {
          $scope.fn.serviceParams['filter'] = $routeParams['filter'];
          var selected_filter = _.find($scope.browser.resource_filters, function(filter) { return $routeParams['filter'] == filter.filter; });
          if(selected_filter != 'undefined') $scope.browser.resource_filter = selected_filter;
        } else {
          $scope.browser.resource_filter = $scope.browser.resource_filters[0];
        }
        if(typeof $routeParams['sort'] == 'undefined') {
          $routeParams['sort'] = 'last_updated';
        } else {
          $scope.browser.date_sort = $routeParams['sort'];
        }
        $scope.fn.selectedClass($routeParams['sort']);
        if(typeof $routeParams['sort_mode'] == 'undefined') {
          $routeParams['sort_mode'] = 'desc';
        }
        $scope.fn.serviceParams['sort'] = $routeParams['sort'];
        $scope.fn.serviceParams['sort_mode'] = $routeParams['sort_mode'];
        //query counts very time, counts return minimal data so performance hit should be minimal however still should cache this somehow
        epeDataService.getPager($scope.fn.serviceParams,true).then(function(res) {
          _.each($scope.browser.enabled_modules, function(module, key) {
            var pager_data = _.find(res.data, function(pager,key) {
              return pager['api'] == module['api'];
            });
            module['total_rows'] = pager_data['total_rows'];
            module['numberofpages'] = pager_data['total_pages'];
          });
        });

        //query selected tab's dataset and only selected tab
        epeDataService.getData($scope.fn.serviceParams).then(function(res) {
          var nodes = res.data.nodes;
          angular.forEach(nodes, function(node) {
            $scope.browser.data.push(node.node);
          });

          if($scope.browser.data.length < 1) {
            $scope.browser.messages.show_progress_bar = false;
            $scope.browser.messages.messages = "No " + $scope.browser.selected_module.type + " Found";
          } else {
            $scope.browser.messages.show_messages = false;
            $scope.browser.messages.show_progress_bar = false;
          }
        });

        //cache query param into session
        var params = {};
        params['type'] = $scope.browser.selected_module.api;
        params['page'] = $routeParams['page'];
        if(typeof $routeParams['search'] != 'undefined') {
          params['search'] = $routeParams['search'];
        }
        if(typeof $routeParams['filter'] != 'undefined') {
          params['filter'] = $routeParams['filter'];
        }
        if(typeof $routeParams['sort'] != 'undefined') {
          params['sort'] = $routeParams['sort'];
        }
        if(typeof $routeParams['sort_mode'] != 'undefined') {
          params['sort_mode'] = $routeParams['sort_mode'];
        }

        $scope.browser.queryparams = webStorage.session.get('queryparams');
        if($scope.browser.queryparams == null) {
          $scope.browser.queryparams = {};
        }
        $scope.browser.queryparams[$scope.browser.selected_module.api] = params;
        webStorage.session.add('queryparams',$scope.browser.queryparams);
      } //init      

      $scope.search.term = $routeParams['search'];
      $scope.fn.searchTerm = function() {
        var params = {};
        params['type'] = $scope.browser.selected_module.api;
        params['page'] = 1; //turn search should reset all paging back to first page
        if($scope.search.term != '') {
          params['search'] = $scope.search.term;
        }
        if(typeof $routeParams['filter'] != 'undefined') {
          params['filter'] = $routeParams['filter'];
        }
        $location.search(params);
      }

      //set click action on resource tab icon
      $scope.fn.setActiveModule = function(module) {
        var params = {};
        //cache current viewing module
        $scope.browser.queryparams = webStorage.session.get('queryparams');
        if(typeof $scope.browser.queryparams[module.api] == 'undefined') {
          params['type'] = module.api;
          params['page'] = 1;
        } else {
          params = $scope.browser.queryparams[module.api];
        }
        if($routeParams['search'] != params['search'] || $routeParams['filter'] != params['filter']) {
          params['page'] = 1
        }
        if(typeof $routeParams['search'] != 'undefined') {
          params['search'] = $routeParams['search'];
        } else {
          params['search'] = '';
        }
        if(typeof $routeParams['filter'] != 'undefined') {
          params['filter'] = $routeParams['filter'];
        }
        if(typeof $routeParams['sort'] != 'undefined') {
          params['sort'] = $routeParams['sort'];
        }
        if(typeof $routeParams['sort_mode'] != 'undefined') {
          params['sort_mode'] = $routeParams['sort_mode'];
        }
        $location.search(params);
      } //end setActiveModule function

      //swich filter type
      $scope.fn.changeViewMode = function() {
        var params = {};
        params['type'] = $scope.browser.selected_module.api;
        params['page'] = 1;
        if(typeof $routeParams['search'] != 'undefined') {
          params['search'] = $routeParams['search'];
        }
        if(typeof $routeParams['exclude'] != 'undefined' && $routeParams['exclude'] == 'true') {
          params['exclude'] = "true";
        }
        params['filter'] = $scope.browser.resource_filter.filter;
        $location.search(params);
      }

      $scope.fn.setCurrentPage = function(page) {
        var params = {};
        params['type'] = $scope.browser.selected_module.api;
        params['page'] = page;
        if(typeof $routeParams['search'] != 'undefined') {
          params['search'] = $routeParams['search'];
        }
        if(typeof $routeParams['exclude'] != 'undefined' && $routeParams['exclude'] == 'true') {
          params['exclude'] = "true";
        }
        if(typeof $routeParams['filter'] != 'undefined') {
          params['filter'] = $routeParams['filter'];
        }
        if(typeof $routeParams['sort'] != 'undefined') {
          params['sort'] = $routeParams['sort'];
        }
        if(typeof $routeParams['sort_mode'] != 'undefined') {
          params['sort_mode'] = $routeParams['sort_mode'];
        }

        $location.search(params);
      }

      $scope.fn.setPageClass = function(number) {
        if(typeof $routeParams['page'] != 'undefined' && number == $routeParams['page'] ) {
          return 'active';
        } else if(typeof $routeParams['page'] == 'undefined' && number == 1) {
          return 'active';
        } else {
          return 'inactive';
        }
      }

      $scope.fn.sortResults = function(column) {
        var params = {};
        if(_.contains(['last_updated','created'],column)) {
          $scope.browser.date_sort = column;
        }
        params['type'] = $scope.browser.selected_module.api;
        params['page'] = $routeParams['page'];
        if(typeof $routeParams['search'] != 'undefined') {
          params['search'] = $routeParams['search'];
        }
        if(typeof $routeParams['exclude'] != 'undefined' && $routeParams['exclude'] == 'true') {
          params['exclude'] = "true";
        }
        if(typeof $routeParams['filter'] != 'undefined') {
          params['filter'] = $routeParams['filter'];
        }
        if($routeParams['sort'] != column && (column == 'author' || column == 'title')) {
          params['sort_mode'] = 'asc';
        } else if($routeParams['sort'] == column) {
          params['sort_mode'] = $routeParams['sort_mode'] == 'asc' ? 'desc' : 'asc';
        } else {
          params['sort_mode'] = $routeParams['sort_mode'] = 'desc';
        }

        /*if($routeParams['sort'] == column) {
          params['sort_mode'] = $routeParams['sort_mode'] == 'asc' ? 'desc' : 'asc';
        }*/
        params['sort'] = column;
        $location.search(params);
      }

      $scope.fn.selectedClass = function(column) {
        if($routeParams['sort'] == column) {
          return 'sort sort_' + $routeParams['sort_mode'];
        } else {
          return 'sort';
        }
      }

      //no module type defined, we reload the browser with url of the 1st module
      if(typeof $routeParams['type'] == "undefined" || (
        typeof $routeParams['type'] != "undefined" && (
          $routeParams['type'] == '' ||
          !_.find($scope.browser.enabled_modules, function(module) { return module['api'] == $routeParams['type']; })
        )
        )) {
        var params = {};
        params['type'] = $scope.browser.enabled_modules[0].api;
        params['page'] = 1;
        $location.search(params);
      } else {
        $scope.fn.init();
      }      
    }]); //end controller function
}); //end define
