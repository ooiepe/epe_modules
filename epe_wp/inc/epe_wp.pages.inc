<?php

function epe_wp_epe_home() {
  return array(
    'my_content' => array(
      '#type' => 'markup',
      '#markup' => 'Placeholder for EPE home page',
    ),
  );
}

function epe_wp_ev_home() {
/*  return array(
    'my_content' => array(
      '#type' => 'markup',
      '#markup' => 'Placeholder for EV home page',
    ),
  );*/
  drupal_add_js(drupal_get_path('module','epe_wp') . '/js/epe_ev.homepage.js');
//  drupal_set_title('Educational Visualizations');
  return theme('epe_ev_homepage');
}

function epe_wp_cm_home() {
/*  return array(
    'my_content' => array(
      '#type' => 'markup',
      '#markup' => 'Placeholder for CM home page',
    ),
  );*/
  drupal_add_js(drupal_get_path('module','epe_wp') . '/js/epe_cm.homepage.js');
  return theme('epe_cm_homepage');
}

function epe_wp_llb_home() {
  return array(
    'my_content' => array(
      '#type' => 'markup',
      '#markup' => 'Placeholder for LLB home page',
    ),
  );
}

function epe_wp_db_home() {
  return array(
    'my_content' => array(
      '#type' => 'markup',
      '#markup' => 'Placeholder for Resources home page',
    ),
  );
}
