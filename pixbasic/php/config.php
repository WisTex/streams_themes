<?php

namespace Code\Theme;

use App;
use Code\Lib\Features;
use Code\Render\Theme;


class PixbasicConfig {

	function get_schemas() {
		$files = glob('view/theme/pixbasic/schema/*.php');

		$scheme_choices = [];

		if($files) {

			if(in_array('view/theme/pixbasic/schema/default.php', $files)) {
				$scheme_choices['---'] = t('Default');
				$scheme_choices['focus'] = t('Focus (Hubzilla default)');
			}
			else {
				$scheme_choices['---'] = t('Redish (default)');
			}

			foreach($files as $file) {
				$f = basename($file, ".php");
				if($f != 'default') {
					$scheme_name = $f;
					$scheme_choices[$f] = $scheme_name;
				}
			}
		}

		return $scheme_choices;
	}

	function get() {
		if(! local_channel()) { 
			return;
		}

		$arr = [];
		$arr['narrow_navbar'] = get_pconfig(local_channel(),'pixbasic', 'narrow_navbar' );
		$arr['nav_bg'] = get_pconfig(local_channel(),'pixbasic', 'nav_bg' );
		$arr['nav_icon_colour'] = get_pconfig(local_channel(),'pixbasic', 'nav_icon_colour' );
		$arr['nav_active_icon_colour'] = get_pconfig(local_channel(),'pixbasic', 'nav_active_icon_colour' );
		$arr['link_colour'] = get_pconfig(local_channel(),'pixbasic', 'link_colour' );
		$arr['banner_colour'] = get_pconfig(local_channel(),'pixbasic', 'banner_colour' );
		$arr['bgcolour'] = get_pconfig(local_channel(),'pixbasic', 'background_colour' );
		$arr['background_image'] = get_pconfig(local_channel(),'pixbasic', 'background_image' );
		$arr['item_colour'] = get_pconfig(local_channel(),'pixbasic', 'item_colour' );
		$arr['comment_item_colour'] = get_pconfig(local_channel(),'pixbasic', 'comment_item_colour' );
		$arr['font_family'] = get_pconfig(local_channel(),'alterbasic', 'font_family' );
		$arr['font_size'] = get_pconfig(local_channel(),'pixbasic', 'font_size' );
		$arr['font_colour'] = get_pconfig(local_channel(),'pixbasic', 'font_colour' );
		$arr['radius'] = get_pconfig(local_channel(),'pixbasic', 'radius' );
		$arr['shadow'] = get_pconfig(local_channel(),'pixbasic', 'photo_shadow' );
		$arr['converse_width']=get_pconfig(local_channel(),"pixbasic","converse_width");
		$arr['top_photo']=get_pconfig(local_channel(),"pixbasic","top_photo");
		$arr['reply_photo']=get_pconfig(local_channel(),"pixbasic","reply_photo");
		return $this->form($arr);
	}

