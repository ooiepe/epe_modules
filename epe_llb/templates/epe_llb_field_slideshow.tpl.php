<?php
if($images):
?>
<div id="carousel-<?php echo $custom_id; ?>" class="carousel slide pull-right"><!-- class of slide for animation -->
  <div class="carousel-inner">
    <?php foreach($images as $key=>$slide): ?>
    <?php $slideclasses = array('item'); ?>
    <?php if($key == 0): array_push($slideclasses, "active"); endif; ?>
    <div class="<?php echo implode(' ', $slideclasses); ?>">
      <?php if($slide->type == 'video_resource') { ?>
        <video id="video-<?php echo $slide->nid ?>-video" data-setup="{}" class="video-js vjs-default-skin" width="480" height="320" controls="controls" preload="auto" poster="<?php echo $slide->thumbnail; ?>">
          <source src="<?php echo $slide->file; ?>">
        </video>
      <?php } elseif($slide->type == 'web_resource') { ?>
      <a href="<?php echo base_path(); ?>node/<?php echo $slide->nid; ?>">
        <img src="<?php print $slide->thumbnail; ?>" alt="<?php print $slide->title; ?>" style="width:480px;">
      </a>
      <?php
/*      $height_pattern = "/height=\"[0-9]*\"/";
      $slide->html = preg_replace($height_pattern, "height='320'", $slide->html);
      $width_pattern = "/width=\"[0-9]*\"/";
      $slide->html = preg_replace($width_pattern, "width='480'", $slide->html);
      $match_pattern = "#<iframe[^>]*>.*?</iframe>#i";
      preg_match_all($match_pattern, $slide->html, $result);
      echo $result[0][0];*/
      ?>
      <?php } else { ?>
      <a href="<?php echo base_path(); ?>node/<?php echo $slide->nid; ?>">
      <?php
      if($slide->uri != '') {
        $slide_image = array('style_name' => 'llb_detail_view', 'path' => $slide->uri, 'alt' => '', 'title' => '');
        echo theme('image_style', $slide_image);
      } else {
        echo '<img src="' . $slide->thumbnail . '" style="width:480px;height:320px;">';
      }
      ?>
      </a>
      <?php } ?>
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
