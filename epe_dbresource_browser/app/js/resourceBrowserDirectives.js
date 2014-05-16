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
      authorname: '=',
      userid: '=',
      updated: '=',
      org: '=',
      credit: '=',
      sourceurl: '=',
      dialogmode: '='
    },
    link: function (scope, elem, attrs) {
      var template = '', element_ck = '', link_target = '_self';
      if(scope.checkbox) {
        element_ck = '<div style="float:left;"><input type="checkbox" style="margin-right:0;position:absolute;" name="nid" data-type="' + scope.type + '" value="' + scope.id + '"></div>';
      }

      if (scope.thumbnail == '')
        scope.thumbnail = Drupal.settings.theme_path + '/images/no_thumb_small.jpg';

      if(scope.dialogmode) { link_target = '_blank'; }

     template += '<td><div style="width:160px;height:99px;position:relative;float:left;">' + element_ck + '<a href="' + scope.url + '" target="' + link_target + '"><img width="133" height="99" style="margin-left:20px;" class="thumb" ng-src="' + scope.thumbnail + '" /></a></div><div class="author" style="margin-left:160px;"><p><a href="' + scope.url + '">' + scope.title + '</a></p></div><div class="text" style="margin-left:160px;">';
     var credit = '', summary = '';
     if(scope.credit) credit = scope.credit;
     if(scope.sourceurl) credit = '<a href="'+ scope.sourceurl +'" target="_blank">'+ credit +'</a>';
     if(credit !== '') summary = '<strong>Credit/Source:</strong>&nbsp;' + credit;
      if (scope.summary)
        summary = scope.summary + '<br/>' + summary;

      template += '<p>' + summary + '</p>';

      template += '</div></td>';

      // start the author cell
      template += '<td><div class="author"><a href="' + Drupal.settings.epe.base_path + 'user/' + scope.userid + '" target="' + link_target + '">';

      if (scope.author)
        template += scope.author;
      else
        template += scope.authorname;

      template += '</a>';

      if (scope.org)
        template += '<br/>(' + scope.org + ')';

      // end the author cell
      template += '</div></td>';

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

      if (scope.author)
        template += scope.author + '<br/>';
      else
        template += scope.authorname + '<br/>';

      if (scope.org)
        template += '(' + scope.org + ')<br/>';

      template += scope.updated;

      elem.html(template).show();

      $compile(elem.contents())(scope);
    }
  }
});