	function post() {
		if(!local_channel()) { 
			return;
		}

		if (isset($_POST['pixbasic-settings-submit'])) {
			set_pconfig(local_channel(), 'pixbasic', 'narrow_navbar', $_POST['pixbasic_narrow_navbar']);
			set_pconfig(local_channel(), 'pixbasic', 'nav_bg', $_POST['pixbasic_nav_bg']);
			set_pconfig(local_channel(), 'pixbasic', 'nav_icon_colour', $_POST['pixbasic_nav_icon_colour']);
			set_pconfig(local_channel(), 'pixbasic', 'nav_active_icon_colour', $_POST['pixbasic_nav_active_icon_colour']);
			set_pconfig(local_channel(), 'pixbasic', 'link_colour', $_POST['pixbasic_link_colour']);
			set_pconfig(local_channel(), 'pixbasic', 'background_colour', $_POST['pixbasic_background_colour']);
			set_pconfig(local_channel(), 'pixbasic', 'banner_colour', $_POST['pixbasic_banner_colour']);
			set_pconfig(local_channel(), 'pixbasic', 'background_image', $_POST['pixbasic_background_image']);
			set_pconfig(local_channel(), 'pixbasic', 'item_colour', $_POST['pixbasic_item_colour']);
			set_pconfig(local_channel(), 'pixbasic', 'comment_item_colour', $_POST['pixbasic_comment_item_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'font_family', $_POST['alterbasic_font_family']);
			set_pconfig(local_channel(), 'pixbasic', 'font_size', $_POST['pixbasic_font_size']);
			set_pconfig(local_channel(), 'pixbasic', 'font_colour', $_POST['pixbasic_font_colour']);
			set_pconfig(local_channel(), 'pixbasic', 'radius', $_POST['pixbasic_radius']);
			set_pconfig(local_channel(), 'pixbasic', 'photo_shadow', $_POST['pixbasic_shadow']);
			set_pconfig(local_channel(), 'pixbasic', 'converse_width', $_POST['pixbasic_converse_width']);
			set_pconfig(local_channel(), 'pixbasic', 'top_photo', $_POST['pixbasic_top_photo']);
			set_pconfig(local_channel(), 'pixbasic', 'reply_photo', $_POST['pixbasic_reply_photo']);
		}
	}

	function form($arr) {

		if(feature_enabled(local_channel(),'advanced_theming')) 
			$expert = 1;
					

	  	$o .= replace_macros(get_markup_template('theme_settings.tpl'), array(
			'$submit' => t('Submit'),
			'$baseurl' => z_root(),
			'$theme' => \App::$channel['channel_theme'],
			'$expert' => $expert,
			'$title' => t("Theme settings"),
			'$narrow_navbar' => array('pixbasic_narrow_navbar',t('Narrow navbar'),$arr['narrow_navbar'], '', array(t('No'),t('Yes'))),
			'$nav_bg' => array('pixbasic_nav_bg', t('Navigation bar background color'), $arr['nav_bg']),
			'$nav_icon_colour' => array('pixbasic_nav_icon_colour', t('Navigation bar icon color '), $arr['nav_icon_colour']),	
			'$nav_active_icon_colour' => array('pixbasic_nav_active_icon_colour', t('Navigation bar active icon color '), $arr['nav_active_icon_colour']),
			'$link_colour' => array('pixbasic_link_colour', t('Link color'), $arr['link_colour'], '', $link_colours),
			'$banner_colour' => array('pixbasic_banner_colour', t('Set font-color for banner'), $arr['banner_colour']),
			'$bgcolour' => array('pixbasic_background_colour', t('Set the background color'), $arr['bgcolour']),
			'$background_image' => array('pixbasic_background_image', t('Set the background image'), $arr['background_image']),	
			'$item_colour' => array('pixbasic_item_colour', t('Set the background color of items'), $arr['item_colour']),
			'$comment_item_colour' => array('pixbasic_comment_item_colour', t('Set the background color of comments'), $arr['comment_item_colour']),
			'$font_family' => array('alterbasic_font_family', t('Set font-family for the entire application'), $arr['font_family'], t('Examples: Liberation Sans, Nimbus Roman')),
			'$font_size' => array('pixbasic_font_size', t('Set font-size for the entire application'), $arr['font_size'], t('Examples: 1rem, 100%, 16px')),
			'$font_colour' => array('pixbasic_font_colour', t('Set font-color for posts and comments'), $arr['font_colour']),
			'$radius' => array('pixbasic_radius', t('Set radius of corners'), $arr['radius'], t('Example: 4px')),
			'$shadow' => array('pixbasic_shadow', t('Set shadow depth of photos'), $arr['shadow']),
			'$converse_width' => array('pixbasic_converse_width',t('Set maximum width of content region in pixel'),$arr['converse_width'], t('Leave empty for default width')),
			'$top_photo' => array('pixbasic_top_photo', t('Set size of conversation author photo'), $arr['top_photo']),
			'$reply_photo' => array('pixbasic_reply_photo', t('Set size of followup author photos'), $arr['reply_photo']),
			));

		return $o;
	}

}






