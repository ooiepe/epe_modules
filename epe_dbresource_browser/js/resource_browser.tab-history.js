(function($) {
  $(function() {
    window.addEventListener("popstate", function(e) {
      var vars = [], hash;
      var q = document.URL.split('?')[1];
      if(q != undefined){
          q = q.split('&');
          for(var i = 0; i < q.length; i++){
              hash = q[i].split('=');
              vars.push(hash[1]);
              vars[hash[0]] = hash[1];
          }
      }
      $('.rb-type-selector li.' + vars['type']).trigger('click');
    });
  })
})(jQuery)

