<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

<?php
  $hideActionButtons = 0;
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
    <?php echo render($content['field_instructional_content']); ?>
    <?php echo render($content['field_preconception_content']); ?>
    <?php echo render($content['field_resources_content']); ?>
  </div>

</div>
</div>

<p><?php echo l('View Lesson Information', "node/" . arg(1)); ?></p>

</article> <!-- /.node -->
