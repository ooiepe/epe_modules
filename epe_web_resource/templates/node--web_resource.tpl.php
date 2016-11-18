<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>




<?php
$isDBFiles = 1;
?>
<?php include realpath(drupal_get_path('theme','epe_theme')) . '/templates/viewpage.tpl.php'; ?>



<div style="border: 1px solid #0195bd;padding:23px;margin-bottom:20px;" class="clearfix">

<style type="text/css">
.field-label {
  display: none;
}
.multimedia.embed {
  position: relative;
  padding-bottom: 56.25%;
  padding-top: 35px;
  height: 0;
  overflow: hidden;
}
.multimedia.embed iframe {
  position: absolute;
  top:0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>
<?php
$wrapper = entity_metadata_wrapper('node', node_load($nid));
$resource_url = $wrapper->field_resource_url->raw();
switch($wrapper->field_resource_origin->raw()) {
  case 'youtube':
    $response = drupal_http_request('http://www.youtube.com/oembed?url=' . $resource_url['display_url'] .'&format=json');
  break;
  case 'vimeo':
    $response = drupal_http_request('http://vimeo.com/api/oembed.json?url=' . $resource_url['url']);
  break;
  case 'slideshare':
    $response = drupal_http_request('http://www.slideshare.net/api/oembed/2?url=' . $resource_url['url'] .'&format=json');
  break;
}
if($response->code == 200) {
  $oembed_data = json_decode($response->data);
  $height_pattern = "/height=\"[0-9]*\"/";
  $oembed_data->html = preg_replace($height_pattern, "height='390'", $oembed_data->html);
  $width_pattern = "/width=\"[0-9]*\"/";
  $oembed_data->html = preg_replace($width_pattern, "width='886'", $oembed_data->html);
  echo '<div class="multimedia embed">' . $oembed_data->html . '</div>';
} else {
  echo '<div class="well error text-center">Embeddable resource not found.  Please contact the OOI EPE Team.</div>';
}

?>

  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    //print render($content);
  ?>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <!-- display any places this item is included and any items copied from this item -->
  <?php include realpath(drupal_get_path('module', 'epe_db')) . '/templates/linked_items.tpl.php'; ?>




  <?php print render($content['comments']); ?>


</div>


</article> <!-- /.node -->
