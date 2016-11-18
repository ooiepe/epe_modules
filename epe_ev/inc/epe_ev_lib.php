<?php

//epe ev shared functions
//echo "<!-- included epe_ev_lib.php -->";

// edit form no render. leaves brackets, etc. does not character escape
function epe_getFieldValue($str_field_name, $node){

  $field_items = field_get_items('node', $node, $str_field_name);

  //$field = field_view_value('node', $node, $str_field_name, $field_items[0]);

  //return render($field);
  return $field_items[0]["value"];

}


function epe_getFieldValue_render($str_field_name, $node){

  $field_items = field_get_items('node', $node, $str_field_name);
  $field = field_view_value('node', $node, $str_field_name, $field_items[0]);

  return render($field);

}

function epe_getNodeValues( $node_field_item_list, $node){

 	$node_field_values = array();

	foreach($node_field_item_list as $node_field_item){

 		$field_items = field_get_items('node', $node, $node_field_item);

		$field = field_view_value('node', $node, $node_field_item, $field_items[0]);

 		$node_field_values[$node_field_item] = $field_items[0]["value"];
	}

 	return $node_field_values;

}

// function to return an array of field values from the parent of an entity relationship of the node
// function epe_getParentFieldValues( $str_parent_field_name, $ary_field_item_list, $node ){

//   $ary_parent_field_vals = array();

//   foreach( $ary_field_item_list as $field_item ){

//     $field_items_parent = field_get_items( 'node', $node, $str_parent_field_name );
//     $parent_items_name = field_get_items( 'node', $field_items_parent[0]["entity"], $field_item );

//     $ary_parent_field_vals[$field_item] = $parent_items_name[0]["value"];
//   }

//   return $ary_parent_field_vals;

// }

function epe_EduVis_Paths(){

  $module_path = drupal_get_path('module', 'epe_ev');

  $EduVis_Drupal_Paths["Drupal"]["base_url"] = $GLOBALS['base_url'];
  $EduVis_Drupal_Paths["Drupal"]["module"] = $module_path;
  $EduVis_Drupal_Paths["Drupal"]["theme"] = drupal_get_path('theme', 'epe_theme');
  $EduVis_Drupal_Paths["EduVis"]["root"] = $module_path;// $EduVis_root;
  $EduVis_Drupal_Paths["EduVis"]["javascript"] = $module_path . '/EduVis.js';

  // removed relative tools path to files upload folder
  //$EduVis_Drupal_Paths["EduVis"]["tools"] = $GLOBALS['base_url'] . '/' . $module_path . '/tools/';

  $EduVis_Drupal_Paths["EduVis"]["tools"] = $GLOBALS['base_url'] . "/" . variable_get('file_public_path', conf_path()) . '/evtools/';

  $EduVis_Drupal_Paths["EduVis"]["resources"] = $GLOBALS['base_url'] . '/' .$module_path . '/resources/';

  return $EduVis_Drupal_Paths;
}

$tool_list_path = "ev/tools";
