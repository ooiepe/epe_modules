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
?>


<?php if ($isUsedByOtherResources == 1 || $hasChildResources == 1 || $hasCopiesOf == 1): ?>
<div class="resource_assoc">
<label class="header">Resources</label>
<div class="section stats clearfix">
  <div class="assoc_type clearfix" onclick="resource_assoc_toggle('stats');"><div class="arrow"></div><span>Statistics</span></div>
</div>
<div class="list stats row hide clearfix">
  <?php echo views_embed_view('resource_view_stats', 'block'); ?>
</div>
<?php if($used_in_results->rowCount() > 0): ?>
  <div class="section used_in clearfix">
    <div class="assoc_type clearfix" onclick="resource_assoc_toggle('used_in');"><div class="arrow"></div><span>Used In</span></div>
    <div class="count_label">
      <?php echo $used_in_public_qry_result->rowCount(); ?> public items (<?php echo $used_in_results->rowCount(); ?> items)
    </div>
  </div>
  <div class="list used_in row hide clearfix" data-count="<?php echo $used_in_results->rowCount(); ?>">
    <?php foreach($used_in_results as $result): ?>
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

  <?php if($child_resources_results->rowCount() > 0): ?>
  <div class="section uses clearfix">
    <div class="assoc_type clearfix" onclick="resource_assoc_toggle('uses');"><div class="arrow"></div><span>Uses</span></div>
    <div class="count_label">
      <?php echo $child_resources_public_qry_result->rowCount(); ?> public items (<?php echo $child_resources_results->rowCount(); ?> items)
    </div>
  </div>
  <div class="list uses row hide clearfix" data-count="<?php echo $child_resources_results->rowCount(); ?>">
    <?php foreach($child_resources_results as $result): ?>
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
