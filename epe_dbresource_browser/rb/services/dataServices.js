'use strict';

angular.module('dataServices',['ngResource'])
.factory('epeDataService', function($http) {
  var getData = function(param) {
    var apiurl = Drupal.settings.epe.base_path + 'api/resource/' + param.resource_type;
    var urlparams = [];
    if(param.hasOwnProperty('search') && param.search != '') urlparams.push('search=' + param.search);
    if(param.hasOwnProperty('page') && param.page != '') urlparams.push('page=' + param.page);
    if(urlparams.length > 0) apiurl = apiurl + '?' + urlparams.join('&');
    console.log(apiurl);
    return $http({
      method: 'GET',
      url: apiurl
    }).then(function(data) {
      return data;
    });
  }

  var getPager = function(param) {
    var apiurl = Drupal.settings.epe.base_path + 'api/resource/' + param.resource_type;
    var urlparams = [];
    if(param.hasOwnProperty('search') && param.search != '') urlparams.push('search=' + param.search);
    urlparams.push('get_pager=true');
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
