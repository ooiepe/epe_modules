<?php

function epe_dbmultimedia_restful_api() {
  global $user;
  $display_name = 'all';

  $view = views_get_view('multimedia_resource_index');
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

function epe_dbmultimedia_restful_api_node($nid) {
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
  if($node && in_array($node->type, array('audio_resource','video_resource'))) {
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

    if($item['type'] == 'audio_resource') {
      $image = $wrapper->field_audio_resource_image->value();
      if($image) {
        $item['thumbnail'] = image_style_url('resource_browser_thumbnail', $image['uri']);
        $item['uri'] = $image['uri'];
      }
      $file = $wrapper->field_audio_resource_file->value();
      if($file) {
        $item['file'] = $file['uri'];
      }
    } else {

      $field = field_get_items('node', $node, 'field_video_resource_file');
      if($field) {
        $item['thumbnail'] = image_style_url('resource_browser_thumbnail', $field[0]['thumbnailfile']->uri);
        $item['uri'] = $field[0]['thumbnailfile']->uri;
        $item['file'] = file_create_url($field[0]['uri']);
      }
    }
  }

  echo json_encode($item);
}
