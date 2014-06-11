/*(function($) {
Drupal.behaviors.epe_llb_exploration_dataset = {
  attach: function(context, settings) {*/
jQuery(document).ready(function($) {
    $('.btn.add-resources').on("click", function() {
      bootbox.dialog({
        message: '<iframe src="' + Drupal.settings.epe.base_path + 'dialog/resource-browser#/dialog/search?dialogmode=true&module=' + $(this).data('api') + '" seamless width="779" height="500" class="resource-browser-iframe" />',
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
                      window.addDataSetItem(data, true);
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
                if(data.thumbnail == '') data.thumbnail = Drupal.settings.epe.base_path + Drupal.settings.llb.thumbnail_placeholder;

                if($('#rbmodal').attr('data-controller') == 'intro') {
                  window.parent.addIntroItem(data, true);
                } else if($('#rbmodal').attr('data-controller') == 'dataset') {
                  window.parent.addDataSetItem(data, true);
                } else if($('#rbmodal').attr('data-controller') == 'background') {
                  window.parent.addBackgroundSlideshowItem(data, true);
                } else if($('#rbmodal').attr('data-controller') == 'challenge') {
                  window.parent.addChallengeThumbnailItem(data, true);
                }
              }
            });
          }
        });
        $('.rbmodal-iframe').contents().find('input[name="nid"]:checked').each(function() {
          $(this).attr('checked', false);
        });
    });

    $('.rbmodal').bind('click', function(e) {
      if($(this).data('adhoc') == true) {
        $('.add-adhoc').show().attr('data-api',$(this).data('api')); } else { $('.add-adhoc').hide();
      }

      //$('button.add-selected').data('controller', $(this).data('controller'));
      $('#rbmodal').attr('data-controller', $(this).data('controller'))
        .height($(window).height() * 0.9)
        /*.bind('show', function(event) {
          $(this).width($(this).find('.rbmodal-iframe').width() + 25).find('.modal-body').css('max-height',$(this).find('.rbmodal-iframe').height());
        })*/
        .find('.rbmodal-iframe')
        .attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/dialog/search?dialogmode=true&module=' + $(this).data('api'))
        .height($(window).height() * 0.8);
        $('#adhocmodal').attr('data-controller', $(this).data('controller'));
      //$('.rbmodal-iframe').attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/search?dialog&type=' + $(this).data('api'));
    });

    $('.add-adhoc').bind('click', function(e) {
      $('#adhocmodal').height($(window).height() * 0.8)
      .find('.adhocmodal-iframe').height($(window).height() * 0.65);
      $('.btn-back').attr('data-api',$(this).data('api'));
      $('.rbmodal-iframe').contents().find('input[name="nid"]:checked').each(function() {
        $(this).attr('checked', false);
      });
    });

    $('.btn-back').bind('click', function(e) {
      $('#rbmodal').attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/dialog/search?dialogmode=true&module=' + $(this).data('api'));
    });

    if(Drupal.settings.default_dataset_value != null) {
      var items = JSON.parse( Drupal.settings.default_dataset_value );
      $.each(items, function( index, value ) {
        value = loadResourceThumbnail(value);
        window.addDataSetItem(value, false);
      });
    }
    if(Drupal.settings.default_intro_slideshow != null) {
      var items = JSON.parse( Drupal.settings.default_intro_slideshow );
      $.each(items, function( index, value ) {
        value = loadResourceThumbnail(value);
        window.addIntroItem(value, false);
      });
    }
    if(Drupal.settings.default_background_slideshow != null) {
      var items = JSON.parse( Drupal.settings.default_background_slideshow );
      $.each(items, function( index, value ) {
        value = loadResourceThumbnail(value);
        window.addBackgroundSlideshowItem(value, false);
      });
    }
    if(Drupal.settings.default_challenge_thumbnail != null) {
      var items = JSON.parse( Drupal.settings.default_challenge_thumbnail );
      $.each(items, function( index, value ) {
        value = loadResourceThumbnail(value);
        window.addChallengeThumbnailItem(value, false);
      });
    }

    $('#edit-submit').click(function(event) {
      event.preventDefault();
      window.saveDatasets();
      window.saveIntroItems();
      window.saveBackgroundItems();
      $('#llb-resource-node-form').submit();
    });
});

function loadResourceThumbnail(value) {
  jQuery.map(Drupal.settings.epe_dbresource_browser.modules, function(obj) {
    if(obj.content_type === value.type) {
      var apiurl = Drupal.settings.epe.base_path + 'api/resource/';
      if(obj.content_type === 'video_resource' || obj.content_type === 'audio_resource') {
        apiurl += 'multimedia';
      } else {
        apiurl += obj.resource_browser.api;
      }

      jQuery.get(apiurl + '/' + value.nid, function(result) {
        var result = JSON.parse(result);
        value.thumbnail = result.thumbnail;
      }).fail(function() {
        value.thumbnail = Drupal.settings.theme_path + '/images/no_thumb_small.jpg';
      });
    }
  });
  return value;
}
/*  }
};
})(jQuery)*/
