/* custom filter to loop through a range of number
 * use this filter to mimic numeric for loop
*/
define(['app'], function(app) {
  app.filter('range', function() {
    return function(input, total) {
      total = parseInt(total);
      for(var i=0; i<total; i++) {
        input.push(i);
      }
      return input;
    }
  });
});
