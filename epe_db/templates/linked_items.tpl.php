<?php
global $user;

drupal_add_js(drupal_get_path('module','epe_db') . '/js/resource_assoc.toggle.js');

// determine if this resource is used in a concept map or lesson
$used_in_results = db_select('resources_assoc', 'ra')
             ->fields('ra', array('parent'))
             ->condition('child', $node->nid)
             ->execute();
$isUsedByOtherResources = 0;
if ($used_in_results->rowCount() > 0) { $isUsedByOtherResources = 1; }

$used_in_public_qry = db_select('field_data_field_public_status','ps');
$used_in_public_qry->fields('ps',array('entity_id'));
$used_in_public_qry->join('resources_assoc','ra','ps.entity_id = ra.parent');
$used_in_public_qry->condition('child', $node->nid);
$used_in_public_qry->condition('field_public_status_value','public');
$used_in_public_qry_result = $used_in_public_qry->execute();

// determine if this resource includes any other resources
$child_resources_results = db_select('resources_assoc', 'ra')
             ->fields('ra', array('child'))
             ->condition('parent', $node->nid)
             ->execute();
$hasChildResources = 0;
if ($child_resources_results->rowCount() > 0) { $hasChildResources = 1; }

$child_resources_public_qry = db_select('field_data_field_public_status','ps');
$child_resources_public_qry->fields('ps',array('entity_id'));
$child_resources_public_qry->join('resources_assoc','ra','ra.child = ps.entity_id');
$child_resources_public_qry->condition('parent', $node->nid);
$child_resources_public_qry->condition('field_public_status_value','public');
$child_resources_public_qry_result = $child_resources_public_qry->execute();

// determine if items have been copied from this resource this resource is used in a concept map or lesson
$copies_of_results = db_select('field_data_field_source_nid', 'sid')
             ->fields('sid', array('entity_id'))
             ->condition('field_source_nid_value', $node->nid)
             ->execute();
$hasCopiesOf = 0;
if ($copies_of_results->rowCount() > 0) { $hasCopiesOf = 1; }

$copies_of_public_qry = db_select('field_data_field_public_status','ps');
$copies_of_public_qry->fields('ps',array('entity_id'));
$copies_of_public_qry->join('field_data_field_source_nid','sid','sid.entity_id = ps.entity_id');
$copies_of_public_qry->condition('sid.entity_id', $node->nid);
$copies_of_public_qry->condition('field_public_status_value','public');
$copies_of_public_qry_result = $copies_of_public_qry->execute();

$isCopyFrom = false;
$is_copy_from_qry = db_select('field_data_field_source_nid','snid');
$is_copy_from_qry->fields('snid',array('field_source_nid_value'));
$is_copy_from_qry->condition('snid.entity_id', $node->nid);
$is_copy_from_qry_result = $is_copy_from_qry->execute();

if($is_copy_from_qry_result->rowCount() > 0) $isCopyFrom = true;
if($isCopyFrom) {
  $resource_usage_view_copy_from = views_get_view('resource_usage');
  $resource_usage_view_copy_from->set_display('copy_parent');
  $filters = $resource_usage_view_copy_from->display_handler->get_option('filters');
  foreach($is_copy_from_qry_result as $result) {
    $filters['nid']['value']['value'] = $result->field_source_nid_value;
  }  
  $resource_usage_view_copy_from->display_handler->override_option('filters', $filters);
  $resource_usage_view_copy_from->execute();
}
?>

<div class="resource_assoc">
<label class="header">Usage Information</label>
<div class="section stats clearfix">
  <div class="assoc_type clearfix" onclick="resource_assoc_toggle('stats');"><div class="arrow"></div><span>Statistics</span></div>
</div>
<div class="list stats row hide clearfix">
  <?php echo views_embed_view('resource_view_stats', 'block'); ?>
</div>
<?php if ($isUsedByOtherResources == 1 || $hasChildResources == 1 || $hasCopiesOf == 1 || $isCopyFrom == true): ?>
<?php if($isCopyFrom == true): ?>
<div class="section is_copy_from clearfix">
  <div class="assoc_type clearfix" onclick="resource_assoc_toggle('is_copy_from');"><div class="arrow"></div><span>Is Copy From</span></div>
</div>
<div class="list is_copy_from row hide clearfix">
<?php echo $resource_usage_view_copy_from->render(); ?>
</div>
<?php endif; ?>

