<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

<?php echo drupal_render($form['type_select']); ?>

<?php foreach($form['dynamic_form'] as $form): ?>
  <div class="clearfix">
  <?php echo drupal_render($form); ?>
  </div>
<?php endforeach; ?>

</div>
</div>
