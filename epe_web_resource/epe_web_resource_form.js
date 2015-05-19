(function($) {
Drupal.behaviors.epe_web_resource_form = {
  attach: function(context, settings) {
    $('#edit-field-resource-url-und-0-url').blur(function() {
      $('#edit-field-resource-origin-und').val(validateUrl($(this).val()));
    });
  }
};
})(jQuery)

function validateUrl(url) {
  var regYoutube = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
  var regVimeo = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
  var regSlideshare = /(http:\/\/www\.slideshare\.net\/[^\.\s\<]+)/; /* /(http|https):\/\/(?:www.)?((slideshare)\.net)\/?(.*?)(?:\z|&)/; */
  if(regYoutube.test(url)) {
    return 'youtube';
  }else if (regSlideshare.test(url)) {
    return 'slideshare';
  }else if(regVimeo.test(url)) {
    return 'vimeo';
  }else{
    return false;
  }
}