<?php

/**
 * Plugin Name: Hamja Delusion Calculator
 * Plugin URI: https://delusionmeter.com/
 * Description: A plugin for Content Recommendation
 * Version: 1.0.0
 * Author: Hamja
 * Author URI: https://delusionmeter.com/
 * License: GPL2
 **/


 function my_plugin_activate()
{

}

register_activation_hook(__FILE__, 'my_plugin_activate');



function load_plugin()
{
}

add_action('admin_init', 'load_plugin');


function my_deactivation()
{
}

register_deactivation_hook(__FILE__, 'my_deactivation');