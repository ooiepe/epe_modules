<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>



<?php
  $hideActionButtons = 0;
  $showContent = false;
  $custom_node_detail_url = $GLOBALS['base_url'] . "/node/" . $node->nid . '/detail';
  include realpath(drupal_get_path('theme','epe_theme')) . '/templates/viewpage.tpl.php';
?>

  <!-- <header>
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
  </header> -->


<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">


  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);

    //print render($content);
  ?>
  <!-- datasets data array -->
  <?php $datasets = json_decode($content['field_exploration_dataset']['#items'][0]['value']); ?>
  <?php $intro_slideshow = json_decode($content['field_introductory_slideshow']['#items'][0]['value']); ?>
  <?php $background_slideshow = json_decode($content['field_background_slideshow']['#items'][0]['value']); ?>
  <?php $challenge_thumbnail = json_decode($content['field_challenge_thumbnail']['#items'][0]['value']); ?>

<div class="tabbable">
<ul id="llbnav" class="nav nav-tabs">
  <li class="active"><a href="#intro" data-toggle="tab">Introduction</a></li>
  <li><a href="#background" data-toggle="tab">Background</a></li>
  <li><a href="#challenge" data-toggle="tab">Challenge</a></li>
  <li id="llb2" class="dropdown">
    <a href="#" class="dropdown-toggle" id="exploration_tab" data-toggle="dropdown">Exploration <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="#exploration" data-toggle="tab">Exploration</a></li>
      <?php foreach($datasets as $key => $dataset): ?>
      <li><a href="#dataset<?php echo $key; ?>" data-toggle="tab"><?php echo $dataset->title; ?></a></li>
      <?php endforeach; ?>
    </ul>
  </li>
  <li><a href="#explanation" data-toggle="tab">Explanation</a></li>
</ul>

<div class="tab-content">

<div class="tab-pane active" id="intro">
  <h3>Introduction</h3>
<!--  Carousel - consult the Twitter Bootstrap docs at
      http://twitter.github.com/bootstrap/javascript.html#carousel -->
  <?php if(!empty($content['field_introductory_slideshow'])) {
    echo theme('epe_llb_field_slideshow',array('images'=>$intro_slideshow,'custom_id'=>'intro'));
  } ?>
  <?php echo render($content['field_introductory_content']); ?>

  <?php //echo render($content['field_introductory_slideshow']); ?>

  <button type="button" class="btn btn-success" data-toggle="tab" data-target="background" onclick="jQuery('#llbnav li:eq(1) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>

</div> <!-- /#intro -->

<div class="tab-pane" id="background">
  <h3>Background</h3>
  <div class="pull-right">
    <?php if(!empty($content['field_background_slideshow'])) {
      echo theme('epe_llb_field_slideshow',array('images'=>$background_slideshow,'custom_id'=>'background'));
    } ?>
    <?php //echo render($content['field_background_slideshow']); ?>
  </div>

  <?php echo render($content['field_background_content']); ?>
  <?php
  foreach($content['field_background_question'] as $key => $question) {
    if(is_numeric($key)) {
      echo '<blockquote>';
      echo 'Question ' . ($key+1) .': ' . $question['#markup'];
      echo '</blockquote>';
    }
  }
  ?>

  <button type="button" class="btn btn-success" data-toggle="tab" data-target="challenge" onclick="jQuery('#llbnav li:eq(2) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>

</div> <!-- /#background -->

<div class="tab-pane" id="challenge">
  <h3>Challenge</h3>
  <div class="pull-right">
    <?php if(!empty($content['field_challenge_thumbnail'])) {
      echo theme('epe_llb_field_slideshow',array('images'=>$challenge_thumbnail,'custom_id'=>'thumbnail'));
    } ?>
    <?php /* echo render($content['field_challenge_thumbnail']); */ ?>
  </div>
  <p>In this activity you will investigate the following research challenge...</p>
  <blockquote><?php echo render($content['field_challenge_content']); ?></blockquote>

  <button type="button" class="btn btn-success" data-toggle="tab" data-target="exploration" onclick="jQuery('#llb2 li:eq(0) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#challenge -->

<div class="tab-pane" id="exploration">
  <h3>Explore the Data</h3>
  <p><?php echo render($content['field_guidance_content']); ?></p>
  <ul class="thumbnails">
    <?php foreach($datasets as $key => $dataset): ?>
    <?php
      $li_classes = array('dataset','span4');
      if(($key + 1) % 3 == 1): $li_classes[] = 'first'; endif;
    ?>
    <li class="<?php echo implode(' ', $li_classes); ?>">
      <div class="thumbnail">
        <div class="image">
        <a href="#dataset<?php echo $key; ?>">
        <?php
          if(isset($dataset->uri) && !empty($dataset->uri)) {
            $thumbnail_image = array('style_name' => 'llb_dataset_teaser', 'path' => $dataset->uri, 'alt' => $dataset->title, 'title' => $dataset->title);
            echo theme('image_style', $thumbnail_image);
          }
          elseif(isset($dataset->thumbnail) && !empty($dataset->thumbnail)) {
            echo '<img src="' . $dataset->thumbnail . '" width="270" height="116" alt="' . $dataset->title . '">';
          } else {
            echo '<img src="' . base_path() . drupal_get_path('theme','epe_theme') . '/images/no_thumb_small.jpg" alt="' . $dataset->title . '" title="' . $dataset->title . '">';
          }
        ?>
        </a>
        </div>
        <!-- <a href="#" onclick="jQuery('#llb2 li:eq(<?php echo ($key + 1); ?>) a').tab('show');"><?php echo $dataset->title; ?></a> -->
        <a href="#dataset<?php echo $key; ?>"><?php echo $dataset->title; ?></a>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  <p>When you're done investigating each dataset, continue to the last section.</p>
  <button type="button" class="btn btn-success" data-toggle="tab" data-target="explanation" onclick="jQuery('#llbnav a[href=#explanation]').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div>

