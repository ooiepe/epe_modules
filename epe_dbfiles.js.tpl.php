/*
jQuery(document).ready(function($) {
  $('.form-file-field').change(function() {
    var ext = $(this).val().split('.').pop();
    <?php if(!$other_exts): ?>
    if($.inArray(ext, $.parseJSON('<?php echo $other_exts; ?>')) > 0) { $('.form-item-files-thumbnail').show(); }
    <?php endif; ?>
    if($.inArray(ext, $.parseJSON('<?php echo $image_exts; ?>')) > 0) { $('.form-item-files-thumbnail').hide(); }
  });
});
*/
(function($) {
Drupal.behaviors.epe_files = {
  attach: function(context, settings) {
  console.log(settings);
  }
};
})(jQuery)
