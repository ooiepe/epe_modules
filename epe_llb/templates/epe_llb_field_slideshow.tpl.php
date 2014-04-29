<?php
/*if(isset($field['#items']) && !empty($field['#items'])): */
if($images):
?>
<div id="carousel-<?php echo $custom_id; ?>" class="carousel slide pull-right"><!-- class of slide for animation -->
  <div class="carousel-inner">
    <?php foreach($images as $key=>$slide): ?>
    <?php $slideclasses = array('item'); ?>
    <?php if($key == 0): array_push($slideclasses, "active"); endif; ?>
    <div class="<?php echo implode(' ', $slideclasses); ?>">
      <?php
        $slide_image = array('style_name' => 'llb_detail_view', 'path' => $slide->uri, 'alt' => '', 'title' => '');
        echo theme('image_style', $slide_image);
      ?>
      <?php if($slide->title != ''): ?>
      <div class="carousel-caption">
        <p><?php echo $slide->title; ?></p>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div><!-- /.carousel-inner -->
  <!--  Next and Previous controls below
        href values must reference the id for this carousel -->
    <?php if(count($images) > 1): ?>
    <a class="carousel-control left" href="#carousel-<?php echo $custom_id; ?>" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#carousel-<?php echo $custom_id; ?>" data-slide="next">&rsaquo;</a>
    <?php endif; ?>
</div><!-- /.carousel -->
<?php endif; ?>
