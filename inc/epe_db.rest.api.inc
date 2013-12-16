<?php

function epe_db_node_lookup() {
  $cm = array();
  $images = array();
  $videos = array();
  $viz = array();
  $docs = array();
  $lessons = array();
  $output = '';

  if($_GET['xml']) {
    $xml = new SimpleXMLElement($_GET['xml']);
    foreach($xml as $collection) {
      if($collection && $collection->node['id']) {
      foreach ($collection as $element) {
        $nid = (string)$element['id'];
        $node = node_load($nid);
        if($node) {
          $item = array();
          $wrapper = entity_metadata_wrapper('node',$node);
          $item['id'] = $wrapper->getIdentifier();
          $item['title'] = $wrapper->label();
          $item['longdesc'] = '';
          if($wrapper->body->value()) {
            $item['longdesc'] = $wrapper->body->value->value(array('sanitize' => TRUE));
          }
          $item['url'] = "node/{$wrapper->getIdentifier()}";
          $item['authorid'] = $wrapper->author->uid->value();
          $item['author_name'] = $wrapper->author->field_account_fname->value() . ' ' . $wrapper->author->field_account_lname->value();
          $item['changed'] = $wrapper->changed->value();
          $item['modified'] = gmdate("Y-m-d H:i:s", $wrapper->changed->value());
          switch($wrapper->getBundle()) {
            case 'llb_resource':
              $file = $wrapper->field_challenge_thumbnail->value();
              if($file) $item['img'] = file_create_url($file['uri']);
              $lessons[] = $item;
            break;
            case 'image_resource':
              $file = $wrapper->field_image_resource_file->value();
              if($file) $item['img'] = file_create_url($file['uri']);
              $images[] = $item;
            break;
            case 'document_resource':
              $file = $wrapper->field_document_resource_file->value();
              if($file) $item['file'] = file_create_url($file['uri']);
              $docs[] = $item;
            break;
            case 'video_resource':
              $field = field_get_items('node', $node, 'field_video_resource_file');
              if($field) {
                $item['file'] = file_create_url($field[0]['uri']);
                if($field[0]['thumbnailfile']) {
                  $item['img'] = file_create_url($field[0]['thumbnailfile']->uri);
                }
              }
              $videos[] = $item;
            case 'cm_resource':
              $cm[] = $item;
            break;
            case 'ev_tool_instance':
              $viz[] = $item;
            break;
          }
        }
      }
      }
    }

    if(!empty($cm)) {
      $output .= '<conceptmaps>';
      foreach($cm as $item) {
        $output .= '<node id="' . $item['id'] . '" datemodified="' . $item['modified'] . '" datemodifiedepoch="' . $item['changed'] . '">';
        $output .= '<title><![CDATA[' . $item['title'] . ']]></title>';
        $output .= '<longDesc><![CDATA[' . $item['longdesc'] . ']]></longDesc>';
        $output .= '<author id="' . $item['authorid'] . '"><![CDATA[' . $item['author_name'] . ']]></author></node>';
      }
      $output .= '</conceptmaps>';
    } else { $output .= '<conceptmaps />'; }

    if(!empty($images)) {
      $output .= '<images>';
      foreach($images as $item) {
        $output .= '<node id="' . $item['id'] . '" img="' . $item['img'] . '" url="' . $item['url'] . '">';
        $output .= '<title><![CDATA[' . $item['title'] . ']]></title>';
        $output .= '<longDesc><![CDATA[' . $item['longdesc'] . ']]></longDesc>';
        $output .= '<author id="' . $item['authorid'] . '"><![CDATA[' . $item['author_name'] . ']]></author></node>';
      }
      $output .= '</images>';
    } else { $output .= '<images />'; }

    if(!empty($docs)) {
      $output .= '<docs>';
      foreach($docs as $item) {
        $output .= '<node id="' . $item['id'] . '" url="' . $item['url'] . '">';
        $output .= '<title><![CDATA[' . $item['title'] . ']]></title>';
        $output .= '<longDesc><![CDATA[' . $item['longdesc'] . ']]></longDesc>';
        $output .= '<author id="' . $item['authorid'] . '"><![CDATA[' . $item['author_name'] . ']]></author></node>';
      }
      $output .= '</docs>';
    } else { $output .= '<docs />'; }

    if(!empty($videos)) {
      $output .= '<videos>';
      foreach($videos as $item) {
        $output .= '<node id="' . $item['id'] . '" img="' . $item['img'] . '" source="' . $item['file'] . '" url="' . $item['url'] . '">';
        $output .= '<title><![CDATA[' . $item['title'] . ']]></title>';
        $output .= '<longDesc><![CDATA[' . $item['longdesc'] . ']]></longDesc>';
        $output .= '<author id="' . $item['authorid'] . '"><![CDATA[' . $item['author_name'] . ']]></author></node>';
      }
      $output .= '</videos>';
    } else { $output .= '<videos />'; }

    if(!empty($viz)) {
      $output .= '<visualizations>';
      foreach($viz as $item) {
        $output .= '<node id="' . $item['id'] . '" url="' . $item['url'] . '">';
        $output .= '<title><![CDATA[' . $item['title'] . ']]></title>';
        $output .= '<longDesc><![CDATA[' . $item['longdesc'] . ']]></longDesc>';
        $output .= '<author id="' . $item['authorid'] . '"><![CDATA[' . $item['author_name'] . ']]></author></node>';
      }
      $output .= '</visualizations>';
    } else { $output .= '<visualizations />'; }

    if(!empty($lessons)) {
      $output .= '<lessons>';
      foreach($lessons as $item) {
        $output .= '<node id="' . $item['id'] . '" url="' . $item['url'] . '">';
        $output .= '<title><![CDATA[' . $item['title'] . ']]></title>';
        $output .= '<longDesc><![CDATA[' . $item['longdesc'] . ']]></longDesc>';
        $output .= '<author id="' . $item['authorid'] . '"><![CDATA[' . $item['author_name'] . ']]></author></node>';
      }
      $output .= '</lessons>';
    } else { $output .= '<lessons />'; }
  }
  echo '<xml>' . $output . '</xml>';
}
