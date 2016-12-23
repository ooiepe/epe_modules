<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

<?php
  $hideActionButtons = 0;
  $showContent = false;
  $custom_node_detail_url = $GLOBALS['base_url'] . "/node/" . $node->nid . '/detail';
  include realpath(drupal_get_path('theme','epe_theme')) . '/templates/viewpage.tpl.php';
?>

<div style="border: 1px solid #0195bd;padding:23px;margin-bottom:20px;" class="clearfix">

  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
  ?>
  <div class=".row-fluid">
    <?php if(isset($content['body'])): ?>
    <?php echo render($content['body']); ?>
    <?php endif; ?>

    <?php if(!empty($content['field_investigation_level'])): ?>
    <p>
    <h3>Investigation Level</h3>
    <?php echo render($content['field_investigation_level']); ?>
    </p>
    <?php endif; ?>

    <?php if(!empty($content['field_teaching_mode'])): ?>
    <p>
    <h3>Teaching Mode</h3>
    <?php echo render($content['field_teaching_mode']); ?>
    </p>
    <?php endif; ?>

    <?php if(!empty($content['field_resource_keywords'])): ?>
    <p>
    <h3>Keywords:</h3>
    <?php echo render($content['field_resource_keywords']); ?>
    </p>
    <?php endif; ?>

    <?php if(!empty($content['field_instructional_content'])) { ?>
    <h3>Instructional Tips</h3>
    <?php echo render($content['field_instructional_content']);
    } ?>

    <?php if(!empty($content['field_preconception_content'])) { ?>
    <h3>Preconceptions and Lecture Questions</h3>
    <?php echo render($content['field_preconception_content']);
    } ?>

    <?php if(!empty($content['field_resources_content'])) { ?>
    <h3>Resources</h3>
    <?php echo render($content['field_resources_content']);
    } ?>

    <?php if(!empty($content['field_resource_file'])) {
      echo render($content['field_resource_file']);
    } ?>
  </div>

</div>

<p align="center"><?php echo l('Data Investigation Details', "node/" . arg(1), array('attributes'=>array('class'=>'btn btn-primary'))); ?> &nbsp;&nbsp; <?php echo l('Begin this Investigation', "node/" . arg(1) . "/detail", array('attributes'=>array('class'=>'btn btn-primary'))); ?></p>

</article> <!-- /.node -->
