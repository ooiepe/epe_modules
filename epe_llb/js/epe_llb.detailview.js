(function($) {
Drupal.behaviors.epe_llb_detailview = {
  attach: function(context, settings) {
  $('.tabbable a').bind('click', function() {
    var attr = $(this).attr('data-toggle');

    // For some browsers, 'attr' is undefined; for others,
    // 'attr' is false.  Check for both.
    if (typeof attr !== typeof undefined && attr !== false) {
      $('.tabbable video').each(function() {
        $(this)[0].player.pause();
      });
    }
  });
}
};
})(jQuery);
