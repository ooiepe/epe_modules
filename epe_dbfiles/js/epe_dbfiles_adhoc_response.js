(function($) {
Drupal.behaviors.epe_dbfiles_adhoc_response = {
  attach: function(context, settings) {
    $.ajax({
      url: Drupal.settings.epe.base_path + 'api/resource/' + Drupal.settings.response.adhoc.api + '/' + Drupal.settings.response.adhoc.nid,
      dataType: 'json',
      async: true,
      success: function(data) {
        var parentFrame = window.parent.document.getElementById('adhocmodal');
        controller = $(parentFrame).data('controller');
        if(controller == 'intro') {
          window.parent.addIntroItem(data, true);
        } else if(controller == 'dataset') {
          window.parent.addDataSetItem(data, true);
        } else if(controller == 'background') {
          window.parent.addBackgroundSlideshowItem(data, true);
        } else if(controller == 'challenge') {
          window.parent.addChallengeThumbnailItem(data, true);
        }
      }
    });
  }
};
})(jQuery)
