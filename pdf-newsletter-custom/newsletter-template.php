<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>

<html lang="nl">
<head>
  <meta charset="utf-8">

  <!--<link type="text/css" href="{parent_style}" rel="stylesheet" />
  <link type="text/css" href="{cached_inline_style}" rel="stylesheet" />
  <link type="text/css" href="{cached_inline_style_2}" rel="stylesheet" />

  <link type="text/css" href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" />-->

  <style type="text/css">
    @font-face {
      font-family: 'Open Sans';
      font-style: normal;
      font-weight: 500;
      src: url('<?php echo plugin_dir_url( __FILE__ ) . 'fonts/OpenSans-Regular.ttf'; ?>') format('truetype');
    }
    @font-face {
      font-family: 'Open Sans';
      font-style: italic;
      font-weight: 500;
      src: url('<?php echo plugin_dir_url( __FILE__ ) . 'fonts/OpenSans-Italic.ttf'; ?>') format('truetype');
    }
    @font-face {
      font-family: 'Open Sans';
      font-style: normal;
      font-weight: 700;
      src: url('<?php echo plugin_dir_url( __FILE__ ) . 'fonts/OpenSans-Bold.ttf'; ?>') format('truetype');
    }
    @font-face {
      font-family: 'Open Sans';
      font-style: italic;
      font-weight: 700;
      src: url('<?php echo plugin_dir_url( __FILE__ ) . 'fonts/OpenSans-BoldItalic.ttf'; ?>') format('truetype');
    }

    @font-face {
      font-family: 'Bree Serif';
      font-style: normal;
      font-weight: 400;
      src: url('<?php echo plugin_dir_url( __FILE__ ) . 'fonts/BreeSerif-Regular.ttf'; ?>') format('truetype');
    }

    @page {
      margin: 40px 0 30px;
      padding: 0;
    }

  	body {
  		font-family: 'Open Sans', Helvetica, Arial, Lucida, sans-serif;
      font-size: 14px;
      font-weight: 500;
      margin: 0;
      padding: 0 60px;
  	}

  	#main-content {
  		margin: 420px 0 0;
      padding: 0;
  		max-width: 960px;
  	}

  	h1 {
      margin-top: -30px;
      margin-bottom: 20px;
      padding: 0;
      font-size: 38px;
      line-height: 26px;
      color: #424cc1;
      font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
      font-weight: 400;
  		line-height: 38px;
  	}

    .gallery {
      margin-bottom: 25px;
    }
    .gallery img { 
      height: 310px;
      max-width: 100%;
    }
    .gallery .gallery-image.small {
      margin-top: 16px;
    }
    .gallery .gallery-image.small img { 
      height: 180px;
    }

    .text-container {
      margin-bottom: 25px;
    }
    
    p {
      margin: 0 0 25px;
      line-height: 18px;
    }

    p:empty,
    p:blank {
      display: none;
    }

    p:last-child,
    .gallery:last-child,
    .text-container:last-child {
      margin-bottom: 0;
    }

    .post {
      margin-bottom: 55px;
    }
    .post:last-child {
      margin-bottom: 0;
    }
    /*
      This will make every post start on its own page
     
    .post {
      page-break-after: always;
    }
    .post:last-child {
      page-break-after: auto;
    }*/

    /* Header & Footer */
    .pdf-header,
    .pdf-footer {
      position: absolute;
      left: 0;
      width: 794px;
      z-index: 5;
      background: #fff;
    }

    .pdf-header img,
    .pdf-footer img {
      width: 794px;
    }

    .pdf-header {
      top: -41px;
    }
    .pdf-header .pdf-side {
      position: absolute;
      top: 84px;
      bottom: 0;
    }

    .pdf-footer {
      bottom: -30px;
    }

    .pdf-footer-faux {
      height: 290px;
      width: 1px;
    }

    /*div:empty,
    p:empty {
      display: none;
    }*/

    /* Side stripes */
    .pdf-side {
      position: fixed;
      top: -40px;
      bottom: -30px;
      width: 5px;
      background: #434CC1;
      z-index: 4;
    }

    .pdf-left {
      left: 20px;
    }

    .pdf-right {
      right: 20px;
    }

    table {
      table-layout: fixed;
      width: 100%;
      max-width: 100%;
      font-size: 13px;
    }
  </style>
</head>

<body>
  <div class="pdf-side pdf-left"></div>
  <div class="pdf-side pdf-right"></div>

  <div class="pdf-header">
    <div class="pdf-side pdf-right"></div>
    <img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/newsletter_header.png'; ?>">
  </div>

  <div id="main-content">
    {content}
	</div>

  <div class="pdf-footer-faux"></div>
  <div class="pdf-footer">
    <img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/newsletter_footer.png'; ?>">
  </div>
</body>
</html>