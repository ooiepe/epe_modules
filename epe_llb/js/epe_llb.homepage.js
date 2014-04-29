(function($) {
Drupal.behaviors.epe_llb_homepage = {
  attach: function(context, settings) {
    $('#llb_submit').on('click',function() {
      var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
      if($('input[name=search_llb]').val() != '') {
        url += '/' + $('input[name=search_llb]').val();
      }
      url += '?type=llb';
      if($('input:radio[name=filter]:checked').val() != '') {
        url += '&filter=' + $('input:radio[name=filter]:checked').val();
      }
      window.location = url;
    });
    $('input[name=search_llb]').on('keydown',function(event) {
      if(event.which == 13) {
        var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
        if($('input[name=search_llb]').val() != '') {
          url += '/' + $('input[name=search_llb]').val();
        }
        url += '?type=llb';
        if($('input:radio[name=filter]:checked').val() != '') {
          url += '&filter=' + $('input:radio[name=filter]:checked').val();
        }
        window.location = url;
      }
    });    
  }
};
})(jQuery)
