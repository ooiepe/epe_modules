(function($) {
Drupal.behaviors.epe_ev_homepage = {
  attach: function(context, settings) {
    $('#ev_submit').on('click',function() {
      var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
      if($('input[name=search_ev]').val() != '') {
        url += '/' + $('input[name=search_ev]').val();
      }
      url += '?type=ev';
      if($('input:radio[name=filter]:checked').val() != '') {
        url += '&filter=' + $('input:radio[name=filter]:checked').val();
      }
      window.location = url;
    });
  }
};
})(jQuery)
