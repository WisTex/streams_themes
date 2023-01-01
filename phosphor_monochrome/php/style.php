<?php

use Code\Lib\Channel;

if(! App::$install) {

	// Get the UID of the channel owner
	$uid = get_theme_uid();

	if($uid) {
		load_pconfig($uid,'phosphor_monochrome');
	}

	// Load the owners pconfig
	$nav_bg = get_pconfig($uid, 'phosphor_monochrome', 'nav_bg');
	$nav_icon_colour = get_pconfig($uid, 'phosphor_monochrome', 'nav_icon_colour');
	$nav_active_icon_colour = get_pconfig($uid, 'phosphor_monochrome', 'nav_active_icon_colour');
	$banner_colour = get_pconfig($uid,'phosphor_monochrome','banner_colour');
	$narrow_navbar = get_pconfig($uid,'phosphor_monochrome','narrow_navbar');
	$link_colour = get_pconfig($uid, 'phosphor_monochrome', 'link_colour');
	$schema = get_pconfig($uid,'phosphor_monochrome','schema');
	$bgcolour = get_pconfig($uid, 'phosphor_monochrome', 'background_colour');
	$background_image = get_pconfig($uid, 'phosphor_monochrome', 'background_image');
	$item_colour = get_pconfig($uid, 'phosphor_monochrome', 'item_colour');
	$comment_item_colour = get_pconfig($uid, 'phosphor_monochrome', 'comment_item_colour');
	$font_size = get_pconfig($uid, 'phosphor_monochrome', 'font_size');
	$font_colour = get_pconfig($uid, 'phosphor_monochrome', 'font_colour');
	$radius = get_pconfig($uid, 'phosphor_monochrome', 'radius');
	$shadow = get_pconfig($uid,'phosphor_monochrome','photo_shadow');
	$converse_width=get_pconfig($uid,'phosphor_monochrome','converse_width');
	$top_photo=get_pconfig($uid,'phosphor_monochrome','top_photo');
	$reply_photo=get_pconfig($uid,'phosphor_monochrome','reply_photo');
	// Extra variables for this theme //
        $font_family = get_pconfig($uid, 'phosphor_monochrome', 'font_family');
        $txtblur = get_pconfig($uid, 'phosphor_monochrome', 'txtblur');
        $btnblur = get_pconfig($uid, 'phosphor_monochrome', 'btnblur');
        $imgfilter = get_pconfig($uid, 'phosphor_monochrome', 'imgfilter');
        $bordblur = get_pconfig($uid, 'phosphor_monochrome', 'bordblur');
        $subtlblur = get_pconfig($uid, 'phosphor_monochrome', 'subtlblur');
}

// Now load the scheme.  If a value is changed above, we'll keep the settings
// If not, we'll keep those defined by the schema
// Setting $schema to '' wasn't working for some reason, so we'll check it's
// not --- like the mobile theme does instead.

// Allow layouts to over-ride the schema

$schema = ((isset($_REQUEST['schema']) && $_REQUEST['schema']) ? $_REQUEST['schema'] : EMPTY_STR);


if (($schema) && ($schema != '---')) {

	// Check it exists, because this setting gets distributed to clones
	if(file_exists('view/theme/phosphor_monochrome/schema/' . $schema . '.php')) {
		$schemefile = 'view/theme/phosphor_monochrome/schema/' . $schema . '.php';
		require_once ($schemefile);
	}

	if(file_exists('view/theme/phosphor_monochrome/schema/' . $schema . '.css')) {
		$schemecss = file_get_contents('view/theme/phosphor_monochrome/schema/' . $schema . '.css');
	}

}

// Allow admins to set a default schema for the hub.
// default.php and default.css MUST be symlinks to existing schema files in view/theme/phosphor_monochrome/schema
if ((!$schema) || ($schema == '---')) {

	if(file_exists('view/theme/phosphor_monochrome/schema/default.php')) {
		$schemefile = 'view/theme/phosphor_monochrome/schema/default.php';
		require_once ($schemefile);
	}

	if(file_exists('view/theme/phosphor_monochrome/schema/default.css')) {
		$schemecss = file_get_contents('view/theme/phosphor_monochrome/schema/default.css');
	}

}

