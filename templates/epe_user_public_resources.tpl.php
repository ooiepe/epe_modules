<?php
  $app_path = drupal_get_path('module', 'epe_wp') . '/js/user_profile';
  drupal_add_js($app_path . '/app.js');
  drupal_add_js(libraries_get_path('angular-ui-bootstrap') . '/ui-bootstrap-tpls-0.6.0.min.js');

  $depend_modules = variable_get('EPE_CONTENT_MODULES',array());
  $resource_browser_tabs = array();
  foreach($depend_modules as $module) {
    if(isset($module['resource_browser'])) {
      $tab = array();
      if(isset($module['resource_browser']['label'])) {
        $tab['label'] = $module['resource_browser']['label'];
      } else {
        $node_type = node_type_load(str_replace('_','-',$module['content_type']));
        $tab['label'] = $node_type->name;
      }

      $tab['api'] = $module['resource_browser']['api'];
      if(isset($module['resource_browser']['default'])) {
        $tab['default'] = $module['resource_browser']['default'];
      }
      if(isset($module['resource_browser']['weight'])) {
        $tab['weight'] = $module['resource_browser']['weight'];
      }
      if(isset($module['resource_browser']['adurl'])) {
        $tab['adurl'] = $module['resource_browser']['adurl'];
      }
      $resource_browser_tabs[] = $tab;
    }
  }

  drupal_add_js(array('epe_dbresource_browser'=>array('modules'=>$resource_browser_tabs)),'setting');

  angularjs_init_application('app');
?>

<div class="app-main" ng-controller="main">
<tabset id="rb-tabs">
  <tab ng-repeat="pane in panes" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active" select="fn.activeTab(pane);">
  <table id="rb-tab-pane-{{pane.api}}">
    <thead>
      <th>Title/Info</th>
      <th width="250">Summary</th>
    </thead>
    <tbody>
      <tr ng-repeat="row in pane.data"
        table-row
        checkbox="pane.show_checkbox" id="row.id" summary="row.summary" type="pane.api" url="row.url" thumbnail="row.thumbnail" title="row.title" author="row.author" updated="row.last_updated" org="row.org">
      </tr>
    </tbody>
  </table>
  </tab>
</tabset>


</div>
