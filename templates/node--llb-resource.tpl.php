<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>



<?php
  $hideActionButtons = 0;
  include realpath(drupal_get_path('theme','bootstrap')) . '/templates/viewpage.tpl.php';
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
  <?php if(!empty($content['field_introductory_slideshow'])): ?>
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
      <?php if($slide['title'] != ''): ?>
      <div class="carousel-caption">
        <p><?php echo $slide['title']; ?></p>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div><!-- /.carousel-inner -->
  <!--  Next and Previous controls below
        href values must reference the id for this carousel -->
    <a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->
  <?php endif; //end checking $content['field_introductory_slideshow'] ?>
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
    <?php
      $li_classes = array('dataset');
      if(($key + 1) % 3 == 1): $li_classes[] = 'first'; endif;
    ?>
    <li class="<?php echo implode(' ', $li_classes); ?>">
      <div class="thumbnail">
        <div class="image">
        <?php
          if(isset($dataset->uri) && !empty($dataset->uri)) {
            $thumbnail_image = array('style_name' => 'llb_dataset_teaser', 'path' => $dataset->uri, 'alt' => $dataset->title, 'title' => $dataset->title);
            echo theme('image_style', $thumbnail_image);
          } else {
            echo '<img src="' . base_path() . drupal_get_path('theme','bootstrap') . '/images/no_thumb_small.jpg" alt="' . $dataset->title . '" title="' . $dataset->title . '">';
          }
        ?>
        </div>
        <a href="#" onclick="$('#llb2 li:eq(<?php echo $key + 2; ?>) a').tab('show');"><?php echo $dataset->title; ?></a>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
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
<!-- cm specific js -->
<script type="text/javascript">
function loadFlash() {
  // from the microwave science website
  var flashvars = {};
  flashvars.USERNAME = 'sgraham';
  flashvars.USERID = '4';
  flashvars.USERSTATUS = '1';
  flashvars.OOI = 'true';
  flashvars.BUILDER = 'false';
  flashvars.RESOURCEDETAILSURL = '<?php echo base_path() ?>?nodelookup=';
  flashvars.PHPPROXY = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/php/RetrieveOWL.php' ?>';
  flashvars.OWLPATH = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/owl/ioos/' ?>';
  var params = {};
  var attributes = { id: 'conceptMapBuilderViewer', name: 'conceptMapBuilderViewer' };
  // this line is unchanged from the mwsci website
  swfobject.embedSWF('<?php echo base_path() . drupal_get_path('module', 'epe_cm') ?>/swf/CMV_15_20131015_1748.swf', 'flashcontent', '100%', '700', '9', 'expressInstall.swf', flashvars, params, attributes);
  return;
}

function getXMLfromJS() {
  // get the contents of the text area
  var xml = document.getElementById('conceptMapContents').value;
  // get a reference to the flash object
  var swf = document.getElementById('conceptMapBuilderViewer');
  // call the load concept map function
  swf.jsToFlashImportMapData(xml);
  //swf.jsToFlashImportMapData('hello');
  return;
}

function doSave() {
  // get a reference to the flash object
  var swf = document.getElementById('conceptMapBuilderViewer');
  // get the contents of the map
  swf.getMapContents();
  return;
}

function giveXMLtoJS(value) {
  // put those contents into the text field
  document.getElementById('conceptMapContents').value = value;
  return;
}
</script>

<?php foreach($datasets as $key => $dataset): ?>
<div class="tab-pane" id="dataset<?php echo $key; ?>">
  <ul class="breadcrumb">
    <li><a href="#" onclick="$('#llb2 li:eq(0) a').tab('show');">Exploration</a> <span class="divider">/</span></li>
    <li class="active"><?php echo $dataset->title; ?></li>
  </ul>
  <h3><?php echo $dataset->title; ?></h3>

  <?php
    if(in_array($dataset->type, $filetypes)) { echo epe_llb_theme_file_dataset($dataset); }
    elseif($dataset->type == 'cm_resource') {
      $cm_resource = node_load($dataset->nid);
      $field_cm_data_items = field_get_items('node', $cm_resource, 'field_cm_data');
      $field_cm_data = field_view_value('node',$cm_resource,'field_cm_data', $field_cm_data_items[0]);
      $field_out = render($field_cm_data);
  ?>
<div style="border-bottom: 2px solid #338ea9;margin-bottom: 10px;">
  <div id="flashcontent"><p>Please update your Flash Player</p></div>
</div>

<textarea id="conceptMapContents" name="conceptMapContents" style="display: none; width:500px; height:100px;"><?php echo $field_out ?></textarea>

  <?php } //end elseif type == cm ?>

  <?php echo $dataset->body; ?>
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
      <?php //print render($content['field_tags']); ?>
      <?php //print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php //print render($content['comments']); ?>

</div>
</div>

<?php echo l('View Lesson Information', "node/" . arg(1)); ?>

</article> <!-- /.node -->
