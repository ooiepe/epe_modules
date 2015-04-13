<?php
/*
 * declare restful api menu callback
 */
function epe_llb_restful_api() {
  global $user;
  $display_name = 'all';

  $view = views_get_view('llb_resource_index');
  //set view to the display machine id
  if(isset($_GET['filter']) && $_GET['filter'] == 'author' && user_is_logged_in()) {
    $display_name = 'author';
  }
  $view->set_display($display_name);

  //if there is search term, pass it in to exposed filter
  $value = '';
  if(isset($_GET['search'])): $value = $_GET['search']; endif;
  if($value) {
    $filter = $view->get_item($display_name, 'filter', 'search_api_aggregation_1');
    $filter['value'] = $value;
    $view->set_item($display_name, 'filter', 'search_api_aggregation_1', $filter);
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

  $sort_filter = array(
    'table'=>'search_api_index_llb_resource_index',
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

function epe_llb_restful_api_node($nid) {
  print epe_llb_restful_api_node_build($nid);
  drupal_exit();
}

function epe_llb_restful_api_node_build($nid) {
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

  //echo json_encode($item);
  return json_encode($item);
}

function epe_llb_restful_api_node_clone($nid) {
  global $user;

  $node = node_load($nid);
  if($node && in_array($node->type,array('llb_resource','cm_resource','ev_tool_instance'))) {
    unset($node->nid);
    unset($node->vid);

    //reset all status field value && author value
    $node->field_featured_status = array();
    $node->field_public_status = array();
    $node->field_source_nid['und'][0]['value'] = $nid;
    $node->status = 0;
    $node->uid = $user->uid;
    $node->revision_uid = $user->uid;
    unset($node->last_comment_timestamp);
    unset($node->last_comment_name);
    unset($node->last_comment_uid);
    unset($node->comment_count);
    $node->name = $user->name;

    $node->created = REQUEST_TIME;
    $node->changed = REQUEST_TIME;
    $node->revision_timestamp = REQUEST_TIME;

    $account = user_load($user->uid);
    $fname = field_get_items('user', $account, 'field_account_fname');
    $lname = field_get_items('user', $account, 'field_account_lname');
    $fname = field_view_value('user', $account, 'field_account_fname', $fname[0]);
    $lname = field_view_value('user', $account, 'field_account_lname', $lname[0]);
    $fullname = trim($fname['#markup'] . ' ' . $lname['#markup']);
    if(!$fullname) { $fullname = $user->name; }
    $node->title = "Copy of " . $node->title . " by " . $fullname;
    node_save($node);
    switch($node->type) {
      case "llb_resource":
        return epe_llb_restful_api_node($node->nid);
      break;
      case "cm_resource":
        module_load_include('inc','epe_cm','inc/epe_cm.rest.api');
        return epe_cm_data_restful_api($node->nid);
      break;
      case "ev_tool_instance":
        module_load_include('inc','epe_ev','inc/epe_ev.api');
        return epe_ev_restful_api_node($node->nid);
      break;
    }
  } else {
    echo json_encode(array('message'=>'Invalid request'));
  }
}
