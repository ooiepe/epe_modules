<div class="control-group">
  <div class="span7">
    <div class="control-group">
      <?php echo file_get_contents(drupal_get_path('module','epe_dbfiles') . '/content/homepage/homepage.html'); ?>
    </div>

    <div class="control-group">
      <div>
        <input type="radio" name="filter" value="" checked="checked">&nbsp;All Resources
        <div class="control-group <?php if(!user_is_logged_in()): echo 'well'; endif; ?>">
          <?php if(!user_is_logged_in()): ?>
          <div><small>Not registered? <?php echo l('Click here','user'); ?></small></div>
          <?php endif; ?>
        <input type="radio" name="filter" value="author" <?php if(!user_is_logged_in()): echo 'disabled'; endif; ?> >&nbsp;My Resources Only
        </div>
        <input type="text" name="search_db" size="50"> <button type="button" id="db_submit" class="btn btn-primary">Search</button>
      </div>
    </div>
  </div>

  <div class="span5">
    <div class="control-group">
      <img src="<?php echo drupal_get_path('module','epe_dbfiles'); ?>/content/homepage/homepage.jpg" />
    </div>
  </div>
</div>

<div class="control-group">
  <div class="span12">
  <?php
    $block = module_invoke('epe_dbfiles','block_view','epe_db_featured');
    echo render($block['title']);
    echo render($block['content']);
  ?>
  </div>
</div>
