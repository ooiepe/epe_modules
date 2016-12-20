<?php
drupal_add_js("http://canvg.github.io/canvg/rgbcolor.js",'external');
drupal_add_js("http://canvg.github.io/canvg/StackBlur.js",'external');
drupal_add_js("http://canvg.github.io/canvg/canvg.js",'external');

module_load_include('php', 'epe_ev', 'inc/epe_ev_lib');

$ev_tool = array();

// build the tool info

// do we have a node?
if(isset($form["#node"]->field_parent_tool)){

  // get instance configuration
  $ev_tool["instance_configuration"] = epe_getFieldValue("field_instance_configuration", $form["#node"]);

  $ev_tool["parent_tool_id"] = $form["#node"]->field_parent_tool["und"][0]["value"];

  // load the parent node item
  $parentNode = node_load($ev_tool["parent_tool_id"]);

  //  the tool name
  $ev_tool["tool"] = epe_getNodeValues( array("field_tool_name"), $parentNode);

  $ev_tool["parentThumbnailId"] = $parentNode->field_tool_thumbnail["und"][0]["fid"];

}
//do we have a query string? this indicates a new instance
elseif(isset($_GET["ev_toolid"])){

  $ev_tool["parent_tool_id"] = $_GET["ev_toolid"];

  // load the parent node item
  $parentNode = node_load($ev_tool["parent_tool_id"]);

  if($parentNode->type != "ev_tool"){

    drupal_goto( $tool_list_path, array('query'=>array(
      'toolname'=>'ev_tool',
      'notify' => "An invalid resource id was provided."
    )));

  }
  else{

    // grab the name, path_css, and path_js
    $ev_tool["tool"] = epe_getNodeValues( array("field_tool_name"), $parentNode);

    $ev_tool["parentThumbnailId"] = $parentNode->field_tool_thumbnail["und"][0]["fid"];
  }

}
// we have nothing, send user to the tools list
else{

  drupal_goto( $tool_list_path, array('query'=>array(
    'toolname'=>'ev_tool'
  )));
}

$EduVis_Paths = epe_EduVis_Paths();

// add EduVis framework to page
drupal_add_js( $EduVis_Paths["EduVis"]["javascript"]);

?>

<style>
  .node-tabs {
    display: none;
  }
</style>

<div class="form-help"><a href="<?php echo drupal_get_path_alias('node/163'); ?>" target="_blank">Help with this tool</a></div>

  <!-- content -->
  <p>Use the tabs to complete all three steps needed to create your custom visualization tool.</p>

    <!-- tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#ev-instance-configure" data-toggle="tab">1. Configure</a></li>
      <li><a href="#ev-instance-preview" data-toggle="tab">2. Preview</a></li>
      <li><a href="#ev-instance-save" data-toggle="tab">3. Save</a></li>
    </ul>

    <!-- tab content -->
    <div class="tab-content">

      <div class="tab-pane active" id="ev-instance-configure">
        <!-- tab controls -->
        <p><em>Use the controls below to customize your visualization tool.</em></p>
        <div>
          <div id="vistool-controls" style="margin:6px;padding:6px;border:2px solid #c8d5de;"></div>
        </div>
      </div>

      <div class="tab-pane" id="ev-instance-preview" style="padding-bottom:100px;">
        <!-- tab preview -->
        <p><em>Here is a preview of the custom visualization tool you have made.  This is what others will see when you share it.</em></p>
        <div id="vistool"></div>
      </div>

      <div class="tab-pane" id="ev-instance-save">
        <!-- tab info -->
        <p><em>Before saving your custom visualization tool, be sure to describe it appropriately using the fields below.</em></p>
        <div>
          <div class="field-container">
            <!-- <label for="edit-title" class="field-label">* Title:</label> -->
            <?php echo render($form['title']); ?>
          </div>

          <div class="field-container" style="display:none;">
            <!-- <label for="edit-parent-tool" class="field-label">* Parent Tool:</label> -->
            <?php echo render($form['field_parent_tool']); ?>
          </div>

          <div class="field-container">
            <!-- <label for="edit-description-value" class="field-label">Description:</label> -->
            <?php echo render($form['field_tool_description']); ?>
          </div>

          <div class="field-container" style="display:none;">
            <!-- <label for="edit-configuration-value" class="field-label">Configuration:</label> -->
            <?php echo render($form['field_instance_configuration']); ?>
          </div>

          <div class="field-container" >
            <label for="edit-instance-thumbnail" class="field-label">Thumbnail</label>
            <div><?php // echo $ev_tool["default_thumb"]; ?></div>
            <?php //echo render($form['field_instance_thumbnail']); 
              //echo render($form['instance_thumb_data']);
            ?>
            <div style="display:none;">
              <canvas id="canvas"></canvas>
            </div>            
            <input type="hidden" id="instance_thumb_data" name="instance_thumb_data" value="" />
          </div>

          <div class="field-container">
            <!-- <label for="edit-configuration-value" class="field-label">Configuration:</label> -->
            <?php echo render($form['body']); ?>
          </div>

          <div class="control-group">
            <div class="controls">
              <?php echo render($form['field_instance_questions']); ?>
            </div>
          </div>

        </div>

         <?php if (empty($form['nid']['#value'])): ?>
          <input type="hidden" name="destination" value="ev/">
          <?php else: ?>
            <input type="hidden" name="destination" value="node/<?php print $form['nid']['#value'] ?>">
          <?php endif; ?>

          <?php echo render($form['options']['status']); ?>

          <?php echo render($form['actions']); ?>

          <?php
            /* form identifier */
            echo render($form['form_build_id']);
            echo render($form['form_id']);
            echo render($form['form_token']);
          ?>

      </div>

    </div>

  <!-- end content -->

