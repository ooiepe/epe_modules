<?php

/**
 * Implements hook_field_default_field_bases().
 */
function _ev_tool_instance_installed_fields() {
  $field_bases = array();

  // Exported field_base: 'field_instance_configuration'
  $field_bases['field_instance_configuration'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_instance_configuration',
    'foreign keys' => array(
      'format' => array(
        'columns' => array(
          'format' => 'format',
        ),
        'table' => 'filter_format',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(),
    'translatable' => 0,
    'type' => 'text_long',
  );

  // // Exported field_base: 'field_instance_description'
  // $field_bases['field_instance_description'] = array(
  //   'active' => 1,
  //   'cardinality' => 1,
  //   'deleted' => 0,
  //   'entity_types' => array(),
  //   'field_name' => 'field_instance_description',
  //   'foreign keys' => array(
  //     'format' => array(
  //       'columns' => array(
  //         'format' => 'format',
  //       ),
  //       'table' => 'filter_format',
  //     ),
  //   ),
  //   'indexes' => array(
  //     'format' => array(
  //       0 => 'format',
  //     ),
  //   ),
  //   'locked' => 0,
  //   'module' => 'text',
  //   'settings' => array(),
  //   'translatable' => 0,
  //   'type' => 'text_with_summary',
  // );

  // Exported field_base: 'body'
  $field_bases['body'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(
      0 => 'node',
    ),
    'field_name' => 'body',
    'foreign keys' => array(
      'format' => array(
        'columns' => array(
          'format' => 'format',
        ),
        'table' => 'filter_format',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(),
    'translatable' => 0,
    'type' => 'text_with_summary',
  );

  // Exported field_base: 'field_instance_questions'
  $field_bases['field_instance_questions'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_instance_questions',
    'foreign keys' => array(
      'format' => array(
        'columns' => array(
          'format' => 'format',
        ),
        'table' => 'filter_format',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(),
    'translatable' => 0,
    'type' => 'text_with_summary',
  );

  // Exported field_base: 'field_instance_thumbnail'
  $field_bases['field_instance_thumbnail'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_instance_thumbnail',
    'foreign keys' => array(
      'fid' => array(
        'columns' => array(
          'fid' => 'fid',
        ),
        'table' => 'file_managed',
      ),
    ),
    'indexes' => array(
      'fid' => array(
        0 => 'fid',
      ),
    ),
    'locked' => 0,
    'module' => 'image',
    'settings' => array(
      'default_image' => 5,
      'uri_scheme' => 'public',
    ),
    'translatable' => 0,
    'type' => 'image',
  );



// NEW
  // Exported field_base: 'field_parent_tool'
  $field_bases['field_parent_tool'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_parent_tool',
    'foreign keys' => array(
      'node' => array(
        'columns' => array(
          'target_id' => 'nid',
        ),
        'table' => 'node',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(
      'max_length' => 255,
    ),
    'translatable' => 0,
    'type' => 'text'
  );


// ORIGINAL
//   // Exported field_base: 'field_parent_tool'
//   $field_bases['field_parent_tool'] = array(
//     'active' => 1,
//     'cardinality' => 1,
//     'deleted' => 0,
//     'entity_types' => array(),
//     'field_name' => 'field_parent_tool',
//     'foreign keys' => array(
//       'node' => array(
//         'columns' => array(
//           'target_id' => 'nid',
//         ),
//         'table' => 'node',
//       ),
//     ),
//     'indexes' => array(
//       'target_id' => array(
//         0 => 'target_id',
//       ),
//     ),
//     'locked' => 0,
//     'module' => 'text',
//     'settings' => array(
//       'max_length' => 255,
//     ),
//     'translatable' => 0,
//     'type' => 'entityreference',
//   );



  return $field_bases;
}


/**
 * Implements hook_field_default_field_bases(). // this is a feature specific hook. 
 */
function _epe_ev_tool_installed_fields() {
  $field_bases = array();

  // Exported field_base: 'field_tool_author'
  $field_bases['field_tool_author'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_tool_author',
    'foreign keys' => array(
      'format' => array(
        'columns' => array(
          'format' => 'format',
        ),
        'table' => 'filter_format',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(
      'max_length' => 255,
    ),
    'translatable' => 0,
    'type' => 'text',
  );


  // Exported field_base: 'body'
  $field_bases['body'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(
      0 => 'node',
    ),
    'field_name' => 'body',
    'foreign keys' => array(
      'format' => array(
        'columns' => array(
          'format' => 'format',
        ),
        'table' => 'filter_format',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(),
    'translatable' => 0,
    'type' => 'text_with_summary',
  );

  // // Exported field_base: 'field_tool_description'
  // $field_bases['field_tool_description'] = array(
  //   'active' => 1,
  //   'cardinality' => 1,
  //   'deleted' => 0,
  //   'entity_types' => array(),
  //   'field_name' => 'field_tool_description',
  //   'foreign keys' => array(
  //     'format' => array(
  //       'columns' => array(
  //         'format' => 'format',
  //       ),
  //       'table' => 'filter_format',
  //     ),
  //   ),
  //   'indexes' => array(
  //     'format' => array(
  //       0 => 'format',
  //     ),
  //   ),
  //   'locked' => 0,
  //   'module' => 'text',
  //   'settings' => array(),
  //   'translatable' => 0,
  //   'type' => 'text_with_summary',
  // );

  // Exported field_base: 'field_tool_last_modified'
  $field_bases['field_tool_last_modified'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_tool_last_modified',
    'foreign keys' => array(
      'format' => array(
        'columns' => array(
          'format' => 'format',
        ),
        'table' => 'filter_format',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(
      'max_length' => 255,
    ),
    'translatable' => 0,
    'type' => 'text',
  );

  // Exported field_base: 'field_tool_name'
  $field_bases['field_tool_name'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_tool_name',
    'foreign keys' => array(
      'format' => array(
        'columns' => array(
          'format' => 'format',
        ),
        'table' => 'filter_format',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(
      'max_length' => 255,
    ),
    'translatable' => 0,
    'type' => 'text',
  );

  // Exported field_base: 'field_tool_thumbnail'
  $field_bases['field_tool_thumbnail'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_tool_thumbnail',
    'foreign keys' => array(
      'fid' => array(
        'columns' => array(
          'fid' => 'fid',
        ),
        'table' => 'file_managed',
      ),
    ),
    'indexes' => array(
      'fid' => array(
        0 => 'fid',
      ),
    ),
    'locked' => 0,
    'module' => 'image',
    'settings' => array(
      'default_image' => 4,
      'uri_scheme' => 'public',
    ),
    'translatable' => 0,
    'type' => 'image',
  );


   // Exported field_base: 'field_featured_status'
  $field_bases['field_featured_status'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_featured_status',
    'foreign keys' => array(),
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        'Not-Featured' => 'Not-Featured',
        'Featured' => 'Featured',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

  // Exported field_base: 'field_public_status'
  $field_bases['field_public_status'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_public_status',
    'foreign keys' => array(),
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        'Private' => 'Private',
        'Public' => 'Public',
        'Pending' => 'Pending',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );
  

  return $field_bases;
}
