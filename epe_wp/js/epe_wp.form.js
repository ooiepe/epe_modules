(function($) {
Drupal.behaviors.epe_wp_form = {
  attach: function(context, settings) {
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  }
};
})(jQuery)
