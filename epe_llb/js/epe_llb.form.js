(function($) {
Drupal.behaviors.epe_llb_form = {
  attach: function(context, settings) {
    $(function() {
      var url = document.location.toString();
      if (url.match('#')) {
        $('.nav-tabs a[href='+window.location.hash+']').tab('show') ;
        $('input[name="fragment"]').val(window.location.hash.substring(1));
      }      
    });

    $('#llbnav a').click(function() {
      if($(this).data('toggle')) {
        $('input[name="fragment"]').val($(this).attr('href').substring(1));
      }
    });

  }
};
})(jQuery);
