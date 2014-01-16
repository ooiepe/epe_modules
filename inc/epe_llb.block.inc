<?php

function epe_llb_load_tab_info_block_content($content_key) {
  $step_previous = (file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/step_previous.html") ? file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/step_previous.html") : '');

  $step_this = (file_exists(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/step_this.html") ? file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/step_this.html") : '');

  $step_next = (file_exists(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/step_next.html") ? file_get_contents(drupal_get_path('module','epe_llb') . "/contents/{$content_key}/step_next.html") : '');

  $content = theme('epe_llb_vertical_tab_info_container', array(
    'key' => $content_key,
    'step_previous' => $step_previous,
    'step_this' => $step_this,
    'step_next' => $step_next,
  ));

  return $content;
}
