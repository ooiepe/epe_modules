<?php

/**
 * Define the fields for our content type.
 *
 * This big array is factored into this function for readability.
 *
 * @return
 *  An associative array specifying the fields we wish to add to our
 *  new node type.
 */
function _image_resource_installed_fields() {
  $fields = array();

  $fields['node-image_resource-body'] = array(
    'active' => '1',
    'cardinality' => '1',
    'deleted' => '0',
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
    'locked' => '0',
    'module' => 'text',
    'settings' => array(),
    'translatable' => '0',
    'type' => 'text_with_summary',
  );

  $fields['node-image_resource-field_image_resource_file'] = array(
    'active' => '1',
    'cardinality' => '1',
    'deleted' => '0',
    'entity_types' => array(),
    'field_name' => 'field_image_resource_file',
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
    'locked' => '0',
    'module' => 'image',
    'settings' => array(
      'default_image' => 0,
      'uri_scheme' => 'private',
    ),
    'translatable' => '0',
    'type' => 'image',
  );

  $fields['field_featured_status'] = array(
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

  $fields['field_public_status'] = array(
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

  return $fields;
}
