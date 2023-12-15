<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require __DIR__ . '/functions.php';

// Both values should be false for production
$debug = true; // Output the PDF directly in the browser instead of downloading it
$as_html = $download_format === 'html'; // Output the HTML instead of the PDF

// First validate URL
if ( ! isset( $download_year ) || ! preg_match( '/^\d{4}$/', $download_year ) || 
	! isset( $download_quarter ) || ! preg_match( '/^[1-4]$/', $download_quarter ) ) {
	status_header( 404 );
    nocache_headers();
    include( get_query_template( '404' ) );
    exit;
}

$download_month = ( $download_quarter - 1 ) * 3 + 1;
$download_day = 1;
$download_time = '12:00:00';
$download_date = new DateTime( $download_year . '-' . $download_month . '-01' );

$timezone = new DateTimeZone( get_option( 'timezone_string' ) );
$before_date_string = $download_year . '-' . $download_month . '-' . $download_day . ' ' . $download_time;
$before_date = new DateTime( $before_date_string, $timezone );
$after_date = new DateTime( $before_date_string, $timezone );
$after_date->modify( '-1 week' );
$now_date = new DateTime( 'NOW', $timezone );

$filename = 'lievevrouweparochie_blad_' . $download_quarter . '.pdf';
$file_directory = __DIR__ . '/cache/' . $download_year;
$file_path = $file_directory . '/' . $filename;

