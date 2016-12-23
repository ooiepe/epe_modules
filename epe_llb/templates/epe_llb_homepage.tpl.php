<style>
.node-tabs, .action-links {
  display: none;
}
</style>

<div class="clearfix about content_wrapper">


<div class="tool-home clearfix">
  <div class="span7">
    <div class="control-group">
      <?php echo file_get_contents(drupal_get_path('module','epe_llb') . '/contents/homepage/homepage.html'); ?>
    </div>

    <!-- <div class="control-group">
      <div>
        <div class="clearbox">
          <input type="radio" name="filter" value="" checked="checked">&nbsp;All Investigations<br>
        </div>
        <div class="<?php if(!user_is_logged_in()): echo 'graybox'; else: echo 'clearbox'; endif; ?>">
        <input type="radio" name="filter" value="author" <?php if(!user_is_logged_in()): echo 'disabled'; endif; ?> >&nbsp;My Investigations Only
        <?php if(!user_is_logged_in()): ?>
          <div style="float:right;"><small>Not registered? <?php echo l('Click here','user'); ?></small></div>
        <?php endif; ?>
        </div>
        <div class="form-horizontal">
          <input type="text" name="search_llb" size="50"> <button type="button" id="llb_submit" class="btn btn-primary">Search</button>
        </div>
        <br><a href="<?php echo base_path() ?>node/add/llb-resource" class="btn btn-primary">Create an Investigation<i class="icon-chevron-right icon-white"></i></a>
      </div>
    </div> -->
  </div>

  <div class="span5">
    <div class="control-group featured-image">
    <?php
      $block = module_invoke('bean', 'block_view', 'investigations-rotator');
      if(!empty($block['content']['bean']['investigations-rotator']['field_rotator_content_fields']['#items'])) {
        print render($block['content']);
      } else {
    ?>
    <img src="<?php echo base_path() . drupal_get_path('module','epe_llb'); ?>/contents/homepage/homepage.jpg" />
    <?php
      } //end if bean has item
    ?>
    </div>
  </div>
</div>
<br clear="all">

<div class="control-group">
  <div class="span7">
    <div class="resource_option lib clearfix">
      <div class="icon_thumb">
        <a href="<?php echo base_path(); ?>resource-browser#/search?type=llb&page=1&filter=featured">
        <img src="<?php echo drupal_get_path('theme','epe_theme'); ?>/images/about-investigation-icon.jpg" alt="Icon of Investigation Library">
        </a>
      </div>
      <div class="info">
        <div class="option_title"><a href="<?php echo base_path(); ?>resource-browser#/search?type=llb&page=1&filter=featured">Investigation Library</a></div>
        <div class="text">Search the library for Featured Investigations developed by your peers.  Here you will find an onine collection of data investigations to enrich your teaching and student learning.</div>
      </div>
    </div>
    <div class="resource_option copy_mod clearfix">
      <div class="icon_thumb">
        <a href="<?php echo base_path(); ?>resource-browser#/search?type=llb&page=1">
        <img src="<?php echo drupal_get_path('theme','epe_theme'); ?>/images/about-copy-modify-icon.jpg" alt="Icon of Copy and Modify">
        </a>
      </div>
      <div class="info">
        <div class="option_title"><a href="<?php echo base_path(); ?>resource-browser#/search?type=llb&page=1">Copy and Modify</a></div>
        <div class="text">Copy and modify an existing investigation to tailor your class needs.  When you copy an investigation, you can adjust the content to your specific classroom needs.</div>
      </div>
    </div>
    <div class="resource_option create clearfix">
      <div class="icon_thumb">
        <a href="<?php echo base_path(); ?>node/add/llb-resource">
        <img src="<?php echo drupal_get_path('theme','epe_theme'); ?>/images/about-create-icon.jpg" alt="Icon of Create your Own">
        </a>
      </div>
      <div class="info">
        <div class="option_title"><a href="<?php echo base_path(); ?>node/add/llb-resource">Create your Own</a></div>
        <div class="text">Create a New Investigation using novel data sets and topics.  Use our Data Investigation Wizard to create your own novel lesson.</div>
      </div>
    </div>
  </div>
  <div class="span5 kb">
    <h4>Getting Started</h4>
    <div class="description">Need help deciding what to do first?  Check out these common questions.</div>
    <?php
    $display_name = 'llb';
    $remove_field = 'body';
    $view = views_get_view('knowledge_base_view');
    $view->set_display($display_name);
    $pager = $view->display_handler->get_option('pager');
    $pager['type'] = 'some';
    $pager['options']['items_per_page'] = '5';
    $view->display_handler->override_option('pager', $pager);

    $view->pre_execute();
    $view->execute();

    echo $view->render();
    ?>
  </div>
</div>

<div class="control-group">
  <div class="span12">
    <div id="tool-featured">
  <?php
    $block = module_invoke('epe_llb','block_view','epe_llb_featured');
    echo '<h2>' . render($block['title']) . '</h2>';
    echo render($block['content']);
  ?>
    </div>
  </div>
</div>
<br clear="all">

</div>
