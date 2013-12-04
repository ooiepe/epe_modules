<?php

require_once("inc/epe_ev_lib.php");

$ev_tool = array();

// build the tool info

// do we have a node?
if(isset($form["#node"]->field_parent_tool)){

  // get instance configuration
  $ev_tool["instance_configuration"] = epe_getFieldValue("field_instance_configuration", $form["#node"]);

  $ev_tool["parent_tool_id"] = $form["#node"]->field_parent_tool["und"][0]["value"];

  // load the parent node item
  $parentNode = node_load($ev_tool["parent_tool_id"]);

  //  the name
  $ev_tool["tool"] = epe_getNodeValues( array("field_tool_name"), $parentNode);

  //$ev_tool["default_thumb"] = epe_getNodeValues(array("field_tool_thumbnail"), $parentNode);

}
//do we have a query string?
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

  }

}
// we have nothing, send user to the tools list
else{
  
  drupal_goto( $tool_list_path, array('query'=>array(
    'toolname'=>'ev_tool'
  )));
}

/////
//THUMBNAIL

module_load_include('inc', 'node', 'node.pages');
$node_type = 'ev_tool';
$org_form_id = $node_type . '_node_form';

//drupal_get_form needs a empty node of edit type
$tmpnode = new stdClass();
$tmpnode->type = $node_type;
$tmpnode->language = LANGUAGE_NONE;
node_object_prepare($tmpnode);
$evtool_form = drupal_get_form($org_form_id, $tmpnode);

//echo render($evtool_form["field_tool_thumbnail"]);

echo "-----" . print_r($evtool_form["field_tool_thumbnail"][und][0]). " ------";


// <input type="hidden" name="field_instance_thumbnail[und][0][fid]" value="2">
// <input type="hidden" name="field_instance_thumbnail[und][0][display]" value="1">
// <input type="hidden" name="field_instance_thumbnail[und][0][width]" value="1440">
// <input type="hidden" name="field_instance_thumbnail[und][0][height]" value="101">

//youll change the $node_type to the tool parent, and the last line is loading the edit form of the parent.  
//you may need to do a print_r to see the structure of the form, but it should be something 
//like $org_form['field_thumbnail_something']

//so what you'll do is assign your parent thumbnail field to your tool instance thumbnail field, and render the tool instance thumbnail field, give this a try

// END THUMBNAIL

$EduVis_Paths = epe_EduVis_Paths();

// add EduVis framework to page
drupal_add_js( $EduVis_Paths["EduVis"]["javascript"]);

?>

<style>
  .node-tabs {
    display: none;
  }
</style>

<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
  <div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

<!-- content -->

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
        <div>
          <h4>Tool Controls</h4>
          <div id="vistool-controls" style="margin:6px;padding:6px;border:2px solid #c8d5de;"></div>
        </div>

      </div>

      <div class="tab-pane" id="ev-instance-preview">
        <!-- tab preview -->
        <div id="vistool"></div>
      </div>

      
      <div class="tab-pane" id="ev-instance-save">
        <!-- tab info -->
        
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
            <?php echo render($form['field_instance_thumbnail']); ?>
          </div>

          <div class="field-container">
            <!-- <label for="edit-configuration-value" class="field-label">Configuration:</label> -->
            <?php echo render($form['body']); ?>
          </div>

        </div>
         
         <?php if (empty($form['nid']['#value'])): ?>
          <input type="hidden" name="destination" value="ev/">
          <?php else: ?>
            <input type="hidden" name="destination" value="node/<?php print $form['nid']['#value'] ?>">
          <?php endif; ?>

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

  </div>
</div>

<script type="text/javascript">

  function EduVis_extract(){

    // pull the configuration from the default tool instance
    var config = EduVis.tool.instances["<?php print $ev_tool['tool']['field_tool_name'];?>"]["default"].configuration;
      
    // update the configuration value of the form element
    $("#edit-field-instance-configuration-und-0-value")
      .val(JSON.stringify(config));
  
    return true;
  }
  
  (function(){

    // update the parent tool ID form element
    $("#edit-field-parent-tool-und-0-value").val("<?php print $ev_tool["parent_tool_id"];?>");

    // add an event to the submit button
    $('#edit-submit').click(function(){
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
        "onLoadComplete": function(){

          // todo: move to function in framework.. pass target_id, instance reference, 
          var divToolControls = $("#vistool-controls"),
            evTool = EduVis.tool.instances["<?php print $ev_tool['tool']['field_tool_name'];?>"]["default"];

          EduVis.controls.drupal_edit_controls(divToolControls, evTool);
          
          // disable enter key press form submission on inputs textboxes.. restrict to type textbox only?
          $("input").bind('keypress keydown keyup', function(e){
             if(e.keyCode == 13) { 
                e.preventDefault(); 
             }
          });

        }
      }
    );

  }());

</script>
