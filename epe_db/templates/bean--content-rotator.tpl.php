<?php
/**
 * @file
 * Default theme implementation for beans.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) entity label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-{ENTITY_TYPE}
 *   - {ENTITY_TYPE}-{BUNDLE}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <div id="carousel-content-rotator" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <?php
          $content_rotator_bean = bean_load($content['field_rotator_content_fields']['#object']->bid);
          $bean_wrapper = entity_metadata_wrapper('bean', $content_rotator_bean);
          foreach($content['field_rotator_content_fields']['#items'] as $key=>$val):
            $raw_collection = $bean_wrapper->field_rotator_content_fields[$key]->value();
            $collection = entity_metadata_wrapper('field_collection_item', $raw_collection);
            $rotator_image = $collection->field_rotator_content_image->value();
            $rotator_caption = $collection->field_rotator_content_caption->value();
            $rotator_url = $collection->field_rotator_content_url->value();
            $classes = array('item');
            if($key == 0) $classes[] = 'active';
        ?>
        <div class="<?php echo implode(' ', $classes); ?>">
          <?php 
            if(drupal_is_front_page()) {
              $style_name = 'homepage_content_rotator_image';
            } else {
              $style_name = 'content_rotator_image';
            }
            $rotator_image = array('style_name' => $style_name, 'path' => $rotator_image['uri'], 'alt' => $rotator_image['alt'], 'title' => $rotator_image['title']);
            $rotator_image_output = theme('image_style', $rotator_image);
          ?>    
          <?php if($rotator_url) { ?>
          <?php //echo l('<img src="' . file_create_url($rotator_image['uri']) . '" alt="' . $rotator_image['alt'] . '">', $rotator_url, array('html'=>true)); ?>
          <?php 
            if($rotator_url) $rotator_image_output = '<a href="' . $rotator_url['url'] . '" title="' . $rotator_url['title'] . '">' . $rotator_image_output . '</a>';
            echo $rotator_image_output;
          ?>
          <?php } else { ?>          
          <?php echo $rotator_image_output; ?>
          <?php } ?>
          <div class="carousel-caption">
            <?php echo $rotator_caption; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <ol class="carousel-indicators">
        <?php foreach($content['field_rotator_content_fields']['#items'] as $key=>$val): ?>
        <li data-target="#carousel-content-rotator" data-slide-to="<?php echo $key; ?>" <?php if($key == 0): echo 'class="active"'; endif; ?>></li>
        <?php endforeach; ?>
      </ol>

      <!-- Controls -->
      <a class="carousel-control left" href="#carousel-content-rotator" data-slide="prev">&lsaquo;</a>
      <a class="carousel-control right" href="#carousel-content-rotator" data-slide="next">&rsaquo;</a>
    </div>
  </div>
</div>
