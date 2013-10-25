
<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">




<div class="tool-home">
  <div class="span7">
    <div class="control-group">
      <?php echo file_get_contents(drupal_get_path('module','epe_cm') . '/content/homepage/homepage.html'); ?>
    </div>
    <div class="control-group">
      <div>
        <div class="clearbox">
          <input type="radio" name="filter" value="" checked="checked">&nbsp;All Concept Maps<br>
        </div>
        <div class="<?php if(!user_is_logged_in()): echo 'graybox'; else: echo 'clearbox'; endif; ?>">
          <input type="radio" name="filter" value="author" <?php if(!user_is_logged_in()): echo 'disabled'; endif; ?> >&nbsp;My Concept Maps Only
          <?php if(!user_is_logged_in()): ?>
            <div style="float:right;"><small>Not registered? <?php echo l('Click here','user'); ?></small></div>
          <?php endif; ?>
        </div>
        <div class="form-horizontal">
          <input type="text" name="search_cm" size="50"> <button type="button" id="cm_submit" class="btn btn-primary">Search</button>
        </div>
      </div>
    </div>
  </div>
  <div class="span5">
    <div class="control-group featured-image">
      <img src="<?php echo base_path() . drupal_get_path('module','epe_cm'); ?>/content/homepage/homepage.jpg" />
    </div>
  </div>
</div><!-- /tool-home  -->
<br clear="all">

<div id="tool-featured">
  <h2>Featured Concept Maps</h2>
  <ul>
    <li class="first">
      <a href=""><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/sample_thumb_1.jpg" width="190" height="141"></a>
      <div class="title">Sandy Wave Heights and Wind Speed</div>      
      <div class="author">by Sage Lichtenwalner</div>      
      <div class="summary">Suspendisse potenti. Donec ac tempus velit.Suspendisse potenti. Donec ac tempus velit.Suspendisse potenti. Donec ac tempus velit.Suspendisse potenti. Donec ac tempus velit. </div>      
    </li>
    <li>
      <a href=""><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/sample_thumb_2.jpg" width="190" height="141"></a>
      <div class="title">RU23 - Hurricane Sandy</div>      
      <div class="author">by Sage Lichtenwalner</div>      
      <div class="summary">Pellentesque potenti. Donec ac tempus velit. </div>      
    </li>
    <li>
      <a href=""><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/sample_thumb_3.jpg" width="190" height="141"></a>
      <div class="title">Title of the item</div>      
      <div class="author">by Joe Wieclawek</div>      
      <div class="summary">Suspendisse potenti. Donec ac tempus velit. </div>      
    </li>
    <li>
      <a href=""><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/sample_thumb_4.jpg" width="190" height="141"></a>
      <div class="title">Title of the item</div>      
      <div class="author">by Joe Wieclawek</div>      
      <div class="summary">Suspendisse potenti. Donec ac tempus velit. </div>      
    </li>
  </ul>
  <br clear="all">
</div>


<div class="control-group">
  <div class="span12">
    <?php
      $block = module_invoke('epe_wp','block_view','epe_cm_featured');
      echo render($block['title']);
      echo render($block['content']);
    ?>
  </div>
</div>
<br clear="all">





</div>
</div>
