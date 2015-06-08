<link href="//vjs.zencdn.net/4.9.0/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/4.9.0/video.js"></script>

<style type="text/css">
  .video-js {padding-top: 56.25%;}
  .vjs-fullscreen {padding-top: 0px;}
</style>

<div class="wrapper">
<div class="videocontent">
  <video id="myvideo" class="video-js vjs-default-skin vjs-fullscreen" controls preload="auto" width="auto" height="auto" <?php if($poster): echo 'poster="' . $poster . '"'; endif; ?> data-setup="{}">
    <source src="<?php echo $video_path; ?>" type='video/mp4'>
  </video>
</div>
</div>