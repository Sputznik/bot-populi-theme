jQuery(document).ready(function(){

  var $el = jQuery( '[data-behaviour~="btp-author-typeahead"]' ),
      $authors_wrapper   = $el.parent().siblings('.checkbox'),
      $authors_input     = $authors_wrapper.find('input');

  $el.on('keyup', function(){
    var filter_val = $el.val().toLowerCase(); // CONVERT THE FILTER VALUE TO LOWERCASE;
    // console.log(filter_val);

    // LOOP THROUGH ALL THE AUTHOR NAMES
    $authors_wrapper.each(function(){
      var $author = jQuery(this),
          $author_name = $author.find('input').data('author');
      // CHECK IF THE AUTHOR NAME CONTAINS THE FILTER VALUE
      if( $author_name.indexOf(filter_val) == -1 ){
        $author.hide();
      } else{
        $author.show();
      }
    }); //LOOP ENDS

  }); //KEYUP ENDS

  $authors_input.click(function(){
    // RESET SEARCH INPUT
    $el.val('');
    $authors_wrapper.show();
  });

});
