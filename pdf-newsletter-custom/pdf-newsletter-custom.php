<?php
/*
Plugin Name: PDF Newsletter Plugin
Description: Generate PDF url of news items for the newsletter.
Version: 0.0.2
Requires PHP: 7.0
Requires at least: 4.9
Author: Jesse Smit
Author URI: https://jessesmit.com
 */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register custom routes
add_action( 'init', 'pdf_newsletter_rewrites_init' );
function pdf_newsletter_rewrites_init()
{
    add_rewrite_rule(
        'nieuwsbrief/([0-9]+)/([0-9]+)/([0-9]+)/pdf?$',
        // 'wp-content/plugins/pdf-newsletter-custom/download_pdf.php?day=$matches[1]&month=$matches[2]&year=$matches[3]',
        'index.php?newsletter_pdf_download=true&newsletter_pdf_day=$matches[2]&newsletter_pdf_month=$matches[1]&newsletter_pdf_year=$matches[3]',
        'top'
    );
}

add_action( 'query_vars', 'pdf_newsletter_query_vars' );
function pdf_newsletter_query_vars( $query_vars )
{
    $query_vars[] = 'newsletter_pdf_download';
    $query_vars[] = 'newsletter_pdf_day';
    $query_vars[] = 'newsletter_pdf_month';
    $query_vars[] = 'newsletter_pdf_year';

    return $query_vars;
}

// Parse download request
add_action( 'parse_request', 'pdf_newsletter_parse_request' );
function pdf_newsletter_parse_request( &$wp )
{
	$plugin_params = ['newsletter_pdf_download', 'newsletter_pdf_day', 'newsletter_pdf_month', 'newsletter_pdf_year'];
    $query_params = array_keys( $wp->query_vars );

    if ( count( array_intersect( $query_params, $plugin_params ) ) === count( $plugin_params ) ) {
    	// Pass data
    	$download_day = $wp->query_vars['newsletter_pdf_day'];
    	$download_month = $wp->query_vars['newsletter_pdf_month'];
        $download_year = $wp->query_vars['newsletter_pdf_year'];

        include( dirname( __FILE__ ) . '/download-pdf.php' );
        exit;
    }
}