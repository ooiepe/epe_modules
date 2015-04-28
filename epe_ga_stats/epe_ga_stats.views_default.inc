<?php
/**
 * Implements hook_views_default_views().
 */
function epe_ga_stats_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'resource_statistics';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Resource statistics';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Top 25 Visualization This Year';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '25';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'table';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['fields']['count']['id'] = 'count';
  $handler->display->display_options['fields']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['fields']['count']['field'] = 'count';
  $handler->display->display_options['fields']['count']['label'] = 'Page Views: Month';
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Page Views: Year';
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_2']['id'] = 'count_2';
  $handler->display->display_options['fields']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_2']['field'] = 'count';
  $handler->display->display_options['fields']['count_2']['label'] = 'Page Views: All Time';
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_2']['id'] = 'count_2';
  $handler->display->display_options['sorts']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_2']['field'] = 'count';
  $handler->display->display_options['sorts']['count_2']['order'] = 'DESC';
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'cm_resource' => 'cm_resource',
  );

  /* Display: Viz Views */
  $handler = $view->new_display('block', 'Viz Views', 'vizviews');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '<none>';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['fields']['count']['id'] = 'count';
  $handler->display->display_options['fields']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['fields']['count']['field'] = 'count';
  $handler->display->display_options['fields']['count']['label'] = 'Page Views: Month';
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Page Views: Year';
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_2']['id'] = 'count_2';
  $handler->display->display_options['fields']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_2']['field'] = 'count';
  $handler->display->display_options['fields']['count_2']['label'] = 'Page Views: All Time';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_2']['id'] = 'count_2';
  $handler->display->display_options['sorts']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_2']['field'] = 'count';
  $handler->display->display_options['sorts']['count_2']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'ev_tool_instance' => 'ev_tool_instance',
  );

  /* Display: File Views */
  $handler = $view->new_display('block', 'File Views', 'fileviews');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '<none>';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Type */
  $handler->display->display_options['fields']['type']['id'] = 'type';
  $handler->display->display_options['fields']['type']['table'] = 'node';
  $handler->display->display_options['fields']['type']['field'] = 'type';
  /* Field: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['fields']['count']['id'] = 'count';
  $handler->display->display_options['fields']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['fields']['count']['field'] = 'count';
  $handler->display->display_options['fields']['count']['label'] = 'Page Views: Month';
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Page Views: Year';
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_2']['id'] = 'count_2';
  $handler->display->display_options['fields']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_2']['field'] = 'count';
  $handler->display->display_options['fields']['count_2']['label'] = 'Page Views: All Time';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_2']['id'] = 'count_2';
  $handler->display->display_options['sorts']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_2']['field'] = 'count';
  $handler->display->display_options['sorts']['count_2']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'audio_resource' => 'audio_resource',
    'document_resource' => 'document_resource',
    'image_resource' => 'image_resource',
    'video_resource' => 'video_resource',
    'web_resource' => 'web_resource',
  );

  /* Display: CM Views */
  $handler = $view->new_display('block', 'CM Views', 'cmviews');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '<none>';

  /* Display: LLB Views */
  $handler = $view->new_display('block', 'LLB Views', 'llbviews');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '<none>';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['fields']['count']['id'] = 'count';
  $handler->display->display_options['fields']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['fields']['count']['field'] = 'count';
  $handler->display->display_options['fields']['count']['label'] = 'Page Views: Month';
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Page Views: Year';
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_2']['id'] = 'count_2';
  $handler->display->display_options['fields']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_2']['field'] = 'count';
  $handler->display->display_options['fields']['count_2']['label'] = 'Page Views: All Time';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_2']['id'] = 'count_2';
  $handler->display->display_options['sorts']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_2']['field'] = 'count';
  $handler->display->display_options['sorts']['count_2']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'llb_resource' => 'llb_resource',
  );

  $export['resource_statistics'] = $view;

  return $export;
}