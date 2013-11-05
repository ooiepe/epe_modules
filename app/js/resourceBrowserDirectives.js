'use strict';

var resourceBrowserDirective = angular.module('resourceBrowserDirective',[]);

resourceBrowserDirective.directive('tableRow', function($compile) {
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
      var template = '', element_ck = '';
      if(scope.checkbox) {
        element_ck = '<input type="checkbox" style="margin-right:0;position:absolute;" name="nid" data-type="' + scope.type + '" value="' + scope.id + '">';
      }

      if (scope.thumbnail == '')
        scope.thumbnail = Drupal.settings.theme_path + '/images/no_thumb_small.jpg';

      template += '<td><div style="width:160px;height:99px;position:relative;">' + element_ck + '<a href="' + scope.url + '"><img width="133" height="99" style="margin-left:20px;" class="thumb" ng-src="' + scope.thumbnail + '" /></a></div><div class="author"><a href="' + scope.url + '">' + scope.title + '</a></div></td>';
      template += '<td>' + scope.summary + '</td>';
      template += '<td><div class="author">' + scope.author + '<br/>(' + scope.org + ')</div></td>';
      template += '<td>' + scope.updated + '</td>';

      elem.html(template).show();

      $compile(elem.contents())(scope);
    }
  }
});

resourceBrowserDirective.directive('listItem', function($compile) {
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
      if(scope.checkbox) {
        template += '<input type="checkbox" name="nid" data-type="' + scope.type + '" value="' + scope.id + '">';
      }
      template += '<a href="' + scope.url + '"><img width="133" height="99" class="thumb" ng-src="' + scope.thumbnail + '" /></a><br/>';
      template += '<a href="' + scope.url + '">' + scope.title + '</a><br/>';
      template += scope.author + '<br/>(' + scope.org + ')<br/>';
      template += scope.updated;

      elem.html(template).show();

      $compile(elem.contents())(scope);
    }
  }
});
