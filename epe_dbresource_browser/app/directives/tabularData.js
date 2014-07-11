/* custom directive for rendering result set layout */
define(['app'], function(app) {
  app.directive('tabularData', ['$compile','webStorage','_', function($compile,webStorage,_) {
    return {
      restrict: 'A',
      replace: true,
      scope: {
        row: '=',
        type: '=',
        updateSelect: '&'
      },
      link: function (scope, elem, attrs) {
        var template = '', element_ck = '', link_target = '_self', row_status = '';
        if(Drupal.settings.resourceBrowser.editmode) {
          element_ck = '<div style="float:left;"><input type="checkbox" style="margin-right:0;position:absolute;" name="nid" ng-click="updateResourceSelection('+ scope.row.id +')" ng-checked="isChecked()" data-type="' + scope.type + '" value="' + scope.row.id + '"></div>';
          link_target = '_blank';
        }

        if (scope.row.thumbnail == '')
          scope.row.thumbnail = Drupal.settings.theme_path + '/images/no_thumb_small.jpg';

        if(scope.row.status == 'Published') row_status += '<span class="btn btn-default btn-sm disabled">Published</span>&nbsp;';
        if(scope.row.public == 'Public') row_status += '<span class="btn btn-info btn-sm disabled">Public</span>&nbsp;';
        if(scope.row.featured == 'Featured') row_status += '<span class="btn btn-success btn-sm disabled">Featured</span>';
        template += '<td><div style="width:160px;height:99px;position:relative;float:left;">' + element_ck + '<a href="' + scope.row.url + '" target="' + link_target + '"><img width="133" height="99" style="margin-left:20px;" class="thumb" ng-src="' + scope.row.thumbnail + '" /></a></div><div class="author" style="margin-left:160px;"><p><a href="' + scope.row.url + '" target="' + link_target + '">' + scope.row.title + '</a><br/>' + row_status + '</p></div><div class="text" style="margin-left:160px;">';
        var credit = '', summary = '';
        if(scope.row.credit) credit = scope.row.credit;
        if(scope.row.sourceurl) credit = '<a href="'+ scope.row.sourceurl +'" target="_blank">'+ credit +'</a>';
        if(credit !== '') summary = '<strong>Credit/Source:</strong>&nbsp;' + credit;
        if (scope.summary)
          summary = scope.row.summary + '<br/>' + summary;

        template += '<p>' + summary + '</p>';

        template += '</div></td>';

        // start the author cell
        template += '<td><div class="author"><a href="' + Drupal.settings.epe.base_path + 'user/' + scope.row.userid + '" target="' + link_target + '">';

        if (scope.row.author)
          template += scope.row.author;
        else
          template += scope.row.author_name;

        template += '</a>';

        if (scope.row.org)
          template += '<br/>(' + scope.row.org + ')';

        // end the author cell
        template += '</div></td>';

        template += '<td>' + scope.row.last_updated + '</td>';

        elem.html(template).show();

        $compile(elem.contents())(scope);

        scope.updateResourceSelection  = function(selected_val) {
          var selectedResources;

          selectedResources = webStorage.session.get('selectedResources');

          if(selectedResources == null) {
            selectedResources = {};
          }

          if(typeof selectedResources[scope.type] == 'undefined') {
            selectedResources[scope.type] = [];
          }

          if(!_.find(selectedResources[scope.type], function(value) { return value == scope.row.id})) {
            //add selected id to session
            selectedResources[scope.type].push(scope.row.id);
          } else {
            //remove selected id to session
            selectedResources[scope.type] = _.without(selectedResources[scope.type], selected_val.toString());
          }
          webStorage.session.add('selectedResources', selectedResources);
        }

        scope.isChecked = function() {
          var selectedResources;
          selectedResources = webStorage.session.get('selectedResources');
          if(selectedResources != null && typeof selectedResources[scope.type] === 'object' && selectedResources[scope.type] instanceof Array) {
            if(_.find(selectedResources[scope.type], function(value) { return value == scope.row.id})) {
              return true;
            } else {
              return false;
            }
          }
        }
      }
    }
  }])
});
