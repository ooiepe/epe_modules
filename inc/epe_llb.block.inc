<?php

function epe_llb_load_tab_info_block_content($content_key) {
  $design_process = (file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/design-process.html") ? file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/design-process.html") : '');

  $content_tips = (file_exists(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/content-tips.html") ? file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/content-tips.html") : '');

  $pedagogy = (file_exists(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/pedagogy.html") ? file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/pedagogy.html") : '');

  $content = theme('epe_llb_vertical_tab_info_container', array(
    'key' => $content_key,
    'design_process' => $design_process,
    'content_tips' => $content_tips,
    'pedagogy' => $pedagogy,
  ));

  return $content;
}
