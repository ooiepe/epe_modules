/*(function($) {
Drupal.behaviors.epe_llb_exploration_dataset = {
  attach: function(context, settings) {*/
jQuery(document).ready(function($) {
    $('button.add-selected').bind('click', function(e) {
        var selected, selected_api = $(this).attr('data-api');
        e.preventDefault();
        selected = JSON.parse(jQuery.session.get('selectedResources'));
        if(selected_api != 'all') {
          if(typeof selected[selected_api] != 'undefined') {
            _.each(selected[selected_api], function(val) {
              $.ajax({
                url: Drupal.settings.epe.base_path + 'api/resource/' + selected_api + '/' + val,
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
            });
            selected[selected_api] = [];
          }
        } else {
          _.each(_.keys(selected), function(key_val, key) {
            _.each(selected[key_val], function(val) {
              $.ajax({
                url: Drupal.settings.epe.base_path + 'api/resource/' + key_val + '/' + val,
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
            });
            selected[key_val] = [];
          });
        }
        $.session.set('selectedResources',JSON.stringify(selected));
        /*_.each(_.keys(selected), function(type_val, key) {
          _.each(selected[type_val], function(nid_val, key) {
            $.ajax({
              url: Drupal.settings.epe.base_path + 'api/resource/' + type_val + '/' + nid_val,
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
          });
        });*/

        //var checkboxes = $('.rbmodal-iframe').contents().find('input[name="nid"]');
/*        checkboxes.each(function() {
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
        });*/
        /*$('.rbmodal-iframe').contents().find('input[name="nid"]:checked').each(function() {
          $(this).attr('checked', false);
        });*/
    });

    $('.rbmodal').bind('click', function(e) {
      var iframe_url = Drupal.settings.epe.base_path + 'dialog/resource-browser#/search?type=' + $(this).data('api');
      if($(this).data('api') != 'all') iframe_url += '&exclude=true';
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
        //.attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/dialog/search?dialogmode=true&dialog=' + $(this).data('api'))
        //.attr('src', Drupal.settings.epe.base_path + 'dialog/rb#/search?type=' + $(this).data('api'))
        .attr('src',iframe_url)
        .height($(window).height() * 0.8);
        $('#adhocmodal').attr('data-controller', $(this).data('controller'));
      $('#rbmodal').find('button.add-selected').attr('data-api',$(this).data('api'));
      //$('.rbmodal-iframe').attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/search?dialog&type=' + $(this).data('api'));
    });

    $('.add-adhoc').bind('click', function(e) {
      $('#adhocmodal').height($(window).height() * 0.8)
      .find('.adhocmodal-iframe').height($(window).height() * 0.65);
      $('#adhocmodal').find('.adhocmodal-iframe').attr('src',Drupal.settings.epe.base_path + 'dialog/resource/add');
      $('.btn-back').attr('data-api',$(this).data('api'));
      $('.rbmodal-iframe').contents().find('input[name="nid"]:checked').each(function() {
        $(this).attr('checked', false);
      });
    });

    $('.btn-back').bind('click', function(e) {
      //$('#rbmodal').attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/dialog/search?dialogmode=true&dialog=' + $(this).data('api'));
      $('#rbmodal').attr('src', Drupal.settings.epe.base_path + 'dialog/resource-browser#/search?type=' + $(this).data('api') + '&exclude=true');
    });

    $('.btn-close').bind('click', function(e) {
      var selected = JSON.parse(jQuery.session.get('selectedResources'));
      selected = {};
      $.session.set('selectedResources',JSON.stringify(selected));
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

    $('.text_resource').click(function() {
      var data = {"nid":"NULL","type":"text","title":"Please enter your title","body":"Please enter your description","thumbnail":Drupal.settings.epe.theme_path+'/images/no_thumb_small.jpg',"uri":""};
      window.parent.addDataSetItem(data, true);
    });
});

function loadResourceThumbnail(value) {
  jQuery.map(Drupal.settings.epe_dbresource_browser.modules, function(obj) {
    if(obj.content_type === value.type) {
      var apiurl = Drupal.settings.epe.base_path + 'api/resource/';
      if(obj.content_type === 'video_resource' || obj.content_type === 'audio_resource' || obj.content_type == 'web_resource') {
        apiurl += 'multimedia';
      } else {
        apiurl += obj.resource_browser.api;
      }

      jQuery.get(apiurl + '/' + value.nid, function(result) {
        var result = JSON.parse(result);
        value.thumbnail = result.thumbnail;
      }).fail(function() {
        value.thumbnail = Drupal.settings.epe.theme_path + '/images/no_thumb_small.jpg';
      });
    }
  });
  return value;
}
/*  }
};
})(jQuery)*/
