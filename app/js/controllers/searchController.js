'use strict';

var SearchController = function($scope, $routeParams, $location, $filter, imageService, documentService, multimediaService) {
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
  $scope.resource = {};
  $scope.filter = {};
  $scope.resource.view_types = [
    {userid:'',label:'All Resources'}
  ];

  //add my resource option if user is logged in
  if(Drupal.settings.epe_dbresource_browser.userid) { $scope.resource.view_types.push({userid:Drupal.settings.epe_dbresource_browser.userid,label:'My Resources'}); }
  //set default resource type
  $scope.filter.view_type = $scope.resource.view_types[0];

  $scope.term = $routeParams['term'];
  $scope.search = function() {
    if(typeof $scope.term == "undefined") {
      $location.url('/search');
    } else {
      $location.url('/search/' + $scope.term);
    }
  }

  //default sort, default view
  $scope.sort = "title";
  $scope.radioModel = "list";

  //tabs data struct
  $scope.panes.table = [
    {
      type:'Image',
      data: {},
      active: true
    },
    {
      type:'Document',
      data: {},
      active: false
    },
    {
      type:'Multimedia',
      data: {},
      active:false
    }
  ];

  //encapsulate init load into function
  $scope.fn.loadresource = function() {

    //set default tab
    if(typeof $location.search()['type'] != 'undefined') {
      var found = false;
      angular.forEach($scope.panes.table, function(pane, index) {
          if(pane.type.toLowerCase() == $location.search()['type'].toLowerCase()) {
            found == true;
            $scope.panes.table[index].active = true;
          } else {
            $scope.panes.table[index].active = false;
          }
      });
      if(!found) $scope.panes.table[0].active = true;
    } else { $scope.panes.table[0].active = true; }

    var searchterm = {};
    if(typeof $routeParams['term'] != "undefined") searchterm = {search:$routeParams['term']};

    //get image resources
    var imageresult = imageService.get(searchterm,function() {
      //add result to $scope data
      angular.forEach(imageresult.nodes, function(node) {
        $scope.resources.imageResource.data.push(node.node);
      });
      //add data to tab
      $scope.panes.table[0].data = $scope.resources.imageResource.data;
    });

    //get document resources
    var documentresult = documentService.get(searchterm,function() {
      //add result to $scope data
      angular.forEach(documentresult.nodes, function(node) {
        $scope.resources.documentResource.data.push(node.node);
      });
      //add data to tab
      $scope.panes.table[1].data = $scope.resources.documentResource.data;
    });

    //get multimedia resources
    var multimediaresult = multimediaService.get(searchterm, function() {
      //add result to $scope data
      angular.forEach(multimediaresult.nodes, function(node) {
        $scope.resources.multimediaResource.data.push(node.node);
      });
      //add data to tab
      $scope.panes.table[2].data = $scope.resources.multimediaResource.data;
    });
  } //loadresource

  $scope.fn.loadresource();

  //watch type change and filter data
  $scope.$watch("filter.view_type", function(view_type) {
    $scope.panes.table[0].data = $filter("resourceFilter")($scope.resources.imageResource.data, view_type.userid);
    $scope.panes.table[1].data = $filter("resourceFilter")($scope.resources.documentResource.data, view_type.userid);
    $scope.panes.table[2].data = $filter("resourceFilter")($scope.resources.multimediaResource.data, view_type.userid);
  });
}
