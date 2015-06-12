<?php echo render($content); ?>
<style type="text/css">
.tabledrag-toggle-weight-wrapper,
.description,
.tabledrag-handle,
.form-actions { display: none; }
</style>
<div>
  <div class="span4">
    <div class="control-group">
      <label>Knowledge Base</label>      
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
    <div class="control-group">
      <label>Concept Map</label>
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
  </div>
  <div class="span4">
    <div class="control-group">
      <label>Visualization</label>
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
      <label>Resources</label>
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
        <input name="search" size="40" /><button class="btn btn-small btn-primary">Search</button>
      </form>
    </div>
    <div class="control-group">
      <label>Lab Lessons</label>
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
</div>
