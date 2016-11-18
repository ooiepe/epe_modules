/**
 * require.js configuration
 * credit: code and example with angularAMD come from:
 * https://github.com/marcoslin/angularAMD
 * http://marcoslin.github.io/angularAMD/#/home
 */
require.config({
  paths: {
    'angular': Drupal.settings.jslibraries.path.angular + '/angular',
    'angularResource': Drupal.settings.jslibraries.path.angular + '/angular-resource',
    'angularRoute': Drupal.settings.jslibraries.path.angular + '/angular-route',
    'angularSanitize': Drupal.settings.jslibraries.path.angular + '/angular-sanitize',
    'angularAnimate': Drupal.settings.jslibraries.path.angular + '/angular-animate',
    /* 3rd party libraries */
    'angularAMD': Drupal.settings.jslibraries.path.angularAMD + '/angularAMD',
    'domReady': Drupal.settings.jslibraries.path.requirejs + '/domReady',
    'ngload': Drupal.settings.jslibraries.path.requirejs + '/ngload',
    'underscore': Drupal.settings.resourceBrowser.appPath + '/services/_',
    'angularUi': Drupal.settings.jslibraries.path.angularUi + '/ui-bootstrap-tpls-0.6.0.min',
    'angularWebstorage': Drupal.settings.jslibraries.path.angularWebstorage + '/angular-webstorage',
    'ngProgress': Drupal.settings.jslibraries.path.ngProgress + '/ngProgress.min',
    'bw.paging': Drupal.settings.jslibraries.path.angularPaging + '/paging',
    /* app controllers */
    'SearchCtrl': Drupal.settings.resourceBrowser.appPath + '/controllers/search_ctrl',
    /* app services */
    'dataServices': Drupal.settings.resourceBrowser.appPath + '/services/dataServices',
  },
  shim: {
    'angular': {
      exports: 'angular'
    },
    'angularResource':['angular'],
    'angularRoute':['angular'],
    'angularSanitize':['angular'],
    'angularUi':['angular'],
    'angularAnimate':['angular'],
    'angularWebstorage':['angular'],
    'ngProgress': {
      exports: 'ngProgress',
      deps: ['angular']
    },
    'bw.paging': {
      exports: 'paging',
      deps: ['angular']
    }
  },
  priority: ["angular"],
  deps: ['app']
});
