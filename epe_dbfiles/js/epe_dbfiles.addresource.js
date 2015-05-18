(function($) {
Drupal.behaviors.epe_dbfiles_add_resource = {
  attach: function(context, settings) {
    $("button[value='Upload']").addClass('hidden');
    $('.resource-type-select').change(function(event) {
      var type = $(this).val();
      $('.node-form').each(function() { 
        if(!$(this).hasClass('hidden')) {
          $(this).addClass('hidden');
          $('.node-' + type + '-form').trigger('reset');
          $(this).find('.form-submit').attr('disabled','disabled');
        }
      });
      if(type != 'NULL') $('.node-' + type + '-form').removeClass('hidden');
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