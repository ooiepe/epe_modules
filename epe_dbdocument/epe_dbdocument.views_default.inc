<?php
/**
 * @file
 * document_resource_feature.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function epe_dbdocument_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'document_resource_index';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'search_api_index_document_resource_index';
  $view->human_name = 'document_resource_index';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'All Document Resources';
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
  /* Field: Indexed Node: Content type */
  $handler->display->display_options['fields']['type']['id'] = 'type';
  $handler->display->display_options['fields']['type']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['type']['field'] = 'type';
  $handler->display->display_options['fields']['type']['label'] = 'content_type';
  $handler->display->display_options['fields']['type']['link_to_entity'] = 0;
  $handler->display->display_options['fields']['type']['format_name'] = 0;
  /* Field: Indexed Node: Node ID */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'search_api_index_document_resource_index';
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
              $image = field_get_items(\'node\', $node, \'field_document_resource_image\');
              $output = \'\';
              if($image) {
              $output = field_view_value(\'node\', $node, \'field_document_resource_image\', $image[0], array(
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
  $handler->display->display_options['fields']['title']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'title';
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['link_to_entity'] = 0;
  /* Field: Indexed Node: Date changed */
  $handler->display->display_options['fields']['changed']['id'] = 'changed';
  $handler->display->display_options['fields']['changed']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['changed']['field'] = 'changed';
  $handler->display->display_options['fields']['changed']['label'] = 'last_updated';
  $handler->display->display_options['fields']['changed']['date_format'] = 'custom';
  $handler->display->display_options['fields']['changed']['custom_date_format'] = 'M j, Y';
  $handler->display->display_options['fields']['changed']['link_to_entity'] = 0;
  /* Field: Author: First Name (indexed) */
  $handler->display->display_options['fields']['author_field_account_fname']['id'] = 'author_field_account_fname';
  $handler->display->display_options['fields']['author_field_account_fname']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['author_field_account_fname']['field'] = 'author_field_account_fname';
  $handler->display->display_options['fields']['author_field_account_fname']['exclude'] = TRUE;
  /* Field: Author: Last Name (indexed) */
  $handler->display->display_options['fields']['author_field_account_lname']['id'] = 'author_field_account_lname';
  $handler->display->display_options['fields']['author_field_account_lname']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['author_field_account_lname']['field'] = 'author_field_account_lname';
  $handler->display->display_options['fields']['author_field_account_lname']['label'] = '';
  $handler->display->display_options['fields']['author_field_account_lname']['exclude'] = TRUE;
  $handler->display->display_options['fields']['author_field_account_lname']['element_label_colon'] = FALSE;
  /* Field: Author: User ID (indexed) */
  $handler->display->display_options['fields']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['fields']['author_uid']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['author_uid']['field'] = 'author_uid';
  $handler->display->display_options['fields']['author_uid']['label'] = 'userid';
  $handler->display->display_options['fields']['author_uid']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['author_uid']['separator'] = '';
  $handler->display->display_options['fields']['author_uid']['link_to_entity'] = 0;
  /* Field: Indexed Node: Status */
  $handler->display->display_options['fields']['status']['id'] = 'status';
  $handler->display->display_options['fields']['status']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['status']['field'] = 'status';
  $handler->display->display_options['fields']['status']['label'] = 'status';
  $handler->display->display_options['fields']['status']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['status']['link_to_entity'] = 0;
  $handler->display->display_options['fields']['status']['format_name'] = 1;
  /* Field: Indexed Node: URL */
  $handler->display->display_options['fields']['url']['id'] = 'url';
  $handler->display->display_options['fields']['url']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['url']['field'] = 'url';
  $handler->display->display_options['fields']['url']['label'] = 'url';
  $handler->display->display_options['fields']['url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['url']['display_as_link'] = FALSE;
  $handler->display->display_options['fields']['url']['link_to_entity'] = 0;
  /* Field: Indexed Node: The main body text */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = 'summary';
  $handler->display->display_options['fields']['body']['type'] = 'text_summary_or_trimmed';
  $handler->display->display_options['fields']['body']['settings'] = array(
    'trim_length' => '200',
  );
  /* Field: Author: Institution / School (indexed) */
  $handler->display->display_options['fields']['author_field_account_organization']['id'] = 'author_field_account_organization';
  $handler->display->display_options['fields']['author_field_account_organization']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['author_field_account_organization']['field'] = 'author_field_account_organization';
  $handler->display->display_options['fields']['author_field_account_organization']['label'] = 'org';
  /* Field: Indexed Node: Featured Status */
  $handler->display->display_options['fields']['field_featured_status']['id'] = 'field_featured_status';
  $handler->display->display_options['fields']['field_featured_status']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['field_featured_status']['field'] = 'field_featured_status';
  $handler->display->display_options['fields']['field_featured_status']['label'] = 'featured';
  /* Field: Indexed Node: Public Status */
  $handler->display->display_options['fields']['field_public_status']['id'] = 'field_public_status';
  $handler->display->display_options['fields']['field_public_status']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['field_public_status']['field'] = 'field_public_status';
  $handler->display->display_options['fields']['field_public_status']['label'] = 'public';
  /* Field: Author: Name (indexed) */
  $handler->display->display_options['fields']['author_name']['id'] = 'author_name';
  $handler->display->display_options['fields']['author_name']['table'] = 'search_api_index_document_resource_index';
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
  /* Field: Indexed Node: Credit */
  $handler->display->display_options['fields']['field_credit']['id'] = 'field_credit';
  $handler->display->display_options['fields']['field_credit']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['field_credit']['field'] = 'field_credit';
  $handler->display->display_options['fields']['field_credit']['label'] = 'credit';
  /* Field: Indexed Node: Source URL */
  $handler->display->display_options['fields']['field_source_url']['id'] = 'field_source_url';
  $handler->display->display_options['fields']['field_source_url']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['field_source_url']['field'] = 'field_source_url';
  $handler->display->display_options['fields']['field_source_url']['label'] = 'source_url';
  $handler->display->display_options['fields']['field_source_url']['click_sort_column'] = 'url';
  $handler->display->display_options['fields']['field_source_url']['type'] = 'link_plain';
  /* Field: Indexed Node: Resource URL */
  $handler->display->display_options['fields']['field_resource_url']['id'] = 'field_resource_url';
  $handler->display->display_options['fields']['field_resource_url']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['field_resource_url']['field'] = 'field_resource_url';
  $handler->display->display_options['fields']['field_resource_url']['label'] = 'resource_url';
  $handler->display->display_options['fields']['field_resource_url']['click_sort_column'] = 'url';
  $handler->display->display_options['fields']['field_resource_url']['type'] = 'link_plain';
  /* Field: Indexed Node: Resource Origin */
  $handler->display->display_options['fields']['field_resource_origin']['id'] = 'field_resource_origin';
  $handler->display->display_options['fields']['field_resource_origin']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['field_resource_origin']['field'] = 'field_resource_origin';
  $handler->display->display_options['fields']['field_resource_origin']['label'] = 'resource_origin';
  $handler->display->display_options['fields']['field_resource_origin']['type'] = 'list_key';
  /* Field: Global: PHP */
  $handler->display->display_options['fields']['php_2']['id'] = 'php_2';
  $handler->display->display_options['fields']['php_2']['table'] = 'views';
  $handler->display->display_options['fields']['php_2']['field'] = 'php';
  $handler->display->display_options['fields']['php_2']['label'] = 'oembed_thumbnail';
  $handler->display->display_options['fields']['php_2']['use_php_setup'] = 0;
  $handler->display->display_options['fields']['php_2']['php_output'] = '<?php
  $output = \'\';
  if($data->_entity_properties[\'type\']==\'web_resource\') {
    $wrapper = entity_metadata_wrapper(\'node\', node_load($data->entity));
    $resource_url = $wrapper->field_resource_url->raw();
    switch($wrapper->field_resource_origin->raw()) {
      case \'slideshare\':
        $response = drupal_http_request(\'http://www.slideshare.net/api/oembed/2?url=\' . $resource_url[\'url\'] .\'&format=json\');
        if($response->code == 200) {
          $oembed_data = json_decode($response->data);
          $output = $oembed_data->thumbnail;
        }
      break;
    }
  }
  echo $output;
  ?>';
  $handler->display->display_options['fields']['php_2']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php_2']['php_click_sortable'] = '';
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['filter_groups']['groups'] = array(
    1 => 'AND',
    2 => 'AND',
    3 => 'AND',
    4 => 'AND',
  );
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid']['table'] = 'search_api_index_document_resource_index';
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
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1']['id'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['search_api_aggregation_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['group'] = 1;
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
  /* Filter criterion: Indexed Node: Content type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'document_resource' => 'document_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
    /* Filter criterion: Indexed Node: Public Status */
    $handler->display->display_options['filters']['field_public_status']['id'] = 'field_public_status';
    $handler->display->display_options['filters']['field_public_status']['table'] = 'search_api_index_document_resource_index';
    $handler->display->display_options['filters']['field_public_status']['field'] = 'field_public_status';
    $handler->display->display_options['filters']['field_public_status']['value'] = array(
      'Public' => 'Public',
    );
  $handler->display->display_options['filters']['field_public_status']['group'] = 2;
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['id'] = 'search_api_aggregation_1_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['group'] = 2;
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['operator_id'] = 'search_api_aggregation_1_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['label'] = 'title_main_body_fulltext_search';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['operator'] = 'search_api_aggregation_1_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['identifier'] = 'search_api_aggregation_1_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: Featured Status */
  $handler->display->display_options['filters']['field_featured_status']['id'] = 'field_featured_status';
  $handler->display->display_options['filters']['field_featured_status']['table'] = 'search_api_index_document_resource_index';
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
  /* Filter criterion: Indexed Node: Content type */
  $handler->display->display_options['filters']['type_2']['id'] = 'type_2';
  $handler->display->display_options['filters']['type_2']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['type_2']['field'] = 'type';
  $handler->display->display_options['filters']['type_2']['value'] = array(
    'document_resource' => 'document_resource',
  );
  $handler->display->display_options['filters']['type_2']['group'] = 2;
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid_1']['id'] = 'author_uid_1';
  $handler->display->display_options['filters']['author_uid_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['author_uid_1']['field'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid_1']['group'] = 3;
  $handler->display->display_options['filters']['author_uid_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['author_uid_1']['expose']['operator_id'] = 'author_uid_1_op';
  $handler->display->display_options['filters']['author_uid_1']['expose']['label'] = 'User ID (indexed)';
  $handler->display->display_options['filters']['author_uid_1']['expose']['operator'] = 'author_uid_1_op';
  $handler->display->display_options['filters']['author_uid_1']['expose']['identifier'] = 'author_uid_1';
  $handler->display->display_options['filters']['author_uid_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['id'] = 'search_api_aggregation_1_2';
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['group'] = 3;
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['expose']['operator_id'] = 'search_api_aggregation_1_2_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['expose']['label'] = 'title_main_body_fulltext_search';
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['expose']['operator'] = 'search_api_aggregation_1_2_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['expose']['identifier'] = 'search_api_aggregation_1_2';
  $handler->display->display_options['filters']['search_api_aggregation_1_2']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: Content type */
  $handler->display->display_options['filters']['type_1']['id'] = 'type_1';
  $handler->display->display_options['filters']['type_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['type_1']['field'] = 'type';
  $handler->display->display_options['filters']['type_1']['value'] = array(
    'web_resource' => 'web_resource',
  );
  $handler->display->display_options['filters']['type_1']['group'] = 3;
  /* Filter criterion: Indexed Node: Resource Origin */
  $handler->display->display_options['filters']['field_resource_origin']['id'] = 'field_resource_origin';
  $handler->display->display_options['filters']['field_resource_origin']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['field_resource_origin']['field'] = 'field_resource_origin';
  $handler->display->display_options['filters']['field_resource_origin']['value'] = array(
    'slideshare' => 'slideshare',
  );
  $handler->display->display_options['filters']['field_resource_origin']['group'] = 3;
  /* Filter criterion: Indexed Node: Public Status */
  $handler->display->display_options['filters']['field_public_status_1']['id'] = 'field_public_status_1';
  $handler->display->display_options['filters']['field_public_status_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['field_public_status_1']['field'] = 'field_public_status';
  $handler->display->display_options['filters']['field_public_status_1']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_1']['group'] = 4;
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['id'] = 'search_api_aggregation_1_3';
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['group'] = 4;
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['expose']['operator_id'] = 'search_api_aggregation_1_3_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['expose']['label'] = 'title_main_body_fulltext_search';
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['expose']['operator'] = 'search_api_aggregation_1_3_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['expose']['identifier'] = 'search_api_aggregation_1_3';
  $handler->display->display_options['filters']['search_api_aggregation_1_3']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: Featured Status */
  $handler->display->display_options['filters']['field_featured_status_1']['id'] = 'field_featured_status_1';
  $handler->display->display_options['filters']['field_featured_status_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['field_featured_status_1']['field'] = 'field_featured_status';
  $handler->display->display_options['filters']['field_featured_status_1']['value'] = array(
    'Not-Featured' => 'Not-Featured',
    'Featured' => 'Featured',
  );
  $handler->display->display_options['filters']['field_featured_status_1']['group'] = 4;
  /* Filter criterion: Indexed Node: Content type */
  $handler->display->display_options['filters']['type_3']['id'] = 'type_3';
  $handler->display->display_options['filters']['type_3']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['type_3']['field'] = 'type';
  $handler->display->display_options['filters']['type_3']['value'] = array(
    'web_resource' => 'web_resource',
  );
  $handler->display->display_options['filters']['type_3']['group'] = 4;
  /* Filter criterion: Indexed Node: Resource Origin */
  $handler->display->display_options['filters']['field_resource_origin_1']['id'] = 'field_resource_origin_1';
  $handler->display->display_options['filters']['field_resource_origin_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['field_resource_origin_1']['field'] = 'field_resource_origin';
  $handler->display->display_options['filters']['field_resource_origin_1']['value'] = array(
    'slideshare' => 'slideshare',
  );
  $handler->display->display_options['filters']['field_resource_origin_1']['group'] = 4;

  /* Display: Rest API Block */
  $handler = $view->new_display('block', 'Rest API Block', 'all');

  /* Display: Rest API Pager */
  $handler = $view->new_display('block', 'Rest API Pager', 'pager');
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Indexed Node: Node ID */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = 'id';
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nid']['separator'] = '';
  $handler->display->display_options['fields']['nid']['link_to_entity'] = 0;

  /* Display: Author API */
  $handler = $view->new_display('block', 'Author API', 'author');
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['filter_groups']['groups'] = array(
    1 => 'AND',
    2 => 'AND',
  );
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid']['table'] = 'search_api_index_document_resource_index';
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
  /* Filter criterion: Indexed Node: Content type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'document_resource' => 'document_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1']['id'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['search_api_aggregation_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['group'] = 1;
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
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid_1']['id'] = 'author_uid_1';
  $handler->display->display_options['filters']['author_uid_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['author_uid_1']['field'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid_1']['group'] = 2;
  $handler->display->display_options['filters']['author_uid_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['author_uid_1']['expose']['operator_id'] = 'author_uid_1_op';
  $handler->display->display_options['filters']['author_uid_1']['expose']['label'] = 'User ID (indexed)';
  $handler->display->display_options['filters']['author_uid_1']['expose']['operator'] = 'author_uid_1_op';
  $handler->display->display_options['filters']['author_uid_1']['expose']['identifier'] = 'author_uid_1';
  $handler->display->display_options['filters']['author_uid_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['id'] = 'search_api_aggregation_1_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['group'] = 2;
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['operator_id'] = 'search_api_aggregation_1_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['label'] = 'title_main_body_fulltext_search';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['operator'] = 'search_api_aggregation_1_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['identifier'] = 'search_api_aggregation_1_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: Resource Origin */
  $handler->display->display_options['filters']['field_resource_origin']['id'] = 'field_resource_origin';
  $handler->display->display_options['filters']['field_resource_origin']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['field_resource_origin']['field'] = 'field_resource_origin';
  $handler->display->display_options['filters']['field_resource_origin']['value'] = array(
    'slideshare' => 'slideshare',
  );
  $handler->display->display_options['filters']['field_resource_origin']['group'] = 2;
  /* Filter criterion: Indexed Node: Content type */
  $handler->display->display_options['filters']['type_1']['id'] = 'type_1';
  $handler->display->display_options['filters']['type_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['type_1']['field'] = 'type';
  $handler->display->display_options['filters']['type_1']['value'] = array(
    'web_resource' => 'web_resource',
  );
  $handler->display->display_options['filters']['type_1']['group'] = 2;

  /* Display: Author API Pager */
  $handler = $view->new_display('block', 'Author API Pager', 'author_pager');
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Indexed Node: Node ID */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = 'id';
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['nid']['separator'] = '';
  $handler->display->display_options['fields']['nid']['link_to_entity'] = 0;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['filter_groups']['groups'] = array(
    1 => 'AND',
    2 => 'AND',
  );
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid']['id'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid']['table'] = 'search_api_index_document_resource_index';
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
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1']['id'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['search_api_aggregation_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1']['group'] = 1;
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
  /* Filter criterion: Indexed Node: Content type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'document_resource' => 'document_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Author: User ID (indexed) */
  $handler->display->display_options['filters']['author_uid_1']['id'] = 'author_uid_1';
  $handler->display->display_options['filters']['author_uid_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['author_uid_1']['field'] = 'author_uid';
  $handler->display->display_options['filters']['author_uid_1']['group'] = 2;
  $handler->display->display_options['filters']['author_uid_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['author_uid_1']['expose']['operator_id'] = 'author_uid_1_op';
  $handler->display->display_options['filters']['author_uid_1']['expose']['label'] = 'User ID (indexed)';
  $handler->display->display_options['filters']['author_uid_1']['expose']['operator'] = 'author_uid_1_op';
  $handler->display->display_options['filters']['author_uid_1']['expose']['identifier'] = 'author_uid_1';
  $handler->display->display_options['filters']['author_uid_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: title_main_body_fulltext_search */
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['id'] = 'search_api_aggregation_1_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['field'] = 'search_api_aggregation_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['group'] = 2;
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['operator_id'] = 'search_api_aggregation_1_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['label'] = 'title_main_body_fulltext_search';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['operator'] = 'search_api_aggregation_1_1_op';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['identifier'] = 'search_api_aggregation_1_1';
  $handler->display->display_options['filters']['search_api_aggregation_1_1']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  /* Filter criterion: Indexed Node: Content type */
  $handler->display->display_options['filters']['type_1']['id'] = 'type_1';
  $handler->display->display_options['filters']['type_1']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['type_1']['field'] = 'type';
  $handler->display->display_options['filters']['type_1']['value'] = array(
    'web_resource' => 'web_resource',
  );
  $handler->display->display_options['filters']['type_1']['group'] = 2;
  /* Filter criterion: Indexed Node: Resource Origin */
  $handler->display->display_options['filters']['field_resource_origin']['id'] = 'field_resource_origin';
  $handler->display->display_options['filters']['field_resource_origin']['table'] = 'search_api_index_document_resource_index';
  $handler->display->display_options['filters']['field_resource_origin']['field'] = 'field_resource_origin';
  $handler->display->display_options['filters']['field_resource_origin']['value'] = array(
    'slideshare' => 'slideshare',
  );
  $handler->display->display_options['filters']['field_resource_origin']['group'] = 2;

  $export['document_resource_index'] = $view;

  return $export;
}
