<?php   
if(!defined('ABSPATH')) {
    exit;
}

$lang = $_GET['lang'];

if(ICL_LANGUAGE_CODE !== $lang) {
    do_action('wpml_switch_language', $lang);
}

$tracking_scripts = get_field('tracking_scripts', 'options');

echo $tracking_scripts;

exit;