(function($) {
Drupal.behaviors.epe_dbfiles_add_resource = {
  attach: function(context, settings) {
    $("button[value='Upload']").addClass('hidden');
    $('.resource-type-select').change(function(event) {
      var form_path = 'resource/add/' + $(this).val();
      if($('.form-mode').val() == 'dialog') form_path = $('.form-mode').val() + '/' + form_path;
      window.location.href=Drupal.settings.epe.base_path + form_path;
    });

    $('input[name=permission]').click(function() {
      if($(this).prop('checked') == true) {
        $('#' + $(this).attr('data-form-id')).find('.form-submit').removeAttr('disabled');
      } else {
        $(this).prop('checked', false);
        $('#' + $(this).attr('data-form-id')).find('.form-submit').attr('disabled','disabled');
      }
    });    
  }
};
})(jQuery)