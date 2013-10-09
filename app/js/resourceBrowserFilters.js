'use strict';

var resourceBrowserFilter = angular.module('resourceBrowserFilter',[]);

resourceBrowserFilter.filter('resourceFilter', function(){

    return function(input, query){
      if(!query) return input;
      var result = [];

      angular.forEach(input, function(node){
        if(query != '') {
          //if(query == node.userid) result.push(node);
          if(Drupal.settings.epe_dbresource_browser.userid == node.userid) result.push(node);
        } else {
          result.push(node);
        }
      });
      return result;
    };
  });
