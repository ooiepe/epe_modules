<?php

  require_once("../inc/epe_ev_lib.php");

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
        <?php echo render($form['field_tool_name']); ?>
      </div>

      <div class="field-container">
        <div>Published Status</div>
        <?php echo render($form['status']); ?>
      </div>

      <div class="field-container">

        <label class="option checkbox control-label" for="edit-status">
        <input type="checkbox" id="edit-status" name="status" value="<?php echo $form["#node"]->status; ?>"
        <?php

          // checked published status.. if published (0), show checked
          echo ($form["#node"]->status == 1 ? 'checked="checked"' : "");

        ?> class="form-checkbox">Published</label>

      </div>

      <div class="field-container thumbnail">
        <label for="edit-thumbnail" class="field-label">Thumbnail:</label>
        <?php echo render($form['field_tool_thumbnail']); ?>
      </div>

      <div class="field-container">
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
      echo render($form['field_source_nid']);
    ?>

<!-- end content -->

  </div>
</div>

<script>

  $.ready(function(){

    // disable enter key press form submission on inputs textboxes.. restrict to type textbox only?
    $("input").bind('keypress keydown keyup', function(e){
       if(e.keyCode == 13) {
          e.preventDefault();
       }
    });

  });

</script>
