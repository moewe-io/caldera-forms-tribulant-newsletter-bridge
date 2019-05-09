<?php
/*
  Plugin Name: Caldera Forms: Tribulant Newsletter Subscription Bridge
  Plugin URI: https://github.com/moewe-io/caldera-forms-tribulant-newsletter-bridge
  Description: Processor, which allows to subscribe users to Tribulant Newsletter lists
  Author: MOEWE
  Author URI: https://www.moewe.io
  Version: 1.0.0
  Text Domain: caldera-forms-tribulant-newsletter-bridge
*/

define('MOEWE_CALDERA_TRIBULANT_BASE_DIR', plugin_dir_path(__FILE__));

add_action('caldera_forms_pre_load_processors', function () {
    include MOEWE_CALDERA_TRIBULANT_BASE_DIR . "/includes/processor.php";
    new MOEWE_Caldera_Forms_Tribulant_Newsletter_Processor();
});
