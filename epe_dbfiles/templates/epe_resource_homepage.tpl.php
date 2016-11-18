<style>
.node-tabs, .action-links {
  display: none;
}
</style>

<div class="clearfix about content_wrapper">

<div class="tool-home clearfix">
  <div class="span7">
    <div class="control-group">
      <?php echo file_get_contents(drupal_get_path('module','epe_dbfiles') . '/content/homepage/homepage.html'); ?>
    </div>
  </div>

  <div class="span5">
    <div class="control-group featured-image">
    <?php
      $block = module_invoke('bean', 'block_view', 'file-resources-rotator');
      if(!empty($block['content']['bean']['file-resources-rotator']['field_rotator_content_fields']['#items'])) {
        print render($block['content']);
      } else {
    ?>
    <img src="<?php echo base_path() . drupal_get_path('module','epe_dbfiles'); ?>/content/homepage/homepage.jpg" />
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
        <img src="<?php echo drupal_get_path('theme','epe_theme'); ?>/images/about-investigation-icon.jpg" alt="Icon of Investigation Library">
      </div>
      <div class="info">
        <div class="option_title">Investigation Library</div>
        <div class="text">Search the library for Featured Investigations developed by your peers.  Here you will find an onine collection of data investigations to enrich your teaching and student learning.</div>
      </div>
    </div>
    <div class="resource_option copy_mod clearfix">
      <div class="icon_thumb">
        <img src="<?php echo drupal_get_path('theme','epe_theme'); ?>/images/about-copy-modify-icon.jpg" alt="Icon of Copy and Modify">
      </div>
      <div class="info">
        <div class="option_title">Copy and Modify</div>
        <div class="text">Copy and modify an existing investigation to tailor your class needs.  When you copy an investigation, you can adjust the content to your specific classroom needs.</div>
      </div>
    </div>
    <div class="resource_option create clearfix">
      <div class="icon_thumb">
        <img src="<?php echo drupal_get_path('theme','epe_theme'); ?>/images/about-create-icon.jpg" alt="Icon of Create your Own">
      </div>
      <div class="info">
        <div class="option_title">Create your Own</div>
        <div class="text">Create a New Investigation using novel data sets and topics.  Use our Data Investigation Wizard to create your own novel lesson.</div>
      </div>
    </div>
  </div>
  <div class="span5 kb">
    <h4>Getting Started</h4>
    <div class="description">Need help deciding what to do first?  Check out these common questions.</div>
    <?php
    $display_name = 'db';
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
    $block = module_invoke('epe_dbfiles','block_view','epe_resource_featured');
    echo '<h2>' . render($block['title']) . '</h2>';
    echo render($block['content']);
  ?>
    </div>
  </div>
</div>
<br clear="all">

</div>
