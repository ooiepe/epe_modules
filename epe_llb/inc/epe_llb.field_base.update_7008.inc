<?php
/**
 * Implements hook_field_default_field_bases().
 */
function _epe_llb_field_default_field_bases() {
  $field_bases = array();

  $field_bases['field_investigation_level'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_investigation_level',
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
        'introduction' => 'Introduction',
        'moderate' => 'Moderate',
        'advanced' => 'Advanced'
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

 $field_bases['field_teaching_mode'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_teaching_mode',
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
        'homework' => 'Homework',
        'in-class-groupwork' => 'In-Class Groupwork',
        'online-course' => 'Online Course',
        'guided-lecture' => 'Guided Lecture'
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

  return $field_bases;
}
