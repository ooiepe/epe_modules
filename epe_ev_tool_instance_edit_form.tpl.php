<?php

require_once("inc/epe_ev_lib.php");

$ev_tool = array();

// better reference to api menu hook link

$tool_list_path = "ev/tools";

// build the tool info

// do we have a node?
if(isset($form["#node"]->field_parent_tool)){

	// get instance configuration
	$ev_tool["instance_configuration"] = epe_getFieldValue("field_instance_configuration", $form["#node"]);

	// get parent tool id for lookup
	$ev_tool["parent_tool_id"] = $form["#node"]->field_parent_tool["und"][0]["target_id"];

	// load the parent node item
	$node = node_load($ev_tool["parent_tool_id"]);

	// grab the name, path_css, and path_js
	$ev_tool["tool"] = epe_getNodeValues( array("field_tool_name"), $node);

}
//do we have a query string?
elseif(isset($_GET["ev_toolid"])){

	$ev_tool["parent_tool_id"] = $_GET["ev_toolid"];

	// load the parent node item
	$node = node_load($ev_tool["parent_tool_id"]);

	// grab the name, path_css, and path_js
	$ev_tool["tool"] = epe_getNodeValues( array("field_tool_name"), $node);	
}
// we have nothing, send user to the tools list
else{
	
	drupal_goto( $tool_list_path, array('query'=>array(
		'toolname'=>'ev_tool',
		'configuration'=>'var2'
	)));
}

$EduVis_Paths = epe_EduVis_Paths();

// (
//     [Drupal] => Array
//         (
//             [base_url] => http://ooi.dev/epe/deploy/deploy
//             [module] => sites/all/modules/custom/epe_ev
//             [theme] => sites/all/themes/epe_theme
//         )

//     [EduVis] => Array
//         (
//             [root] => sites/all/modules/custom/epe_ev/EduVis/
//             [javascript] => sites/all/modules/custom/epe_ev/EduVis/EduVis.js
//             [tools] => http://ooi.dev/epe/deploy/deploy/sites/all/modules/custom/epe_ev/tools/
//             [resources] => http://ooi.dev/epe/deploy/deploy/sites/all/modules/custom/epe_ev/EduVis/resources/
//         )

// )

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
		<div id="vistool"></div>

		<div>
			<h4>Tool Controls</h4>
			<div id="vistool-controls" style="margin:6px;padding:6px;border:2px solid #c8d5de;"></div>
		</div>
		
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

			<div class="field-container">
				<!-- <label for="edit-configuration-value" class="field-label">Configuration:</label> -->
				<?php echo render($form['field_instance_description']); ?>
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

<!-- end content -->
	</div>
</div>

<script type="text/javascript">

	function EduVis_extract(){

		// pull the configuration from the default tool instance
		var config = EduVis.tool.instances["<?php print $ev_tool['tool']['field_tool_name'];?>"]["default"].configuration,
			config_updates = EduVis.controls.load_tool_config_values(config);

		// update the configuration value of the form element
		$("#edit-field-instance-configuration-und-0-value").val(JSON.stringify(config_updates));
	
		return true;
	}
  
  	(function(){

		// update the parent tool ID form element
  		$("#edit-field-parent-tool-und").val("<?php print $ev_tool["parent_tool_id"];?>");

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

				if(typeof evTool.controls !== "object"){
		            
		            // if there are no controls, tell the user
		            divToolControls.append(
		            	
		            	$("<p/>",{"class":"notify"})
		            		.html("This tool does not have an configurable properties.")
	            	);
		        }
		        else{

		            // Add each control to the specified div
		            $.each(evTool.controls, function (control_id, control) {
		                
		                // override default value with form based value
		                control.default_value = evTool.configuration[control_id];

		                // add the tool to the controls area
		                divToolControls.append(
		                    EduVis.controls.create( evTool, "config-"+control_id, control)
		                );

		            });
		        }
        	}
	      }
	    );
  	}());

</script>