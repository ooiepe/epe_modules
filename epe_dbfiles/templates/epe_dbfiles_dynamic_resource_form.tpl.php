<div class="clearfix">

<div class="form-help"><a href="<?php echo drupal_get_path_alias('node/51'); ?>" target="_blank">Help with this form</a></div>

<?php echo drupal_render($form['mode']); ?>

<?php echo drupal_render($form['type_select']); ?>

<?php foreach($form['dynamic_form'] as $form): ?>
  <div class="clearfix">
  <?php echo drupal_render($form); ?>
  </div>
<?php endforeach; ?>

</div>
