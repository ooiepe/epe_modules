<?php

/**
 * Implements hook_field_default_field_instances().
 */
function _ev_tool_installed_instances() {
  $field_instances = array();

  // Exported field_instance: 'node-ev_tool-field_tool_author'
  $field_instances['node-ev_tool-field_tool_author'] = array(
    'bundle' => 'ev_tool',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 3,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_tool_author',
    'label' => 'Tool Author',
    'required' => 0,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => 3,
    ),
  );

  $field_instances['node-ev_tool-body'] = array(
    'bundle' => 'ev_tool',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 0,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'trim_length' => 600,
        ),
        'type' => 'text_summary_or_trimmed',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'body',
    'label' => 'Description',
    'required' => 0,
    'settings' => array(
      'better_formats' => array(
        'allowed_formats' => array(
          'filtered_html' => 'filtered_html',
          'full_html' => 0,
          'plain_text' => 0,
        ),
        'allowed_formats_toggle' => 1,
        'default_order_toggle' => 0,
        'default_order_wrapper' => array(
          'formats' => array(
            'filtered_html' => array(
              'weight' => 0,
            ),
            'full_html' => array(
              'weight' => 1,
            ),
            'plain_text' => array(
              'weight' => 10,
            ),
          ),
        ),
      ),
      'display_summary' => 0,
      'text_processing' => 1,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'rows' => 20,
        'summary_rows' => 5,
      ),
      'type' => 'text_textarea_with_summary',
      'weight' => -4,
    ),
  );

  // // Exported field_instance: 'node-ev_tool-field_tool_description'
  // $field_instances['node-ev_tool-field_tool_description'] = array(
  //   'bundle' => 'ev_tool',
  //   'default_value' => NULL,
  //   'deleted' => 0,
  //   'description' => '',
  //   'display' => array(
  //     'default' => array(
  //       'label' => 'above',
  //       'module' => 'text',
  //       'settings' => array(),
  //       'type' => 'text_default',
  //       'weight' => 6,
  //     ),
  //     'teaser' => array(
  //       'label' => 'above',
  //       'settings' => array(),
  //       'type' => 'hidden',
  //       'weight' => 0,
  //     ),
  //   ),
  //   'entity_type' => 'node',
  //   'field_name' => 'field_tool_description',
  //   'label' => 'Tool Description',
  //   'required' => 0,
  //   'settings' => array(
  //     'display_summary' => 0,
  //     'text_processing' => 1,
  //     'user_register_form' => FALSE,
  //   ),
  //   'widget' => array(
  //     'active' => 1,
  //     'module' => 'text',
  //     'settings' => array(
  //       'rows' => 20,
  //       'summary_rows' => 5,
  //     ),
  //     'type' => 'text_textarea_with_summary',
  //     'weight' => 6,
  //   ),
  // );

  // Exported field_instance: 'node-ev_tool-field_tool_last_modified'
  $field_instances['node-ev_tool-field_tool_last_modified'] = array(
    'bundle' => 'ev_tool',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 4,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_tool_last_modified',
    'label' => 'Last Modified',
    'required' => 0,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => 5,
    ),
  );

  // Exported field_instance: 'node-ev_tool-field_tool_name'
  $field_instances['node-ev_tool-field_tool_name'] = array(
    'bundle' => 'ev_tool',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 5,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_tool_name',
    'label' => 'Tool Name',
    'required' => 1,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => 1,
    ),
  );

  // Exported field_instance: 'node-ev_tool-field_tool_thumbnail'
  $field_instances['node-ev_tool-field_tool_thumbnail'] = array(
    'bundle' => 'ev_tool',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'image',
        'settings' => array(
          'image_link' => '',
          'image_style' => '',
        ),
        'type' => 'image',
        'weight' => 2,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_tool_thumbnail',
    'label' => 'Tool Thumbnail',
    'required' => 1,
    'settings' => array(
      'alt_field' => 0,
      'default_image' => 0,
      'file_directory' => '[current-user:uid]/ev_tool',
      'file_extensions' => 'png gif jpg jpeg',
      'max_filesize' => '',
      'max_resolution' => '',
      'min_resolution' => '',
      'title_field' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'image',
      'settings' => array(
        'preview_image_style' => 'thumbnail',
        'progress_indicator' => 'throbber',
      ),
      'type' => 'image_image',
      'weight' => 4,
    ),
  );

  return $field_instances;
}



