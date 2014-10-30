<?php
/*
 * declare restful api menu callback
 */
function epe_dbdocument_restful_api() {
  global $user;
  $display_name = 'all';

  $view = views_get_view('document_resource_index');
  //set view to the display machine id
  if(isset($_GET['filter']) && $_GET['filter'] == 'author' && user_is_logged_in()) {
    $display_name = 'author';
  }
  $view->set_display($display_name);

  //if log in user, pass in userid to exposed filter
  if(user_is_logged_in()) {
    $filter = $view->get_item($display_name, 'filter', 'author_uid');
    $filter['value'] = $user->uid;
    $view->set_item($display_name, 'filter', 'author_uid', $filter);

    $filter = $view->get_item($display_name, 'filter', 'author_uid_1');
    $filter['value'] = $user->uid;
    $view->set_item($display_name, 'filter', 'author_uid_1', $filter);
  } else  {
    /*$filters = $view->display_handler->get_option('filters');
    unset($filters['author_uid']);*/
    $filters = $view->display_handler->get_option('filters');
    $filter_groups = $view->display_handler->get_option('filter_groups');
    unset($filter_groups['groups'][1]);
    unset($filter_groups['groups'][3]);

    foreach($filters as $key=>$filter) {
      if($filter['group'] == 1 ||$filter['group'] == 3) {
        unset($filters[$key]);
      }
    }
    $view->display_handler->override_option('filters', $filters);
    $view->display_handler->override_option('filter_groups', $filter_groups);
  }

  //if there is search term, pass it in to exposed filter
  $value = '';
  if(isset($_GET['search'])): $value = $_GET['search']; endif;
  if($value) {
    $filter = $view->get_item($display_name, 'filter', 'search_api_aggregation_1');
    if($filter) {
    $filter['value'] = $value;
    $view->set_item($display_name, 'filter', 'search_api_aggregation_1', $filter);
    }
    for($i=1;$i<=3;$i++) {
      $filter = $view->get_item($display_name, 'filter', 'search_api_aggregation_1_' . $i);
      if($filter) {
      $filter['value'] = $value;
      $view->set_item($display_name, 'filter', 'search_api_aggregation_1', $filter);
      }
    }
  }

  if($display_name != 'author') {
    $featured_filter = array('Not-Featured'=>'Not-Featured','Featured'=>'Featured');
    if(isset($_GET['filter']) && $_GET['filter'] == 'featured') {
      unset($featured_filter['Not-Featured']);
    }
    $filter = $view->get_item($display_name, 'filter', 'field_featured_status');
    if($filter) {
    $filter['value'] = $featured_filter;
    $view->set_item($display_name, 'filter', 'field_featured_status', $filter);
    }
    $filter = $view->get_item($display_name, 'filter', 'field_featured_status_1');
    if($filter) {
    $filter['value'] = $featured_filter;
    $view->set_item($display_name, 'filter', 'field_featured_status_1', $filter);
    }
  }

  $sort_filter = array(
    'table'=>'search_api_index_document_resource_index',
    'relationship'=>'none',
    'group_type'=>'group',
    'ui_name'=>''
  );

  $sort_fields = array();

  if(isset($_GET['sort']) && in_array($_GET['sort'],array('title','author','last_updated'))) {
    switch ($_GET['sort']) {
      case 'last_updated':
        $sort_fields[] = 'changed';
      break;

      case 'author':
        $sort_fields[] = 'author_field_account_lname';
        $sort_fields[] = 'author_field_account_fname';
      break;

      default:
        $sort_fields[] = $_GET['sort'];
      break;
    }
  } else {
    $sort_fields[] = 'title';
  }

  if(isset($_GET['sort_mode']) && in_array($_GET['sort_mode'], array('asc','desc'))) {
    $sort_filter['order'] = strtoupper($_GET['sort_mode']);
  } else {
    $sort_filter['order'] = 'ASC';
  }
  foreach($sort_fields as $field) {
    $sort_filter['id'] = $field;
    $sort_filter['field'] = $field;
    $view->set_item($display_name,'sort',$field,$sort_filter);
  }

  if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
    $page = $_GET['page'];
  } else {
    $page = 0;
  }

  $view->current_page = $page;
  $view->pre_execute();
  $view->execute();

  echo $view->render();
}

function epe_dbdocument_restful_api_node($nid) {
  $item = array(
    'nid' => '',
    'type' => '',
    'title' => '',
    'body' => '',
    'thumbnail' => '',
    'uri' => '',
    'file' => '',
    'credit' => '',
    'source_url' => ''
  );

  $node = node_load($nid);
  if($node && ($node->type == 'document_resource' || $node->type == 'web_resource')) {
    $wrapper = entity_metadata_wrapper('node',$node);
    $item['nid'] = $wrapper->getIdentifier();
    $item['type'] = $wrapper->getBundle();
    $item['title'] = $wrapper->label();
    if($wrapper->body->value()) {
      $item['body'] = $wrapper->body->value->value(array('sanitize' => TRUE));
    }
    if($wrapper->field_credit->value()) {
      $item['credit'] = $wrapper->field_credit->value(array('sanitize' => TRUE));
    }
    if($wrapper->field_source_url->value()) {
      $item['source_url'] = $wrapper->field_source_url->url->value(array('sanitize' => TRUE));
    }

    if($node->type == 'document_resource') {
      $image = $wrapper->field_document_resource_image->value();
      if($image) {
        $item['thumbnail'] = image_style_url('resource_browser_thumbnail', $image['uri']);
        $item['uri'] = $image['uri'];
      }
      $file = $wrapper->field_document_resource_file->value();
      if($file) {
        $item['file'] = $file['uri'];
      }
    }

    if($node->type == 'web_resource' && $wrapper->field_resource_origin->raw() == 'slideshare') {
      $item['resource_origin'] = $wrapper->field_resource_origin->raw();
      $resource_url = $wrapper->field_resource_url->raw();
      $response = drupal_http_request('http://www.slideshare.net/api/oembed/2?url=' . $resource_url['url'] .'&format=json');
      if($response->code == 200) {
        $oembed_data = json_decode($response->data);
        $item['thumbnail'] = $oembed_data->thumbnail;
        $item['html'] = $oembed_data->html;
      }
    }
  }

  echo json_encode($item);
}
