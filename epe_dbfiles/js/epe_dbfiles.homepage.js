(function($) {
Drupal.behaviors.epe_dbfiles_homepage = {
  attach: function(context, settings) {
    $('#db_submit').on('click',function() {
      var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
      if($('input[name=search_db]').val() != '') {
        url += '/' + $('input[name=search_db]').val();
      }
      url += '?type=image';
      if($('input:radio[name=filter]:checked').val() != '') {
        url += '&filter=' + $('input:radio[name=filter]:checked').val();
      }
      window.location = url;
    });
    $('input[name=search_db]').on('keydown',function(event) {
      if(event.which == 13) {
        var url = Drupal.settings.epe.base_path + 'resource-browser#/search';
        if($('input[name=search_db]').val() != '') {
          url += '/' + $('input[name=search_db]').val();
        }
        url += '?type=image';
        if($('input:radio[name=filter]:checked').val() != '') {
          url += '&filter=' + $('input:radio[name=filter]:checked').val();
        }
        window.location = url;
      }
    });    
  }
};
})(jQuery)
