<?php


function epe_db_node_delete_function($node) {
  
  // Taken from node modules node_delete_confirm submit handler
  node_delete($node->nid);
  watchdog('content', '@type: deleted %title.', array('@type' => $node->type, '%title' => $node->title));
  drupal_set_message(t('@type %title has been deleted.', array('@type' => node_type_get_name($node), '%title' => $node->title)));

  // Do a drupal goto here to preserver the 'destination' parameter
	if ($node->type == "audio_resource" || $node->type == "video_resource")
		drupal_goto( 'resource-browser', array( 'fragment' =>  'search/?filter=author&type=multimedia', 'alias' => TRUE ) );
	elseif ($node->type == "image_resource")
		drupal_goto( 'resource-browser', array( 'fragment' =>  'search/?filter=author&type=image', 'alias' => TRUE ) );
	elseif ($node->type == "document_resource")
		drupal_goto( 'resource-browser', array( 'fragment' =>  'search/?filter=author&type=document', 'alias' => TRUE ) );
	elseif ($node->type == "llb_resource")
		drupal_goto( 'resource-browser', array( 'fragment' =>  'search/?filter=author&type=llb', 'alias' => TRUE ) );
	elseif ($node->type == "cm_resource")
		drupal_goto( 'resource-browser', array( 'fragment' =>  'search/?filter=author&type=cm', 'alias' => TRUE ) );
	elseif ($node->type == "ev_tool_instance")
		drupal_goto( 'resource-browser', array( 'fragment' =>  'search/?filter=author&type=ev', 'alias' => TRUE ) );
	else
		drupal_goto();
	
}


function epe_db_node_submit_public_function($node) {
	// update the status to pending
	$node->field_public_status[$node->language][0]['value'] = 'Pending';
	// automatically set this to "drupal published" or "epe shared"
	$node->status = 1;
	// save the node
	node_save($node);

	// auto share the children
	if ($node->type == 'cm_resource' || $node->type == 'llb_resource') {
		$results = db_select('resources_assoc', 'ra')
    	           ->fields('ra', array('child'))
        	       ->condition('parent', $node->nid)
            	   ->execute();
	    foreach ($results as $result) {
	    	// load the children and share if same author
	    	$child_node = node_load($result->child);
	    	if ($node->uid == $child_node->uid) {
				$child_node->status = 1;
				node_save($child_node);
	    	}
	    }
	}

	// set the message
	drupal_set_message(t('@type %title has been submitted for inclusion in the public database.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}

function epe_db_node_unsubmit_public_function($node) {
	// update the status to pending
	$node->field_public_status[$node->language][0]['value'] = 'Private';
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been removed from the public database.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}

function epe_db_node_approve_public_function($node) {
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
function epe_db_node_reject_public_function($node) {
	// update the status to pending
	$node->field_public_status[$node->language][0]['value'] = 'Private';
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been rejected for inclusion in the public database.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}

function epe_db_node_share_function($node) {
	// update the published status to pending
	$node->status = 1;
	// resetting the public status to private if they chose to share again
	$node->field_public_status[$node->language][0]['value'] = 'Private';
	// save the node
	node_save($node);

	// auto share the children
	if ($node->type == 'cm_resource' || $node->type == 'llb_resource') {
		$results = db_select('resources_assoc', 'ra')
    	           ->fields('ra', array('child'))
        	       ->condition('parent', $node->nid)
            	   ->execute();
	    foreach ($results as $result) {
	    	// load the children and share if same author
	    	$child_node = node_load($result->child);
	    	if ($node->uid == $child_node->uid) {
				$child_node->status = 1;
				node_save($child_node);
	    	}
	    }
	}

	// set the message
	drupal_set_message(t('@type %title has been published and is now visible to anyone with the url.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}


function epe_db_node_unshare_function($node) {
	// update the published status to pending
	$node->status = 0;
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been unpublished and is no longer visible by other users.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}


function epe_db_node_feature_function($node) {
	// update the status to pending
	$node->field_featured_status[$node->language][0]['value'] = 'Featured';
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been flagged as featured.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}

function epe_db_node_unfeature_function($node) {
	// update the status to pending
	$node->field_featured_status[$node->language][0]['value'] = 'Not-Featured';
	// save the node
	node_save($node);
	// set the message
	drupal_set_message(t('@type %title has been unfeatured.', array('@type' => node_type_get_name($node), '%title' => $node->title)));
	// return to the view page
  	drupal_goto($path = "node/" . $node -> nid);
}