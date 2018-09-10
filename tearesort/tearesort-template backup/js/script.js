/*----------------------------------*/
/*      Always Start Body From Top If It IS Refresh
/*----------------------------------*/

    $(window).unload(function() {
        $('body').scrollTop(0);
    });
    


/*----------------------------------*/
/*      Adding classes to lists
/*----------------------------------*/

$(document).ready(function() {      
    $("ul > li:nth-child(even)").addClass("even");
    $("ul > li:nth-child(odd)").addClass("odd");
    $("ul li:first-child").addClass("first-child");
    $("ul li:last-child").addClass("last-child");
}); 






/*
-----------------------
-----------------------
    prettyPhoto
-----------------------
-----------------------
*/
$(document).ready(function(){
  $("a[rel^='prettyPhoto']").prettyPhoto({
      deeplinking:false,
      default_width: 600,
      default_height: 400,
      overlay_gallery: false
  });

  $("a[rel^='gallery']").prettyPhoto({
      deeplinking:false,
      default_width: 1000,
      default_height: 800,
      overlay_gallery: false
  });

  $("a[rel^='restaurant_vtours']").prettyPhoto({
      deeplinking:false,
      default_width: 640,
      default_height: 485,
      overlay_gallery: false
  });

  $("a[rel^='photos']").prettyPhoto({
      deeplinking:false,
      overlay_gallery: false
  });
});


/*
-------------------------
-------------------------
    Anchor Replace
-------------------------
-------------------------
*/

if($(window).outerWidth()<768){
  //var mobileLink = $('.virtual-tour-container .virtual-tour-ul > li > a').attr('data-xs-href');
  //$('.virtual-tour-container .virtual-tour-ul > li > a').attr('href', mobileLink);

  $('.virtual-tour-container .virtual-tour-ul > li > a').each(function() {
    var value = $(this).attr('data-xs-href');
    $(this).attr('href', value);
  });

  $('.vt-holder > a.vt-item').each(function() {
    var value = $(this).attr('data-xs-href');
    $(this).attr('href', value);
  });

  $('.restaurant-media-div > a.vt-item').each(function() {
    var value = $(this).attr('data-xs-href');
    $(this).attr('href', value);
  });

  $('.link-ul > li > a.vt-item').each(function() {
    var value = $(this).attr('data-xs-href');
    $(this).attr('href', value);
  });

}



