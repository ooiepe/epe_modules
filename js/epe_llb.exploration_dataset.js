/*(function($) {
Drupal.behaviors.epe_llb_exploration_dataset = {
  attach: function(context, settings) {*/
jQuery(document).ready(function($) {
    $('.btn.add-resources').on("click", function() {
      bootbox.dialog({
        message: '<iframe src="' + Drupal.settings.epe.base_path + 'dialog/resource-browser#/search?dialog&type=' + $(this).data('api') + '" seamless width="779" height="500" class="resource-browser-iframe" />',
        className: 'resource-browser-modal',
        buttons: {
          main: {
            label: "Add Selected",
            className: "btn btn-primary pull-left",
            callback: function(event) {
            var selected = [];
            event.preventDefault();
            var checkboxes = $('.resource-browser-iframe').contents().find('input[name="nid"]');
            checkboxes.each(function() {
              if($(this).is(':checked')) {
                  $.ajax({
                    url: Drupal.settings.epe.base_path + 'api/resource/' + $(this).data('type') + '/' + $(this).val(),
                    dataType: 'json',
                    async: true,
                    success: function(data) {
                      window.addItem(data, true);
                    }
                  });
              }
            });
            }
          },
          adhoc: {
            label: "Upload Resource",
            className: "btn",
            callback: function(event) {
              event.preventDefault();
              bootbox.dialog({
                message: '<iframe src="' + Drupal.settings.epe.base_path + 'dialog/resource/add/file" seamless width="779" height="500" class="resource-browser-iframe" />',
                className: 'resource-browser-modal',
                buttons: {
                  cancel: {
                    label: 'Cancel',
                    className: 'btn'
                  }
                }
              })
            }
          },
          cancel: {
            label: "Cancel",
            className: "btn"
          }
        }
      });
    });

    $('button.add-selected').bind('click', function(e) {
        var selected = [];
        e.preventDefault();
        var checkboxes = $('.rbmodal-iframe').contents().find('input[name="nid"]');
        checkboxes.each(function() {
          if($(this).is(':checked')) {
            $.ajax({
              url: Drupal.settings.epe.base_path + 'api/resource/' + $(this).data('type') + '/' + $(this).val(),
              dataType: 'json',
              async: true,
              success: function(data) {
                window.parent.addItem(data, true);
              }
            });
          }
        });
    });

    $('.rbmodal').bind('click', function(e) {
      $('#rbmodal')
        /*.bind('show', function(event) {
          $(this).width($(this).find('.rbmodal-iframe').width() + 25).find('.modal-body').css('max-height',$(this).find('.rbmodal-iframe').height());
        })*/
        .find('.rbmodal-iframe').attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/search?dialog&type=' + $(this).data('api'));
      //$('.rbmodal-iframe').attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/search?dialog&type=' + $(this).data('api'));
    });



    if(Drupal.settings.default_dataset_value != null) {
      var items = JSON.parse( Drupal.settings.default_dataset_value );
      $.each(items, function( index,value ) {
        window.addItem(value, false);
      });
    }

    $('#edit-submit').click(function(event) {
      event.preventDefault();
      window.saveDatasets();
      $('#llb-resource-node-form').submit();
    });
})
/*  }
};
})(jQuery)*/
