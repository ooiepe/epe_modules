'use strict';

var app = angular.module('app', ['ngSanitize','ngResource']);

app.factory('data', function($resource) {
  var resources = [];

  angular.forEach(Drupal.settings.epe_dbresource_browser.modules, function(module, index) {
    var tab = { data: [], name: module.api, weight:module.weight, active:module.default };
    var tempData = $resource(Drupal.settings.epe.base_path + 'api/resource/:resource_type',
      {resource_type: module.api}, {}).get({}, function() {
        angular.forEach(tempData.nodes, function(node) {
          tab.data.push(node.node);
        });
        if(tab.data.length > 0) { resources.push(tab); }
      });
  });

  resources.sort(function(a,b) {
    return ((a.weight < b.weight) ? -1 : ((a.weight > b.weight) ? 1 : 0));
  });

  return {
    resources: resources,
  }
});

app.directive('tableRow', function($compile) {
  return {
    restrict: 'A',
    replace: true,
    scope: {
      checkbox: '=',
      id: '=',
      summary: '=',
      type: '=',
      url: '=',
      thumbnail: '=',
      title: '=',
      author: '=',
      updated: '=',
      org: '='
    },
    link: function (scope, elem, attrs) {
      var template = '';
      if (scope.thumbnail == '')
        scope.thumbnail = Drupal.settings.theme_path + '/images/no_thumb_small.jpg';

      template += '<td><div style="width:160px;height:99px;position:relative;"><a href="' + scope.url + '"><img width="133" height="99" style="margin-left:20px;" class="thumb" ng-src="' + scope.thumbnail + '" /></a></div><div class="author"><a href="' + scope.url + '">' + scope.title + '</a></div></td>';
      template += '<td>' + scope.summary + '</td>';
      template += '<td><div class="author">' + scope.author + '<br/>(' + scope.org + ')</div></td>';
      template += '<td>' + scope.updated + '</td>';

      elem.html(template).show();

      $compile(elem.contents())(scope);
    }
  }
});

app.controller('main', function($scope, data) {
  $scope.panes = data.resources;
});
