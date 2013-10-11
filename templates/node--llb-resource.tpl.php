<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>



<?php
include dirname(__FILE__) . '/../../../../../../' . drupal_get_path('theme',$GLOBALS['theme']) . '/templates/viewpage.tpl.php';
?>

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

  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);

    //print render($content);
  ?>
  <!-- datasets data array -->
  <?php $datasets = json_decode($content['field_exploration_dataset']['#items'][0]['value']); ?>

<div class="tabbable">
<ul id="llbnav" class="nav nav-tabs">
  <li class="active"><a href="#intro" data-toggle="tab">Introduction</a></li>
  <li><a href="#background" data-toggle="tab">Problem</a></li>
  <!-- <li><a href="#challenge" data-toggle="tab">Challenge</a></li> -->
  <li id="llb2" class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Exploration <b class="caret"></b></a>
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
  <blockquote><?php echo render($content['field_introductory_content']); ?></blockquote>
<!--  Carousel - consult the Twitter Bootstrap docs at
      http://twitter.github.com/bootstrap/javascript.html#carousel -->
<div id="this-carousel-id" class="carousel slide pull-right"><!-- class of slide for animation -->
  <div class="carousel-inner">
    <?php foreach($content['field_introductory_slideshow']['#items'] as $key=>$slide): ?>
    <?php $slideclasses = array('item'); ?>
    <?php if($key == 0): array_push($slideclasses, "active"); endif; ?>
    <div class="<?php echo implode(' ', $slideclasses); ?>">
      <?php
        $slide_image = array('style_name' => 'llb_detail_view', 'path' => $slide['uri'], 'alt' => '', 'title' => '');
        echo theme('image_style', $slide_image);
      ?>
      <div class="carousel-caption">
        <p>Caption text here</p>
      </div>
    </div>
    <?php endforeach; ?>
  </div><!-- /.carousel-inner -->
  <!--  Next and Previous controls below
        href values must reference the id for this carousel -->
    <a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->

  <?php echo render($content['field_background_content']); ?>

  <?php //echo render($content['field_introductory_slideshow']); ?>

</div> <!-- /#intro -->

<div class="tab-pane" id="background">
  <h3>The Problem</h3>
  <div class="pull-right">
    <?php echo render($content['field_background_slideshow']); ?>
  </div>

  <p>In this activity you will research the following problem:</p>
  <blockquote><em>Research question</em><?php echo render($content['field_background_question']); ?></blockquote>

</div> <!-- /#background -->

<!-- <div class="tab-pane" id="challenge">
  <p><?php echo render($content['field_challenge_content']); ?></p>
  <p><?php echo render($content['field_challenge_thumbnail']); ?></p>
</div> --> <!-- /#challenge -->

<div class="tab-pane" id="exploration">
  <ul class="thumbnails">
    <?php foreach($datasets as $key => $dataset): ?>
    <li class="span4">
      <div class="thumbnail">
        <img src="<?php echo $dataset->thumbnail; ?>" alt="<?php echo $dataset->title; ?>">
        <a href="#" onclick="$('#llb2 li:eq(<?php echo $key + 2; ?>) a').tab('show');"><?php echo $dataset->title; ?></a>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
</div>

<?php foreach($datasets as $key => $dataset): ?>
<div class="tab-pane" id="dataset<?php echo $key; ?>">
  <ul class="breadcrumb">
    <li><a href="#" onclick="$('#llb2 li:eq(0) a').tab('show');">Exploration</a> <span class="divider">/</span></li>
    <li class="active"><?php echo $dataset->title; ?></li>
  </ul>
  <h3><?php echo $dataset->title; ?></h3>
  <?php echo $dataset->thumbnail; ?>
  <?php echo $dataset->body; ?>
  <?php if(!empty($dataset->questions)): ?>
  <div class="row">
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
  <button type="button" class="btn btn-success" onclick="$('#llb2 li:eq(0) a').tab('show');">Return to Exploration <i class="icon-chevron-right icon-white"></i></button>
</div>
<?php endforeach; ?>

<div class="tab-pane" id="explanation">
  <p>Recall that the research question you are trying to address is:</p>
  <blockquote><?php echo render($content['field_introductory_content']); ?></blockquote>
  <p>As you take into account the data you just viewed, consider the following <strong>Inference Questions</strong>.</p>
  <p><?php echo render($content['field_inference_question']); ?></p>
  <p>Thinking deeper, consider the following <strong>Extrapolation Questions</strong>.</p>
  <p><?php echo render($content['field_extrapolation_question']); ?></p>

</div> <!-- /#explanation -->

</div> <!-- /.tab-content -->
</div> <!-- /.tabbable -->

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</article> <!-- /.node -->
