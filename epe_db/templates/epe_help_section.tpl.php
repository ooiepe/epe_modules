<?php echo render($content); ?>
<?php
  $display_name = $tag[0];
  $view = views_get_view('knowledge_base_view');
  $view->set_display($display_name);

  $view->pre_execute();
  $view->execute();

  echo $view->render();
?>
