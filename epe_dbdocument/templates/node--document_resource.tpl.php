<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>




<?php
$isDBFiles = 1;
?>
<?php include realpath(drupal_get_path('theme','epe_theme')) . '/templates/viewpage.tpl.php'; ?>



<div style="border: 1px solid #0195bd;padding:23px;margin-bottom:20px;" class="clearfix">

<style type="text/css">
.field-label {
  display: none;
}
</style>

<?php print render($content['field_document_resource_file']) ?>








  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    //print render($content);
  ?>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <!-- display any places this item is included and any items copied from this item -->
  <?php include realpath(drupal_get_path('module', 'epe_db')) . '/templates/linked_items.tpl.php'; ?>




  <?php print render($content['comments']); ?>


</div>


</article> <!-- /.node -->
