<?php 

  $form['title']['#title_display'] = 'invisible';
  $form['body']['und'][0]['value']['#title_display'] = 'invisible';


?>

<style>
.node-tabs {
  display: none;
}
</style>



<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">


<div class="field-container">
<label for="edit-title" class="field-label">* Title:</label>
<?php echo render($form['title']); ?>
</div>



<?php 
  

  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/swf/swfobject.js');
  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/swf/swfaddress/swfaddress.js');


  drupal_add_js('jQuery(document).ready(function () { loadFlash() });', array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));

?>



<script type="text/javascript">

Drupal.behaviors.module = {
  attach: function() {

       jQuery('#edit-submit').click(function(){
          doSave();
      });

  }
}
function loadFlash() {

  
  var flashvars = {}; 
  flashvars.USERNAME = 'sgraham'; 
  flashvars.USERID = '4'; 
  flashvars.USERSTATUS = '1';
  flashvars.OOI = 'true';
  flashvars.builder = 'true';
  flashvars.RESOURCEDETAILSURL = 'http://www.resourcedetailsurl.com';
  flashvars.PHPPROXY = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/php/RetrieveOWL.php' ?>';
  flashvars.OWLPATH = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/owl/ioos/' ?>';
  
  var params = {};
  var attributes = { id: 'conceptMapBuilderViewer', name: 'conceptMapBuilderViewer' };
  
  // this line is unchanged from the mwsci website
  swfobject.embedSWF('<?php echo base_path() . drupal_get_path('module', 'epe_cm') ?>/swf/CMV_15_20131011_0930.swf', 'flashcontent', '100%', '700', '9', 'expressInstall.swf', flashvars, params, attributes);
  
  return;
}

function getXMLfromJS() {
  
  //alert('joe');

  // get the contents of the text area
  var xml = document.getElementById('edit-field-cm-data-und-0-value').value;
  //var xml = document.getElementById('conceptMapContents').value;

  // get a reference to the flash object
  var swf = document.getElementById('conceptMapBuilderViewer');

  // call the load concept map function
  swf.jsToFlashImportMapData(xml);

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
  document.getElementById('edit-field-cm-data-und-0-value').value = value;
  return;
}


</script>


<div id="flashcontent"><p>Please update your Flash Player</p></div>


<div class="field-container">
<label for="edit-description-value" class="field-label">Description:</label>
<?php echo render($form['body']); ?>
</div>

<div class="field-container" style="display:none;">
<label for="edit-cm_data-value" class="field-label">CM:</label>
<?php echo render($form['field_cm_data']); ?>
</div>


<?php echo render($form['actions']); ?>

<?php
  /* form identifier */
  echo render($form['form_build_id']);
  echo render($form['form_id']);
  echo render($form['form_token']);
?>

</div>
</div>

