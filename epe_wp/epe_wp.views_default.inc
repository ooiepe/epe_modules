<?php
/**
 * @file
 * epe_db.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function epe_wp_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'user_resources';
  $view->description = 'Display list of logged in user\'s resources';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'user resources';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Favorite Resources';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['columns'] = array(
    'nid' => 'nid',
    'php_1' => 'php_1',
    'title' => 'title',
    'body' => 'body',
    'type' => 'type',
  );
  $handler->display->display_options['style_options']['default'] = '-1';
  $handler->display->display_options['style_options']['info'] = array(
    'nid' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'php_1' => array(
      'align' => 'views-align-center',
      'separator' => '',
      'empty_column' => 0,
    ),
    'title' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'body' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'type' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  /* No results behavior: Global: Text area */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = 'No Published Resources';
  $handler->display->display_options['empty']['area']['format'] = 'filtered_html';
  /* Field: Content: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['exclude'] = TRUE;
  /* Field: Global: PHP */
  $handler->display->display_options['fields']['php_1']['id'] = 'php_1';
  $handler->display->display_options['fields']['php_1']['table'] = 'views';
  $handler->display->display_options['fields']['php_1']['field'] = 'php';
  $handler->display->display_options['fields']['php_1']['label'] = '';
  $handler->display->display_options['fields']['php_1']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['php_1']['use_php_setup'] = 0;
  $handler->display->display_options['fields']['php_1']['php_output'] = '<?php
    $thumbnail = \'\';
    if(in_array($data->node_type,array(\'image_resource\',\'document_resource\',\'audio_resource\',\'video_resource\'))) {
      $node = node_load($data->nid);
      $wrapper = entity_metadata_wrapper(\'node\',$node);
      switch($data->node_type) {
        case \'image_resource\':
          $image = $wrapper->field_image_resource_file->value();
          $thumbnail = image_style_url(\'resource_browser_thumbnail\', $image[\'uri\']);
        break;

        case \'document_resource\':
        $image = $wrapper->field_document_resource_image->value();
        if($image) {
          $thumbnail = image_style_url(\'resource_browser_thumbnail\', $image[\'uri\']);
        } else {
          $thumbnail = base_path() . drupal_get_path(\'theme\',\'bootstrap\') . \'/images/no_thumb_small.jpg\';
        }
        break;

        case \'audio_resource\':
          $image = $wrapper->field_audio_resource_image->value();
          if($image) {
            $thumbnail = image_style_url(\'resource_browser_thumbnail\', $image[\'uri\']);
          } else {
            $thumbnail = base_path() . drupal_get_path(\'theme\',\'bootstrap\') . \'/images/no_thumb_small.jpg\';
          }
        break;

        case \'video_resource\':
          $field = field_get_items(\'node\', $node, \'field_video_resource_file\');
          if($field) {
            $thumbnail = image_style_url(\'resource_browser_thumbnail\', $field[0][\'thumbnailfile\']->uri);
          } else {
            $thumbnail = base_path() . drupal_get_path(\'theme\',\'bootstrap\') . \'/images/no_thumb_small.jpg\';
          }
        break;
      }
    } else {
      $thumbnail = base_path() . drupal_get_path(\'theme\',\'bootstrap\') . \'/images/no_thumb_small.jpg\';
    }
    ?>

    <img src="<?php echo $thumbnail; ?>" width="133" height="99" />';
  $handler->display->display_options['fields']['php_1']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php_1']['php_click_sortable'] = '';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['exclude'] = TRUE;
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  /* Field: Content: Description */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = 'Title / Info';
  $handler->display->display_options['fields']['body']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['body']['alter']['text'] = '<p>[title]</p>
    [body]';
  $handler->display->display_options['fields']['body']['type'] = 'text_summary_or_trimmed';
  $handler->display->display_options['fields']['body']['settings'] = array(
    'trim_length' => '500',
  );
  /* Field: Content: Type */
  $handler->display->display_options['fields']['type']['id'] = 'type';
  $handler->display->display_options['fields']['type']['table'] = 'node';
  $handler->display->display_options['fields']['type']['field'] = 'type';
  /* Sort criterion: Content: Type */
  $handler->display->display_options['sorts']['type']['id'] = 'type';
  $handler->display->display_options['sorts']['type']['table'] = 'node';
  $handler->display->display_options['sorts']['type']['field'] = 'type';
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  /* Contextual filter: Content: Author uid */
  $handler->display->display_options['arguments']['uid']['id'] = 'uid';
  $handler->display->display_options['arguments']['uid']['table'] = 'node';
  $handler->display->display_options['arguments']['uid']['field'] = 'uid';
  $handler->display->display_options['arguments']['uid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['uid']['default_argument_type'] = 'php';
  $handler->display->display_options['arguments']['uid']['default_argument_options']['code'] = 'global $user;
    if(arg(0) == \'user\' && arg(1)) {
          $user_from_url = user_load(arg(1));
          if($user_from_url) { return $user_from_url->uid; } else {  return $user->uid; }
    } else {
    return $user->uid;
    }';
  $handler->display->display_options['arguments']['uid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['uid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['uid']['summary_options']['items_per_page'] = '25';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'audio_resource' => 'audio_resource',
    'cm_resource' => 'cm_resource',
    'document_resource' => 'document_resource',
    'ev_tool_instance' => 'ev_tool_instance',
    'image_resource' => 'image_resource',
    'llb_resource' => 'llb_resource',
    'video_resource' => 'video_resource',
  );

  /* Display: Public */
  $handler = $view->new_display('block', 'Public', 'public');

  /* Display: Favorites */
  $handler = $view->new_display('block', 'Favorites', 'favorites');
  $handler->display->display_options['defaults']['empty'] = FALSE;
  /* No results behavior: Global: Text area */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = 'No Favorite Resources';
  $handler->display->display_options['empty']['area']['format'] = 'filtered_html';
  $handler->display->display_options['defaults']['relationships'] = FALSE;
  /* Relationship: Flags: favorite_resource */
  $handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['table'] = 'node';
  $handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'favorite_resource';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['exclude'] = TRUE;
  /* Field: Global: PHP */
  $handler->display->display_options['fields']['php_1']['id'] = 'php_1';
  $handler->display->display_options['fields']['php_1']['table'] = 'views';
  $handler->display->display_options['fields']['php_1']['field'] = 'php';
  $handler->display->display_options['fields']['php_1']['label'] = '';
  $handler->display->display_options['fields']['php_1']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['php_1']['use_php_setup'] = 0;
  $handler->display->display_options['fields']['php_1']['php_output'] = '<?php
    $thumbnail = \'\';
    if(in_array($data->node_type,array(\'image_resource\',\'document_resource\',\'audio_resource\',\'video_resource\'))) {
      $node = node_load($data->nid);
      $wrapper = entity_metadata_wrapper(\'node\',$node);
      switch($data->node_type) {
        case \'image_resource\':
          $image = $wrapper->field_image_resource_file->value();
          $thumbnail = image_style_url(\'resource_browser_thumbnail\', $image[\'uri\']);
        break;

        case \'document_resource\':
        $image = $wrapper->field_document_resource_image->value();
        if($image) {
          $thumbnail = image_style_url(\'resource_browser_thumbnail\', $image[\'uri\']);
        } else {
          $thumbnail = base_path() . drupal_get_path(\'theme\',\'bootstrap\') . \'/images/no_thumb_small.jpg\';
        }
        break;

        case \'audio_resource\':
          $image = $wrapper->field_audio_resource_image->value();
          if($image) {
            $thumbnail = image_style_url(\'resource_browser_thumbnail\', $image[\'uri\']);
          } else {
            $thumbnail = base_path() . drupal_get_path(\'theme\',\'bootstrap\') . \'/images/no_thumb_small.jpg\';
          }
        break;

        case \'video_resource\':
          $field = field_get_items(\'node\', $node, \'field_video_resource_file\');
          if($field) {
            $thumbnail = image_style_url(\'resource_browser_thumbnail\', $field[0][\'thumbnailfile\']->uri);
          } else {
            $thumbnail = base_path() . drupal_get_path(\'theme\',\'bootstrap\') . \'/images/no_thumb_small.jpg\';
          }
        break;
      }
    } else {
      $thumbnail = base_path() . drupal_get_path(\'theme\',\'bootstrap\') . \'/images/no_thumb_small.jpg\';
    }
    ?>

    <img src="<?php echo $thumbnail; ?>" width="133" height="99" />';
  $handler->display->display_options['fields']['php_1']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php_1']['php_click_sortable'] = '';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['exclude'] = TRUE;
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  /* Field: Content: Description */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = 'Title / Info';
  $handler->display->display_options['fields']['body']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['body']['alter']['text'] = '<p>[title]</p>
    [body]';
  $handler->display->display_options['fields']['body']['type'] = 'text_summary_or_trimmed';
  $handler->display->display_options['fields']['body']['settings'] = array(
    'trim_length' => '500',
  );
  /* Field: Content: Type */
  $handler->display->display_options['fields']['type']['id'] = 'type';
  $handler->display->display_options['fields']['type']['table'] = 'node';
  $handler->display->display_options['fields']['type']['field'] = 'type';
  /* Field: Flags: Flag link */
  $handler->display->display_options['fields']['ops']['id'] = 'ops';
  $handler->display->display_options['fields']['ops']['table'] = 'flagging';
  $handler->display->display_options['fields']['ops']['field'] = 'ops';
  $handler->display->display_options['fields']['ops']['relationship'] = 'flag_content_rel';
  $handler->display->display_options['fields']['ops']['label'] = 'Actions';
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'audio_resource' => 'audio_resource',
    'cm_resource' => 'cm_resource',
    'document_resource' => 'document_resource',
    'ev_tool_instance' => 'ev_tool_instance',
    'image_resource' => 'image_resource',
    'llb_resource' => 'llb_resource',
    'video_resource' => 'video_resource',
  );

  $export['user_resources'] = $view;

  return $export;
}
