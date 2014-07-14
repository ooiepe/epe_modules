(function($) {
  $(function() {
    $('a[data-toggle="tab"]').on('click', function(e) {
      history.pushState(null, null, $(this).attr('href'));
    });

    $('button[data-toggle="tab"]').on('click', function(e) {
      history.pushState(null, null, '#' + $(this).data('target'));
    });

    // navigate to a tab when the history changes
    window.addEventListener("popstate", function(e) {
      var activeTab = $('[href=' + location.hash + ']');
      if (activeTab.length) {
        activeTab.tab('show');
      } else {
        var $tab = $('a[data-toggle="tab"][href="#intro"]');
        $tab.show();                  // Display the tab
        $tab.tab('show');
      }
    });
  })
})(jQuery)
