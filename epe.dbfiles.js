(function($) {
Drupal.behaviors.epe_files = {
  attach: function(context, settings) {
    var imgexts = $.parseJSON(settings.image_exts), otherexts = $.parseJSON(settings.other_exts);
    $('.form-file-field').change(function() {
      var ext = $(this).val().split('.').pop();
      if(otherexts.length > 0 && $.inArray(ext, otherexts) > 0) { $('.form-item-files-thumbnail').show(); }
      if(imgexts.length > 0 && $.inArray(ext, imgexts) > 0) { $('.form-item-files-thumbnail').hide(); }
    });
  }
};
})(jQuery)
