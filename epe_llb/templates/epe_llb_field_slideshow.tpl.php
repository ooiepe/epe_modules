<?php
if($images):
?>
<div id="carousel-<?php echo $custom_id; ?>" class="carousel slide pull-right"><!-- class of slide for animation -->
  <div class="carousel-inner">
    <?php foreach($images as $key=>$slide): ?>
    <?php $slideclasses = array('item'); ?>
    <?php if($key == 0): array_push($slideclasses, "active"); endif; ?>
    <div class="<?php echo implode(' ', $slideclasses); ?>">
      <?php
        if($slide->type == 'video_resource') {
      ?>
        <video id="video-<?php echo $slide->nid ?>-video" data-setup="{}" class="video-js vjs-default-skin" width="480" height="320" controls="controls" preload="auto" poster="<?php echo $slide->thumbnail; ?>">
          <source src="<?php echo $slide->file; ?>">
        </video>
      <?php
        } else {
          $slide_image = array('style_name' => 'llb_detail_view', 'path' => $slide->uri, 'alt' => '', 'title' => '');
      ?>
      <a href="<?php echo base_path(); ?>node/<?php echo $slide->nid; ?>"><?php echo theme('image_style', $slide_image); ?></a>
      <?php
        }
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
