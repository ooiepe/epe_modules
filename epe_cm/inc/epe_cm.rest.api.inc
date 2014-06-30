<?php
/*
 * declare restful api menu callback
 */
function epe_cm_data_restful_api($nid) {
  $item = array(
    'nid' => '',
    'type' => '',
    'title' => '',
    'body' => '',
    'thumbnail' => ''
  );

  $node = node_load($nid);

  if($node && $node->type == 'cm_resource') {
    $wrapper = entity_metadata_wrapper('node',$node);
    $item['nid'] = $wrapper->getIdentifier();
    $item['type'] = $wrapper->getBundle();
    $item['title'] = $wrapper->label();
    if($wrapper->body->value()) {
      $item['body'] = $wrapper->body->value->value(array('sanitize' => TRUE));
    }
  }

  echo json_encode($item);
}

/*
 * declare restful api menu callback
 */
function epe_cm_restful_api() {
  global $user;

  $view = views_get_view('epe_cm_search_view');
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
