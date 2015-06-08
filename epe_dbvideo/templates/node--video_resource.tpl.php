<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>




<?php 
$isDBFiles = 1;
?>
<?php include realpath(drupal_get_path('theme','bootstrap')) . '/templates/viewpage.tpl.php'; ?>



<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

<style type="text/css">
.field-label {
  display: none;
}
</style>

<?php print render($content['field_video_resource_file']) ?>

<legend>
  <label class="embed-toggle">Embed link</label>
  <div class="embed-wrapper hidden">
    &lt;iframe width="560" height="315" src="<?php echo base_path() . 'node/' . arg(1) . '/embed'; ?>" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;
  </div>
</legend>

<script type="text/javascript">
(function($){
  $('.embed-toggle').click(function() { 
    $('.embed-wrapper').toggleClass('hidden'); 
  });
})(jQuery);
</script>



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
</div>


</article> <!-- /.node -->