<script type="text/javascript">

  function EduVis_extract(){

    // pull the configuration from the default tool instance
    var config = EduVis.tool.instances["<?php print $ev_tool['tool']['field_tool_name'];?>"]["default"].configuration,
        thumbnailId = $( "input[name='field_instance_thumbnail[und][0][fid]']" );

    // update the configuration value of the form element
    $("#edit-field-instance-configuration-und-0-value")
      .val(JSON.stringify(config));

    // check for the instance thumbnail.. if nothing is present, use the parent
    if(thumbnailId.val() == "0"){
      thumbnailId.val(<?php print $ev_tool["parentThumbnailId"];?>)
    }

    return true;
  }

  function svgToCanvas(){
    //load an svg snippet in the canvas
    canvg(
      document.getElementById('canvas'),
      $('<div>').append($("#vistool .svg_export").clone()).html(), // hack to pull html contents
      { ignoreMouse: true, ignoreAnimation: true }
    );
  }

  function canvasToImage(){
    // save canvas image as data url (png format by default)
    var canvas = document.getElementById("canvas"),
    w = canvas.width,
    h = canvas.height;

    //create a rectangle with the desired background color
    var destCtx = canvas.getContext('2d');
    destCtx.globalCompositeOperation = "destination-over";
    destCtx.fillStyle = "#FFFFFF";
    destCtx.fillRect(0,0,w,h);
    var thumb = new Image();
    thumb.src = canvas.toDataURL('image/png');
    dataURL = canvas.toDataURL('image/png');
    document.getElementById('instance_thumb_data').value = dataURL;
    //dataURL.replace(/^data:image\/[^;]/, 'data:application/octet-stream');

    //window.open(dataURL,"Visualization Image","location=0");
  }

  (function(){

    // update the parent tool ID form element
    $("#edit-field-parent-tool-und-0-value").val("<?php print $ev_tool["parent_tool_id"];?>");

    // add an event to the submit button
    $('#edit-submit').click(function(event){
      svgToCanvas();
      canvasToImage();  
      return EduVis_extract();
    });

    // set the EduVis, tools, and resources paths
    EduVis.Environment.setPaths(
      '<?php echo $EduVis_Paths["EduVis"]["root"];?>', // eduvis
      '<?php echo $EduVis_Paths["EduVis"]["tools"];?>', // tools
      '<?php echo $EduVis_Paths["EduVis"]["resources"];?>' // resources
    );

    EduVis.tool.load(
      {
        "name" : "<?php print $ev_tool['tool']['field_tool_name'];?>",
        "tool_container_div": "vistool",
        "instance_config": <?php
          if(isset($ev_tool["instance_configuration"]))
            print $ev_tool["instance_configuration"] . "\n";
          else
            print "{}";
        ?>,
        "isEdit" : true
      }
    );

  }());

</script>
