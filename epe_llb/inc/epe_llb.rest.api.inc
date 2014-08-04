<?php
/*
 * declare restful api menu callback
 */
function epe_llb_restful_api() {
  global $user;
  $display_name = 'all';

  $view = views_get_view('llb_resource_index');
  //set view to the display machine id
  if(isset($_GET['filter']) && $_GET['filter'] == 'author') {
    $display_name = 'author';
  }
  $view->set_display($display_name);

  //if log in user, pass in userid to exposed filter
  if(user_is_logged_in()) {
    $filter = $view->get_item($display_name, 'filter', 'author_uid');
    $filter['value'] = $user->uid;
    $view->set_item($display_name, 'filter', 'author_uid', $filter);
  }

  //if there is search term, pass it in to exposed filter
  $value = '';
  if(isset($_GET['search'])): $value = $_GET['search']; endif;
  if($value) {
    $filter = $view->get_item($display_name, 'filter', 'search_api_aggregation_1');
    $filter['value'] = $value;
    $view->set_item($display_name, 'filter', 'search_api_aggregation_1', $filter);
  }

  $featured_filter = array('Not-Featured'=>'Not-Featured','Featured'=>'Featured');
  if(isset($_GET['filter']) && $_GET['filter'] == 'featured') {
    unset($featured_filter['Not-Featured']);
  }
  $filter = $view->get_item($display_name, 'filter', 'field_featured_status');
  $filter['value'] = $featured_filter;
  $view->set_item($display_name, 'filter', 'field_featured_status', $filter);

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

function epe_llb_restful_api_node($nid) {
  $item = array(
    'nid' => '',
    'type' => '',
    'title' => '',
    'body' => '',
    'thumbnail' => base_path() . path_to_theme() . '/images/no_thumb_small.jpg',
    'uri' => '',
    'file' => ''
  );

  $node = node_load($nid);
  if($node && $node->type == 'llb_resource') {
    $wrapper = entity_metadata_wrapper('node',$node);
    $item['nid'] = $wrapper->getIdentifier();
    $item['type'] = $wrapper->getBundle();
    $item['title'] = $wrapper->label();
    if($wrapper->body->value()) {
      $item['body'] = $wrapper->body->value->value(array('sanitize' => TRUE));
    }

    $field_value = $wrapper->field_challenge_thumbnail->value();
    if($field_value) {
      $thumbnail_info = drupal_json_decode($field_value);
      $node = node_load($thumbnail_info[0]['nid']);
      $wrapper = entity_metadata_wrapper('node',$node );

      $image = $wrapper->field_image_resource_file->value();

      $item['thumbnail'] = image_style_url('resource_browser_thumbnail', $image['uri']);
      $item['uri'] = $image['uri'];

      $item['file'] = file_create_url($image['uri']);
    }
  }

  echo json_encode($item);
}
