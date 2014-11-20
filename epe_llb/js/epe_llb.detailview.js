(function($) {
Drupal.behaviors.epe_llb_detailview = {
  attach: function(context, settings) {
      $(".tabbable *[data-toggle]").click(function(event) {
        event.preventDefault();

        $('.tabbable video').each(function() {
          $(this)[0].player.pause();
        });

        if($(this).attr('id') != 'exploration_tab') {
          $('.tabbable iframe').each(function() {
            //$(this).contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
            var iframe_source = $(this).attr('src');
            //remove source then add it back
            $(this).attr('src', iframe_source);
          });
        }
      });
  }
};
})(jQuery);
