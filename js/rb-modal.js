(function($) {

Drupal.theme.prototype.llb_modal = function () {
  var html = '';
  html += '<div id="ctools-modal" class="popups-box">';
  html += '  <div class="ctools-modal-content ctools-modal-llb-modal-content">';
  html += '    <span class="popups-close"><a class="close" href="#">' + Drupal.CTools.Modal.currentSettings.closeImage + '</a></span>';
  html += '    <div class="modal-scroll"><div id="modal-content" class="modal-content popups-body"></div></div>';
  html += '  </div>';
  html += '</div>';
  return html;
};


})(jQuery)


/**
* Provide the HTML to create the modal dialog.
*/
/*(function ($) {
Drupal.theme.prototype.llb_modal = function () {
  var html = '';
  html += '<div id="ctools-modal" class="popups-box">';
  html += '  <div class="ctools-modal-content ctools-modal-llb-modal-content">';
  html += '    <span class="popups-close"><a class="close" href="#">' + Drupal.CTools.Modal.currentSettings.closeImage + '</a></span>';
  html += '    <div class="modal-scroll"><div id="modal-content" class="modal-content popups-body"></div></div>';
  html += '  </div>';
  html += '</div>';
  return html;
}
})(jQuery);
*/
jQuery(document).ready(function($) {
  /*
  $('input[name="nids"]').each(function() {
    console.log($(this));
    $(this).live('click',function() {
      console.log('clicking');
      $('#edit-field-resource-objects-und-0-value').val($('#edit-field-resource-objects-und-0-value').val() + ' here');
    })
  });
*/
/*
  $('input[name="nids"]').live('click',function() {
    $('#edit-field-resource-objects-und-0-value').val($('#edit-field-resource-objects-und-0-value').val() + ' here');
    Drupal.CTools.Modal.dismiss();
  });
*/

/*  $('button[name="op"]').live('click', function(event) {
    event.preventDefault();
    console.log('here');
    var objects = $.parseJSON($('#edit-field-resource-objects-und-0-value').val());
    if(objects == null) { objects = new Array(); }

    //console.log(objects);
    var nids = new Array();
    $('input:checkbox').each(function() {
      if(this.checked) {
        nids.push($(this).val());
      }
    });
    var resource = new Object();
    resource.nids = nids;
    resource.title = $('#rop-title').val();
    resource.content = $('#rop-content').val();
    objects.push(resource);
    $('#edit-field-resource-objects-und-0-value').val(JSON.stringify(objects));
    $('#sortable').append('<li>' + resource.title + '<br/><span class="label label-success">Text/Image</span></li>');
    Drupal.CTools.Modal.dismiss();
  });*/

});
