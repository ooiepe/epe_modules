<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">


<div class="tool-home">
  <div class="span7">
    <div class="control-group">
      <?php echo file_get_contents(drupal_get_path('module','epe_ev') . '/content/homepage/homepage.html'); ?>
    </div>

    <div class="control-group">
      <div>
        <div class="clearbox">
          <input type="radio" name="filter" value="" checked="checked">&nbsp;All Visualizations<br>
        </div>
        <div class="<?php if(!user_is_logged_in()): echo 'graybox'; else: echo 'clearbox'; endif; ?>">
        <input type="radio" name="filter" value="author" <?php if(!user_is_logged_in()): echo 'disabled'; endif; ?> >&nbsp;My Visualizations Only
        <?php if(!user_is_logged_in()): ?>
          <div style="float:right;"><small>Not registered? <?php echo l('Click here','user'); ?></small></div>
        <?php endif; ?>
        </div>
        <div class="form-horizontal">
          <input type="text" name="search_ev" size="50"> <button type="button" id="ev_submit" class="btn btn-primary">Search</button>
        </div>
        <br><a href="<?php echo base_path() ?>ev/tools" class="btn btn-primary">Create a Visualization<i class="icon-chevron-right icon-white"></i></a>
      </div>
    </div>
  </div>

  <div class="span5">
    <div class="control-group featured-image">
    <?php  
      $block = module_invoke('bean', 'block_view', 'visualizations-rotator');
      if(!empty($block['content']['bean']['visualizations-rotator']['field_rotator_content_fields']['#items'])) {
        print render($block['content']);  
      } else {  
    ?>    
    <img src="<?php echo base_path() . drupal_get_path('module','epe_ev'); ?>/content/homepage/homepage.jpg" />
    <?php
      } //end if bean has item
    ?>
    </div>
  </div>
</div>
<br clear="all">


<div class="control-group">
  <div class="span12">
    <div id="tool-featured">
    <?php
      $block = module_invoke('epe_wp','block_view','epe_ev_featured');
      echo '<h2>' . render($block['title']) . '</h2>';
      echo render($block['content']);
    ?>
    </div>
  </div>
</div>
<br clear="all">

</div>
</div>

