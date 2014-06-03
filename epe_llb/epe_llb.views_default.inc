<?php
/**
 * @file
 * llb_resource_feature.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function epe_llb_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'llb_resource_index';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'search_api_index_llb_resource_index';
  $view->human_name = 'llb_resource_index';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'All LLB Resources';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'views_json';
  $handler->display->display_options['style_options']['plaintext_output'] = 1;
  $handler->display->display_options['style_options']['remove_newlines'] = 0;
  $handler->display->display_options['style_options']['jsonp_prefix'] = '';
  $handler->display->display_options['style_options']['using_views_api_mode'] = 0;
  $handler->display->display_options['style_options']['object_arrays'] = 0;
  $handler->display->display_options['style_options']['numeric_strings'] = 0;
  $handler->display->display_options['style_options']['bigint_string'] = 0;
  $handler->display->display_options['style_options']['pretty_print'] = 0;
  $handler->display->display_options['style_options']['unescaped_slashes'] = 0;
  $handler->display->display_options['style_options']['unescaped_unicode'] = 0;
  $handler->display->display_options['style_options']['char_encoding'] = array();
  /* Field: Indexed Node: Node ID */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = 'id';
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nid']['separator'] = '';
  $handler->display->display_options['fields']['nid']['link_to_entity'] = 0;
  /* Field: Global: PHP */
  $handler->display->display_options['fields']['php']['id'] = 'php';
  $handler->display->display_options['fields']['php']['table'] = 'views';
  $handler->display->display_options['fields']['php']['field'] = 'php';
  $handler->display->display_options['fields']['php']['label'] = 'thumbnail';
  $handler->display->display_options['fields']['php']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['php']['use_php_setup'] = 0;
  $handler->display->display_options['fields']['php']['php_output'] = '<?php
    $node = node_load($data->entity);
    $field = field_get_items(\'node\', $node, \'field_challenge_thumbnail\');
    $field_value = drupal_json_decode($field[0][\'value\']);

    $output = \'\';
    if($field_value) {
      $output = theme(\'image_style\', array(\'style_name\' => \'resource_browser_thumbnail\', \'path\' =>$field_value[0][\'uri\']));
    }
    echo render($output);
  ?>';
  $handler->display->display_options['fields']['php']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php']['php_click_sortable'] = '';
  /* Field: Author: First Name (indexed) */
  $handler->display->display_options['fields']['author_field_account_fname']['id'] = 'author_field_account_fname';
  $handler->display->display_options['fields']['author_field_account_fname']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['author_field_account_fname']['field'] = 'author_field_account_fname';
  $handler->display->display_options['fields']['author_field_account_fname']['label'] = '';
  $handler->display->display_options['fields']['author_field_account_fname']['exclude'] = TRUE;
  $handler->display->display_options['fields']['author_field_account_fname']['element_label_colon'] = FALSE;
  /* Field: Author: Last Name (indexed) */
  $handler->display->display_options['fields']['author_field_account_lname']['id'] = 'author_field_account_lname';
  $handler->display->display_options['fields']['author_field_account_lname']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['author_field_account_lname']['field'] = 'author_field_account_lname';
  $handler->display->display_options['fields']['author_field_account_lname']['label'] = '';
  $handler->display->display_options['fields']['author_field_account_lname']['exclude'] = TRUE;
  $handler->display->display_options['fields']['author_field_account_lname']['element_label_colon'] = FALSE;
  /* Field: Author: User ID (indexed) */
  $handler->display->display_options['fields']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['fields']['author_uid']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['author_uid']['field'] = 'author_uid';
  $handler->display->display_options['fields']['author_uid']['label'] = 'userid';
  $handler->display->display_options['fields']['author_uid']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['author_uid']['separator'] = '';
  $handler->display->display_options['fields']['author_uid']['link_to_entity'] = 0;
  /* Field: Indexed Node: Date changed */
  $handler->display->display_options['fields']['changed']['id'] = 'changed';
  $handler->display->display_options['fields']['changed']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['changed']['field'] = 'changed';
  $handler->display->display_options['fields']['changed']['label'] = 'last_updated';
  $handler->display->display_options['fields']['changed']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['changed']['date_format'] = 'custom';
  $handler->display->display_options['fields']['changed']['custom_date_format'] = 'M j, Y';
  $handler->display->display_options['fields']['changed']['link_to_entity'] = 0;
  /* Field: Indexed Node: Status */
  $handler->display->display_options['fields']['status']['id'] = 'status';
  $handler->display->display_options['fields']['status']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['status']['field'] = 'status';
  $handler->display->display_options['fields']['status']['label'] = 'status';
  $handler->display->display_options['fields']['status']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['status']['link_to_entity'] = 0;
  $handler->display->display_options['fields']['status']['format_name'] = 1;
  /* Field: Indexed Node: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'title';
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['link_to_entity'] = 0;
  /* Field: Indexed Node: URL */
  $handler->display->display_options['fields']['url']['id'] = 'url';
  $handler->display->display_options['fields']['url']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['url']['field'] = 'url';
  $handler->display->display_options['fields']['url']['label'] = 'url';
  $handler->display->display_options['fields']['url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['url']['display_as_link'] = FALSE;
  $handler->display->display_options['fields']['url']['link_to_entity'] = 0;
  /* Field: Indexed Node: The main body text */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = 'summary';
  $handler->display->display_options['fields']['body']['type'] = 'text_summary_or_trimmed';
  $handler->display->display_options['fields']['body']['settings'] = array(
    'trim_length' => '200',
  );
  /* Field: Author: Institution / School (indexed) */
  $handler->display->display_options['fields']['author_field_account_organization']['id'] = 'author_field_account_organization';
  $handler->display->display_options['fields']['author_field_account_organization']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['author_field_account_organization']['field'] = 'author_field_account_organization';
  $handler->display->display_options['fields']['author_field_account_organization']['label'] = 'org';
  /* Field: Global: PHP */
  $handler->display->display_options['fields']['php_1']['id'] = 'php_1';
  $handler->display->display_options['fields']['php_1']['table'] = 'views';
  $handler->display->display_options['fields']['php_1']['field'] = 'php';
  $handler->display->display_options['fields']['php_1']['label'] = 'author';
  $handler->display->display_options['fields']['php_1']['use_php_setup'] = 0;
  $handler->display->display_options['fields']['php_1']['php_output'] = '<?php
    $fullname = array();
    if( !empty($data->_entity_properties[\'author:entity object\']->field_account_fname) ) {
      $fullname[] = $data->_entity_properties[\'author:entity object\']->field_account_fname[\'und\'][0][\'value\'];
    }
    if( !empty($data->_entity_properties[\'author:entity object\']->field_account_lname) ) {
      $fullname[] = $data->_entity_properties[\'author:entity object\']->field_account_lname[\'und\'][0][\'value\'];
    }
    echo implode(\' \',$fullname);
    ?>';
  $handler->display->display_options['fields']['php_1']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php_1']['php_click_sortable'] = '';
  /* Field: Author: Name (indexed) */
  $handler->display->display_options['fields']['author_name']['id'] = 'author_name';
  $handler->display->display_options['fields']['author_name']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['author_name']['field'] = 'author_name';
  $handler->display->display_options['fields']['author_name']['label'] = 'author_name';
  $handler->display->display_options['fields']['author_name']['link_to_entity'] = 0;
  /* Field: Indexed Node: Featured Status */
  $handler->display->display_options['fields']['field_featured_status']['id'] = 'field_featured_status';
  $handler->display->display_options['fields']['field_featured_status']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['field_featured_status']['field'] = 'field_featured_status';
  $handler->display->display_options['fields']['field_featured_status']['label'] = 'featured';
  /* Field: Indexed Node: Public Status */
  $handler->display->display_options['fields']['field_public_status']['id'] = 'field_public_status';
  $handler->display->display_options['fields']['field_public_status']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['fields']['field_public_status']['field'] = 'field_public_status';
  $handler->display->display_options['fields']['field_public_status']['label'] = 'public';
  $handler->display->display_options['filter_groups']['groups'] = array(
    1 => 'OR',
    2 => 'AND',
  );
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['filters']['author_uid']['field'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid']['group'] = 1;
  $handler->display->display_options['filters']['author_uid']['exposed'] = TRUE;
  $handler->display->display_options['filters']['author_uid']['expose']['operator_id'] = 'author_uid_op';
  $handler->display->display_options['filters']['author_uid']['expose']['label'] = 'User ID (indexed)';
  $handler->display->display_options['filters']['author_uid']['expose']['operator'] = 'author_uid_op';
  $handler->display->display_options['filters']['author_uid']['expose']['identifier'] = 'author';
  $handler->display->display_options['filters']['author_uid']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
  );
  /* Filter criterion: Search: Fulltext search */
  $handler->display->display_options['filters']['search_api_views_fulltext']['id'] = 'search_api_views_fulltext';
  $handler->display->display_options['filters']['search_api_views_fulltext']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['filters']['search_api_views_fulltext']['field'] = 'search_api_views_fulltext';
  $handler->display->display_options['filters']['search_api_views_fulltext']['group'] = 2;
  $handler->display->display_options['filters']['search_api_views_fulltext']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['operator_id'] = 'search_api_views_fulltext_op';
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['label'] = 'Fulltext search';
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['operator'] = 'search_api_views_fulltext_op';
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['identifier'] = 'search';
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
  );
  $handler->display->display_options['filters']['search_api_views_fulltext']['fields'] = array(
    'title' => 'title',
    'body:value' => 'body:value',
  );
  /* Filter criterion: Indexed Node: Public Status */
  $handler->display->display_options['filters']['field_public_status']['id'] = 'field_public_status';
  $handler->display->display_options['filters']['field_public_status']['table'] = 'search_api_index_llb_resource_index';
  $handler->display->display_options['filters']['field_public_status']['field'] = 'field_public_status';
  $handler->display->display_options['filters']['field_public_status']['value'] = array(
    'Public' => 'Public',
  );

  /* Display: REST API Block */
  $handler = $view->new_display('block', 'REST API Block', 'all');

  $export['llb_resource_index'] = $view;

  return $export;
}