<?php if($used_in_results->rowCount() > 0): ?>
  <div class="section used_in clearfix">
    <div class="assoc_type clearfix" onclick="resource_assoc_toggle('used_in');"><div class="arrow"></div><span>Used In</span></div>
    <div class="count_label">
      <?php echo $used_in_public_qry_result->rowCount(); ?> public items (<?php echo $used_in_results->rowCount(); ?> items)
    </div>
  </div>
  <div class="list used_in row hide clearfix" data-count="<?php echo $used_in_results->rowCount(); ?>">

  <?php
//only show this section if author is the same as logged in user
  if($user->uid == $node->uid) {
    $resource_usage_view_author_not_public = views_get_view('resource_usage');
    $resource_usage_view_author_not_public->set_display('by_author_not_public');

    $filters = $resource_usage_view_author_not_public->display_handler->get_option('filters');  
    $filters['uid']['value'][] = $node->uid;
    foreach($used_in_results as $index=>$result) {
      if($index == 0) {
        $filters['nid']['value']['value'] = $result->parent;
      } else {
        $filter_nid = $filters['nid'];

        $filter_nid['value']['value'] = $result->parent;
        $filter_nid['id'] = 'nid_' . ($index + 1);
        $filters[$filter_nid['id']] = $filter_nid;
      }
    }
    
    $resource_usage_view_author_not_public->display_handler->override_option('filters', $filters);

    $resource_usage_view_author_not_public->execute();
  }
  

  $resource_usage_view_all_public = views_get_view('resource_usage');
  $resource_usage_view_all_public->set_display('all_public');

  $filters = $resource_usage_view_all_public->display_handler->get_option('filters');
  foreach($used_in_results as $index=>$result) {
    if($index == 0) {
      $filters['nid']['value']['value'] = $result->parent;
    } else {
      $filter_nid = $filters['nid'];

      $filter_nid['value']['value'] = $result->parent;
      $filter_nid['id'] = 'nid_' . ($index + 1);
      $filters[$filter_nid['id']] = $filter_nid;
    }
  }
  
  $resource_usage_view_all_public->display_handler->override_option('filters', $filters);
  
  $resource_usage_view_all_public->execute();

  if(isset($resource_usage_view_author_not_public) && count($resource_usage_view_author_not_public->result) > 0) {
    $resource_usage_view_all_public->result = array_merge($resource_usage_view_all_public->result,$resource_usage_view_author_not_public->result);
  }

  echo $resource_usage_view_all_public->render();  
    ?>
  </div>
  <?php endif; ?>

  <?php if($copies_of_results->rowCount() > 0): ?>
  <div class="section copies clearfix">
    <div class="assoc_type clearfix" onclick="resource_assoc_toggle('copies_of');"><div class="arrow"></div><span>Copies<span></div>
    <div class="count_label">
      <?php echo $copies_of_public_qry_result->rowCount(); ?> public items (<?php echo $copies_of_results->rowCount(); ?> items)
    </div>
  </div>
  <div class="list copies_of row hide clearfix" data-count="<?php echo $copies_of_results->rowCount(); ?>">
    <?php foreach($copies_of_results as $result): ?>
    <?php $resource = node_load($result->parent); ?>
    <div class="span3 resource_item">
    <?php $thumbnail = base_path() . drupal_get_path('theme','epe_theme') . '/images/no_thumb_small.jpg'; //default thumb ?>
    <?php switch($resource->type) {
      case 'llb_resource':
        if(!empty($resource->field_challenge_thumbnail)) {
          $thumbdata = drupal_json_decode($resource->field_challenge_thumbnail['und'][0]['value']);
          $thumbnail = image_style_url('resource_browser_thumbnail', $thumbdata[0]['uri']);
        }
      break;
    } ?>
      <div class="thumbnail">
        <img src="<?php echo $thumbnail; ?>" alt="Resource Image for <?php echo $resource->title; ?>" />
      </div>
      <div class="title"><?php echo l($resource->title,"node/{$resource->nid}"); ?></div>
      <div class="author">
        By: <?php $author = user_load($resource->uid);  echo $author->field_account_fname['und'][0]['value'] . ' ' . $author->field_account_lname['und'][0]['value']; ?>
      </div>
      <div class="date">
        <?php echo format_date($resource->changed, 'custom','n-d-y') ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>

<?php endif; ?>
