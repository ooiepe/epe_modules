<?php

function epe_dbfiles_adhoc_response($nid) {
  global $user;
  $has_access = true;

  $node = node_load($nid);

  if($node->uid != $user->uid): $has_access = false; endif;

  if(!user_is_logged_in() || !$has_access) {
    drupal_access_denied();
    drupal_exit();
  }

  $modules = variable_get('EPE_CONTENT_MODULES',array());
  $api = '';
  foreach($modules as $module) {
    if(isset($module['resource_type']) && $module['resource_type'] == 'file') {
      if($module['content_type'] == $node->type) {
        if(isset($module['resource_browser']) && isset($module['resource_browser']['api'])) {
          $api = $module['resource_browser']['api'];
        } else {
          $api = 'multimedia';
        }
      }
    }
  }

  drupal_add_js("jQuery.ajax({
                    url: '" . base_path() . "api/resource/{$api}/{$nid}',
                    dataType: 'json',
                    async: true,
                    success: function(data) {
                      window.parent.addItem(data, true);
                    }
                  });", 'inline');

  return 'Your new resource has been added to the lesson.  To add another one, please click ' . l('here', 'dialog/resource/add/file');
}
