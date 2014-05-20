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
  $showContent = false;
  include realpath(drupal_get_path('theme','bootstrap')) . '/templates/viewpage.tpl.php';
?>

<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;" class="clearfix">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;" class="clearfix">

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
            if(isset($content['field_challenge_thumbnail']) && $content['field_challenge_thumbnail']) {
              try{
                $thumbnail_node_info = json_decode($content['field_challenge_thumbnail']['#items'][0]['value']);
                foreach($thumbnail_node_info as $info) {
                  $node_info = epe_llb_dataset_query($info);
                  $thumbnail = array('style_name' => 'llb_teaser_view', 'path' => $node_info->uri, 'alt' => '', 'title' => '', 'attributes' => array('class'=>'img-polaroid'));
                  echo theme('image_style', $thumbnail);
                }
              } catch (exception $e) {
                $output = '<img src="' . base_path() . drupal_get_path('theme','bootstrap') . '/images/no_thumb_small.jpg">';
              }
            }
          ?>
        </p>
      </div>
      <p class="pull-right">
        <a href="<?php echo base_path() . 'node/' . arg(1); ?>/instructor" class="btn btn-primary">Instructor Notes <i class="icon-chevron-right icon-white"></i></a>
        &nbsp;
        <a href="<?php echo base_path() . 'node/' . arg(1); ?>/detail" class="btn btn-primary">Begin this Investigation <i class="icon-chevron-right icon-white"></i></a>
      </p>
    </div>
  </div>
  <br clear="all"/>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php //print render($content['links']); ?>
    </footer>
  <?php endif; ?>
  
  <!-- display any places this item is included and any items copied from this item -->
  <?php include realpath(drupal_get_path('module', 'epe_db')) . '/templates/linked_items.tpl.php'; ?>

</div>
</div>

<?php print render($content['comments']); ?>

</article> <!-- /.node -->
