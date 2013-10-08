<?php


function epe_cm_node_delete_function($node) {
  // Taken from node modules node_delete_confirm submit handler
  node_delete($node->nid);
  watchdog('content', '@type: deleted %title.', array('@type' => $node->type, '%title' => $node->title));
  drupal_set_message(t('@type %title has been deleted.', array('@type' => node_type_get_name($node), '%title' => $node->title)));

  // Do a drupal goto here to preserver the 'destination' parameter
  drupal_goto();
}


function epe_cm_node_submit_public_function($node) {
	// update the status to pending
	$node->field_public_status[$node->language][0]['value'] = 'Pending';
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been submitted for inclusion in the public database.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}

function epe_cm_node_unsubmit_public_function($node) {
	// update the status to pending
	$node->field_public_status[$node->language][0]['value'] = 'Private';
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been removed from the public database.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}

function epe_cm_node_approve_public_function($node) {
	// update the status to pending
	$node->field_public_status[$node->language][0]['value'] = 'Public';
	$node->status = 1;
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been added to the public database.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}
function epe_cm_node_reject_public_function($node) {
	// update the status to pending
	$node->field_public_status[$node->language][0]['value'] = 'Private';
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been rejected for inclusion in the public database.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}

function epe_cm_node_share_function($node) {
	// update the published status to pending
	$node->status = 1;
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been published and is now visible to anyone with the url.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}


function epe_cm_node_unshare_function($node) {
	// update the published status to pending
	$node->status = 0;
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been unpublished and is no longer visible by other users.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}
