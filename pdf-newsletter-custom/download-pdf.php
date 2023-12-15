<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Both values should be false for production
$debug = false;
$as_html = false;

// First validate URL
if ( ! isset( $download_year ) || ! preg_match( '/^\d{4}$/', $download_year ) || 
	! isset( $download_month ) || ! preg_match( '/^\d{1,2}$/', $download_month ) ||
	! isset( $download_day ) || ! preg_match( '/^\d{1,2}$/', $download_day ) ) {
	status_header( 404 );
    nocache_headers();
    include( get_query_template( '404' ) );
    exit;
}

$download_date = new DateTime( $download_year . '-' . $download_month . '-' . $download_day );
$download_month = $download_date->format( 'n' );
$download_day = $download_date->format( 'j' );
$download_time = '12:00:00';

$timezone = new DateTimeZone( get_option( 'timezone_string' ) );
$before_date_string = $download_year . '-' . $download_month . '-' . $download_day . ' ' . $download_time;
$before_date = new DateTime( $before_date_string, $timezone );
$after_date = new DateTime( $before_date_string, $timezone );
$after_date->modify( '-1 week' );
$now_date = new DateTime( 'NOW', $timezone );

$filename = 'lievevrouweparochie_nieuws_' . $download_day . '_' . $download_month . '.pdf';
$file_directory = __DIR__ . '/cache/' . $download_year . '/' . $download_month;
$file_path = $file_directory . '/' . $filename;

// Caching check. Only return cached file after download date+time
$will_cache = $now_date >= $before_date ;
if ( is_file( $file_path ) && $debug === false && $will_cache === true ) {
	header( 'Content-type: application/pdf' );
	header( 'Content-Length: ' . filesize( $file_path ) ); 
	header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	exit( file_get_contents( $file_path ) );
}

// Start script
//putenv( 'TMPDIR=/home/parochie/tmp' );
require( __DIR__ . '/vendor/autoload.php' );

use Dompdf\Dompdf;
use Dompdf\Options;

libxml_use_internal_errors(true);

// Validate given date
if ( ! $before_date ) {
	status_header( 404 );
    nocache_headers();
    include( get_query_template( '404' ) );
    exit;
}

// Get news data externally from URLs (I know, I know)
$news_items_html = '';
$news_query = new WP_Query( [
	'date_query' => [
		'after' => $after_date->format( 'Y-m-d H:i:s' ),
		'before' => $before_date->format( 'Y-m-d H:i:s' ),
    ],
	'orderby' => 'post_date',
	'order' => 'DESC',
	'category_name' => 'nieuws'
] );

// 6 uur savonds dinsdag

if ( $news_query->have_posts() ) {
	while ( $news_query->have_posts() ) {
		$news_query->the_post();
		$post_title = get_the_title();
		$post_excerpt = get_the_excerpt();
		$post_image = get_the_post_thumbnail_url();
		$fields = get_fields();

		// Render post data in template
		ob_start();
		require( __DIR__ . '/post-template.php' );
		$news_items_html .= ob_get_clean();

		/*$url = get_the_permalink( $id );
		$request = wp_remote_get( esc_url_raw( $url ), [ 'timeout' => 30 ] );
		if ( is_wp_error( $request ) ) {
			exit( 'Fout tijdens ophalen van nieuwsberichten: ' . $request->get_error_message() );
		}

		$content = wp_remote_retrieve_body( $request );

		// Parse page
		$dom = new DomDocument();
		$dom->loadHtml( $content );
		$finder = new DomXPath( $dom );
		$nodes = $finder->query( "//*[contains(@class, 'et-l') and contains(@class, 'et-l--body')]" ); // [@id='main-content']/
		$html = $dom->saveHTML( $nodes->item(0) );

		if ( !isset( $parent_css, $inline_css, $inline_css_2 ) ) {
			$parent_css = $finder->query( "//link[@id='parent-style-css']/@href" )->item(0)->nodeValue;
			$inline_css = $finder->query( "//link[@id='et-divi-customizer-global-cached-inline-styles']/@href" )->item(0)->nodeValue;
			$inline_css_2 = $finder->query( "//link[starts-with(@id,'et-core-unified')]/@href" )->item(0)->nodeValue;
		}*/
	}
} else {
	// No data
	exit( 'Geen nieuwsbrief PDF gevonden voor de opgegeven data.' );
}

// Render news data in template
ob_start();
require( __DIR__ . '/newsletter-template.php' );
$html_template = ob_get_clean();

$parent_css = $inline_css = $inline_css_2 = '';
$html_data = str_replace( 
	['{content}', '{parent_style}', '{cached_inline_style}', '{cached_inline_style_2}'],
	[$news_items_html, $parent_css, $inline_css, $inline_css_2],
	$html_template
);

// Start PDF HTML rendering
if ( $as_html === false ) {
	$options = new Options();
	$options->setIsHtml5ParserEnabled( true );
	$options->set( 'isRemoteEnabled', true );
	$options->set( 'debugLayout', false );

	// exit($html_data); // Debug HTML output

	// Clean HTML
	$clean_html_data = preg_replace( '/>\s+</', '><', $html_data ); // Remove spaces
	// $clean_html = preg_replace( '/<[^\/>]*>([\s]?)*<\/[^>]*>/', '', $clean_html ); // Remove empty elements

	// Initialise
	$dompdf = new Dompdf( $options );
	$dompdf->loadHtml( $clean_html_data );
	$dompdf->setPaper( 'A4', 'portrait' );
	$dompdf->render();

	// Save PDF data to cache file
	$output = $dompdf->output();
}

if (! is_dir( $file_directory )) {
	mkdir( $file_directory, 0777, true );
}
if ( $debug === false ) {
	file_put_contents( $file_path, $output );
}

// Download PDF
if ( $debug === false ) {
	header( 'Content-Length: ' . filesize( $file_path ) ); 
}
if ( $as_html === false ) {
	header( 'Content-type: application/pdf' );
	header( 'Content-Disposition: ' . ( $debug === true ? 'inline' : 'attachment' ) . '; filename="' . $filename . '"' );
}

exit( $as_html ? $html_data : $output );
