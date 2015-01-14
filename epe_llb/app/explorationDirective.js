'use strict';

var epe_llb_directive = angular.module('epe_llb_directive',[]);

epe_llb_directive.directive('htmlContent', function($compile) {
  return {
    restrict: 'A',
    replace: true,
    scope: {
      html: '='
    },
    link: function (scope, elem, attrs) {
      elem.html(scope.html).show();
      $compile(elem.contents())(scope);
    }
  }
});

epe_llb_directive.directive('contenteditable', function($compile) {
    return {
        require: 'ngModel',
        link: function(scope, elm, attrs, ctrl) {
            // view -> model
            elm.bind('blur', function() {
                scope.$apply(function() {
                    ctrl.$setViewValue(elm.html());
                });
            });

            // model -> view
            ctrl.render = function(value) {
                elm.html(value);
            };

            // load init value from DOM
            ctrl.$setViewValue(elm.html());

            elm.bind('keydown', function(event) {
                console.log("keydown " + event.which);
                var esc = event.which == 27,
                    el = event.target;

                if (esc) {
                        console.log("esc");
                        ctrl.$setViewValue(elm.html());
                        el.blur();
                        event.preventDefault();
                    }
            });
            $compile(elm.contents())(scope);
        }
    };
});

epe_llb_directive.directive('inlineEdit', function($compile) {
  return {
    restrict: 'A',
    replace: true,
    scope: {
      item: '=',
      id: '='
    },
    link: function(scope, elem, attrs) {
      var template = '', view = '', edit = '';
      template = '<input name="title" class="dataset" ng-model="item.title">' +
      '<textarea name="body'+scope.id+'" class="dataset form-textarea" ng-model="item.body"></textarea>';// +
      //'<a ng-click="toggleInlineEdit()" class="action">Edit</a>';
      //view = '<div class="view"><strong>{{item.title}}</strong>' + '<div ng-bind-html-unsafe="item.body"></div>' + '<a ng-click="toggleInlineEdit()" class="action">Edit</a></div>';
      //edit = '<input name="title" class="dataset" ng-model="item.title">' +
      //'<textarea class="dataset text-full form-textarea" ck-editor ng-model="item.body"></textarea>' +
      //'<textarea class="dataset text-full form-textarea" ng-model="item.body"></textarea>' +
      //'<a ng-click="toggleInlineEdit()" class="action">Save</a>';

      //template = angular.element($compile('<div class="dataset-container">' + view + '</div>')(scope));
      //template = '<div class="dataset-container">' + view + '</div>';

      scope.toggleInlineEdit = function() {
        if(elem.find('.dataset-container').find('div.view').length > 0) {
          //elem.find('.dataset-container').html($compile(edit)(scope));
          elem.find('.dataset-container').html(edit);
        } else {
          elem.find('.dataset-container').html(view);
          //elem.find('.dataset-container').html($compile(view)(scope));
        }
        $compile(elem.contents())(scope);

 /*       angular.forEach(elem.find('.dataset'), function(input) {
          if(angular.element(input).attr('disabled') == 'disabled') {
            angular.element(input).removeAttr('disabled');
          } else { angular.element(input).attr('disabled','disabled'); }
        });*/
        /*if(elem.find('.action').html() == 'Edit') { elem.find('.action').html('Save'); } else { elem.find('.action').html('Edit'); }*/
      }

      elem.html(template).show();

      $compile(elem.contents())(scope);
    }
  }
});

epe_llb_directive.directive('ckeditor', function() {
  return {
    require: '?ngModel',
    link: function($scope, elm, attr, ngModel) {
      var ck = CKEDITOR.replace(elm[0], {
        toolbar: [
          { items: ['Bold', 'Italic', 'Underline', 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', 'Source', 'HorizontalRule'] }
        ]
      });

      ck.on('pasteState', function() {
        $scope.$apply(function() {
          ngModel.$setViewValue(ck.getData());
        });
      });

      ngModel.$render = function(value) {
        ck.setData(ngModel.$modelValue);
      }
    }
  }
});
