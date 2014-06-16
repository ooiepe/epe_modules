<?php 

  $form['title']['#title_display'] = 'invisible';
  $form['body']['und'][0]['value']['#title_display'] = 'invisible';



?>

<style>
.node-tabs {
  display: none;
}

.resource-browser-modal { width: 829px; height: 500px; }

</style>



<div class="form-help"><a href="<?php echo base_path() . "node/178" ?>" target="_blank">Help with this form</a></div>
<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">


<div class="field-container">
<label for="edit-title" class="field-label">* Title:</label>
<?php echo render($form['title']); ?>
</div>



<?php 
  

  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/swf/swfobject.js');
  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/swf/swfaddress/swfaddress.js');

  drupal_add_js(libraries_get_path('bootbox') . '/bootbox.min.js');




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
  flashvars.DEBUG = 'false';
  flashvars.RESOURCEDETAILSURL = '<?php echo base_path() ?>api/resource/lookup?xml=';
  flashvars.PHPPROXY = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/php/RetrieveOWL.php' ?>';
  flashvars.OWLPATH = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/owl/ioos/' ?>';
  flashvars.MAPID = '0';
  flashvars.SWFLOCATION = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/swf/' ?>';
  
  var params = {};
  var attributes = { id: 'conceptMapBuilderViewer', name: 'conceptMapBuilderViewer' };
  
  // this line is unchanged from the mwsci website
  swfobject.embedSWF('<?php echo base_path() . drupal_get_path('module', 'epe_cm') ?>/swf/CMV_15_20140610_1210.swf', 'flashcontent', '100%', '700', '9', 'expressInstall.swf', flashvars, params, attributes);
  
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

function getMapTitleAndDesc() {
  
  var mapTitleAndDesc = {title: document.getElementById('edit-title').value, description: document.getElementById('edit-body-und-0-value').value};
    return mapTitleAndDesc;
    
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

var selectedResources = Array();

function addItem(data) {

  // add this item to the array
  selectedResources.push(data);

  // get the swf object
  var swf = document.getElementById('conceptMapBuilderViewer');

  // generate the xml and import to the swf
  swf.jsToFlashImportResources(generateXMLFromItems(selectedResources));


}

function generateXMLFromItems(items) {
  str = '';
  strCM = '';
  strEV = '';
  strLLB = '';
  strImages = '';
  strVideos = '';
  strDocs = '';

  for (i = 0; i < items.length; i++) {
    console.log(items[i]);

    if (items[i].type == 'cm_resource') {
      strCM += '<node id="' + items[i].nid + '" url="<?php echo base_path() ?>node/' + items[i].nid + '" img="' + items[i].thumbnail + '" imgw="" imgh="" datemodified="2012-03-07 17:25:32" datemodifiedepoch="1331141132"><title><![CDATA[' + items[i].title + ']]></title><longDesc><![CDATA[' + items[i].body + ']]></longDesc><author id="4"><![CDATA[Sean Graham]]></author></node>';
    } else if (items[i].type == 'ev_tool_instance') {
      strEV += '<node id="' + items[i].nid + '" url="<?php echo base_path() ?>node/' + items[i].nid + '"><title><![CDATA[' + items[i].title + ']]></title><longDesc><![CDATA[' + items[i].body + ']]></longDesc></node>';
    } else if (items[i].type == 'llb_resource') {
      strLLB += '<node id="' + items[i].nid + '" url="<?php echo base_path() ?>node/' + items[i].nid + '"><title><![CDATA[' + items[i].title + ']]></title><longDesc><![CDATA[' + items[i].body + ']]></longDesc></node>';
    } else if (items[i].type == 'image_resource') {
      strImages += '<node id="' + items[i].nid + '" img="' + items[i].thumbnail + '" source="' + items[i].file + '" sourcew="" sourceh="" hires="" hiresw="" hiresh="" url="' + items[i].thumbnail + '"><title><![CDATA[' + items[i].title + ']]></title><longDesc><![CDATA[' + items[i].body + ']]></longDesc></node>';
    } else if (items[i].type == 'video_resource' || items[i].type == 'audio_resource') {
      strVideos += '<node id="' + items[i].nid + '" img="' + items[i].thumbnail + '" imgw="" imgh="" source="' + items[i].file + '" audio=""><title><![CDATA[' + items[i].title + ']]></title><longDesc><![CDATA[' + items[i].body + ']]></longDesc></node>';
    } else if (items[i].type == 'document_resource') {
      strDocs += '<node id="' + items[i].nid + '" url="<?php echo base_path() ?>node/' + items[i].nid + '"><title><![CDATA[' + items[i].title + ']]></title><longDesc><![CDATA[' + items[i].body + ']]></longDesc></node>';
    }

  }

  if (strCM.length > 0) 
    str += '<conceptmaps>' + strCM + '</conceptmaps>';

  if (strEV.length > 0) 
    str += '<visualizations>' + strEV + '</visualizations>';

  if (strLLB.length > 0) 
    str += '<lessons>' + strLLB + '</lessons>';

  if (strImages.length > 0) 
    str += '<images>' + strImages + '</images>';

  if (strVideos.length > 0) 
    str += '<videos>' + strVideos + '</videos>';

  if (strDocs.length > 0) 
    str += '<docs>' + strDocs + '</docs>';


  // add the xml tags
  str = '<xml>' + str + '</xml>';

  console.log(str);

  return str;
}

function launchResourceBrowser() {
  
  selectedResources.length = 0;

  bootbox.dialog({
        message: '<iframe src="' + '<?php echo base_path() ?>'  + 'dialog/resource-browser#/dialog/search" seamless width="779" height="500" class="resource-browser-iframe" />',
        className: 'resource-browser-modal',
        buttons: {
          main: {
            label: "Add Selected",
            className: "btn btn-primary pull-left",
            callback: function(event) {
            var selected = [];
            event.preventDefault();
            var checkboxes = jQuery('.resource-browser-iframe').contents().find('input[name="nid"]');
            checkboxes.each(function() {
              if(jQuery(this).is(':checked')) {
                  jQuery.ajax({
                    url: '<?php echo base_path() ?>' + 'api/resource/' + jQuery(this).data('type') + '/' + jQuery(this).val(),
                    dataType: 'json',
                    async: true,
                    success: function(data) {
                      window.addItem(data);
                    }
                  });
              }
            });
            }
          },
          cancel: {
            label: "Cancel",
            className: "btn"
          }
        }
      });



  return;
}



</script>



<?php if (empty($form['nid']['#value'])): ?>
  <input type="hidden" name="destination" value="cm/">
<?php else: ?>
  <input type="hidden" name="destination" value="node/<?php print $form['nid']['#value'] ?>">
<?php endif; ?>



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

