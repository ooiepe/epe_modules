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
    'thumbnail' => base_path() . path_to_theme() . '/images/no_thumb_small.jpg'
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
    $image = $wrapper->field_instance_thumbnail->value();
    if($image) {
      $item['thumbnail'] = image_style_url('resource_browser_thumbnail', $image['uri']);
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

  $view->execute();
  echo $view->render();
}
