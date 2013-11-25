(function($) {
Drupal.behaviors.epe_files = {
  attach: function(context, settings) {
    var imgexts = $.parseJSON(settings.image_exts), otherexts = $.parseJSON(settings.other_exts);
    $('.form-file-field').change(function() {
      var ext = $(this).val().split('.').pop();
      if(otherexts.length > 0 && $.inArray(ext, otherexts) >= 0) { $('.thumbnail').show(); }
      if(imgexts.length > 0 && $.inArray(ext, imgexts) >= 0) { $('.thumbnail').hide(); }
    });

    $('input[name=permission]').click(function() {
      if($(this).prop('checked') == true) {
        $('.form-submit').removeAttr('disabled');
      } else {
        $(this).prop('checked', false);
        $('.form-submit').attr('disabled','disabled');
      }
    });

    $(".form-text").keypress(function (event) {
      if (event.keyCode == 10 || event.keyCode == 13) {
        event.preventDefault();
      }
    });
  }
};
})(jQuery)
