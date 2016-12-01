<?php
// Exit if accessed directly from browser
if (!defined('ABSPATH')) exit;

/*
 * Plugin Name: WP Primary Categories
 * Description: This plugin enables that you choice a category to be marked like primary from a post or custom post type (except a page).
 * Plugin URI: https://github.com/dorianneto/wp-primary-category
 * Author: Dorian Neto
 * Version: 1.0.0
 * Author URI: http://dorianneto.com.br/
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 *
 * Copyright 2016 Dorian Neto
 */

// Constants
define('PLUGIN_PATH', plugin_dir_path( __FILE__ ));

// Libs
include PLUGIN_PATH . 'src/PrimaryCategory.php';

new PrimaryCategory();