/**
 * define underscore with require.js, export this as a module usable in angular application
 */
define(['underscore'],function(underscore) {
  var underscore = angular.module('underscore', []);
  underscore.factory('_', function() {
    return window._;
  });

  return underscore;
});
