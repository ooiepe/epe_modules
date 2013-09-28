<?php

function epe_llb_load_tab_info_block_content($content_key) {
  $content = theme('epe_llb_vertical_tab_info_container', array(
    'key' => $content_key,
    'design_process' => file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/design-process.html"),
    'content_tips' => file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/content-tips.html"),
    'pedagogy' => file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/pedagogy.html"),
  ));

  return $content;
}