// Caching check. Only return cached file after download date+time
if ( is_file( $file_path ) && $cache === true && $refresh_cache === false && $as_html === false ) {
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

define( 'MAGAZINE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Get news data externally from URLs (I know, I know)
$post_items_html = [];
$posts_query = new WP_Query( [
	/*'date_query' => [
		'after' => $after_date->format( 'Y-m-d H:i:s' ),
		'before' => $before_date->format( 'Y-m-d H:i:s' ),
    ],*/
	'orderby' => 'post_date',
	'order' => 'DESC',
    'post_type' => 'parochieblad',
    'offset' => 0,
    'posts_per_page' => 99999,
    'tax_query' => array(
        array(
            'taxonomy' => 'parochieblad_category',
            'field' => 'slug',
            'terms' => array( $download_year . '-blad-' . $download_quarter )
        )
    )
] );

if ( ! $posts_query->have_posts() ) {
    nocache_headers();
    exit( 'Geen parochieblad PDF gevonden voor de opgegeven data.' );
}

$front_background_image = $head_article_title = '';
$front_column_titles = $front_article_titles = $index_authors = [];
$category_colors = ['#424cc1', '#ff6c6c', '#ff6d00', '#00ff00', '#ffff00', '#00ffff'];
$category_colors = array_merge( $category_colors, $category_colors, $category_colors );
$category_text_colors = ['#424cc1', '#bf4545', '#a04100', '#009b00', '#ffc200', '#00779b'];
$category_text_colors = array_merge( $category_text_colors, $category_text_colors, $category_text_colors );
$index_categories = [
    'voorwoord' => [
        'title' => 'Voorwoord',
        'articles' => [],
    ],
    'van-het-parochiebestuur' => [
        'title' => 'Van het parochiebestuur',
        'articles' => [],
    ],
    'van-het-pastoraal-team' => [
        'title' => 'Van het pastoraal team',
        'articles' => [],
    ],
    'hoofdartikel' => [
        'title' => 'Hoofdartikel',
        'articles' => [],
    ],
    'vanuit-de-geloofsgemeenschap' => [
        'title' => 'Vanuit de geloofsgemeenschap',
        'articles' => [],
    ],
    'verdieping' => [
        'title' => 'Verdieping',
        'articles' => [],
    ],
    'in-gesprek-met' => [
        'title' => 'In gesprek met',
        'articles' => [],
    ],
    'voor-kinderen' => [
        'title' => 'Voor kinderen',
        'articles' => [],
    ],
    'familieberichten' => [
        'title' => 'Familieberichten',
        'articles' => [],
    ],
    'column' => [
        'title' => 'Column',
        'articles' => [],
    ],
    'bezinning' => [
        'title' => 'Bezinning',
        'articles' => [],
    ],
];

// Assign colors to categories if there are posts that use them
while ( $posts_query->have_posts() ) {
    $posts_query->the_post();

    $categories = get_the_terms( get_the_ID(), 'parochieblad_category' );
    $category_slugs = array_map( function( $category ) {
        return $category->slug;
    }, $categories );

    foreach ( $category_slugs as $category_slug ) {
        if ( array_key_exists( $category_slug, $index_categories ) ) {
            $index_categories[$category_slug]['color'] = $category_colors[array_search( $category_slug, array_keys( $index_categories ) )];
            $index_categories[$category_slug]['text_color'] = $category_text_colors[array_search( $category_slug, array_keys( $index_categories ) )];
        }
    }
}

while ( $posts_query->have_posts() ) {
    $posts_query->the_post();

    // Check if appropriate category is set
    $categories = get_the_terms( get_the_ID(), 'parochieblad_category' );
    $category_slugs = array_map( function( $category ) {
        return $category->slug;
    }, $categories );

    // Find front page image
    if ( in_array( 'foto-voorpagina', $category_slugs ) ) {
        $front_background_image = get_field( 'afbeelding_voor_voorpagina_liefst_staand' );
        $front_background_image = $front_background_image['url'] ?? '';
    }
    // Find head article
    if ( in_array( 'hoofdartikel', $category_slugs ) ) {
        $head_article_title = get_the_title();
    }
    // Front titles
    if (in_array( 'titel-op-de-voorpagina', $category_slugs )) {
        // Find column titles
        if ( in_array( 'column', $category_slugs ) ) {
            $front_column_titles[] = get_the_title();
        }
        // Find article titles
        if ( in_array( '1-kolom', $category_slugs ) || in_array( '2-kolommen', $category_slugs ) ) {
            $front_article_titles[] = get_the_title();
        }
    }

    // Index categories
    $category_color = null;
    $category_text_color = null;
    $post_category = null;
    $post_category_name = null;
    foreach ( $category_slugs as $category_slug ) {
        if ( array_key_exists( $category_slug, $index_categories ) ) {
            $index_categories[$category_slug]['articles'][] = [
                'id' => get_the_ID(),
                'title' => get_the_title(),
            ];
            $post_category = $category_slug;
            $post_category_name = $index_categories[$category_slug]['title'] ?? null;
            $post_color = $index_categories[$category_slug]['color'] ?? null;
            $post_text_color = $index_categories[$category_slug]['text_color'] ?? null;
        }
    }

    if (! $post_category) {
        continue;
    }

    // Index authors from ACF fields
    /*$authors = get_field( 'schrijver' );
    if ( $authors ) {
        foreach ( $authors as $author ) {
            if (! in_array( $author, $index_authors )) {
                $index_authors[] = $author;
            }
        }
    }*/

    // Determine page template and background for article
    $post_background = null;
    if ( in_array( '1-kolom', $category_slugs ) ) {
        $page_type = '1-column';
    } else if ( in_array( '2-kolommen', $category_slugs ) ) {
        $page_type = '2-column';
    }

    if ( in_array( 'bezinning', $category_slugs ) ) {
        $page_type = '1-column';
        $post_background = 'bezinning_background.png';
        $post_category_name = 'Bezinning';
        $post_text_color = '#bf4545';
    } elseif ( in_array( 'column', $category_slugs ) ) {
        $page_type = '1-column';
        $post_background = 'column_background.png';
        $post_category_name = 'Column';
        $post_text_color = '#434cc1';
    } elseif ( in_array( 'voor-kinderen', $category_slugs ) ) {
        $page_type = '1-column';
        $post_background = 'voor_kinderen_background.png';
        $post_category_name = 'Voor kinderen';
        $post_text_color = '#009b00';
    } elseif ( in_array( 'voorwoord', $category_slugs ) ) {
        $page_type = '1-column';
        $post_background = 'voorwoord_background.png';
        $post_category_name = 'Voorwoord';
        $post_text_color = '#00779b';
    }

    // Post data
    $post_id = get_the_ID();
    $post_title = get_the_title();
    $post_excerpt = get_the_excerpt();
    $post_image = get_the_post_thumbnail( $post_id, 'medium' );
    $post_image_url = get_the_post_thumbnail_url();
    $post_content = apply_filters( 'the_content', get_the_content() );
    $fields = get_fields();

    if (! isset($post_items_html[$post_category])) {
        $post_items_html[$post_category] = [];
    }

	// Render post data in template
	ob_start();
	require( __DIR__ . '/templates/' . $page_type . '-template.php' );
	$post_items_html[$post_category][] = ob_get_clean();
}

// Render data in base magazine layout template
ob_start();
require( __DIR__ . '/templates/magazine-template.php' );
$html_template = ob_get_clean();

// Render front page and index page
ob_start();
require( __DIR__ . '/templates/front-template.php' );
$front_page_html = ob_get_clean();

ob_start();
require( __DIR__ . '/templates/index-template.php' );
$index_page_html = ob_get_clean();

// Order post items by the keys of $index_categories
$post_items = '';
foreach ( array_keys( $index_categories ) as $category_slug ) {
    if ( array_key_exists( $category_slug, $post_items_html ) ) {
        $post_items .= implode( '', $post_items_html[$category_slug] );
    }
}

// Render the main template with data
$html_data = str_replace(
	['{front_page}', '{index_page}', '{content}'],
	[$front_page_html, $index_page_html, $post_items],
	$html_template
);

// Start PDF HTML rendering
if ( $as_html === false ) {
    // exit($html_data); // Debug HTML output

	// Clean HTML
	$clean_html_data = preg_replace( '/>\s+</', '><', $html_data ); // Remove spaces

	// Initialise DOMPDF
    $options = new Options();
    //$options->setDpi(96);
    $options->setIsRemoteEnabled( true );
    $options->setIsHtml5ParserEnabled( true );
    $options->set( 'debugLayout', false );

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
if ( ($cache === true || $refresh_cache === true) && $as_html === false ) {
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
