<?php
  $view = views_get_view('featured_resources');
  $view->set_display('all');

  if(!empty($type)) {
    $filter = $view->get_item('all', 'filter', 'type');
    $filter['value'] = $type;
    $view->set_item('all', 'filter', 'type', $filter);
  }

  $view->execute();

  foreach($view->result as $result):
?>
<?php $node = node_load($result->nid); ?>
<?php if($node): ?>
<?php $wrapper = entity_metadata_wrapper('node',$node); ?>
<div class="item">
  <div><strong><?php echo l($wrapper->label(),"node/{$wrapper->getIdentifier()}"); ?></strong></div>
  <div><?php echo $wrapper->author->field_account_fname->value() . ' ' . $wrapper->author->field_account_lname->value(); ?></div>
</div>
<?php endif; ?>
<?php endforeach; ?>
