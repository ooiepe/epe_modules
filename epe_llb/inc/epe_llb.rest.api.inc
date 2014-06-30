<?php
/*
 * declare restful api menu callback
 */
function epe_llb_restful_api() {
  global $user;

  $view = views_get_view('llb_resource_index');
  //set view to the display machine id
  $view->set_display('all');

  //if log in user, pass in userid to exposed filter
  if(user_is_logged_in()) {
    $filter = $view->get_item('all', 'filter', 'author_uid');
    $filter['value'] = $user->uid;
    $view->set_item('all', 'filter', 'author_uid', $filter);
  }

  //if there is search term, pass it in to exposed filter
  $value = '';
  if(isset($_GET['search'])): $value = $_GET['search']; endif;
  if($value) {
    $filter = $view->get_item('all', 'filter', 'search_api_views_fulltext');
    $filter['value'] = $value;
    $view->set_item('all', 'filter', 'search_api_views_fulltext', $filter);
  }

/*  $view->execute();
  echo $view->render();*/
  if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
    $page = $_GET['page'];
  } else {
    $page = 0;
  }

  $view->current_page = $page;
  $view->pre_execute();
  $view->execute();

  if(isset($_GET['get_pager']) && $_GET['get_pager'] == true) {
    $result = array();
    $result['total_pages'] = ceil($view->total_rows / $view->display_handler->options['items_per_page']);
    $result['current_page'] = $page;
    $result['total_rows'] = $view->total_rows;
    echo json_encode($result);
  } else {
    echo $view->render();
  }
}

function epe_llb_restful_api_node($nid) {
  $item = array(
    'nid' => '',
    'type' => '',
    'title' => '',
    'body' => '',
    'thumbnail' => ''
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
