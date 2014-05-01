
<div class="form-help"><a href="<?php echo base_path() . "node/171" ?>" target="_blank">Help with this form</a></div>
<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

<?php if (empty($form['nid']['#value'])): ?>
  <input type="hidden" name="destination" value="db/">
<?php else: ?>
  <input type="hidden" name="destination" value="node/<?php print $form['nid']['#value'] ?>">
<?php endif; ?>


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

<div class="field-container">
<label for="edit-credit" class="field-label">Credit:</label>
<?php echo render($form['field_credit']); ?>
</div>

<div class="field-container">
<label for="edit-source-url" class="field-label">Source URL:</label>
<?php echo render($form['field_source_url']); ?>
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
