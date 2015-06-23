<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>



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


<?php include realpath(drupal_get_path('theme','epe_theme')) . '/templates/viewpage.tpl.php'; ?>



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
  swfobject.embedSWF('<?php echo base_path() . drupal_get_path('module', 'epe_cm') ?>/swf/CMV_15_20150501_0839.swf', 'flashcontent', '100%', '700', '9', 'expressInstall.swf', flashvars, params, attributes, 
      function(e) {
        if (!e.success) {
          document.getElementById('flashcontent').innerHTML = '<iframe width="885" height="700" frameBorder="0" src="<?php echo $embedPath ?>js"></iframe>';
          console.log(e)

        }
        return;
      } );
  
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

<?php 
  //var_dump($content);
  
//print __DIR__;

//print_r($content);
  
?>


<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

<div style="border-bottom: 2px solid #338ea9;margin-bottom: 10px;">
  <div id="flashcontent"></div>
</div>



<textarea id="conceptMapContents" name="conceptMapContents" style="display: none; width:500px; height:100px;"><?php echo $field_out ?></textarea>


  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    //print render($content);
  ?>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>



  <?php include realpath(drupal_get_path('module', 'epe_db')) . '/templates/linked_items.tpl.php'; ?>




  <?php print render($content['comments']); ?>


</div>
</div>


</article> <!-- /.node -->



