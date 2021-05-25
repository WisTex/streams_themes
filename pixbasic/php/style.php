<?php

if(! App::$install) {

	// Get the UID of the channel owner
	$uid = get_theme_uid();

	if($uid) {
		load_pconfig($uid,'pixbasic');
	}

	// Load the owners pconfig
	$nav_bg = get_pconfig($uid, 'pixbasic', 'nav_bg');
	$nav_icon_colour = get_pconfig($uid, 'pixbasic', 'nav_icon_colour');
	$nav_active_icon_colour = get_pconfig($uid, 'pixbasic', 'nav_active_icon_colour');
	$banner_colour = get_pconfig($uid,'pixbasic','banner_colour');
	$narrow_navbar = get_pconfig($uid,'pixbasic','narrow_navbar');
	$link_colour = get_pconfig($uid, 'pixbasic', 'link_colour');
	$schema = get_pconfig($uid,'pixbasic','schema');
	$bgcolour = get_pconfig($uid, 'pixbasic', 'background_colour');
	$background_image = get_pconfig($uid, 'pixbasic', 'background_image');
	$item_colour = get_pconfig($uid, 'pixbasic', 'item_colour');
	$comment_item_colour = get_pconfig($uid, 'pixbasic', 'comment_item_colour');
	$font_family = get_pconfig($uid, 'alterbasic', 'font_family');
	$font_size = get_pconfig($uid, 'pixbasic', 'font_size');
	$font_colour = get_pconfig($uid, 'pixbasic', 'font_colour');
	$radius = get_pconfig($uid, 'pixbasic', 'radius');
	$shadow = get_pconfig($uid,'pixbasic','photo_shadow');
	$converse_width=get_pconfig($uid,'pixbasic','converse_width');
	$top_photo=get_pconfig($uid,'pixbasic','top_photo');
	$reply_photo=get_pconfig($uid,'pixbasic','reply_photo');
}

// Now load the scheme.  If a value is changed above, we'll keep the settings
// If not, we'll keep those defined by the schema
// Setting $schema to '' wasn't working for some reason, so we'll check it's
// not --- like the mobile theme does instead.

// Allow layouts to over-ride the schema

$schema = ((isset($_REQUEST['schema']) && $_REQUEST['schema']) ? $_REQUEST['schema'] : EMPTY_STR);


if (($schema) && ($schema != '---')) {

	// Check it exists, because this setting gets distributed to clones
	if(file_exists('view/theme/pixbasic/schema/' . $schema . '.php')) {
		$schemefile = 'view/theme/pixbasic/schema/' . $schema . '.php';
		require_once ($schemefile);
	}

	if(file_exists('view/theme/pixbasic/schema/' . $schema . '.css')) {
		$schemecss = file_get_contents('view/theme/pixbasic/schema/' . $schema . '.css');
	}

}

// Allow admins to set a default schema for the hub.
// default.php and default.css MUST be symlinks to existing schema files in view/theme/pixbasic/schema
if ((!$schema) || ($schema == '---')) {

	if(file_exists('view/theme/pixbasic/schema/default.php')) {
		$schemefile = 'view/theme/pixbasic/schema/default.php';
		require_once ($schemefile);
	}

	if(file_exists('view/theme/pixbasic/schema/default.css')) {
		$schemecss = file_get_contents('view/theme/pixbasic/schema/default.css');
	}

}
		
//Set some defaults - we have to do this after pulling owner settings, and we have to check for each setting
//individually.  If we don't, we'll have problems if a user has set one, but not all options.
if (! (isset($nav_bg) && $nav_bg))
	$nav_bg = '#E44D3A';
if (! (isset($nav_icon_colour) && $nav_icon_colour))
	$nav_icon_colour = 'rgba(255, 255, 255, 0.75)';
if (! (isset($nav_active_icon_colour) && $nav_active_icon_colour))
	$nav_active_icon_colour = 'rgba(255, 255, 255, 0.9)';
if (! (isset($link_colour) && $link_colour))
	$link_colour = '#E44D3A';
if (! (isset($banner_colour) && $banner_colour))
	$banner_colour = '#fff';
if (! (isset($bgcolour) && $bgcolour))
	$bgcolour = '#F2F2F2';
if (! (isset($background_image) && $background_image))
	$background_image ='';
if (! (isset($item_colour) && $item_colour))
	$item_colour = 'rgb(255,255,255)';
if (! (isset($comment_item_colour) && $comment_item_colour))
	$comment_item_colour = 'rgb(255,255,255)';
if (! (isset($item_opacity) && $item_opacity))
	$item_opacity = '1';
if (! (isset($font_family) && $font_family))
	$font_family = 'Liberation Sans, Arial';
if (! (isset($font_size) && $font_size))
	$font_size = '0.825rem';
if (! (isset($font_colour) && $font_colour))
	$font_colour = '#4d4d4d';
if (! (isset($radius) && $radius))
	$radius = '0.25rem';
if (! (isset($shadow) && $shadow))
	$shadow = '0';
if (! (isset($converse_width) && $converse_width))
	$converse_width = '635';
if (! (isset($top_photo) && $top_photo))
	$top_photo = '64px';
if (! (isset($reply_photo) && $reply_photo))
	$reply_photo = '32px';

// Apply the settings
if(file_exists('view/theme/pixbasic/css/style.css')) {

	$x = file_get_contents('view/theme/pixbasic/css/style.css');

	if($narrow_navbar && file_exists('view/theme/pixbasic/css/narrow_navbar.css')) {
		$x .= file_get_contents('view/theme/pixbasic/css/narrow_navbar.css');
	}

	if(isset($schemecss)) {
		$x .= $schemecss;
	}

	$aside_width = 288;

	// left aside and right aside are 285px + converse width
	$main_width = (($aside_width * 2) + intval($converse_width));

	// prevent main_width smaller than 768px
	$main_width = (($main_width < 768) ? 768 : $main_width);

	$options = array (
		'$nav_bg' => $nav_bg,
		'$nav_icon_colour' => $nav_icon_colour,
		'$nav_active_icon_colour' => $nav_active_icon_colour,
		'$link_colour' => $link_colour,
		'$banner_colour' => $banner_colour,
		'$bgcolour' => $bgcolour,
		'$background_image' => $background_image,
		'$item_colour' => $item_colour,
		'$comment_item_colour' => $comment_item_colour,
		'$font_family' => $font_family,
		'$font_size' => $font_size,
		'$font_colour' => $font_colour,
		'$radius' => $radius,
		'$shadow' => $shadow,
		'$converse_width' => $converse_width,
		'$top_photo' => $top_photo,
		'$reply_photo' => $reply_photo,
		'$main_width' => $main_width,
		'$aside_width' => $aside_width
	);

	echo str_replace(array_keys($options), array_values($options), $x);

}

// Set the schema to the default schema in derived themes. See the documentation for creating derived themes how to override this. 

if(local_channel() && App::$channel && App::$channel['channel_theme'] != 'pixbasic')
	set_pconfig(local_channel(), 'pixbasic', 'schema', '---');
