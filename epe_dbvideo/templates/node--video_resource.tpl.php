<?php 
drupal_add_js('http://getbootstrap.com/2.3.2/assets/js/bootstrap-tooltip.js','external');
drupal_add_js('http://getbootstrap.com/2.3.2/assets/js/bootstrap-popover.js','external');

global $base_url;
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>




<?php
$isDBFiles = 1;
?>
<?php include realpath(drupal_get_path('theme','epe_theme')) . '/templates/viewpage.tpl.php'; ?>



<div style="border: 1px solid #0195bd;padding:23px;margin-bottom:20px;" class="clearfix">

<style type="text/css">
.field-label,
.embed-wrapper.hidden {
  display: none;
}
.embed-container .popover { max-width: 100%; }
</style>

<?php print render($content['field_video_resource_file']) ?>

<div class="embed-container">
<?php 
echo l(t('Embed Link'), '#',
  array(
    'attributes'=>array(
      'data-placement'=>'bottom',
      'rel'=>'tooltip',
      'class'=>array('links','embed-link','popover-link'),
      'id'=>'embed-link-btn',
      'title'=>'Share this video',
      'trigger'=>'manual'
    ),
    'external'=>true
  )
);
?>
</div>

<script type="text/javascript">
(function($){

  $(function() {
    $('#embed-link-btn')
      .popover(
        {
          title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closePopoverConfirm(\"embed-link-btn\"); return false;"><i class="icon-remove"></i></button>',
          html: 'true',
          placement: 'bottom',
          content: 'Embed this video on your site using the following code.<br/><input type="text" class="input" style="width:100%;" value="<iframe width=\'560\' height=\'315\' src=\'<?php echo $base_url . '/node/' . arg(1) . '/videoembed'; ?>\' frameborder=\'0\' allowfullscreen></iframe>">'
        }
      );    

      $('.popover-link').click(function(event) {
        event.preventDefault();
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
      });
    });

  $('.embed-toggle').click(function() {
    $('.embed-wrapper').toggleClass('hidden');
  });
})(jQuery);

function closePopoverConfirm(divid) {
  jQuery(divid).popover('hide');
}
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


</article> <!-- /.node -->