//Set some defaults - we have to do this after pulling owner settings, and we have to check for each setting
//individually.  If we don't, we'll have problems if a user has set one, but not all options.
if (! (isset($nav_bg) && $nav_bg))
	$nav_bg = '#000005';
if (! (isset($nav_icon_colour) && $nav_icon_colour))
        $nav_icon_colour = 'rgba(245, 245, 255, 0.75)';
if (! (isset($nav_active_icon_colour) && $nav_active_icon_colour))
        $nav_active_icon_colour = 'rgba(245, 245, 255, 1)';
if (! (isset($link_colour) && $link_colour))
	$link_colour = '#f5f5ff';
if (! (isset($banner_colour) && $banner_colour))
	$banner_colour = '#f5f5ff';
if (! (isset($bgcolour) && $bgcolour))
	$bgcolour = '#000005';
if (! (isset($background_image) && $background_image))
	$background_image ='';
if (! (isset($item_colour) && $item_colour))
	$item_colour = '#00001d';
if (! (isset($comment_item_colour) && $comment_item_colour))
	$comment_item_colour = '#000';
if (! (isset($item_opacity) && $item_opacity))
	$item_opacity = '1';
if (! (isset($font_size) && $font_size))
	$font_size = '0.875rem';
if (! (isset($font_colour) && $font_colour))
	$font_colour = '#f5f5ff';
if (! (isset($radius) && $radius))
	$radius = '0.25rem';
if (! (isset($shadow) && $shadow))
	$shadow = '0';
if (! (isset($converse_width) && $converse_width))
	$converse_width = '790';
if (! (isset($top_photo) && $top_photo))
	$top_photo = '64px';
if (! (isset($reply_photo) && $reply_photo))
	$reply_photo = '32px';
// Extra variables for this theme //
if (! (isset($font_family) && $font_family))
        $font_family = 'Liberation Mono, Arial';
if (! (isset($txtblur) && $txtblur))
        $txtblur = '0 0 2px #ccccff, 0 0 8px #8a8aff, 0 0 12px #8a8aff';
if (! (isset($btnblur) && $btnblur))
        $btnblur = '0 0 1px #00000a, 0 0 10px #7070ff';
if (! (isset($subtlblur) && $subtlblur))
        $subtlblur = '0 0 1px #ccccff, 0 0 3px #8a8aff';
if (! (isset($bordblur) && $bordblur))
        $bordblur = sprintf("0 0 2px 1px %s, 0 0 2px 1px %s inset",$font_colour,$font_colour);
if (! (isset($imgfilter) && $imgfilter))
        $imgfilter = 'none';

// Apply the settings
if(file_exists('view/theme/phosphor_monochrome/css/style.css')) {

	$x = file_get_contents('view/theme/phosphor_monochrome/css/style.css');

	if($narrow_navbar && file_exists('view/theme/phosphor_monochrome/css/narrow_navbar.css')) {
		$x .= file_get_contents('view/theme/phosphor_monochrome/css/narrow_navbar.css');
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
		'$font_size' => $font_size,
		'$font_colour' => $font_colour,
		'$radius' => $radius,
		'$shadow' => $shadow,
		'$converse_width' => $converse_width,
		'$top_photo' => $top_photo,
		'$reply_photo' => $reply_photo,
		'$main_width' => $main_width,
		'$aside_width' => $aside_width,
		// Extra variables for this theme //
                '$font_family' => $font_family,
                '$txtblur' => $txtblur,
                '$btnblur' => $btnblur,
                '$imgfilter' => $imgfilter,
                '$bordblur' => $bordblur,
                '$subtlblur' => $subtlblur
	);

	echo str_replace(array_keys($options), array_values($options), $x);

}

// Set the schema to the default schema in derived themes. See the documentation for creating derived themes how to override this. 

if(local_channel() && App::$channel && App::$channel['channel_theme'] != 'phosphor_monochrome')
	set_pconfig(local_channel(), 'phosphor_monochrome', 'schema', '---');
