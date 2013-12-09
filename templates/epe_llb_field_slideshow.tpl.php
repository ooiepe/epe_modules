<?php
if(isset($field['#items']) && !empty($field['#items'])): ?>
<div id="this-carousel-id" class="carousel slide pull-right"><!-- class of slide for animation -->
  <div class="carousel-inner">
    <?php foreach($field['#items'] as $key=>$slide): ?>
    <?php $slideclasses = array('item'); ?>
    <?php if($key == 0): array_push($slideclasses, "active"); endif; ?>
    <div class="<?php echo implode(' ', $slideclasses); ?>">
      <?php
        $slide_image = array('style_name' => 'llb_detail_view', 'path' => $slide['uri'], 'alt' => '', 'title' => '');
        echo theme('image_style', $slide_image);
      ?>
      <?php if($slide['title'] != '' && count($field['#item']) > 1): ?>
      <div class="carousel-caption">
        <p><?php echo $slide['title']; ?></p>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div><!-- /.carousel-inner -->
  <!--  Next and Previous controls below
        href values must reference the id for this carousel -->
    <?php if(count($field['#item']) > 1): ?>
    <a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
    <?php endif; ?>
</div><!-- /.carousel -->
<?php endif; ?>
