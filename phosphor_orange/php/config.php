<?php

namespace Code\Theme;

use App;
use Code\Lib\Features;
use Code\Render\Theme;


class Phosphor_orangeConfig
{

    function get_schemas()
    {
        $files = glob('view/theme/phosphor_orange/schema/*.php');

        $scheme_choices = [];

        if ($files) {

            if (in_array('view/theme/phosphor_orange/schema/default.php', $files)) {
                $scheme_choices['---'] = t('Default');
                $scheme_choices['focus'] = t('Retro (default)');
            } else {
                $scheme_choices['---'] = t('Retro (default)');
            }

            foreach ($files as $file) {
                $f = basename($file, ".php");
                if ($f != 'default') {
                    $scheme_name = $f;
                    $scheme_choices[$f] = $scheme_name;
                }
            }
        }

        return $scheme_choices;
    }

    function get()
    {
        if (!local_channel()) {
            return '';
        }

        $arr = [];
        $arr['narrow_navbar'] = get_pconfig(local_channel(), 'phosphor_orange', 'narrow_navbar');
        $arr['nav_bg'] = get_pconfig(local_channel(), 'phosphor_orange', 'nav_bg');
        $arr['nav_icon_colour'] = get_pconfig(local_channel(), 'phosphor_orange', 'nav_icon_colour');
        $arr['nav_active_icon_colour'] = get_pconfig(local_channel(), 'phosphor_orange', 'nav_active_icon_colour');
        $arr['link_colour'] = get_pconfig(local_channel(), 'phosphor_orange', 'link_colour');
        $arr['banner_colour'] = get_pconfig(local_channel(), 'phosphor_orange', 'banner_colour');
        $arr['bgcolour'] = get_pconfig(local_channel(), 'phosphor_orange', 'background_colour');
        $arr['background_image'] = get_pconfig(local_channel(), 'phosphor_orange', 'background_image');
        $arr['item_colour'] = get_pconfig(local_channel(), 'phosphor_orange', 'item_colour');
        $arr['comment_item_colour'] = get_pconfig(local_channel(), 'phosphor_orange', 'comment_item_colour');
        $arr['font_size'] = get_pconfig(local_channel(), 'phosphor_orange', 'font_size');
        $arr['font_colour'] = get_pconfig(local_channel(), 'phosphor_orange', 'font_colour');
        $arr['radius'] = get_pconfig(local_channel(), 'phosphor_orange', 'radius');
        $arr['shadow'] = get_pconfig(local_channel(), 'phosphor_orange', 'photo_shadow');
        $arr['converse_width'] = get_pconfig(local_channel(), "phosphor_orange", "converse_width");
        $arr['top_photo'] = get_pconfig(local_channel(), "phosphor_orange", "top_photo");
        $arr['reply_photo'] = get_pconfig(local_channel(), "phosphor_orange", "reply_photo");
        return $this->form($arr);
    }

