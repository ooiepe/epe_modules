<div class="field-container">
<label for="edit-file" class="field-label">Upload file resource:</label>
<?php echo render($form['form-container']['file-container']); ?>
</div>

<div class="field-container">
<label for="edit-title" class="field-label">* Title:</label>
<?php echo render($form['form-container']['title-container']); ?>
</div>

<div class="field-container">
<label for="edit-description-value" class="field-label">Description:</label>
<?php echo render($form['form-container']['desc-container']); ?>
</div>

<div class="field-container thumbnail">
<label for="edit-thumbnail" class="field-label">Thumbnail:</label>
<?php echo render($form['form-container']['thumbnail-container']); ?>
</div>

<div class="field-container">
<label for="edit-permission-1" class="field-label">Permission:</label>
<?php echo render($form['form-container']['permission-container']); ?>
</div>

<?php echo render($form['form-container']['node_type']); ?>

<?php echo render($form['form-container']['action-container']); ?>

<?php
  /* form identifier */
  echo render($form['form_build_id']);
  echo render($form['form_id']);
  echo render($form['form_token']);
?>
