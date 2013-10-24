(function($) {
Drupal.behaviors.epe_llb_teaser_instructor = {
  attach: function(context, settings) {
    $('.btn.show-instructor-notes').click(function() {
      bootbox.dialog({
        message: $('.instructor-notes').html(),
      });
    });
  }
}})(jQuery)
