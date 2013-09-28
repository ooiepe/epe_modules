(function($) {
Drupal.behaviors.epe_llb_resource_browser = {
  attach: function(context, settings) {
    /*
    var imgexts = $.parseJSON(settings.image_exts), otherexts = $.parseJSON(settings.other_exts);
    $('.form-file-field').change(function() {
      var ext = $(this).val().split('.').pop();
      if(otherexts.length > 0 && $.inArray(ext, otherexts) >= 0) { $('.thumbnail').show(); }
      if(imgexts.length > 0 && $.inArray(ext, imgexts) >= 0) { $('.thumbnail').hide(); }
    });
    */
    $('input[name="op"]').once('addresource', function() {
/*    $('input[name="op"]').live('click', function(event) {
      event.preventDefault();
      var checkboxes = $('.resource-browser-iframe').contents().find('input[name="nid"]');
      checkboxes.each(function() {
        if($(this).is(':checked')) console.log($(this).val());
      });
    });*/
      $('input[name="op"]').click(function() {
        var selected = [];
        event.preventDefault();
        var checkboxes = $('.resource-browser-iframe').contents().find('input[name="nid"]');
        checkboxes.each(function() {
          if($(this).is(':checked')) {
            /*$.getJSON('/api/resource/image/' + $(this).val(), function(data) {
              console.log(data);
              selected.push(data);
            });*/
 /*           $.getJSON('/api/resource/image/' + $(this).val()).done(function(data) {
              //selected.push(data);
              window.addResources(data);
            });*/
              $.ajax({
                url: '/api/resource/' + $(this).data('type') + '/' + $(this).val(),
                dataType: 'json',
                async: true,
                success: function(data) {
                  window.addItem(data);
                }
              });
          }
        });

        //$(selected).promise().done(function() { console.log(selected); });

        Drupal.CTools.Modal.dismiss();
      });
    });
  }
};


})(jQuery)
