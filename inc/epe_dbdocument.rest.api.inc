<?php
/*
 * declare restful api menu callback
 */
function epe_dbdocument_restful_api() {
  global $user;

  $view = views_get_view('document_resource_index');
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

function epe_dbdocument_restful_api_node($nid) {
  $item = array(
    'nid' => '',
    'type' => '',
    'title' => '',
    'body' => '',
    'thumbnail' => '',
    'uri' => '',
    'file' => '',
  );

  $node = node_load($nid);
  if($node && $node->type == 'document_resource') {
    $wrapper = entity_metadata_wrapper('node',$node);
    $item['nid'] = $wrapper->getIdentifier();
    $item['type'] = $wrapper->getBundle();
    $item['title'] = $wrapper->label();
    if($wrapper->body->value()) {
      $item['body'] = $wrapper->body->value->value(array('sanitize' => TRUE));
    }

    $image = $wrapper->field_document_resource_image->value();
    if($image) {
      $item['thumbnail'] = image_style_url('thumbnail', $image['uri']);
      $item['uri'] = $image['uri'];
    }
    $file = $wrapper->field_document_resource_file->value();
    if($file) {
      $item['file'] = $file['uri'];
    }
  }

  echo json_encode($item);
}
