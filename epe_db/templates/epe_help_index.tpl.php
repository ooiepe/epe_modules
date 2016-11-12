<?php echo render($content); ?>
<style type="text/css">
.tabledrag-toggle-weight-wrapper,
.description,
.tabledrag-handle,
.form-actions,
footer { display: none; }
label { padding-bottom: 0.5em; }
label a { color: #ac7f25; }
</style>
<div class="epe_help">
  <div class="span8">
    <div class="control-group">
      <label><?php echo l('Investigation','help/llb'); ?></label>
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
    <div class="control-group">
      <label><?php echo l('Concept Map','help/cm'); ?></label>
      <?php
      $display_name = 'cm';
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
    <div class="control-group">
      <label><?php echo l('Visualization','help/ev'); ?></label>
      <?php
      $display_name = 'ev';
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
    <div class="control-group">
      <label><?php echo l('Resources','help/db'); ?></label>
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
  <div class="span4">
    <div class="control-group">
      <form action="<?php echo base_path(); ?>help/search" method="get">
        <input name="search" class="search-field" size="30" placeholder="Search Knowledge Base" /><button class="btn btn-small btn-primary">Search</button>
      </form>
    </div>
    <div class="control-group">
      <label><?php echo l('Common Issues','help'); ?></label>
      <?php
      $display_name = 'kb';
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
</div>
