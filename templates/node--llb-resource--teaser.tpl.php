<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<!--
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page && $title): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <?php if ($display_submitted): ?>
      <span class="submitted">
        <?php print $user_picture; ?>
        <?php print $submitted; ?>
      </span>
    <?php endif; ?>
  </header>
-->




<?php
  include realpath(drupal_get_path('theme','bootstrap')) . '/templates/viewpage.tpl.php';
?>

<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
  ?>
  <div>
    <div class="span7">
      <?php echo render($content['body']); ?>
    </div>
    <div class="span5">
      <div class="pull-right">
        <p>
          <?php //echo render($content['field_challenge_thumbnail']);
            $thumbnail = array('style_name' => 'llb_teaser_view', 'path' => $content['field_challenge_thumbnail']['#items'][0]['uri'], 'alt' => '', 'title' => '', 'attributes' => array('class'=>'img-polaroid'));
            echo theme('image_style', $thumbnail);
          ?>
        </p>
      </div>
      <p class="pull-right">
        <a href="<?php echo base_path() . 'node/' . arg(1); ?>/instructor" class="btn btn-primary">Instructor Notes <i class="icon-chevron-right icon-white"></i></a>
        &nbsp;&nbsp;&nbsp;
        <a href="<?php echo base_path() . 'node/' . arg(1); ?>/detail" class="btn btn-primary">Begin this investigation <i class="icon-chevron-right icon-white"></i></a>
      </p>
    </div>
  </div>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</div>
</div>

</article> <!-- /.node -->
