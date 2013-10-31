<?php

require_once("inc/epe_ev_lib.php");

$ev_tool = array();

$EduVis_Paths = epe_EduVis_Paths();

// add EduVis framework to page
drupal_add_js( $EduVis_Paths["EduVis"]["javascript"]);

?>

<style>
  .node-tabs {
    display: none;
  }
</style>

<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
  <div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

<!-- content -->
    <div id="vistool"></div>
    
    <div>
      <div class="field-container">
        <!-- <label for="edit-title" class="field-label">* Title:</label> -->
        <?php echo render($form['title']); ?>
      </div>

      <div class="field-container" style="display:none;">
        <label for="edit-tool-author" class="field-label">Author:</label>
        <?php echo render($form['field_tool_author']); ?>
      </div>

      <div class="field-container">
        <label for="edit-tool-name" class="field-label">* Tool Name:</label>
        <?php echo render($form['field_tool_name']); ?>
      </div>


      <div class="field-container">
        <label for="edit-description-value" class="field-label">Description:</label>
        <?php echo render($form['body']); ?>
      </div>
      
    </div>

    <?php if (empty($form['nid']['#value'])): ?>
      <input type="hidden" name="destination" value="ev/">
    <?php else: ?>
      <input type="hidden" name="destination" value="node/<?php print $form['nid']['#value'] ?>">
    <?php endif; ?>

    <?php echo render($form['actions']); ?>

    <?php
      /* form identifier */
      echo render($form['form_build_id']);
      echo render($form['form_id']);
      echo render($form['form_token']);
    ?>

<!-- end content -->

  </div>
</div>
