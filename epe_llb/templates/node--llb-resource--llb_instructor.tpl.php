<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

<?php
  $hideActionButtons = 0;
  $showContent = false;
  include realpath(drupal_get_path('theme','bootstrap')) . '/templates/viewpage.tpl.php';
?>

<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px; position:relative;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px; position:relative;">

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

    <?php if(!empty($content['field_instructional_content'])) { ?>
    <p><strong>Instructional Tips</strong></p>
    <?php echo render($content['field_instructional_content']);
    } ?>

    <?php if(!empty($content['field_preconception_content'])) { ?>
    <p><strong>Preconceptions and Lecture Questions</strong></p>
    <?php echo render($content['field_preconception_content']);
    } ?>

    <?php if(!empty($content['field_resources_content'])) { ?>
    <p><strong>Resources</strong></p>
    <?php echo render($content['field_resources_content']);
    } ?>

    <?php if(!empty($content['field_resource_file'])) { ?>
    <?php echo render($content['field_resource_file']);
    } ?>
  </div>

</div>
</div>

<p align="center"><?php echo l('Data Investigation Details', "node/" . arg(1)); ?> | <?php echo l('Begin this Investigation', "node/" . arg(1) . "/detail"); ?></p>

</article> <!-- /.node -->
