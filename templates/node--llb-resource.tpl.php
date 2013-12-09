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
  <li><a href="#background" data-toggle="tab">Background</a></li>
  <li><a href="#challenge" data-toggle="tab">Challenge</a></li>
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
  <h3>Activity Introduction</h3>
<!--  Carousel - consult the Twitter Bootstrap docs at
      http://twitter.github.com/bootstrap/javascript.html#carousel -->
  <?php if(!empty($content['field_introductory_slideshow'])) {
    echo theme('epe_llb_field_slideshow',array('field'=>$content['field_introductory_slideshow']));
  } ?>
  <?php echo render($content['field_introductory_content']); ?>

  <?php //echo render($content['field_introductory_slideshow']); ?>

  <!-- <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(1) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->

</div> <!-- /#intro -->

<div class="tab-pane" id="background">
  <h3>Background</h3>
  <div class="pull-right">
    <?php if(!empty($content['field_background_slideshow'])) {
      echo theme('epe_llb_field_slideshow',array('field'=>$content['field_background_slideshow']));
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

  <!-- <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(2) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->

</div> <!-- /#background -->

<div class="tab-pane" id="challenge">
  <h3>Challenge</h3>
  <div class="pull-right"><?php echo render($content['field_challenge_thumbnail']); ?></div>
  <p><?php echo render($content['field_desired_assessment']); ?></p>
  <blockquote><?php echo render($content['field_challenge_content']); ?></blockquote>

  <!-- <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(3) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
</div> <!-- /#challenge -->

<div class="tab-pane" id="exploration">
  <h3>Explore the Data</h3>
  <p><?php echo render($content['field_guidance_content']); ?></p>
  <p>Investigate each piece of evidence below and answer the investigation questions on each page.  After viewing all of the data, come up with a list of possible impacts the ocean and hurricanes have on each other, and justify each based on the evidence you reviewed.</p>
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
        <a href="#" onclick="jQuery('#llb2 li:eq(<?php echo ($key + 1); ?>) a').tab('show');"><?php echo $dataset->title; ?></a>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  <p>When you're done investigating the datasets, continue to the last section.</p>
  <!-- <button type="button" class="btn btn-success" onclick="jQuery('#llb li:eq(4) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
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

<!-- add eduvis -->
<?php
  // include php file for epe_ev functions.
  include realpath(drupal_get_path('module', 'epe_ev') . "/inc/epe_ev_lib.php");

  // set paths for EduVis and epe_ev
  $EduVis_Paths = epe_EduVis_Paths();
  // add EduVis framework to page
  drupal_add_js( $EduVis_Paths["EduVis"]["javascript"]);

  // canvas export resources
  drupal_add_js("http://canvg.googlecode.com/svn/trunk/rgbcolor.js");
  drupal_add_js("http://canvg.googlecode.com/svn/trunk/StackBlur.js");
  drupal_add_js("http://canvg.googlecode.com/svn/trunk/canvg.js");
?>

<?php foreach($datasets as $key => $dataset): ?>
<div class="tab-pane" id="dataset<?php echo $key; ?>">
  <ul class="breadcrumb">
    <li><a href="#" onclick="jQuery('#llb2 li:eq(0) a').tab('show');">Exploration</a> <span class="divider">/</span></li>
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

  <?php } elseif($dataset->type == 'ev_tool_instance') { ?>

<?php
    $vis_instance = node_load($dataset->nid);
    $ev_tool["instance_configuration"] = epe_getFieldValue( "field_instance_configuration", $vis_instance );

    $ev_tool["parent_tool_id"] = epe_getFieldValue( "field_parent_tool", $vis_instance );

    $parentNode = node_load($ev_tool["parent_tool_id"]);

    $ev_tool["tool"] = epe_getNodeValues( array("field_tool_name"), $parentNode);
?>
    <div id="vistool"></div>

    <div style="display:none;">
      <canvas id="canvas<?php echo $dataset->nid; ?>"></canvas>
    </div>

<script type="text/javascript">

(function(){

  function svgToCanvas(){

    //load an svg snippet in the canvas
    canvg(
      document.getElementById('canvas<?php echo $dataset->nid; ?>'),
      $('<div>').append($("#vistool svg").clone()).html(), // hack to pull html contents
      { ignoreMouse: true, ignoreAnimation: true }
    );
  }

  function canvasToImage(){
    // save canvas image as data url (png format by default)
      var canvas = document.getElementById("canvas<?php echo $dataset->nid; ?>"),
        dataURL = canvas.toDataURL();
        window.open(dataURL,"Tool Image","location=0");
  }

  // set EduVis environment paths
  EduVis.Environment.setPaths(
    '<?php echo $EduVis_Paths["EduVis"]["root"];?>', // eduvis
    '<?php echo $EduVis_Paths["EduVis"]["tools"];?>', // tools
    '<?php echo $EduVis_Paths["EduVis"]["resources"];?>' // resources
  );

  EduVis.tool.load(
    {
      "name" : '<?php print $ev_tool['tool']['field_tool_name'];?>',
      "tool_container_div": "vistool",
      "instance_config": <?php
            if(isset($ev_tool['instance_configuration']))
              print $ev_tool["instance_configuration"] . "\n";
            else
              print "{}";

          ?>
    }
  );

  // tool buttons

  $("#tool-function-export-image")
    .on("click", function(){

      svgToCanvas();
      canvasToImage();

    });

}());

</script>

  <?php } //end elseif type == ev_tool_instance ?>

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
  <!-- <button type="button" class="btn btn-success" onclick="jQuery('#llb2 li:eq(0) a').tab('show');">Return to Exploration <i class="icon-chevron-right icon-white"></i></button> -->
</div>
<?php endforeach; ?>

<div class="tab-pane" id="explanation">
  <h3>Develop an Explanation</h3>
  <p><?php echo render($content['field_explanation_content']); ?></p>
  <p>Recall that the research question you are trying to address is:</p>
  <blockquote><?php echo render($content['field_introductory_content']); ?></blockquote>
  <p>As you take into account the data you just viewed, consider the following <strong>Inference Questions</strong>.</p>
  <?php
  foreach($content['field_inference_question'] as $key => $question) {
    if(is_numeric($key)) {
      echo '<div>';
      echo ($key + 1) . '. ' . $question['#markup'];
      echo '</div>';
    }
  }
  ?>
  <p></p>
  <p>Thinking deeper, consider the following <strong>Extrapolation Questions</strong>.</p>
  <?php
  foreach($content['field_extrapolation_question'] as $key => $question) {
    if(is_numeric($key)) {
      echo '<div>';
      echo ($key + 1) . '. ' . $question['#markup'];
      echo '</div>';
    }
  }
  ?>
  <p></p>
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

<p><?php echo l('View Lesson Information', "node/" . arg(1)); ?></p>

</article> <!-- /.node -->
