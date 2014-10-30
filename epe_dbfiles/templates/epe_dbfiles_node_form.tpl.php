
<div class="form-help"><a href="<?php echo base_path() . "node/171" ?>" target="_blank">Help with this form</a></div>
<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">



<?php if (empty($form['nid']['#value'])): ?>
  <input type="hidden" name="destination" value="db/">
<?php else: ?>
  <input type="hidden" name="destination" value="node/<?php print $form['nid']['#value'] ?>">
<?php endif; ?>


<?php /*
<div class="field-container">
<label for="edit-file" class="field-label">Upload file resource:</label>
<?php echo render($form['file']); ?>
</div>

<div class="field-container">
<label for="edit-file" class="field-label">Web Resource URL:</label>
<?php echo render($form['url']); ?>
</div>
*/ ?>
<div class="field-container">
<label for="edit-file" class="field-label">* Resource to add:</label>
<?php echo render($form['resource_field']); ?>
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
<label for="edit-credit-value" class="field-label">* Credit:</label>
<?php echo render($form['credit']); ?>
</div>

<?php if(isset($form['source_url'])): ?>
<div class="field-container">
<label for="edit-source-url-value" class="field-label">Source URL:</label>
<?php echo render($form['source_url']); ?>
</div>
<?php endif; ?>

<div class="field-container thumbnail">
<label for="edit-thumbnail" class="field-label">Thumbnail:</label>
<?php echo render($form['thumbnail']); ?>
</div>

<div class="field-container">
<!-- <label for="edit-permission-1" class="field-label">Permission:</label> -->
<?php //echo render($form['permission']); ?>
<div class="control-group form-item">
<div class="controls">
<input type="checkbox" name="permission" style="float: left;"> <div style="margin-left: 20px;">I hereby certify that this resource is either my own work or I have been given permission to use it within an educational context</div>
</div>
</div>
</div>

<?php echo render($form['node_type']); ?>

<?php echo render($form['submit']); ?>

<?php
  /* form identifier */
  echo render($form['form_build_id']);
  echo render($form['form_id']);
  echo render($form['form_token']);
?>



</div>
</div>
