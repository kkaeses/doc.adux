

jQuery(document).ready(function(){

  /*

  _____         _                              _             ______         _                                 _
 /  __ \       | |                            (_)            | ___ \       | |                               | |
 | /  \/  __ _ | |_   ___   __ _   ___   _ __  _   ___  ___  | |_/ /  __ _ | |_   ___   ___   __ _  _ __   __| |
 | |     / _` || __| / _ \ / _` | / _ \ | '__|| | / _ \/ __| |    /  / _` || __| / _ \ / __| / _` || '__| / _` |
 | \__/\| (_| || |_ |  __/| (_| || (_) || |   | ||  __/\__ \ | |\ \ | (_| || |_ |  __/| (__ | (_| || |   | (_| |
  \____/ \__,_| \__| \___| \__, | \___/ |_|   |_| \___||___/ \_| \_| \__,_| \__| \___| \___| \__,_||_|    \__,_|
                            __/ |
                           |___/

  */
  $('a.dropdown-toggle').click(function(){
    $('.col-sm-3').css('z-index', -1);
  })
  $('.dropdown-menu').mouseenter(function(){
    $('.col-sm-3').css('z-index', -1);
  })
  $('div.row').mouseenter(function(){
    $('.col-sm-3').css('z-index', 1);
  })

})
