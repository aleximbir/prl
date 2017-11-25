<?php

global $wpdb;
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

global $charset_collate;
$charset_collate = $wpdb->get_charset_collate();

$sql = "

";

dbDelta( $sql );
