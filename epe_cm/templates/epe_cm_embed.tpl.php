

<?php

$node = node_load($nid);


// print('<pre>');
// print_r($node);
// print('</pre>');

?>



<?php

//$field_public_status_items = field_get_items('node', $node, 'field_public_status');
//$field_public_status = field_view_value('node',$node,'field_public_status', $field_public_status_items[0]);

//print_r('field_public_status: *' . $field_public_status . '*<br>');
//print_r('hasAccess_ApprovePublish: *' . $hasAccess_ApprovePublish . '*<br>');

//print('<pre>');
//print_r($node);
//print('</pre>');


  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/swf/swfobject.js');
  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/swf/swfaddress/swfaddress.js');


  drupal_add_js('jQuery(document).ready(function () { loadFlash(); });', array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));


$field_cm_data_items = field_get_items('node', $node, 'field_cm_data');
$field_cm_data = field_view_value('node',$node,'field_cm_data', $field_cm_data_items[0]);

$field_out = render($field_cm_data);


$cm_desc = '';
if (isset($node -> body['und'][0]['value']))
  $cm_desc = json_encode($node -> body['und'][0]['value']);

if (isset($nid))
  $embedPath = $GLOBALS['base_url'] . '/node/' . $nid . '/cmembed';
else
  $embedPath = '';
?>



<script type="text/javascript">

function loadFlash() {

  
  // from the microwave science website
  var flashvars = {}; 
  flashvars.USERNAME = 'sgraham'; 
  flashvars.USERID = '4'; 
  flashvars.USERSTATUS = '1';
  flashvars.OOI = 'true';
  flashvars.BUILDER = 'false';
  flashvars.RESOURCEDETAILSURL = '<?php echo base_path() ?>api/resource/lookup?xml=';
  flashvars.PHPPROXY = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/php/RetrieveOWL.php' ?>';
  flashvars.OWLPATH = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/owl/ioos/' ?>';
  flashvars.MAPID = '<?php echo $node->nid ?>';
  flashvars.TITLE = <?php echo json_encode($node->title) ?>;
  flashvars.DESCRIPTION = '<?php echo $cm_desc ?>';
  flashvars.SWFLOCATION = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/swf/' ?>';
  flashvars.EMBEDPATH = '<?php echo $embedPath ?>';

  var params = {};
  var attributes = { id: 'conceptMapBuilderViewer', name: 'conceptMapBuilderViewer' };
  
  // this line is unchanged from the mwsci website
  swfobject.embedSWF('<?php echo base_path() . drupal_get_path('module', 'epe_cm') ?>/swf/CMV_15_20141218_1054.swf', 'flashcontent', '100%', '400', '9', 'expressInstall.swf', flashvars, params, attributes);
  
  return;
}

function getXMLfromJS() {
  
  // get the contents of the text area
  var xml = document.getElementById('conceptMapContents').value;

  // get a reference to the flash object
  var swf = document.getElementById('conceptMapBuilderViewer');

  //console.log(xml);
  
  // call the load concept map function
  swf.jsToFlashImportMapData(xml);
  //swf.jsToFlashImportMapData('hello');

  return;
}


function giveXMLtoJS(value) {
  // put those contents into the text field
  document.getElementById('conceptMapContents').value = value;
  
  return;
}


</script>


<div style="border-bottom: 2px solid #338ea9;margin-bottom: 10px;">
  <div id="flashcontent"><p>Please update your Flash Player</p></div>
</div>
<textarea id="conceptMapContents" name="conceptMapContents" style="display: none; width:500px; height:100px;"><?php echo $field_out ?></textarea>





