<?php

require_once("inc/epe_ev_lib.php");

$ev_tool = array();

$tool_list_path = "tools";

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
//do we have a query string
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


// set path to EduVis framework
$EduVis_path = $GLOBALS['base_url'] . '/'. drupal_get_path('module', 'epe_ev') .'/EduVis/';

// add EduVis framework to page
drupal_add_js( $EduVis_path . "EduVis.js" );

//if(!$teaser){	
	
	if($output = true){
		
		echo "<pre>";

		print "\nJS Tool\n";
		//print_r($ev_tool);
	
		//print "Configuration:" . $ev_tool["instance_configuration"] . "\n";

		//print_r($form["#node"]);
		
		// print "\nNode\n";
		// print_r($node);
		
		echo "</pre>";
	}

//}

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

	<div class="field-container">
	<!-- <label for="edit-configuration-value" class="field-label">Configuration:</label> -->
	<?php echo render($form['field_instance_configuration']); ?>
	</div>

	<div class="field-container">
	<!-- <label for="edit-configuration-value" class="field-label">Configuration:</label> -->
	<?php echo render($form['field_instance_description']); ?>
	</div>

</div>

<?php echo render($form['actions']); ?>

<?php
  /* form identifier */
  echo render($form['form_build_id']);
  echo render($form['form_id']);
  echo render($form['form_token']);
?>

<script type="text/javascript">

	function EduVis_extract(){

		var config = EduVis.tool.instances["<?php print $ev_tool['tool']['field_tool_name'];?>"]["default"].configuration;

		config = JSON.stringify(config);

		console.log(config);

		$("#edit-field-configuration-und-0-value").val(config);
	}
  
  	(function(){


  		alert("epe_ev_tool_instance_edit_form.tpl.php");

  		// $("#edit-field-instance-configuration-und-0-value")
  		$("#edit-field-parent-tool-und").val(<?php 
	         	
	         //	if(isset($ev_tool['tool']['field_tool_name']))
	         //		print $ev_tool['tool']['field_tool_name'];

  			print $ev_tool["parent_tool_id"];
  		 ?>);
		      	

	  	$('#edit-submit').click(function(){
	  		return EduVis_extract();
		});
	
	    EduVis.Environment.setPath("<?php print $EduVis_path; ?>");

	    EduVis.tool.load(
	      { 
	        "name" : "<?php print $ev_tool['tool']['field_tool_name'];?>", 
	        "tool_container_div": "vistool",
	        "instance_config": <?php 
	        	if(isset($ev_tool["instance_configuration"]))
	        		print $ev_tool["instance_configuration"] . "\n";
	        	else
	        		print "{}";
        	?>
	      }
	    );

  	}());

  </script>

<!-- end content -->

	</div>
</div>