/**
 * Implements hook_field_default_field_instances().
 */
function _epe_ev_tool_instance_installed_instances() {
  $field_instances = array();

  // Exported field_instance: 'node-ev_tool_instance-field_instance_configuration'
  $field_instances['node-ev_tool_instance-field_instance_configuration'] = array(
    'bundle' => 'ev_tool_instance',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 6,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_instance_configuration',
    'label' => 'Instance Configuration',
    'required' => 1,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'rows' => 5,
      ),
      'type' => 'text_textarea',
      'weight' => 5,
    ),
  );

  $field_instances['node-ev_tool_instance-body'] = array(
    'bundle' => 'ev_tool_instance',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 0,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'trim_length' => 600,
        ),
        'type' => 'text_summary_or_trimmed',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'body',
    'label' => 'Description',
    'required' => 0,
    'settings' => array(
      'better_formats' => array(
        'allowed_formats' => array(
          'filtered_html' => 'filtered_html',
          'full_html' => 0,
          'plain_text' => 0,
        ),
        'allowed_formats_toggle' => 1,
        'default_order_toggle' => 0,
        'default_order_wrapper' => array(
          'formats' => array(
            'filtered_html' => array(
              'weight' => 0,
            ),
            'full_html' => array(
              'weight' => 1,
            ),
            'plain_text' => array(
              'weight' => 10,
            ),
          ),
        ),
      ),
      'display_summary' => 0,
      'text_processing' => 1,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'rows' => 20,
        'summary_rows' => 5,
      ),
      'type' => 'text_textarea_with_summary',
      'weight' => -4,
    ),
  );

  // // Exported field_instance: 'node-ev_tool_instance-field_instance_description'
  // $field_instances['node-ev_tool_instance-field_instance_description'] = array(
  //   'bundle' => 'ev_tool_instance',
  //   'default_value' => NULL,
  //   'deleted' => 0,
  //   'description' => '',
  //   'display' => array(
  //     'default' => array(
  //       'label' => 'above',
  //       'module' => 'text',
  //       'settings' => array(),
  //       'type' => 'text_default',
  //       'weight' => 8,
  //     ),
  //     'teaser' => array(
  //       'label' => 'above',
  //       'settings' => array(),
  //       'type' => 'hidden',
  //       'weight' => 0,
  //     ),
  //   ),
  //   'entity_type' => 'node',
  //   'field_name' => 'field_instance_description',
  //   'label' => 'Instance Description',
  //   'required' => 0,
  //   'settings' => array(
  //     'display_summary' => 0,
  //     'text_processing' => 1,
  //     'user_register_form' => FALSE,
  //   ),
  //   'widget' => array(
  //     'active' => 1,
  //     'module' => 'text',
  //     'settings' => array(
  //       'rows' => 20,
  //       'summary_rows' => 5,
  //     ),
  //     'type' => 'text_textarea_with_summary',
  //     'weight' => 3,
  //   ),
  // );

  // Exported field_instance: 'node-ev_tool_instance-field_instance_questions'
  $field_instances['node-ev_tool_instance-field_instance_questions'] = array(
    'bundle' => 'ev_tool_instance',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 7,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_instance_questions',
    'label' => 'Investigation Questions',
    'required' => 0,
    'settings' => array(
      'better_formats' => array(
        'allowed_formats' => array(
          'filtered_html' => 'filtered_html',
          'full_html' => 0,
          'plain_text' => 0,
        ),
        'allowed_formats_toggle' => 1,
        'default_order_toggle' => 0,
        'default_order_wrapper' => array(
          'formats' => array(
            'filtered_html' => array(
              'weight' => 0,
            ),
            'full_html' => array(
              'weight' => 1,
            ),
            'plain_text' => array(
              'weight' => 10,
            ),
          ),
        ),
      ),
      'display_summary' => 0,
      'text_processing' => 1,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'rows' => 20,
        'summary_rows' => 5,
      ),
      'type' => 'text_textarea_with_summary',
      'weight' => 4,
    ),
  );

  // Exported field_instance: 'node-ev_tool_instance-field_instance_thumbnail'
  $field_instances['node-ev_tool_instance-field_instance_thumbnail'] = array(
    'bundle' => 'ev_tool_instance',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'image',
        'settings' => array(
          'image_link' => '',
          'image_style' => '',
        ),
        'type' => 'image',
        'weight' => 9,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_instance_thumbnail',
    'label' => 'Thumbnail',
    'required' => 0,
    'settings' => array(
      'alt_field' => 0,
      'default_image' => 0,
      'file_directory' => '[current-user:uid]/ev_tool_instance',
      'file_extensions' => 'png gif jpg jpeg',
      'max_filesize' => '',
      'max_resolution' => '',
      'min_resolution' => '',
      'title_field' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'image',
      'settings' => array(
        'preview_image_style' => 'thumbnail',
        'progress_indicator' => 'throbber',
      ),
      'type' => 'image_image',
      'weight' => 2,
    ),
  );

