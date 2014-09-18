<?php
/*
 * declare restful api menu callback
 */
function epe_dbvideo_restful_api() {
  global $user;
  $display_name = 'all';

  $view = views_get_view('video_resource_index');
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
  } else  {
    $filters = $view->display_handler->get_option('filters');
    unset($filters['author_uid']);
    $view->display_handler->override_option('filters', $filters);
  }

  //if there is search term, pass it in to exposed filter
  $value = '';
  if(isset($_GET['search'])): $value = $_GET['search']; endif;
  if($value) {
    $filter = $view->get_item($display_name, 'filter', 'search_api_views_fulltext');
    $filter['value'] = $value;
    $view->set_item($display_name, 'filter', 'search_api_views_fulltext', $filter);
  }

  if($display_name != 'author') {
    $featured_filter = array('Not-Featured'=>'Not-Featured','Featured'=>'Featured');
    if(isset($_GET['filter']) && $_GET['filter'] == 'featured') {
      unset($featured_filter['Not-Featured']);
    }
    $filter = $view->get_item($display_name, 'filter', 'field_featured_status');
    $filter['value'] = $featured_filter;
    $view->set_item($display_name, 'filter', 'field_featured_status', $filter);
  }

  $view->execute();
  echo $view->render();
}
