define([
  'require',
  'angular',
  'app',
], function(require, angular) {
  'use strict';
console.log('here again');
  require(['domReady!'], function(document) {
      try {
          // Wrap this call to try/catch
          angular.bootstrap(document, ['app']);
          console.log('here');
      }
      catch (e) {
          console.error(e.stack || e.message || e);
      }
  });
});
