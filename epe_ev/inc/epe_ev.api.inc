<?php
/*
 * declare restful api menu callback
 */
// function epe_ev_restful_api() {
//   global $user;

//   $view = views_get_view('ev_resource_index');
//   //set view to the display machine id
//   $view->set_display('all');

//   //if log in user, pass in userid to exposed filter
//   if(user_is_logged_in()) {
//     $filter = $view->get_item('all', 'filter', 'author_uid');
//     $filter['value'] = $user->uid;
//     $view->set_item('all', 'filter', 'author_uid', $filter);
//   }

//   //if there is search term, pass it in to exposed filter
//   $value = '';
//   if(isset($_GET['search'])): $value = $_GET['search']; endif;
//   if($value) {
//     $filter = $view->get_item('all', 'filter', 'search_api_views_fulltext');
//     $filter['value'] = $value;
//     $view->set_item('all', 'filter', 'search_api_views_fulltext', $filter);
//   }

//   $view->execute();
//   echo $view->render();
// }


// get the epe ev module path
$epe_ev_path = drupal_get_path('module', 'epe_ev');

// include some php functions for retrieving node and entity values
include($_SERVER["DOCUMENT_ROOT"] . $GLOBALS["base_path"] . $epe_ev_path . "/inc/epe_ev_lib.php");

/*
 * declare restful api menu callback
*/

function epe_ev_instance_config($instance_nid){

  // load the node based on ID, built from the url
  $node = node_load($instance_nid);

  // get the configuration from the instance node
  $ev_tool["instance_configuration"] = epe_getFieldValue( "field_instance_configuration", $node );

  // echo instance configuration
  echo $ev_tool["instance_configuration"];

}

/*
 * declare restful api menu callback
 */

function epe_ev_restful_api(){
  global $user;
  $display_name = 'all';

  $view = views_get_view('epe_ev_search_view');
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
    'table'=>'search_api_index_epe_ev_search_index',
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

function epe_ev_restful_api_node($nid) {
  print epe_ev_restful_api_node_build($nid);
  drupal_exit();
}

function epe_ev_restful_api_node_build($nid) {
  $item = array(
    'nid' => '',
    'type' => '',
    'title' => '',
    'body' => '',
    'uri' => '',
    'file' => '',
    'thumbnail' => base_path() . path_to_theme() . '/images/no_thumb_small.jpg'
  );

  $node = node_load($nid);
  if($node && $node->type == 'ev_tool_instance') {
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
      $item['uri'] = $image['uri'];
      $item['file'] = file_create_url($image['uri']);
    }
  }

  //echo json_encode($item);
  return json_encode($item);
}

// tool id -> type_ name/id
function epe_ev_api_tool_load($tool_id_type, $tool_id, $tool_configuration){
  global $user;
  $node = node_load($tool_id);

  if($node && ($node->status == NODE_PUBLISHED || ($node->status != NODE_PUBLISHED && $node->uid == $user->uid))) {
  // we will need to test for published status

  //if(user_is_logged_in()) {
		//echo "LOGGED IN!";
	//}

	if(isset($tool_configuration) && $tool_configuration != ""){
		$ev_tool["configuration"] = $tool_configuration;
	}

	switch($tool_id_type){

		case "name":

      // set the tool name from the query string
			$ev_tool["name"] = $tool_id;

			break;

		case "id":

      // load the node of the id
      $node = node_load($tool_id);

      if($node->type == "ev_tool"){
        $ev_tool["name"] = epe_getFieldValue( "field_tool_name", $node);
      }
      else{
        // get the configuration and the parent tool id
        $ev_tool["configuration"] = epe_getFieldValue( "field_instance_configuration", $node );
        $ev_tool["parent_tool_id"] = epe_getFieldValue( "field_parent_tool", $node );

        // load the parent node item to get the tool name
        $parentNode = node_load( $ev_tool["parent_tool_id"] );

        //  the tool name
        $ev_tool["name"] = epe_getFieldValue( "field_tool_name", $parentNode);
      }

			break;

		default: echo "";
	}

  echo epe_ev_html_wrapper($ev_tool);
  } //valided node published
  else {
    echo "Access Denied";
  }
}

function epe_ev_html_wrapper($ev_tool){

$EduVis_Paths = epe_EduVis_Paths();

  // [Drupal] => Array
  //     (
  //         [base_url] => http://ooi.dev/epe/epedev/deploy2
  //         [module] => sites/all/modules/custom/epe_ev
  //         [theme] => sites/all/themes/epe_theme
  //     )

  // [EduVis] => Array
  //     (
  //         [root] => sites/all/modules/custom/epe_ev
  //         [javascript] => sites/all/modules/custom/epe_ev/EduVis.js
  //         [tools] => http://ooi.dev/epe/epedev/deploy2/sites/default/files/evtools/
  //         [resources] => http://ooi.dev/epe/epedev/deploy2/sites/all/modules/custom/epe_ev/resources/
  //     )

	$htmlOut =
'<!DOCTYPE html>
<html lang="en">
<head>
	<title>EV Framework __EPE_EDUVIS_TOOLNAME__ </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="vistool"></div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="__DRUPAL_BASE_URL__/__EPE_EDUVIS_PATH_ROOT__/EduVis.js"></script>
<script>
(function(){

  // set the EduVis, tools, and resources paths

  EduVis.Environment.setPaths(
      "__EPE_EDUVIS_PATH_ROOT__", // eduvis
      "__EPE_EDUVIS_PATH_TOOLS__", // tools
      "__EPE_EDUVIS_PATH_RESOURCES__" // resources
  );

  EduVis.tool.load({
    "name" : "__EPE_EDUVIS_TOOLNAME__"__EPE_EDUVIS_CONFIGURATION__
  });

}());

</script>
<script>
  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

  ga("create", "UA-48897328-1", "oceanobservatories.org");
  ga("send", "pageview");
</script>
</body>
</html>';

  $htmlOut = str_replace("__DRUPAL_BASE_URL__", $EduVis_Paths["Drupal"]["base_url"], $htmlOut);
	$htmlOut = str_replace("__EPE_EDUVIS_TOOLNAME__",$ev_tool["name"], $htmlOut);
	$htmlOut = str_replace("__EPE_EDUVIS_PATH_ROOT__",$EduVis_Paths["EduVis"]["root"], $htmlOut);
  $htmlOut = str_replace("__EPE_EDUVIS_PATH_TOOLS__",$EduVis_Paths["EduVis"]["tools"], $htmlOut);
  $htmlOut = str_replace("__EPE_EDUVIS_PATH_RESOURCES__",$EduVis_Paths["EduVis"]["resources"], $htmlOut);

	if(isset($ev_tool["configuration"])){
		$__EPE_EDUVIS_CONFIGURATION__ = ",\n    " .'"instance_config" : ' . $ev_tool["configuration"] ."\n";
	}
  else{
    $__EPE_EDUVIS_CONFIGURATION__ = "";
  }

  $htmlOut = str_replace("__EPE_EDUVIS_CONFIGURATION__",$__EPE_EDUVIS_CONFIGURATION__, $htmlOut);

	return $htmlOut;

}
