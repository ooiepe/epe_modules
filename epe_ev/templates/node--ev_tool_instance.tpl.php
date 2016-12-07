<?php

  // include php file for epe_ev functions.
  include($_SERVER["DOCUMENT_ROOT"] . $GLOBALS["base_path"] . drupal_get_path('module', 'epe_ev') . "/inc/epe_ev_lib.php");

  // set paths for EduVis and epe_ev
  $EduVis_Paths = epe_EduVis_Paths();

  // initialize the tool array
  $ev_tool = array();

  // dont show anything in teaser mode... conditional still necessary?
  if(!$teaser){

    // get the configuration from the instance node
    $ev_tool["instance_configuration"] = epe_getFieldValue( "field_instance_configuration", $node );

    $ev_tool["parent_tool_id"] = epe_getFieldValue( "field_parent_tool", $node );

    $parentNode = node_load($ev_tool["parent_tool_id"]);

    $ev_tool["tool"] = epe_getNodeValues( array("field_tool_name"), $parentNode);

    // get the tool details (name, path_css, path_js) from the instance parent reference "field_parent_tool"
    //$ev_tool["tool"] = epe_getParentFieldValues( "field_parent_tool", array("field_tool_name"), $node );
    // get current toolid

  }

  // add EduVis framework to page
  drupal_add_js( $EduVis_Paths["EduVis"]["javascript"]);

  // canvas export resources
  drupal_add_js("http://canvg.googlecode.com/svn/trunk/rgbcolor.js");
  drupal_add_js("http://canvg.googlecode.com/svn/trunk/StackBlur.js");
  drupal_add_js("http://canvg.googlecode.com/svn/trunk/canvg.js");

?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

<?php
  if(arg(2) && arg(2) == 'vsembed') { /*if embed url hide */
  } else { ?>
  <?php include realpath(drupal_get_path('theme','epe_theme')) . '/templates/viewpage.tpl.php'; ?>
  <div style="border: 1px solid #0195bd;padding:23px;margin-bottom:20px;" class="clearfix">
<?php } //end if vsembed  ?>
      <div id="vistool"></div>

      <?php
        if(arg(2) && arg(2) == 'vsembed') { /*if embed url hide */
        } else { ?>
      <div id="tool-functions">
        <button class="btn btn-primary" value="Export to Image" id="tool-function-export-image">Export to Image</button>
        <?php echo render($content['links']); ?>
      </div>
      <?php } //end if vsembed  ?>


      <div style="display:none;">
        <canvas id="canvas"></canvas>
      </div>
  </div>

<!-- display any places this item is included and any items copied from this item -->
<?php
  if(arg(2) && arg(2) == 'vsembed') { /*if embed url hide */
  } else { ?>

<?php print render($content['field_instance_questions']); ?>

<?php include realpath(drupal_get_path('module', 'epe_db')) . '/templates/linked_items.tpl.php'; ?>

<?php print render($content['comments']); ?>
<?php } //end if vsembed ?>
</article>

<script type="text/javascript">

(function(){

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

    dataURL = canvas.toDataURL('image/png');
    dataURL.replace(/^data:image\/[^;]/, 'data:application/octet-stream');

    window.open(dataURL,"Visualization Image","location=0");
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
