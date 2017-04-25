jQuery(document).ready(function(){

  if($(window).width() >= 1024){
    $('a.dropdown-toggle').click(function(){
      $('.col-sm-3').css('z-index', -1);
    })
    $('.dropdown-menu').mouseenter(function(){
      $('.col-sm-3').css('z-index', -1);
    })
    $('div.row').mouseenter(function(){
      $('.col-sm-3').css('z-index', 1);
    })
  }
})
