(function($) {
Drupal.behaviors.epe_ev_homepage = {
  attach: function(context, settings) {
    $('#ev_submit').on('click',function() {
      var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
      url += '?type=ev';
      if($('input:radio[name=filter]:checked').val() != '') {
        url += '&filter=' + $('input:radio[name=filter]:checked').val();
      }
      if($('input[name=search_ev]').val() != '') {
        url += '&search=' + $('input[name=search_ev]').val();
      }
      window.location = url;
    });
    $('input[name=search_ev]').on('keydown',function(event) {
      if(event.which == 13) {
        var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
        url += '?type=ev';
        if($('input:radio[name=filter]:checked').val() != '') {
          url += '&filter=' + $('input:radio[name=filter]:checked').val();
        }
        if($('input[name=search_ev]').val() != '') {
          url += '&search=' + $('input[name=search_ev]').val();
        }
        window.location = url;
      }
    });    
  }
};
})(jQuery)
