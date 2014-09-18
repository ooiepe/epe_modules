'use strict';

angular.module('dataServices',['ngResource','_'])
.factory('epeDataService', function($http,_) {
  var getData = function(param) {
    var apiurl = Drupal.settings.epe.base_path + 'api/resource/' + param.resource_type;
    var urlparams = [];
    if(param.hasOwnProperty('search') && param.search != '') urlparams.push('search=' + param.search);
    if(param.hasOwnProperty('page') && param.page != '') urlparams.push('page=' + param.page);
    if(param.hasOwnProperty('filter') && param.filter != '') urlparams.push('filter=' + param.filter);
    if(param.hasOwnProperty('sort') && _.contains(['title','author','last_updated'],param.sort)) urlparams.push('sort=' + param.sort);
    if(param.hasOwnProperty('sort_mode') && _.contains(['asc','desc'],param.sort_mode)) urlparams.push('sort_mode=' + param.sort_mode);
    if(urlparams.length > 0) apiurl = apiurl + '?' + urlparams.join('&');

    return $http({
      method: 'GET',
      url: apiurl
    }).then(function(data) {
      return data;
    });
  }

  var getPager = function(param) {
    var apiurl = Drupal.settings.epe.base_path + 'api/resource/pager';
    var urlparams = [];
    if(param.hasOwnProperty('search') && param.search != '') urlparams.push('search=' + param.search);
    if(param.hasOwnProperty('filter') && param.filter != '') urlparams.push('filter=' + param.filter);
    if(urlparams.length > 0) apiurl = apiurl + '?' + urlparams.join('&');
    return $http({
      method: 'GET',
      url: apiurl
    }).then(function(data) {
      return data;
    });
  }

  return {
    getData : getData,
    getPager : getPager
  }
});
