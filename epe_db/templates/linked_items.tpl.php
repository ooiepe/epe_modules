


<?php


// determine if this resource is used in a concept map or lesson
$used_in_results = db_select('resources_assoc', 'ra')
             ->fields('ra', array('parent'))
             ->condition('child', $node->nid)
             ->execute();
$isUsedByOtherResources = 0;
if ($used_in_results->rowCount() > 0)
  $isUsedByOtherResources = 1;

// determine if this resource includes any other resources
$child_resources_results = db_select('resources_assoc', 'ra')
             ->fields('ra', array('child'))
             ->condition('parent', $node->nid)
             ->execute();
$hasChildResources = 0;
if ($child_resources_results->rowCount() > 0)
  $hasChildResources = 1;


// determine if items have been copied from this resource this resource is used in a concept map or lesson
$copies_of_results = db_select('field_data_field_source_nid', 'sid')
             ->fields('sid', array('entity_id'))
             ->condition('field_source_nid_value', $node->nid)
             ->execute();
$hasCopiesOf = 0;
if ($copies_of_results->rowCount() > 0)
  $hasCopiesOf = 1;

?>


<?php if ($isUsedByOtherResources == 1 || $hasChildResources == 1 || $hasCopiesOf == 1): ?>

    <div class="tabbable">
    <ul class="nav nav-tabs">
<?php if ($isUsedByOtherResources == 1): ?>
    <li class="active"><a href="#tab_used_in" data-toggle="tab">Used in:</a></li>
<?php endif; ?>
<?php if ($hasChildResources == 1): ?>
    <li><a href="#child_resources" data-toggle="tab">Resources included within this item:</a></li>
<?php endif; ?>
<?php if ($hasCopiesOf == 1): ?>
    <li><a href="#copies_of" data-toggle="tab">Copies:</a></li>
<?php endif; ?>
    </ul>
    <div class="tab-content">
<?php if ($isUsedByOtherResources == 1): ?>
    <div class="tab-pane active" id="tab_used_in">
    <p>Below is a list of resources this item is used in:</p>

    <table class="views-table cols-1 table">
    	<tr>
    		<th align="left">Resource</th>
    		<!-- <th>Type</th> -->
    	</tr>


<?php

	    foreach ($used_in_results as $result) {
	    	// load the parent item
	    	$parent_node = node_load($result->parent);

        if(isset($parent_node->title)) {
          //print('<tr><td><a href="' . base_path() . 'node/' . $result->parent . '">');
          print('<tr><td><a href="' . base_path() . 'node/' . $result->parent . '">');
          print_r($parent_node->title);
          print('</a></td></tr>');
        }
	    }


?>
    </table>
    </div>
<?php endif; ?>

<?php if ($hasChildResources == 1): ?>
    <div class="tab-pane" id="child_resources">
    <p>Below is a list of resources included within this item:</p>

    <table class="views-table cols-1 table">
      <tr>
        <th align="left">Resource</th>
        <!-- <th>Type</th> -->
      </tr>


<?php

      foreach ($child_resources_results as $result) {
        // load the parent item
        $child_node = node_load($result->child);

        if(isset($child_node->title)) {
          print('<tr><td><a href="' . base_path() . 'node/' . $result->child . '">');
          print_r($child_node->title);
          print('</a></td></tr>');
        }
      }


?>
    </table>
    </div>
<?php endif; ?>

<?php if ($hasCopiesOf == 1): ?>
    <div class="tab-pane" id="copies_of">
    <p>Below is a list of resources that have been copied from this resource:</p>

    <table class="views-table cols-1 table">
    	<tr>
    		<th align="left">Resource</th>
    		<!-- <th>Type</th> -->
    	</tr>


<?php

	    foreach ($copies_of_results as $result) {
	    	// load the parent item
	    	$copied_node = node_load($result->entity_id);

        if(isset($copied_node->title)) {
          print('<tr><td><a href="' . base_path() . 'node/' . $result->entity_id . '">');
          print_r($copied_node->title);
          print('</a></td></tr>');
        }
	    }


?>
    </table>

    </div>

<?php endif; ?>
    </div>
    </div>


<?php endif; ?>