// NEW
// Exported field_instance: 'node-ev_tool_instance-field_parent_tool'
  $field_instances['node-ev_tool_instance-field_parent_tool'] = array(
    'bundle' => 'ev_tool_instance',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 10,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_parent_tool',
    'label' => 'Parent Tool ID',
    'required' => 1,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => 1,
    ),
  );

  // ORIGINAL 'node-ev_tool_instance-field_parent_tool'

  // // Exported field_instance: 'node-ev_tool_instance-field_parent_tool'
  // $field_instances['node-ev_tool_instance-field_parent_tool'] = array(
  //   'bundle' => 'ev_tool_instance',
  //   'default_value' => NULL,
  //   'deleted' => 0,
  //   'description' => '',
  //   'display' => array(
  //     'default' => array(
  //       'label' => 'above',
  //       'module' => 'entityreference',
  //       'settings' => array(
  //         'link' => FALSE,
  //       ),
  //       'type' => 'entityreference_label',
  //       'weight' => 10,
  //     ),
  //     'teaser' => array(
  //       'label' => 'above',
  //       'settings' => array(),
  //       'type' => 'hidden',
  //       'weight' => 0,
  //     ),
  //   ),
  //   'entity_type' => 'node',
  //   'field_name' => 'field_parent_tool',
  //   'label' => 'Parent Tool',
  //   'required' => 1,
  //   'settings' => array(
  //     'user_register_form' => FALSE,
  //   ),
  //   'widget' => array(
  //     'active' => 1,
  //     'module' => 'options',
  //     'settings' => array(),
  //     'type' => 'options_select',
  //     'weight' => 1,
  //   ),
  // );

// Exported field_instance: 'node-ev_tool_instance-field_featured_status'
  $field_instances['node-ev_tool_instance-field_featured_status'] = array(
    'bundle' => 'ev_tool_instance',
    'default_value' => array(
      0 => array(
        'value' => 'Not-Featured',
      ),
    ),
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'list',
        'settings' => array(),
        'type' => 'list_default',
        'weight' => 3,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_featured_status',
    'label' => 'Featured Status',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(),
      'type' => 'options_select',
      'weight' => -1,
    ),
  );

  // Exported field_instance: 'node-ev_tool_instance-field_public_status'
  $field_instances['node-ev_tool_instance-field_public_status'] = array(
    'bundle' => 'ev_tool_instance',
    'default_value' => array(
      0 => array(
        'value' => 'Private',
      ),
    ),
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'list',
        'settings' => array(),
        'type' => 'list_default',
        'weight' => 2,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_public_status',
    'label' => 'Public Status',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(),
      'type' => 'options_select',
      'weight' => -2,
    ),
  );



  return $field_instances;
}
