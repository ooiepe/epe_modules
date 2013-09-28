/*(function($) {
Drupal.behaviors.epe_llb_exploration_dataset = {
  attach: function(context, settings) {*/
jQuery(document).ready(function($) {
    $('.btn.add-resources').on("click", function() {
/*                  bootbox.alert("Hello world!", function() {
                console.log("Alert Callback");
            });*/

      bootbox.dialog({
        message: '<iframe src="/dialog/resource-browser#/search?dialog&type=' + $(this).data('api') + '" seamless width="879" height="500" class="resource-browser-iframe" />',
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
            /*$.getJSON('/api/resource/image/' + $(this).val(), function(data) {
              console.log(data);
              selected.push(data);
            });*/
 /*           $.getJSON('/api/resource/image/' + $(this).val()).done(function(data) {
              //selected.push(data);
              window.addResources(data);
            });*/
              $.ajax({
                url: '/api/resource/' + $(this).data('type') + '/' + $(this).val(),
                dataType: 'json',
                async: true,
                success: function(data) {
                  window.addItem(data);
                }
              });
          }
        });
            }
          },
          cancel: {
            label: "Cancel",
            className: "btn"
          }
        }
      });
    });

    if(Drupal.settings.default_dataset_value != null) {
      var items = JSON.parse( Drupal.settings.default_dataset_value );
      $.each(items, function( index,value ) {
        window.addItem(value);
      });
      //window.addItem(Drupal.settings.default_dataset_value);
    }
})
/*  }
};
})(jQuery)*/
