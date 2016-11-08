<?php echo render($content); ?>
<style media="screen">
  label { padding-bottom: 1em; }
  label a { color: #ac7f25; padding-bottom: 0.5em; }
</style>
<div class="epe_help">
<?php
  $display_name = $tag[0];
  $view = views_get_view('knowledge_base_view');
  $view->set_display($display_name);

  $view->pre_execute();
  $view->execute();

  echo $view->render();
?>
</div>
