<ul>
<?php
  $view = views_get_view('featured_resources');
  $view->set_display('all');

  if(!empty($type)) {
    $filter = $view->get_item('all', 'filter', 'type');
    $filter['value'] = $type;
    $view->set_item('all', 'filter', 'type', $filter);
  }

  $view->execute();

  foreach($view->result as $key => $result):
?>
<?php $node = node_load($result->nid); ?>
<?php if($node): ?>
<?php
  $wrapper = entity_metadata_wrapper('node',$node);
  $thumbnail = '';
  if(in_array($wrapper->getBundle(),array('cm_resource'))) {
    /* temporary fix */
    $thumbnail = '<img src="' . base_path() . drupal_get_path('theme','epe_theme') . '/images/no_thumb_small.jpg" width="190" height="141">';
  } else {
    switch($wrapper->getBundle()) {
      case 'image_resource':
      $image = $wrapper->field_image_resource_file->value();
      if($image) {
        $thumbnail = '<img src="' . image_style_url('homepage_featured_image', $image['uri']) . '">';
      }
      break;
      case 'document_resource':
      $image = $wrapper->field_document_resource_image->value();
      if($image) {
        $thumbnail = '<img src="' . image_style_url('homepage_featured_image', $image['uri']) . '">';
      }
      break;
      case 'audio_resource':
      $image = $wrapper->field_audio_resource_image->value();
      if($image) {
        $thumbnail = '<img src="' . image_style_url('homepage_featured_image', $image['uri']) . '">';
      }
      break;
      case 'video_resource':
      $field = field_get_items('node', $node, 'field_video_resource_file');
      if($field) {
        $thumbnail = '<img src="' . image_style_url('homepage_featured_image', $field[0]['thumbnailfile']->uri) . '">';
      }
      break;
      case 'llb_resource':
      $thumbnail_field = $wrapper->field_challenge_thumbnail->value();
      if($thumbnail_field) {
        $thumbnail_node_info = json_decode($thumbnail_field);
        foreach($thumbnail_node_info as $info) {
          $node_info = epe_llb_dataset_query($info);
          if(!isset($node_info->uri) || (isset($node_info->uri) &&!$node_info->uri)) {
            $thumbnail = '<img src="' . base_path() . drupal_get_path('theme','epe_theme') . '/images/no_thumb_small.jpg" width="190" height="141">';
          } else {
            $thumbnail = '<img src="' . image_style_url('homepage_featured_image', $node_info->uri) . '">';
          }
        }
      }
      break;
      case 'ev_tool_instance':
      $image = $wrapper->field_instance_thumbnail->value();
      if($image) {
        $thumbnail = '<img src="' . image_style_url('homepage_featured_image', $image['uri']) . '">';
      }
      break;
    }
    if(!$thumbnail) $thumbnail = '<img src="' . base_path() . drupal_get_path('theme','epe_theme') . '/images/no_thumb_small.jpg" width="190" height="141">';
  }
?>
<li <?php if($key == 0): echo 'class="first"'; endif; ?>>
  <?php if($thumbnail): echo l($thumbnail,"node/{$wrapper->getIdentifier()}",array('html'=>'TRUE')); endif; ?>
  <div class="title"><?php echo l($wrapper->label(),"node/{$wrapper->getIdentifier()}"); ?></div>
  <div class="author">by <?php echo $wrapper->author->field_account_fname->value() . ' ' . $wrapper->author->field_account_lname->value(); ?></div>
  <?php if($wrapper->body->value()): ?>
  <div class="summary"><?php echo substr($wrapper->body->value->value(array('sanitize' => 'TRUE')),0,200); ?><div class="after"></div></div>
  <?php endif; ?>
</li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
