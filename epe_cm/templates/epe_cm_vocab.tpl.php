




<?php



  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/swf/swfobject.js');
  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/swf/swfaddress/swfaddress.js');


  drupal_add_js('jQuery(document).ready(function () { loadFlash(); });', array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));



?>





<script type="text/javascript">

function loadFlash() {

  var vocabTerm = location.search.split('term=')[1] ? location.search.split('term=')[1] : 'ocean observatories initiative';

  // from the microwave science website
  var flashvars = {}; 
  flashvars.OOI = 'true';
  flashvars.VOCABONLY = 'true';
  flashvars.VOCABTERM = vocabTerm;
  flashvars.builder = 'true';
  flashvars.RESOURCEDETAILSURL = '<?php echo base_path() ?>api/resource/lookup?xml=';
  flashvars.PHPPROXY = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/php/RetrieveOWL.php' ?>';
  flashvars.OWLPATH = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/owl/ioos/' ?>';
  flashvars.DEBUG = 'false';
  flashvars.SWFLOCATION = '<?php echo base_path() . drupal_get_path('module', 'epe_cm') . '/swf/' ?>';

  
  var params = {};
  params.allowFullScreen = 'true';
  
  var attributes = { id: 'conceptMapBuilderViewer', name: 'conceptMapBuilderViewer' };
  
  // this line is unchanged from the mwsci website
  swfobject.embedSWF('<?php echo base_path() . drupal_get_path('module', 'epe_cm') ?>/swf/CMV_15_20150501_0839.swf', 'flashcontent', '100%', '700', '9', 'expressInstall.swf', flashvars, params, attributes);
  
  return;
}

</script>

<p>Use the interactive Vocabulary Navigator to explore Ocean Observatory Initiative science, sites, platforms, instruments, and data products. You can type a term into the search field, or start exploring by clicking on terms (in squares) to reveal related concepts. </p>

<p>Each term in the vocabulary has a definition, which is revealed when hovering over the concept's 'i' icon. Many concepts also contain images that can be viewed by clicking the camera icon. To return to the top of the vocabulary, click on the 'home' icon.</p>

<div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
<div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

<div style="border-bottom: 2px solid #338ea9;margin-bottom: 10px;">
  <div id="flashcontent"><p>Please update your Flash Player</p></div>
</div>



</div>
</div>
