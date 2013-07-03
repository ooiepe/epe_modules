'use strict';

var resourceBrowserDirective = angular.module('resourceBrowserDirective',[]);

resourceBrowserDirective.directive('tableData', function() {
  return {
    restrict: 'E',
    scope: {
      data: "=data"
    },
    templateUrl: "/resource-browser/partial/search-list-table-tpl.html"
  }
});

resourceBrowserDirective.directive('gridData', function() {
  return {
    restrict: 'E',
    scope: {
      data: "=data"
    },
    templateUrl: "/resource-browser/partial/search-list-grid-tpl.html"
  }
});
