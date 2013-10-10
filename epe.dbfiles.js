(function($) {
Drupal.behaviors.epe_files = {
  attach: function(context, settings) {
    var imgexts = $.parseJSON(settings.image_exts), otherexts = $.parseJSON(settings.other_exts);
    $('.form-file-field').change(function() {
      var ext = $(this).val().split('.').pop();
      if(otherexts.length > 0 && $.inArray(ext, otherexts) >= 0) { $('.thumbnail').show(); }
      if(imgexts.length > 0 && $.inArray(ext, imgexts) >= 0) { $('.thumbnail').hide(); }
    });

    $('.form-radio').click(function() {
      console.log($(this).val());
      if($(this).val() == 1) {
        $('button.form-submit').removeAttr('disabled');
      } else {
        $('button.form-submit').attr('disabled','disabled');
      }
    });
  }
};
})(jQuery)
