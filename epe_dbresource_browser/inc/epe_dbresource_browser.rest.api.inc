<?php

function epe_dbresource_browser_pager_api() {
  global $user;
  $pagers = array();
  $display_name = 'pager';
  $epe_modules = variable_get('EPE_CONTENT_MODULES',array());
  foreach($epe_modules as $key=>$module) {
    if(isset($module['resource_browser'])) {
      switch ($key) {
        case 'epe_cm':
          $view_name = 'epe_cm_search_view';
        break;

        case 'epe_ev':
          $view_name = 'epe_ev_search_view';
        break;

        case 'epe_dbimage':
          $view_name = 'image_resource_index';
        break;

        case 'epe_dbdocument':
          $view_name = 'document_resource_index';
        break;

        case 'epe_dbmultimedia':
          $view_name = 'multimedia_resource_index';
        break;

        case 'epe_llb':
          $view_name = 'llb_resource_index';
        break;
      }

      $view = views_get_view($view_name);
      //set view to the display machine id
      if(isset($_GET['filter']) && $_GET['filter'] == 'author') {
        $display_name = 'author_pager';
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

      if($display_name != 'author_pager') {
        $featured_filter = array('Not-Featured'=>'Not-Featured','Featured'=>'Featured');
        if(isset($_GET['filter']) && $_GET['filter'] == 'featured') {
          unset($featured_filter['Not-Featured']);
        }
        $filter = $view->get_item($display_name, 'filter', 'field_featured_status');
        $filter['value'] = $featured_filter;
        $view->set_item($display_name, 'filter', 'field_featured_status', $filter);
      }

      $view->pre_execute();
      $view->execute();

      $pager = array(
        'api'=>$module['resource_browser']['api'],
        'total_pages'=> ceil($view->total_rows / $view->display_handler->options['items_per_page']),
        'total_rows'=>$view->total_rows
      );

      $pagers[] = $pager;
    }
  }

  echo json_encode($pagers);
}
