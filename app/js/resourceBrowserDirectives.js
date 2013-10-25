'use strict';

var resourceBrowserDirective = angular.module('resourceBrowserDirective',[]);

resourceBrowserDirective.directive('tableRow', function($compile) {
  return {
    restrict: 'A',
    replace: true,
    scope: {
      checkbox: '=',
      id: '=',
      type: '=',
      url: '=',
      thumbnail: '=',
      title: '=',
      author: '=',
      updated: '='
    },
    link: function (scope, elem, attrs) {
      var template = '', element_ck = '';
      if(scope.checkbox) {
        element_ck = '<input type="checkbox" name="nid" data-type="' + scope.type + '" value="' + scope.id + '">';
      }


      if (scope.thumbnail == '')
        scope.thumbnail = Drupal.settings.theme_path + '/images/no_thumb_small.jpg';


      template += '<td>' + element_ck + '<a href="' + scope.url + '"><img width="133" height="99" class="thumb" ng-src="' + scope.thumbnail + '" /></a><div class="author"><a href="' + scope.url + '">' + scope.title + '</a></div></td>';
      template += '<td><div class="author">' + scope.author + '</div></td>';
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
      type: '=',
      url: '=',
      thumbnail: '=',
      title: '=',
      author: '=',
      updated: '='
    },
    link: function (scope, elem, attrs) {
      var template = '';
      if(scope.checkbox) {
        template += '<input type="checkbox" name="nid" data-type="' + scope.type + '" value="' + scope.id + '">';
      }
      template += '<a href="' + scope.url + '"><img ng-src="' + scope.thumbnail + '" /></a><br/>';
      template += '<a href="' + scope.url + '">' + scope.title + '</a><br/>';
      template += scope.author + '<br/>';
      template += scope.updated;

      elem.html(template).show();

      $compile(elem.contents())(scope);
    }
  }
});
