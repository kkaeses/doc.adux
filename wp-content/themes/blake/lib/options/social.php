<?php
	
	$blake_general_options= array( array(
		"name" => "Twitter and Social Icons",
		"type" => "title",
		"img" => BLAKE_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"social", "name"=>"Social Icons"), array("id"=>"twitter", "name" => "Twitter"))
	),
	
	
	
	/* ------------------------------------------------------------------------*
	 * Top Panel
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'social'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Social Icons</h3>"
	),
	
	array(
		"name" => "Facebook Icon",
		"id" => "blake_icon-facebook",
		"type" => "text",
		"desc" => "Enter full url   ex: http://facebook.com/UpperThemes",
		"std" => ""
	),
	array(
		"name" => "Twitter Icon",
		"id" => "blake_icon-twitter",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Tumblr Icon",
		"id" => "blake_icon-tumblr",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Stumble Upon Icon",
		"id" => "blake_icon-stumbleupon",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Flickr Icon",
		"id" => "blake_icon-flickr",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "LinkedIn Icon",
		"id" => "blake_icon-linkedin",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Delicious Icon",
		"id" => "blake_icon-delicious",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Skype Icon",
		"id" => "blake_icon-skype",
		"type" => "text",
		"desc" => "For a directly call to your Skype, add the following code.  skype:username?call",
		"std" => ""
	),
	array(
		"name" => "Digg Icon",
		"id" => "blake_icon-digg",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Google Icon",
		"id" => "blake_icon-google-plus",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Vimeo Icon",
		"id" => "blake_icon-vimeo-square",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "DeviantArt Icon",
		"id" => "blake_icon-deviantart",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Behance Icon",
		"id" => "blake_icon-behance",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Instagram Icon",
		"id" => "blake_icon-instagram",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Blogger Icon",
		"id" => "blake_icon-blogger",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Wordpress Icon",
		"id" => "blake_icon-wordpress",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Youtube Icon",
		"id" => "blake_icon-youtube",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Reddit Icon",
		"id" => "blake_icon-reddit",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "RSS Icon",
		"id" => "blake_icon-rss",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "SoundCloud Icon",
		"id" => "blake_icon-soundcloud",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Pinterest Icon",
		"id" => "blake_icon-pinterest",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Dribbble Icon",
		"id" => "blake_icon-dribbble",
		"type" => "text",
		"std" => ""
	),

	array(
		"type" => "close"
	),
	
	/* twitter options */ 
	array(
		"type" => "subtitle",
		"id"=>'twitter'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Twitter Scroller</h3>"
	),
	
	array(
		"name" => "Twitter Username",
		"id" => "blake_twitter_username",
		"type" => "text",
		"std" => ''
	),
	
	array(
		"name" => "Twitter App Consumer Key",
		"id" => "twitter_consumer_key",
		"type" => "text"
	),
	
	array(
		"name" => "Twitter App Consumer Secret",
		"id" => "twitter_consumer_secret",
		"type" => "text"
	),
	
	array(
		"name" => "Twitter App Access Token",
		"id" => "twitter_user_token",
		"type" => "text"
	),
	
	array(
		"name" => "Twitter App Access Token Secret",
		"id" => "twitter_user_secret",
		"type" => "text"
	),
	
	array(
		"name" => "Number Tweets",
		"id" => "blake_twitter_number_tweets",
		"type" => "text",
		"std" => '5'
	),
	
	array( "type" => "close" ),
	
		
	/*close array*/
	
	array(
		"type" => "close"
	));
	
	blake_add_options($blake_general_options);
	
?>