    function post()
    {
        if (!local_channel()) {
            return;
        }

        if (isset($_POST['phosphor_orange-settings-submit'])) {
            set_pconfig(local_channel(), 'phosphor_orange', 'narrow_navbar', $_POST['redbasic_narrow_navbar']);
            set_pconfig(local_channel(), 'phosphor_orange', 'nav_bg', $_POST['redbasic_nav_bg']);
            set_pconfig(local_channel(), 'phosphor_orange', 'nav_icon_colour', $_POST['redbasic_nav_icon_colour']);
            set_pconfig(local_channel(), 'phosphor_orange', 'nav_active_icon_colour', $_POST['redbasic_nav_active_icon_colour']);
            set_pconfig(local_channel(), 'phosphor_orange', 'link_colour', $_POST['redbasic_link_colour']);
            set_pconfig(local_channel(), 'phosphor_orange', 'background_colour', $_POST['redbasic_background_colour']);
            set_pconfig(local_channel(), 'phosphor_orange', 'banner_colour', $_POST['redbasic_banner_colour']);
            set_pconfig(local_channel(), 'phosphor_orange', 'background_image', $_POST['redbasic_background_image']);
            set_pconfig(local_channel(), 'phosphor_orange', 'item_colour', $_POST['redbasic_item_colour']);
            set_pconfig(local_channel(), 'phosphor_orange', 'comment_item_colour', $_POST['redbasic_comment_item_colour']);
            set_pconfig(local_channel(), 'phosphor_orange', 'font_size', $_POST['redbasic_font_size']);
            set_pconfig(local_channel(), 'phosphor_orange', 'font_colour', $_POST['redbasic_font_colour']);
            set_pconfig(local_channel(), 'phosphor_orange', 'radius', $_POST['redbasic_radius']);
            set_pconfig(local_channel(), 'phosphor_orange', 'photo_shadow', $_POST['redbasic_shadow']);
            set_pconfig(local_channel(), 'phosphor_orange', 'converse_width', $_POST['redbasic_converse_width']);
            set_pconfig(local_channel(), 'phosphor_orange', 'top_photo', $_POST['redbasic_top_photo']);
            set_pconfig(local_channel(), 'phosphor_orange', 'reply_photo', $_POST['redbasic_reply_photo']);
        }
    }

    function form($arr)
    {

        $expert = Features::enabled(local_channel(), 'advanced_theming');

        return replace_macros(Theme::get_template('theme_settings.tpl'), array(
            '$submit' => t('Submit'),
            '$baseurl' => z_root(),
            '$theme' => App::$channel['channel_theme'],
            '$expert' => $expert,
            '$title' => t("Theme settings"),
            '$narrow_navbar' => ['phosphor_orange_narrow_navbar', t('Narrow navbar'), $arr['narrow_navbar'], '', [t('No'), t('Yes')]],
            '$nav_bg' => ['phosphor_orange_nav_bg', t('Navigation bar background color'), $arr['nav_bg']],
            '$nav_icon_colour' => ['phosphor_orange_nav_icon_colour', t('Navigation bar icon color '), $arr['nav_icon_colour']],
            '$nav_active_icon_colour' => ['phosphor_orange_nav_active_icon_colour', t('Navigation bar active icon color '), $arr['nav_active_icon_colour']],
            '$link_colour' => ['phosphor_orange_link_colour', t('Link color'), $arr['link_colour']],
            '$banner_colour' => ['phosphor_orange_banner_colour', t('Set font-color for banner'), $arr['banner_colour']],
            '$bgcolour' => ['phosphor_orange_background_colour', t('Set the background color'), $arr['bgcolour']],
            '$background_image' => ['phosphor_orange_background_image', t('Set the background image'), $arr['background_image']],
            '$item_colour' => ['phosphor_orange_item_colour', t('Set the background color of items'), $arr['item_colour']],
            '$comment_item_colour' => ['phosphor_orange_comment_item_colour', t('Set the background color of comments'), $arr['comment_item_colour']],
            '$font_size' => ['phosphor_orange_font_size', t('Set font-size for the entire application'), $arr['font_size'], t('Examples: 1rem, 100%, 16px')],
            '$font_colour' => ['phosphor_orange_font_colour', t('Set font-color for posts and comments'), $arr['font_colour']],
            '$radius' => ['phosphor_orange_radius', t('Set radius of corners'), $arr['radius'], t('Example: 4px')],
            '$shadow' => ['phosphor_orange_shadow', t('Set shadow depth of photos'), $arr['shadow']],
            '$converse_width' => ['phosphor_orange_converse_width', t('Set maximum width of content region in pixel'), $arr['converse_width'], t('Leave empty for default width')],
            '$top_photo' => ['phosphor_orange_top_photo', t('Set size of conversation author photo'), $arr['top_photo']],
            '$reply_photo' => ['phosphor_orange_reply_photo', t('Set size of followup author photos'), $arr['reply_photo']],
        ));
    }
}

