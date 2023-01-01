<?php


namespace Code\Theme;

class Phosphor_greenConfig {

	function get_schemas() {
		$files = glob('view/theme/phosphor_green/schema/*.php');

		$scheme_choices = [];

		if($files) {

			if(in_array('view/theme/phosphor_green/schema/default.php', $files)) {
				$scheme_choices['---'] = t('Default');
				$scheme_choices['focus'] = t('Retro (default)');
			}
			else {
				$scheme_choices['---'] = t('Retro (default)');
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
		$arr['narrow_navbar'] = get_pconfig(local_channel(),'phosphor_green', 'narrow_navbar' );
		$arr['nav_bg'] = get_pconfig(local_channel(),'phosphor_green', 'nav_bg' );
		$arr['nav_icon_colour'] = get_pconfig(local_channel(),'phosphor_green', 'nav_icon_colour' );
		$arr['nav_active_icon_colour'] = get_pconfig(local_channel(),'phosphor_green', 'nav_active_icon_colour' );
		$arr['link_colour'] = get_pconfig(local_channel(),'phosphor_green', 'link_colour' );
		$arr['banner_colour'] = get_pconfig(local_channel(),'phosphor_green', 'banner_colour' );
		$arr['bgcolour'] = get_pconfig(local_channel(),'phosphor_green', 'background_colour' );
		$arr['background_image'] = get_pconfig(local_channel(),'phosphor_green', 'background_image' );
		$arr['item_colour'] = get_pconfig(local_channel(),'phosphor_green', 'item_colour' );
		$arr['comment_item_colour'] = get_pconfig(local_channel(),'phosphor_green', 'comment_item_colour' );
		$arr['font_size'] = get_pconfig(local_channel(),'phosphor_green', 'font_size' );
		$arr['font_colour'] = get_pconfig(local_channel(),'phosphor_green', 'font_colour' );
		$arr['radius'] = get_pconfig(local_channel(),'phosphor_green', 'radius' );
		$arr['shadow'] = get_pconfig(local_channel(),'phosphor_green', 'photo_shadow' );
		$arr['converse_width']=get_pconfig(local_channel(),"phosphor_green","converse_width");
		$arr['top_photo']=get_pconfig(local_channel(),"phosphor_green","top_photo");
		$arr['reply_photo']=get_pconfig(local_channel(),"phosphor_green","reply_photo");
		//  Extra variables for this theme //
                $arr['font_family'] = get_pconfig(local_channel(),'phosphor_green', 'font_family' );
                $arr['txtblur'] = get_pconfig(local_channel(),'phosphor_green', 'txtblur' );
                $arr['btnblur'] = get_pconfig(local_channel(),'phosphor_green', 'btnblur' );
                $arr['imgfilter'] = get_pconfig(local_channel(),'phosphor_green', 'imgfilter' );
                $arr['bordblur'] = get_pconfig(local_channel(),'phosphor_green', 'bordblur' );
                $arr['subtlblur'] = get_pconfig(local_channel(),'phosphor_green', 'subtlblur' );
		return $this->form($arr);
	}

	function post() {
		if(!local_channel()) {
			return;
		}

		if (isset($_POST['phosphor_green-settings-submit'])) {
			set_pconfig(local_channel(), 'phosphor_green', 'narrow_navbar', $_POST['phosphor_green_narrow_navbar']);
			set_pconfig(local_channel(), 'phosphor_green', 'nav_bg', $_POST['phosphor_green_nav_bg']);
			set_pconfig(local_channel(), 'phosphor_green', 'nav_icon_colour', $_POST['phosphor_green_nav_icon_colour']);
			set_pconfig(local_channel(), 'phosphor_green', 'nav_active_icon_colour', $_POST['phosphor_green_nav_active_icon_colour']);
			set_pconfig(local_channel(), 'phosphor_green', 'link_colour', $_POST['phosphor_green_link_colour']);
			set_pconfig(local_channel(), 'phosphor_green', 'background_colour', $_POST['phosphor_green_background_colour']);
			set_pconfig(local_channel(), 'phosphor_green', 'banner_colour', $_POST['phosphor_green_banner_colour']);
			set_pconfig(local_channel(), 'phosphor_green', 'background_image', $_POST['phosphor_green_background_image']);
			set_pconfig(local_channel(), 'phosphor_green', 'comment_item_colour', $_POST['phosphor_green_comment_item_colour']);
			set_pconfig(local_channel(), 'phosphor_green', 'font_size', $_POST['phosphor_green_font_size']);
			set_pconfig(local_channel(), 'phosphor_green', 'font_colour', $_POST['phosphor_green_font_colour']);
			set_pconfig(local_channel(), 'phosphor_green', 'radius', $_POST['phosphor_green_radius']);
			set_pconfig(local_channel(), 'phosphor_green', 'photo_shadow', $_POST['phosphor_green_shadow']);
			set_pconfig(local_channel(), 'phosphor_green', 'converse_width', $_POST['phosphor_green_converse_width']);
			set_pconfig(local_channel(), 'phosphor_green', 'top_photo', $_POST['phosphor_green_top_photo']);
			set_pconfig(local_channel(), 'phosphor_green', 'reply_photo', $_POST['phosphor_green_reply_photo']);
			// Extra variables for this theme //
                        set_pconfig(local_channel(), 'phosphor_green', 'font_family', $_POST['phosphor_green_font_family']);
                        set_pconfig(local_channel(), 'phosphor_green', 'txtblur', $_POST['phosphor_green_txtblur']);
                        set_pconfig(local_channel(), 'phosphor_green', 'btnblur', $_POST['phosphor_green_btnblur']);
                        set_pconfig(local_channel(), 'phosphor_green', 'imgfilter', $_POST['phosphor_green_imgfilter']);
                        set_pconfig(local_channel(), 'phosphor_green', 'bordblur', $_POST['phosphor_green_bordblur']);
                        set_pconfig(local_channel(), 'phosphor_green', 'subtlblur', $_POST['phosphor_green_subtlblur']);
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
			'$narrow_navbar' => array('phosphor_green_narrow_navbar',t('Narrow navbar'),$arr['narrow_navbar'], '', array(t('No'),t('Yes'))),
			'$nav_bg' => array('phosphor_green_nav_bg', t('Navigation bar background color'), $arr['nav_bg']),
			'$nav_icon_colour' => array('phosphor_green_nav_icon_colour', t('Navigation bar icon color '), $arr['nav_icon_colour']),
			'$nav_active_icon_colour' => array('phosphor_green_nav_active_icon_colour', t('Navigation bar active icon color '), $arr['nav_active_icon_colour']),
			'$link_colour' => array('phosphor_green_link_colour', t('Link color'), $arr['link_colour'], '', $link_colours),
			'$banner_colour' => array('phosphor_green_banner_colour', t('Set font-color for banner'), $arr['banner_colour']),
			'$bgcolour' => array('phosphor_green_background_colour', t('Set the background color'), $arr['bgcolour']),
			'$background_image' => array('phosphor_green_background_image', t('Set the background image'), $arr['background_image']),
			'$item_colour' => array('phosphor_green_item_colour', t('Set the background color of items'), $arr['item_colour']),
			'$comment_item_colour' => array('phosphor_green_comment_item_colour', t('Set the background color of comments'), $arr['comment_item_colour']),
			'$font_size' => array('phosphor_green_font_size', t('Set font-size for the entire application'), $arr['font_size'], t('Examples: 1rem, 100%, 16px')),
			'$font_colour' => array('phosphor_green_font_colour', t('Set font-color for posts and comments'), $arr['font_colour']),
			'$radius' => array('phosphor_green_radius', t('Set radius of corners'), $arr['radius'], t('Example: 4px')),
			'$shadow' => array('phosphor_green_shadow', t('Set shadow depth of photos'), $arr['shadow']),
			'$converse_width' => array('phosphor_green_converse_width',t('Set maximum width of content region in pixel'),$arr['converse_width'], t('Leave empty for default width')),
			'$top_photo' => array('phosphor_green_top_photo', t('Set size of conversation author photo'), $arr['top_photo']),
			'$reply_photo' => array('phosphor_green_reply_photo', t('Set size of followup author photos'), $arr['reply_photo']),
			// Extra variables for this theme //
                        '$font_family' => array('phosphor_green_font_family', t('Set font-family for the entire application'), $arr['font_family'], t('Examples: Liberation Sans, Nimbus Roman')),
                        '$txtblur' => array('phosphor_green_txtblur', t('Set text-shadow most of application text'), $arr['txtblur'], t('Example: 0 0 2px #ccccff, 0 0 8px #ffffff')),
                        '$btnblur' => array('phosphor_green_btnblur', t('Set text-shadow for additional text ie buttons'), $arr['btnblur'], t('Example: 0 0 2px #ffffff, 0 0 8px #ccccff')),
                        '$imgfilter' => array('phosphor_green_imgfilter', t('Set filter all application images'), $arr['imgfilter'], t('Example: brightness(0.8) saturate(1.2)')),
                        '$bordblur' => array('phosphor_green_bordblur', t('Set shadow-box for the entire application'), $arr['bordblur'], t('Example: 0 0 4px 3px #ffffff')),
                        '$subtlblur' => array('phosphor_green_subtlblur', t('Set text-shadow for some tiny navigation icons'), $arr['subtlblur'], t('Example: 0 0 3px #bbbbee, 0 0 8px #dddddd')),
			));

		return $o;
	}

}






