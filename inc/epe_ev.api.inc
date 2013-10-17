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

  $view = views_get_view('epe_ev_search_view');
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

function epe_ev_restful_api_node($nid) {
  $item = array(
    'nid' => '',
    'type' => '',
    'title' => '',
    'body' => '',
    'thumbnail' => ''
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
  }

  echo json_encode($item);
}

// tool id -> type_ name/id
function epe_ev_api_tool_load($tool_id_type, $tool_id, $tool_configuration){

	if(user_is_logged_in()) {
		echo "LOGGED IN!";
	}

	if(isset($tool_configuration) && $tool_configuration != ""){
		$ev_tool["configuration"] = $tool_configuration;
	}

	switch($tool_id_type){

		case "name":

			$ev_tool["name"] = $tool_id;

			echo epe_ev_html_wrapper($ev_tool);

			break;

		case "id":

			// look up name field from node id

			break;

		default: echo "";
	}

}

function epe_ev_html_wrapper($ev_tool){

	// get path to EduVis
	$epe_ev_path = drupal_get_path('module', 'epe_ev');

	// set path to EduVis framework
	$EduVis_path = $GLOBALS['base_url'] . '/'. $epe_ev_path .'/EduVis/';


	$htmlOut = 
'<!DOCTYPE html>
<html lang="en">
<head>
	<title>EV Framework</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="__EPE_EDUVIS_PATH__resources/css/EduVis.css">
	<style type="text/css">

	</style>
</head>
<body>
<div id="vistool"></div>
<script src="__EPE_EDUVIS_PATH__EduVis.js"></script>
<script>
(function(){

	EduVis.Environment.setPath("__EPE_EDUVIS_PATH__");

	EduVis.tool.load({
		"name" : "__EPE_EDUVIS_TOOLNAME__",
		"tool_container_div": "vistool"__EPE_EDUVIS_CONFIGURATION__
	});

}());
	
</script>
</body>
</html>';

	$htmlOut = str_replace("__EPE_EDUVIS_TOOLNAME__",$ev_tool["name"], $htmlOut);
	$htmlOut = str_replace("__EPE_EDUVIS_PATH__",$EduVis_path, $htmlOut);

	if(isset($ev_tool["configuration"])){
		$__EPE_EDUVIS_CONFIGURATION__ = ",\n\t\t" .'"instance_config" : ' . $ev_tool["configuration"] ."\n";
		$htmlOut = str_replace("__EPE_EDUVIS_CONFIGURATION__",$__EPE_EDUVIS_CONFIGURATION__, $htmlOut);
	}


	return $htmlOut;

}
