<?php
/**
 * Installs Easy Digital Downloads for the purpose of the unit-tests
 */
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT );

echo "Welcome to the Easy Digital Downloads Test Suite" . PHP_EOL;
echo "Version: 1.0" . PHP_EOL;
echo "Authors: Chris Christoff and Sunny Ratilal" . PHP_EOL;

$config_file_path = $argv[1];
$multisite = ! empty( $argv[2] );

require_once $config_file_path;
require_once dirname( $config_file_path ) . '/includes/functions.php';

function _load_edd() {
	require dirname( dirname( dirname( __FILE__ ) ) ) . '/easy-digital-downloads.php';
}
tests_add_filter( 'muplugins_loaded', '_load_edd' );

// Always load admin bar
tests_add_filter( 'show_admin_bar', '__return_true' );

$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
$_SERVER['HTTP_HOST'] = WP_TESTS_DOMAIN;
$PHP_SELF = $GLOBALS['PHP_SELF'] = $_SERVER['PHP_SELF'] = '/index.php';

require_once ABSPATH . '/wp-settings.php';

echo "Installing Easy Digital Downloads...\n";

// Install Easy Digital Downloads
edd_install();