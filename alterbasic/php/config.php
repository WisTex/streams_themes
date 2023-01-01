<?php

use App;
use Code\Lib\Features;
use Code\Render\Theme;


namespace Code\Theme;

class AlterbasicConfig {

	function get_schemas() {
		$files = glob('view/theme/alterbasic/schema/*.php');

		$scheme_choices = [];

		if($files) {

			if(in_array('view/theme/alterbasic/schema/default.php', $files)) {
				$scheme_choices['---'] = t('Default');
				$scheme_choices['focus'] = t('Redish (default)');
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
		$arr['narrow_navbar'] = get_pconfig(local_channel(),'alterbasic', 'narrow_navbar' );
		$arr['nav_bg'] = get_pconfig(local_channel(),'alterbasic', 'nav_bg' );
		$arr['nav_icon_colour'] = get_pconfig(local_channel(),'alterbasic', 'nav_icon_colour' );
		$arr['nav_active_icon_colour'] = get_pconfig(local_channel(),'alterbasic', 'nav_active_icon_colour' );
		$arr['link_colour'] = get_pconfig(local_channel(),'alterbasic', 'link_colour' );
		$arr['banner_colour'] = get_pconfig(local_channel(),'alterbasic', 'banner_colour' );
		$arr['bgcolour'] = get_pconfig(local_channel(),'alterbasic', 'background_colour' );
		$arr['background_image'] = get_pconfig(local_channel(),'alterbasic', 'background_image' );
		$arr['item_colour'] = get_pconfig(local_channel(),'alterbasic', 'item_colour' );
		$arr['comment_item_colour'] = get_pconfig(local_channel(),'alterbasic', 'comment_item_colour' );
		$arr['font_family'] = get_pconfig(local_channel(),'alterbasic', 'font_family' );
		$arr['font_size'] = get_pconfig(local_channel(),'alterbasic', 'font_size' );
		$arr['font_colour'] = get_pconfig(local_channel(),'alterbasic', 'font_colour' );
		$arr['radius'] = get_pconfig(local_channel(),'alterbasic', 'radius' );
		$arr['shadow'] = get_pconfig(local_channel(),'alterbasic', 'photo_shadow' );
		$arr['converse_width']=get_pconfig(local_channel(),"alterbasic","converse_width");
		$arr['top_photo']=get_pconfig(local_channel(),"alterbasic","top_photo");
		$arr['reply_photo']=get_pconfig(local_channel(),"alterbasic","reply_photo");
		return $this->form($arr);
	}

	function post() {
		if(!local_channel()) { 
			return;
		}

		if (isset($_POST['alterbasic-settings-submit'])) {
			set_pconfig(local_channel(), 'alterbasic', 'narrow_navbar', $_POST['alterbasic_narrow_navbar']);
			set_pconfig(local_channel(), 'alterbasic', 'nav_bg', $_POST['alterbasic_nav_bg']);
			set_pconfig(local_channel(), 'alterbasic', 'nav_icon_colour', $_POST['alterbasic_nav_icon_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'nav_active_icon_colour', $_POST['alterbasic_nav_active_icon_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'link_colour', $_POST['alterbasic_link_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'background_colour', $_POST['alterbasic_background_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'banner_colour', $_POST['alterbasic_banner_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'background_image', $_POST['alterbasic_background_image']);
			set_pconfig(local_channel(), 'alterbasic', 'item_colour', $_POST['alterbasic_item_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'comment_item_colour', $_POST['alterbasic_comment_item_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'font_family', $_POST['alterbasic_font_family']);
			set_pconfig(local_channel(), 'alterbasic', 'font_size', $_POST['alterbasic_font_size']);
			set_pconfig(local_channel(), 'alterbasic', 'font_colour', $_POST['alterbasic_font_colour']);
			set_pconfig(local_channel(), 'alterbasic', 'radius', $_POST['alterbasic_radius']);
			set_pconfig(local_channel(), 'alterbasic', 'photo_shadow', $_POST['alterbasic_shadow']);
			set_pconfig(local_channel(), 'alterbasic', 'converse_width', $_POST['alterbasic_converse_width']);
			set_pconfig(local_channel(), 'alterbasic', 'top_photo', $_POST['alterbasic_top_photo']);
			set_pconfig(local_channel(), 'alterbasic', 'reply_photo', $_POST['alterbasic_reply_photo']);
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
			'$narrow_navbar' => array('alterbasic_narrow_navbar',t('Narrow navbar'),$arr['narrow_navbar'], '', array(t('No'),t('Yes'))),
			'$nav_bg' => array('alterbasic_nav_bg', t('Navigation bar background color'), $arr['nav_bg']),
			'$nav_icon_colour' => array('alterbasic_nav_icon_colour', t('Navigation bar icon color '), $arr['nav_icon_colour']),	
			'$nav_active_icon_colour' => array('alterbasic_nav_active_icon_colour', t('Navigation bar active icon color '), $arr['nav_active_icon_colour']),
			'$link_colour' => array('alterbasic_link_colour', t('Link color'), $arr['link_colour'], '', $link_colours),
			'$banner_colour' => array('alterbasic_banner_colour', t('Set font-color for banner'), $arr['banner_colour']),
			'$bgcolour' => array('alterbasic_background_colour', t('Set the background color'), $arr['bgcolour']),
			'$background_image' => array('alterbasic_background_image', t('Set the background image'), $arr['background_image']),	
			'$item_colour' => array('alterbasic_item_colour', t('Set the background color of items'), $arr['item_colour']),
			'$comment_item_colour' => array('alterbasic_comment_item_colour', t('Set the background color of comments'), $arr['comment_item_colour']),
			'$font_family' => array('alterbasic_font_family', t('Set font-family for the entire application'), $arr['font_family'], t('Examples: Liberation Sans, Nimbus Roman')),
			'$font_size' => array('alterbasic_font_size', t('Set font-size for the entire application'), $arr['font_size'], t('Examples: 1rem, 100%, 16px')),
			'$font_colour' => array('alterbasic_font_colour', t('Set font-color for posts and comments'), $arr['font_colour']),
			'$radius' => array('alterbasic_radius', t('Set radius of corners'), $arr['radius'], t('Example: 4px')),
			'$shadow' => array('alterbasic_shadow', t('Set shadow depth of photos'), $arr['shadow']),
			'$converse_width' => array('alterbasic_converse_width',t('Set maximum width of content region in pixel'),$arr['converse_width'], t('Leave empty for default width')),
			'$top_photo' => array('alterbasic_top_photo', t('Set size of conversation author photo'), $arr['top_photo']),
			'$reply_photo' => array('alterbasic_reply_photo', t('Set size of followup author photos'), $arr['reply_photo']),
			));

		return $o;
	}

}






