<?php
/**
 * Implements hook_field_default_field_bases().
 */
function _cm_resource_installed_fields() {
  $field_bases = array();

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


  return $field_bases;
}
