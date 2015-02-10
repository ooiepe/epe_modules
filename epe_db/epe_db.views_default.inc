<?php
/**
 * Implements hook_views_default_views().
 */
function epe_db_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'epe_knowledge_base_search';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'search_api_index_published_basic_page_index';
  $view->human_name = 'EPE Knowledge Base Search';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'EPE Knowledge Base';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '5';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Field: Indexed Node: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'search_api_index_published_basic_page_index';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['link_to_entity'] = 1;
  /* Sort criterion: Indexed Node: Date created */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'search_api_index_published_basic_page_index';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  /* Filter criterion: Indexed Node: Tags */
  $handler->display->display_options['filters']['field_tags']['id'] = 'field_tags';
  $handler->display->display_options['filters']['field_tags']['table'] = 'search_api_index_published_basic_page_index';
  $handler->display->display_options['filters']['field_tags']['field'] = 'field_tags';
  $handler->display->display_options['filters']['field_tags']['value'] = 'kb';
  $handler->display->display_options['filters']['field_tags']['expose']['operator_id'] = 'field_tags_op';
  $handler->display->display_options['filters']['field_tags']['expose']['label'] = 'Tags';
  $handler->display->display_options['filters']['field_tags']['expose']['operator'] = 'field_tags_op';
  $handler->display->display_options['filters']['field_tags']['expose']['identifier'] = 'field_tags';
  /* Filter criterion: Tags: Name (indexed) */
  $handler->display->display_options['filters']['field_tags_name']['id'] = 'field_tags_name';
  $handler->display->display_options['filters']['field_tags_name']['table'] = 'search_api_index_published_basic_page_index';
  $handler->display->display_options['filters']['field_tags_name']['field'] = 'field_tags_name';
  $handler->display->display_options['filters']['field_tags_name']['value'] = 'kb';

  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'search');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['empty'] = FALSE;
  /* No results behavior: Global: Text area */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = 'No page match your search term.  Please try again.';
  $handler->display->display_options['empty']['area']['format'] = 'filtered_html';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Search: Fulltext search */
  $handler->display->display_options['filters']['search_api_views_fulltext']['id'] = 'search_api_views_fulltext';
  $handler->display->display_options['filters']['search_api_views_fulltext']['table'] = 'search_api_index_published_basic_page_index';
  $handler->display->display_options['filters']['search_api_views_fulltext']['field'] = 'search_api_views_fulltext';
  $handler->display->display_options['filters']['search_api_views_fulltext']['exposed'] = TRUE;
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['operator_id'] = 'search_api_views_fulltext_op';
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['label'] = 'Search';
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['operator'] = 'search_api_views_fulltext_op';
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['identifier'] = 'search';
  $handler->display->display_options['filters']['search_api_views_fulltext']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
  );
  $handler->display->display_options['filters']['search_api_views_fulltext']['fields'] = array(
    'title' => 'title',
    'body:value' => 'body:value',
  );
  /* Filter criterion: Indexed Node: Tags */
  $handler->display->display_options['filters']['field_tags']['id'] = 'field_tags';
  $handler->display->display_options['filters']['field_tags']['table'] = 'search_api_index_published_basic_page_index';
  $handler->display->display_options['filters']['field_tags']['field'] = 'field_tags';
  $handler->display->display_options['filters']['field_tags']['operator'] = '>=';
  $handler->display->display_options['filters']['field_tags']['value'] = 'kb';
  $handler->display->display_options['path'] = 'help/search';

  $export['epe_knowledge_base_search'] = $view;

  $view = new view();
  $view->name = 'epe_help_sections';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'EPE Knowledge Base Sections';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'EPE Knowledge Base';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '5';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    1 => '1',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: KB Index */
  $handler = $view->new_display('block', 'KB Index', 'kb');

  /* Display: CM Index */
  $handler = $view->new_display('block', 'CM Index', 'cm');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Concept Map Knowledge Base';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    3 => '3',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: DB Index */
  $handler = $view->new_display('block', 'DB Index', 'db');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Resources Knowledge Base';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    5 => '5',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: EV Index */
  $handler = $view->new_display('block', 'EV Index', 'ev');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Visualization Knowledge Base';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    2 => '2',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: LLB Index */
  $handler = $view->new_display('block', 'LLB Index', 'llb');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Lab Lessons Knowledge Base';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    4 => '4',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: WP Index */
  $handler = $view->new_display('block', 'WP Index', 'wp');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Web Portal Knowledge Base';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    6 => '6',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: KB_page */
  $handler = $view->new_display('block', 'KB_page', 'kb_page');
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;

  /* Display: CM Page */
  $handler = $view->new_display('block', 'CM Page', 'cm_page');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Concept Map Knowledge Base';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    3 => '3',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: DB Page */
  $handler = $view->new_display('block', 'DB Page', 'db_page');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Resources Knowledge Base';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    5 => '5',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: EV Page */
  $handler = $view->new_display('block', 'EV Page', 'ev_page');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Visualization Knowledge Base';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    2 => '2',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: LLB Page */
  $handler = $view->new_display('block', 'LLB Page', 'llb_page');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Lab Lessons Knowledge Base';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    4 => '4',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  /* Display: WP Page */
  $handler = $view->new_display('block', 'WP Page', 'wp_page');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'EPE Web Portal Knowledge Base';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = '';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );
  /* Filter criterion: Content: Tags (field_tags) */
  $handler->display->display_options['filters']['field_tags_tid']['id'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['table'] = 'field_data_field_tags';
  $handler->display->display_options['filters']['field_tags_tid']['field'] = 'field_tags_tid';
  $handler->display->display_options['filters']['field_tags_tid']['value'] = array(
    6 => '6',
  );
  $handler->display->display_options['filters']['field_tags_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_tags_tid']['vocabulary'] = 'tags';

  $export['epe_help_sections'] = $view;

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
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Past Year';
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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
    'image_resource' => 'image_resource',
  );

  /* Display: Viz Monthly */
  $handler = $view->new_display('block', 'Viz Monthly', 'vizmonth');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Visualization This Month';
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
  $handler->display->display_options['fields']['count']['label'] = 'Views Past Month';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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

  /* Display: Viz Yearly */
  $handler = $view->new_display('block', 'Viz Yearly', 'vizyear');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Visualization This Year';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Past Year';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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

  /* Display: Image Yearly */
  $handler = $view->new_display('block', 'Image Yearly', 'imgyear');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Images This Year';

  /* Display: Image Monthly */
  $handler = $view->new_display('block', 'Image Monthly', 'imgmonth');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Images This Month';
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
  $handler->display->display_options['fields']['count']['label'] = 'Past Month';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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
    'image_resource' => 'image_resource',
  );

  /* Display: Doc Monthly */
  $handler = $view->new_display('block', 'Doc Monthly', 'docmonth');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Documents This Month';
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
  $handler->display->display_options['fields']['count']['label'] = 'Past Month';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_value']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'document_resource' => 'document_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: Doc Yearly */
  $handler = $view->new_display('block', 'Doc Yearly', 'docyear');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Documents This Year';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Past Year';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_value']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'document_resource' => 'document_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: Multimedia Monthly */
  $handler = $view->new_display('block', 'Multimedia Monthly', 'multimonth');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Multimedia This Month';
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
  $handler->display->display_options['fields']['count']['label'] = 'Past Month';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_value']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'audio_resource' => 'audio_resource',
    'video_resource' => 'video_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: Multimedia Yearly */
  $handler = $view->new_display('block', 'Multimedia Yearly', 'multiyear');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Multimedia This Year';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count']['id'] = 'count';
  $handler->display->display_options['fields']['count']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count']['field'] = 'count';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_value']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'audio_resource' => 'audio_resource',
    'video_resource' => 'video_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: CM Monthly */
  $handler = $view->new_display('block', 'CM Monthly', 'cmonth');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Concept Maps This Month';
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
  $handler->display->display_options['fields']['count']['label'] = 'Past Month';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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
    'cm_resource' => 'cm_resource',
  );

  /* Display: CM Yearly */
  $handler = $view->new_display('block', 'CM Yearly', 'cmyear');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Concept Maps This Year';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Past Year';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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
    'cm_resource' => 'cm_resource',
  );

  /* Display: Resource stats */
  $handler = $view->new_display('block', 'Resource stats', 'node_stats');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '<none>';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Page View Past Year';
  /* Field: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['fields']['count']['id'] = 'count';
  $handler->display->display_options['fields']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['fields']['count']['field'] = 'count';
  $handler->display->display_options['fields']['count']['label'] = 'Page View Past Month';
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_2']['id'] = 'count_2';
  $handler->display->display_options['fields']['count_2']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_2']['field'] = 'count';
  $handler->display->display_options['fields']['count_2']['label'] = 'Page View All Time';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  /* Contextual filter: Content: Nid */
  $handler->display->display_options['arguments']['nid']['id'] = 'nid';
  $handler->display->display_options['arguments']['nid']['table'] = 'node';
  $handler->display->display_options['arguments']['nid']['field'] = 'nid';
  $handler->display->display_options['arguments']['nid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['nid']['default_argument_type'] = 'node';
  $handler->display->display_options['arguments']['nid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['nid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['nid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  $handler->display->display_options['block_description'] = 'Resource statistics';

  /* Display: Viz All Time */
  $handler = $view->new_display('block', 'Viz All Time', 'vizall');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Visualization All Time';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Page Views All Time';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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

  /* Display: Image All Time */
  $handler = $view->new_display('block', 'Image All Time', 'imgall');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Images All Time';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
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
    'image_resource' => 'image_resource',
  );

  /* Display: Doc All Time */
  $handler = $view->new_display('block', 'Doc All Time', 'docall');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Documents All Time';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_value']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'document_resource' => 'document_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: Multimedia All Time */
  $handler = $view->new_display('block', 'Multimedia All Time', 'multiall');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Multimedia All Time';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_value']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'audio_resource' => 'audio_resource',
    'video_resource' => 'video_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: CM All Time */
  $handler = $view->new_display('block', 'CM All Time', 'cmall');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Concept Maps All Time';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
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
    'cm_resource' => 'cm_resource',
  );

  /* Display: DIS All Time */
  $handler = $view->new_display('block', 'DIS All Time', 'disall');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Data Investigation All Time';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
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

  /* Display: DIS Monthly */
  $handler = $view->new_display('block', 'DIS Monthly', 'dismonth');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Data Investigation This Month';
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
  $handler->display->display_options['fields']['count']['label'] = 'Views Past Month';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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

  /* Display: DIS Yearly */
  $handler = $view->new_display('block', 'DIS Yearly', 'disyear');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Data Investigation This Year';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Past Year';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
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

  /* Display: Web Monthly */
  $handler = $view->new_display('block', 'Web Monthly', 'block_1');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Web Resource This Month';
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
  $handler->display->display_options['fields']['count']['label'] = 'Past Month';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 31 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_month';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_value']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'web_resource' => 'web_resource',
  );

  /* Display: Web Yearly */
  $handler = $view->new_display('block', 'Web Yearly', 'block_2');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Web ResourcesThis Year';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['fields']['count_1']['label'] = 'Past Year';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views in the past 365 days */
  $handler->display->display_options['sorts']['count']['id'] = 'count';
  $handler->display->display_options['sorts']['count']['table'] = 'ga_stats_count_pageviews_year';
  $handler->display->display_options['sorts']['count']['field'] = 'count';
  $handler->display->display_options['sorts']['count']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['filter_groups']['operator'] = 'OR';
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Public Status (field_public_status) */
  $handler->display->display_options['filters']['field_public_status_value']['id'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['table'] = 'field_data_field_public_status';
  $handler->display->display_options['filters']['field_public_status_value']['field'] = 'field_public_status_value';
  $handler->display->display_options['filters']['field_public_status_value']['value'] = array(
    'Public' => 'Public',
  );
  $handler->display->display_options['filters']['field_public_status_value']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'web_resource' => 'web_resource',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: Web All Time */
  $handler = $view->new_display('block', 'Web All Time', 'block_3');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top 25 Web Resources All Time';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Statistics: Page Views since 2005 began */
  $handler->display->display_options['fields']['count_1']['id'] = 'count_1';
  $handler->display->display_options['fields']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['fields']['count_1']['field'] = 'count';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Statistics: Page Views since 2005 began */
  $handler->display->display_options['sorts']['count_1']['id'] = 'count_1';
  $handler->display->display_options['sorts']['count_1']['table'] = 'ga_stats_count_pageviews_forever';
  $handler->display->display_options['sorts']['count_1']['field'] = 'count';
  $handler->display->display_options['sorts']['count_1']['order'] = 'DESC';
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
    'web_resource' => 'web_resource',
  );

  $export['resource_statistics'] = $view;

  return $export;
}
