<?php
/*
Plugin Name: PDF Magazine Plugin
Description: Generate PDF url of news items for the magazine (parochieblad).
Version: 0.0.1
Requires PHP: 7.0
Requires at least: 4.9
Author: Jesse Smit
Author URI: https://jessesmit.com
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

ini_set( 'max_execution_time', 120 );

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register custom routes
add_action( 'init', 'pdf_magazine_rewrites_init' );
function pdf_magazine_rewrites_init()
{
    // Access the url with ?magazine_pdf_cache=0 to disable caching and ?magazine_pdf_refresh_cache=1 to refresh the cache
    add_rewrite_rule(
        'magnificat-pdf/([0-9]{4})/([1-4])/(pdf|html)$',
        'index.php?magazine_pdf_download=true&magazine_pdf_quarter=$matches[2]&magazine_pdf_year=$matches[1]&magazine_pdf_format=$matches[3]',
        'top'
    );
}

add_action( 'query_vars', 'pdf_magazine_query_vars' );
function pdf_magazine_query_vars( $query_vars )
{
    $query_vars[] = 'magazine_pdf_download';
    $query_vars[] = 'magazine_pdf_quarter';
    $query_vars[] = 'magazine_pdf_year';
    $query_vars[] = 'magazine_pdf_format';
    $query_vars[] = 'magazine_pdf_cache';
    $query_vars[] = 'magazine_pdf_refresh_cache';

    return $query_vars;
}

// Parse download request
add_action( 'parse_request', 'pdf_magazine_parse_request' );
function pdf_magazine_parse_request( &$wp )
{
	$plugin_params = ['magazine_pdf_download', 'magazine_pdf_quarter', 'magazine_pdf_year', 'magazine_pdf_format'];
    $query_params = array_keys( $wp->query_vars );

    if ( count( array_intersect( $query_params, $plugin_params ) ) === count( $plugin_params ) ) {
    	// Pass data
    	$download_quarter = $wp->query_vars['magazine_pdf_quarter'];
        $download_year = $wp->query_vars['magazine_pdf_year'];
        $download_format = $wp->query_vars['magazine_pdf_format'] ?? 'pdf';
        // Optional GET param "magazine_pdf_cache" and "magazine_pdf_refresh_cache"
        $cache = ! isset( $wp->query_vars['magazine_pdf_cache'] ) || $wp->query_vars['magazine_pdf_cache'] !== '0';
        $refresh_cache = isset( $wp->query_vars['magazine_pdf_refresh_cache'] ) && $wp->query_vars['magazine_pdf_refresh_cache'] === '1';

        include( dirname( __FILE__ ) . '/download-pdf.php' );
        exit;
    }
}