<?php
  $filetypes = array();
  $modules = variable_get('EPE_CONTENT_MODULES',array());
  foreach($modules as $module) {
    if(isset($module['resource_type']) && $module['resource_type'] == 'file') {
      $filetypes[] = $module['content_type'];
    }
  }
?>

<?php foreach($datasets as $key => $dataset): ?>
<div class="tab-pane" id="dataset<?php echo $key; ?>">
  <ul class="breadcrumb">
    <li>
      <a href="#exploration">
      Exploration</a> <span class="divider">/</span></li>
    <li class="active"><?php echo $dataset->title; ?></li>
  </ul>
  <h3><?php echo $dataset->title; ?></h3>
<p>
  <?php
  switch($dataset->type) {

    case 'text':
    //do nothing
    break;

    case 'cm_resource':
      $cm_resource = node_load($dataset->nid);
      $field_cm_data_items = field_get_items('node', $cm_resource, 'field_cm_data');
      $field_cm_data = field_view_value('node',$cm_resource,'field_cm_data', $field_cm_data_items[0]);
      $field_out = render($field_cm_data);
  ?>
    <div style="margin-bottom: 10px;">
      <!-- <div id="flashcontent"><p>Please update your Flash Player</p></div> -->
       <iframe class="cmembed" width="100%" height="424" src="<?php echo base_path(); ?>node/<?php echo $dataset->nid; ?>/cmembed" frameborder="0" allowfullscreen></iframe>
    </div>
    <textarea id="conceptMapContents" name="conceptMapContents" style="display: none; width:500px; height:100px;"><?php echo $field_out ?></textarea>
    <div class="clearfix"><a href="<?php echo base_path() ?>node/<?php echo $dataset->nid; ?>" class="pull-right">View Resource Page</a></div>
  <?php
    break;

    case 'ev_tool_instance':
  ?>
  <iframe class="ev_tool_instance" frameborder="0" width="100%" height="500" src="<?php echo base_path(); ?>ev/embed/id/<?php echo $dataset->nid ?>"></iframe>
  <div class="clearfix"><a href="<?php echo base_path() ?>node/<?php echo $dataset->nid; ?>" class="pull-right">View Resource Page</a></div>
  <?php
    break;

    case 'web_resource':
      $height_pattern = "/height=\"[0-9]*\"/";
      $dataset->html = preg_replace($height_pattern, "height='360'", $dataset->html);
      $width_pattern = "/width=\"[0-9]*\"/";
      $dataset->html = preg_replace($width_pattern, "width='886'", $dataset->html);
      $match_pattern = "#<iframe[^>]*>.*?</iframe>#i";
      preg_match_all($match_pattern, $dataset->html, $result);
      echo $result[0][0];
    break;

    default:
      echo epe_llb_theme_file_dataset($dataset);
    break;

  }
  ?>
</p>

  <div class="well well-sm">
    <?php echo $dataset->body; ?>
    <?php
    $credit_output = '';
    if(isset($dataset->credit) && $dataset->credit): $credit_output = trim($dataset->credit); endif;
    if(isset($dataset->source_url) && $dataset->source_url && $credit_output):
    $credit_output = '<a href="' . $dataset->source_url . '" target="_blank">' . $credit_output . '</a>';
  endif;
    if($credit_output): echo 'Credit/Source: ' . $credit_output; endif;
    ?>
  </div>
  <?php if(!empty($dataset->questions)): ?>
  <div>
    <div>
      <h4>Interpretation Questions</h4>
      <ul>
        <?php foreach($dataset->questions as $question): ?>
        <li><?php echo $question->text; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <?php endif; ?>
  <button type="button" class="btn btn-success" data-toggle="tab" data-target="exploration" onclick="jQuery('#llb2 li:eq(0) a').tab('show');">Return to Exploration <i class="icon-chevron-right icon-white"></i></button>
</div>
<?php endforeach; ?>

<div class="tab-pane" id="explanation">
  <h3>Develop an Explanation</h3>

  <div class="row-fluid control-group">
    <div class="span6">
      <?php if(!empty($content['field_challenge_content'])): ?>
      <p>Recall that the research challenge you are trying to address is:</p>
      <div class="control-group">
      <blockquote>
      <?php echo render($content['field_challenge_content']); ?>
      </blockquote>
      </div>
      <?php endif; ?>

      <?php if(!empty($content['field_inference_question'])): ?>
      <p>As you consider the data you just investigated, consider the following questions:</p>
      <div class="control-group">
      <ol>
      <?php
      foreach($content['field_inference_question'] as $key => $question) {
        if(is_numeric($key)) {
          echo '<li>';
          echo $question['#markup'];
          echo '</li>';
        }
      }
      ?>
      </ol>
      </div>
      <?php endif; ?>
    </div>
    <div class="span6">
      <?php if(!empty($content['field_desired_assessment'])): ?>
      <p><strong>Assessment</strong></p>
      <div class="control-group">
      <?php echo render($content['field_desired_assessment']); ?>
      </div>
      <?php endif; ?>
      <?php if(!empty($content['field_explanation_content'])): ?>
      <p><strong>Additional Instructions</strong></p>
      <div class="control-group">
      <?php echo render($content['field_explanation_content']); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div> <!-- /#explanation -->

</div> <!-- /.tab-content -->
</div> <!-- /.tabbable -->

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php //print render($content['field_tags']); ?>
      <?php //print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php //print render($content['comments']); ?>

</div>
</div>

<p><?php echo l('About this Data Investigation', "node/" . arg(1)); ?></p>

</article> <!-- /.node -->
