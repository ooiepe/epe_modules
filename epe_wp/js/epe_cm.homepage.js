(function($) {
Drupal.behaviors.epe_cm_homepage = {
  attach: function(context, settings) {
    $('#cm_submit').on('click',function() {
      var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
      url += '?type=cm';
      if($('input:radio[name=filter]:checked').val() != '') {
        url += '&filter=' + $('input:radio[name=filter]:checked').val();
      }
      if($('input[name=search_cm]').val() != '') {
        url += '&search=' + $('input[name=search_cm]').val();
      }
      window.location = url;
    });
    $('input[name=search_cm]').on('keydown',function(event) {
      if(event.which == 13) {
        var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
        url += '?type=cm';
        if($('input:radio[name=filter]:checked').val() != '') {
          url += '&filter=' + $('input:radio[name=filter]:checked').val();
        }
        if($('input[name=search_cm]').val() != '') {
          url += '&search=' + $('input[name=search_cm]').val();
        }
        window.location = url;
      }
    });    
  }
};
})(jQuery)
