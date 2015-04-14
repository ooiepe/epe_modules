<?php
/**
 * @file
 * [your_module_name].views_default.inc
 *
 * COMMENTS HERE:
 * Change [your_module_name] placeholder text to the name of the module that contains this view include file
 * Change [your view machine name] placeholder text to the name you want, machine name must be text_text_text format
 * Change [your view name] placeholder to the name you want, this is the name displayed on the admin/structure/views page
 * Change [your search api index machine name] to the machine name of the search api inex, you will find the name in the .module file
 * Change [your image thumbnail field name] to the image thumbnail field machine name of your content type
 *
 */

/**
 * Implements hook_views_default_views().
 */
function epe_cm_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'epe_cm_search_view';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'search_api_index_epe_cm_search_index';
  $view->human_name = 'epe_cm_search_view';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'EPE CM Search View';
  $handler->display->display_options['css_class'] = 'block-list';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '10';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
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
  $handler->display->display_options['fields']['nid']['table'] = 'search_api_index_epe_cm_search_index';
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
          $image = field_get_items(\'node\', $node, \'field_instance_thumbnail\');
          $output = \'\';
          if($image) {
          $output = field_view_value(\'node\', $node, \'field_instance_thumbnail\', $image[0], array(
            \'type\' => \'image\',
            \'settings\' => array(
               \'image_style\' => \'resource_browser_thumbnail\',
            ),
          ));
          }
          //echo render($output);
          echo image_style_url(\'resource_browser_thumbnail\', $image[0][\'uri\']);
      ?>';
  $handler->display->display_options['fields']['php']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php']['php_click_sortable'] = '';
  /* Field: Indexed Node: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'title';
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['link_to_entity'] = 0;
  /* Field: Indexed Node: Date changed */
  $handler->display->display_options['fields']['changed']['id'] = 'changed';
  $handler->display->display_options['fields']['changed']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['changed']['field'] = 'changed';
  $handler->display->display_options['fields']['changed']['label'] = 'last_updated';
  $handler->display->display_options['fields']['changed']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['changed']['date_format'] = 'custom';
  $handler->display->display_options['fields']['changed']['custom_date_format'] = 'M j, Y';
  $handler->display->display_options['fields']['changed']['link_to_entity'] = 0;
  /* Field: Author: First Name (indexed) */
  $handler->display->display_options['fields']['author_field_account_fname']['id'] = 'author_field_account_fname';
  $handler->display->display_options['fields']['author_field_account_fname']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['author_field_account_fname']['field'] = 'author_field_account_fname';
  $handler->display->display_options['fields']['author_field_account_fname']['label'] = '';
  $handler->display->display_options['fields']['author_field_account_fname']['exclude'] = TRUE;
  $handler->display->display_options['fields']['author_field_account_fname']['element_label_colon'] = FALSE;
  /* Field: Author: Last Name (indexed) */
  $handler->display->display_options['fields']['author_field_account_lname']['id'] = 'author_field_account_lname';
  $handler->display->display_options['fields']['author_field_account_lname']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['author_field_account_lname']['field'] = 'author_field_account_lname';
  $handler->display->display_options['fields']['author_field_account_lname']['label'] = '';
  $handler->display->display_options['fields']['author_field_account_lname']['exclude'] = TRUE;
  $handler->display->display_options['fields']['author_field_account_lname']['element_label_colon'] = FALSE;
  /* Field: Author: User ID (indexed) */
  $handler->display->display_options['fields']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['fields']['author_uid']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['author_uid']['field'] = 'author_uid';
  $handler->display->display_options['fields']['author_uid']['label'] = 'userid';
  $handler->display->display_options['fields']['author_uid']['separator'] = '';
  $handler->display->display_options['fields']['author_uid']['link_to_entity'] = 0;
  /* Field: Indexed Node: Status */
  $handler->display->display_options['fields']['status']['id'] = 'status';
  $handler->display->display_options['fields']['status']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['status']['field'] = 'status';
  $handler->display->display_options['fields']['status']['label'] = 'status';
  $handler->display->display_options['fields']['status']['link_to_entity'] = 0;
  $handler->display->display_options['fields']['status']['format_name'] = 1;
  /* Field: Indexed Node: URL */
  $handler->display->display_options['fields']['url']['id'] = 'url';
  $handler->display->display_options['fields']['url']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['url']['field'] = 'url';
  $handler->display->display_options['fields']['url']['label'] = 'url';
  $handler->display->display_options['fields']['url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['url']['display_as_link'] = FALSE;
  $handler->display->display_options['fields']['url']['link_to_entity'] = 0;
  /* Field: Author: Institution / School (indexed) */
  $handler->display->display_options['fields']['author_field_account_organization']['id'] = 'author_field_account_organization';
  $handler->display->display_options['fields']['author_field_account_organization']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['author_field_account_organization']['field'] = 'author_field_account_organization';
  $handler->display->display_options['fields']['author_field_account_organization']['label'] = 'org';
  /* Field: Indexed Node: Featured Status */
  $handler->display->display_options['fields']['field_featured_status']['id'] = 'field_featured_status';
  $handler->display->display_options['fields']['field_featured_status']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['field_featured_status']['field'] = 'field_featured_status';
  $handler->display->display_options['fields']['field_featured_status']['label'] = 'featured';
  /* Field: Indexed Node: Public Status */
  $handler->display->display_options['fields']['field_public_status']['id'] = 'field_public_status';
  $handler->display->display_options['fields']['field_public_status']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['field_public_status']['field'] = 'field_public_status';
  $handler->display->display_options['fields']['field_public_status']['label'] = 'public';
  /* Field: Author: Name (indexed) */
  $handler->display->display_options['fields']['author_name']['id'] = 'author_name';
  $handler->display->display_options['fields']['author_name']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['author_name']['field'] = 'author_name';
  $handler->display->display_options['fields']['author_name']['label'] = 'author_name';
  $handler->display->display_options['fields']['author_name']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['author_name']['link_to_entity'] = 0;
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
  /* Contextual filter: Indexed Node: Author */
  $handler->display->display_options['arguments']['author']['id'] = 'author';
  $handler->display->display_options['arguments']['author']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['arguments']['author']['field'] = 'author';
  $handler->display->display_options['arguments']['author']['default_action'] = 'default';
  $handler->display->display_options['arguments']['author']['default_argument_type'] = 'current_user';
  $handler->display->display_options['arguments']['author']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['author']['break_phrase'] = 0;
  $handler->display->display_options['filter_groups']['groups'] = array(
    1 => 'OR',
    2 => 'AND',
  );
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid']['table'] = 'search_api_index_epe_cm_search_index';
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
  /* Filter criterion: Indexed Node: Public Status */
  $handler->display->display_options['filters']['field_public_status']['id'] = 'field_public_status';
  $handler->display->display_options['filters']['field_public_status']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['filters']['field_public_status']['field'] = 'field_public_status';
  $handler->display->display_options['filters']['field_public_status']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status']['group'] = 1;
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1']['id'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['filters']['search_api_aggregation_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['group'] = 2;
  $handler->display->display_options['filters']['search_api_aggregation_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['operator_id'] = 'search_api_aggregation_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['label'] = 'title_main_body_fulltext_search';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['operator'] = 'search_api_aggregation_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['identifier'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: Featured Status */
  $handler->display->display_options['filters']['field_featured_status']['id'] = 'field_featured_status';
  $handler->display->display_options['filters']['field_featured_status']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['filters']['field_featured_status']['field'] = 'field_featured_status';
  $handler->display->display_options['filters']['field_featured_status']['value'] = array(
    'Not-Featured' => 'Not-Featured',
    'Featured' => 'Featured',
  );
  $handler->display->display_options['filters']['field_featured_status']['group'] = 2;
  $handler->display->display_options['filters']['field_featured_status']['expose']['operator_id'] = 'field_featured_status_op';
  $handler->display->display_options['filters']['field_featured_status']['expose']['label'] = 'Featured Status';
  $handler->display->display_options['filters']['field_featured_status']['expose']['operator'] = 'field_featured_status_op';
  $handler->display->display_options['filters']['field_featured_status']['expose']['identifier'] = 'featured';
  $handler->display->display_options['filters']['field_featured_status']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  $handler->display->display_options['filters']['field_featured_status']['expose']['reduce'] = 0;

  /* Display: RESTful API Block */
  $handler = $view->new_display('block', 'RESTful API Block', 'all');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['defaults']['arguments'] = FALSE;

  /* Display: RESTful API Pager */
  $handler = $view->new_display('block', 'RESTful API Pager', 'pager');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Indexed Node: Node ID */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = 'id';
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nid']['separator'] = '';
  $handler->display->display_options['fields']['nid']['link_to_entity'] = 0;
  $handler->display->display_options['defaults']['arguments'] = FALSE;

  /* Display: Author API */
  $handler = $view->new_display('block', 'Author API', 'author');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['groups'] = array(
    1 => 'OR',
    2 => 'AND',
  );
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid']['table'] = 'search_api_index_epe_cm_search_index';
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
    5 => 0,
  );
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1']['id'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['filters']['search_api_aggregation_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['group'] = 2;
  $handler->display->display_options['filters']['search_api_aggregation_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['operator_id'] = 'search_api_aggregation_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['label'] = 'title_main_body_fulltext_search';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['operator'] = 'search_api_aggregation_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['identifier'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );

  /* Display: Author API Pager */
  $handler = $view->new_display('block', 'Author API Pager', 'author_pager');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Indexed Node: Node ID */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = 'id';
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nid']['separator'] = '';
  $handler->display->display_options['fields']['nid']['link_to_entity'] = 0;
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['groups'] = array(
    1 => 'OR',
    2 => 'AND',
  );
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid']['table'] = 'search_api_index_epe_cm_search_index';
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
    5 => 0,
  );
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1']['id'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['table'] = 'search_api_index_epe_cm_search_index';
  $handler->display->display_options['filters']['search_api_aggregation_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['group'] = 2;
  $handler->display->display_options['filters']['search_api_aggregation_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['operator_id'] = 'search_api_aggregation_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['label'] = 'title_main_body_fulltext_search';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['operator'] = 'search_api_aggregation_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['identifier'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );

  $export['epe_cm_search_view'] = $view;

  return $export;
}
