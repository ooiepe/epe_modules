<div class="alert alert-info alert-block">
  <div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#<?php echo $key; ?>a" data-toggle="tab">Design Process</a></li>
      <li><a href="#<?php echo $key; ?>b" data-toggle="tab">Content Tips</a></li>
      <li><a href="#<?php echo $key; ?>c" data-toggle="tab">Pedagogy</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="<?php echo $key; ?>a">
        <?php echo $design_process; ?>
      </div>
      <div class="tab-pane" id="<?php echo $key; ?>b">
        <?php echo $content_tips; ?>
      </div>
      <div class="tab-pane" id="<?php echo $key; ?>c">
        <?php echo $pedagogy; ?>
      </div>
    </div>
  </div>
</div>
