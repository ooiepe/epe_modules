
<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">


<div class="field-container">
<label for="edit-file" class="field-label">* Upload file resource:</label>
<?php echo render($form['file-container']); ?>
</div>

<div class="field-container">
<label for="edit-title" class="field-label">* Title:</label>
<?php echo render($form['title']); ?>
</div>

<div class="field-container">
<label for="edit-description-value" class="field-label">* Description:</label>
<?php echo render($form['body']); ?>
</div>

<?php if(!empty($form['thumb-container']['#attributes'])): ?>
<div class="field-container thumbnail">
<label for="edit-thumbnail" class="field-label">Thumbnail:</label>
<?php echo render($form['thumb-container']); ?>
</div>
<?php endif; ?>

<?php echo render($form['actions']); ?>

<?php
  /* form identifier */
  echo render($form['form_build_id']);
  echo render($form['form_id']);
  echo render($form['form_token']);
?>


</div>
</div>
