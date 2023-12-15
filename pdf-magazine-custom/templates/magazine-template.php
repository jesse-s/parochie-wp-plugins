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

  <style type="text/css">
    @font-face {
      font-family: 'Open Sans';
      font-style: normal;
      font-weight: 500;
      src: url('<?php echo MAGAZINE_PLUGIN_URL . 'fonts/OpenSans-Regular.ttf'; ?>') format('truetype');
    }
    @font-face {
      font-family: 'Open Sans';
      font-style: italic;
      font-weight: 500;
      src: url('<?php echo MAGAZINE_PLUGIN_URL . 'fonts/OpenSans-Italic.ttf'; ?>') format('truetype');
    }
    @font-face {
      font-family: 'Open Sans';
      font-style: normal;
      font-weight: 700;
      src: url('<?php echo MAGAZINE_PLUGIN_URL . 'fonts/OpenSans-Bold.ttf'; ?>') format('truetype');
    }
    @font-face {
      font-family: 'Open Sans';
      font-style: italic;
      font-weight: 700;
      src: url('<?php echo MAGAZINE_PLUGIN_URL . 'fonts/OpenSans-BoldItalic.ttf'; ?>') format('truetype');
    }

    @font-face {
      font-family: 'Bree Serif';
      font-style: normal;
      font-weight: 400;
      src: url('<?php echo MAGAZINE_PLUGIN_URL . 'fonts/BreeSerif-Regular.ttf'; ?>') format('truetype');
    }

    @page {
      margin: 30px 0 0;
      padding: 0;
    }

    * {
        box-sizing: border-box;
    }

  	body {
  	  font-family: 'Open Sans', Helvetica, Arial, Lucida, sans-serif;
      font-size: 16px;
      font-weight: 500;
      margin: 0;
      padding: 0;
  	}

    .clear {
        clear: both;
    }

  	h1 {
      margin-bottom: 20px;
      padding: 0;
      font-size: 38px;
      color: #424cc1;
      font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
      font-weight: 400;
  	  line-height: 38px;
  	}

    a {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }

    strong, b {
        font-weight: 700;
    }
    
    p {
      margin: 0 0 15px;
      line-height: 17px;
    }
    .columns-container {
        page-break-inside: avoid;
        line-height: 17px;
    }
    .separator {
        margin: 0 0 15px;
    }

    p:empty,
    p:blank,
    h3:empty,
    h3:blank {
      display: none;
    }

    p:last-child {
      margin-bottom: 0;
    }

    blockquote {
      display: block;
      margin: 20px 0;
      padding: 0 0 0 15px;
      border-left: 3px solid #424cc1;
    }

    .page {
        width: 100%;
        height: 100%;
        page-break-after: always;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .page:last-child {
        page-break-after: auto;
    }

    .page-background-image {
        position: fixed;
        top: -30px;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
    }

    .gallery {
        margin-bottom: 15px;
    }
    .gallery img {
        max-height: 700px;
        max-width: 100%;
    }

    .gallery.gallery-series {
        width: 100%;
    }
    .gallery.gallery-series .gallery-image {
        float: left;
        width: 33.333%;
        padding-right: 10px;
    }
    .gallery.gallery-series .gallery-image img {
        height: 180px;
    }

    .text-container {
        margin-bottom: 15px;
    }
    .text-container h3 {
        margin-top: 0;
        margin-bottom: 5px;
        font-size: 22px;
        color: #424cc1;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
        line-height: 18px;
    }
    .text-container img {
        width: auto;
        max-height: 700px;
        margin-bottom: 15px;
    }
    .text-container .wp-caption-text {
        margin-top: 15px;
    }

    .columns-container.new-page {
        page-break-before: always;
    }
    .column-1-content {
        width: 47%;
        margin-right: 3%;
        float: left;
    }
    .column-2-content {
        width: 47%;
        margin-left: 3%;
        float: left;
    }
    .columns-container img {
        max-width: 100%;
        margin-top: 6px;
        margin-bottom: 15px;
    }

    /* Front page */
    .page-front {
        margin-top: -30px;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
        color: #fff;
        page-break-inside: avoid;
    }

    .page-front .page-footer {
        position: absolute;
        bottom: 32px;
        left: 80px;
        font-size: 18px;
        text-align: right;
    }

    .front-logo-container {
        padding-top: 40px;
        width: 100%;
        text-align: center;
    }

    .front-logo {
        display: block;
        margin: 0 auto;
    }

    .front-bottom {
        position: absolute;
        bottom: 0;
        left: -1px;
        width: 796px;
        height: 560px;
        font-size: 28px;
        text-align: center;
    }

    .front-bottom-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: -1;
    }

    .front-title {
        font-size: 66px;
        line-height: 50px;
        margin-top: 120px;
    }

    .front-title-line {
        height: 3px;
        background: #fff;
        margin: 5px auto 30px;
        width: 55%;
    }

    .front-articles {
        font-size: 31px;
        line-height: 25px;
    }

    /* Index */
    .page-index {
        position: absolute;
        top: -30px;
        left: 0;
        right: 0;
        bottom: 0;
        height: auto;
        page-break-inside: avoid;
    }

    .page-index .page-footer {
        position: absolute;
        bottom: 4px;
        right: 64px;
        font-size: 18px;
        color: #434CC1;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
    }

    .index-content {
        position: absolute;
        top: 115px;
        left: 96px;
        width: 410px;
        height: 940px;
    }

    .index-title {
        margin-bottom: 30px;
        font-size: 66px;
        color: #434CC1;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
        line-height: 40px;
    }

    .index-category-column {
        width: 43%;
        margin-right: 7%;
        float: left;
    }
    .index-category-column:last-child {
        margin-right: 0;
        margin-left: 7%;
    }

    .index-category {
        width: 100%;
        margin-bottom: 15px;
    }

    .index-category-title {
        margin-bottom: 6px;
        color: #434CC1;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
        font-size: 18px;
        line-height: 16px;
    }

    .index-category-line {
        height: 1px;
        width: 100%;
        background: #000;
    }

    .index-colofon {
        position: absolute;
        top: 200px;
        right: 27px;
        width: 220px;
        height: 860px;
        font-size: 17px;
        line-height: 18px;
    }

    .index-colofon-header {
        font-size: 28px;
        color: #434CC1;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
        line-height: 22px;
    }

    .index-colofon-subheader {
        margin-bottom: 11px;
        font-size: 20px;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
    }

    .index-colofon-author {
        margin-bottom: 12px;
        line-height: 14px;
    }

    .index-colofon-block {
        margin-bottom: 32px;
    }

    .index-category-article {
        display: block;
        margin-bottom: 8px;
        line-height: 12px;
    }

    .index-side-title {
        position: absolute;
        left: 51px;
        top: 170px;
        color: #FFC000;
        font-size: 18px;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
        transform: rotate(-90deg);
        transform-origin: left bottom 0;
    }

    /* 1 and 2 column pages */
    .page-column {
        position: relative;
        width: 87%;
        padding: 50px 20px 30px 70px;
        page-break-before: avoid;
    }
    .page-column .author {
        margin-bottom: 30px;
    }
    .page-column.page-columns-2 .author {
        margin-bottom: 14px;
    }
    .page-column.page-columns-2 p {
        margin-bottom: 14px;
    }

    .page-column.has-bg {
        width: 84%;
        padding: 125px 30px 30px 85px;
        font-size: 18px;
        color: #fff;
    }
    .page-column.has-bg .column-header {
        max-width: 480px;
        margin: 0 auto 30px;
        text-align: center;
        color: #fff;
    }
    .page-column.has-bg h3 {
        color: inherit;
    }
    .page-column.has-bg .author {
        margin-bottom: 38px;
        text-align: center;
    }
    .page-column.has-bg .text-container,
    .page-column.has-bg .wp-caption {
        width: 100% !important;
    }
    .page-column.has-bg .wp-caption,
    .page-column.has-bg .gallery-image {
        text-align: center;
    }
    .page-column.has-bg img {
        display: block;
    }

    .page-column.is-column .text-container {
        margin-top: 35px;
    }

    .page-column .page-footer {
        position: fixed;
        bottom: 30px;
        left: 50px;
        width: 700px;
        height: 30px;
        font-size: 18px;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
        color: #434CC1;
        z-index: 10;
    }
    .page-column .page-footer .page-footer-line {
        position: absolute;
        bottom: 15px;
        left: 0;
        width: 100%;
        height: 2px;
    }
    .page-column .page-footer .page-footer-text {
        position: absolute;
        right: 0;
        bottom: 6px;
        background: #fff;
        padding-left: 12px;
    }
    .page-column .page-footer .page-footer-image {
        position: absolute;
        left: -35px;
        bottom: -8px;
        background-color: #fff;
        text-align: center;
        z-index: 8;
    }

    .column-side-title {
        position: absolute;
        left: 51px;
        top: 263px;
        width: 300px;
        transform: rotate(-90deg);
        transform-origin: left bottom 0;
        text-align: right;
        z-index: 5;
    }
    .column-side-title .text {
        padding: 0 30px 0 18px;
        background: #fff;
        font-size: 18px;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
    }
    .column-side-title.green .text {
        color: #009b00;
    }
    .column-side-title.orange .text {
        color: #ffc200;
    }
    .page.has-bg .column-side-title .text {
        background: none;
    }

    .page.is-voor-kinderen .column-side-title {
        top: 250px;
    }
    .page.is-column .column-side-title {
        top: 280px;
    }
    .page.is-bezinning .column-side-title {
        top: 280px;
    }
    .page.is-voorwoord .column-side-title {
        top: 280px;
    }

    .column-header {
        margin-bottom: 15px;
        font-size: 38px;
        color: #424cc1;
        font-family: 'Bree Serif', Georgia, 'Times New Roman', serif;
        font-weight: 400;
        line-height: 28px;
    }
    .page-columns-2 .column-header {
        margin-top: -2px;
        margin-bottom: 10px;
        line-height: 27px;
    }

    /* Side stripes */
    .pdf-side {
      position: fixed;
      top: 10px;
      bottom: 50px;
      width: 2px;
      background: #434CC1;
      z-index: 4;
    }
    .pdf-side.green {
        background: #009b00;
    }
    .pdf-side.orange {
        background: #a04100;
    }

    .pdf-left {
      left: 39px;
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
  {front_page}
  {index_page}
  {content}

  <!--<div class="pdf-footer-faux"></div>
  <div class="pdf-footer">
    <img src="<?php echo MAGAZINE_PLUGIN_URL . 'images/newsletter_footer.png'; ?>">
  </div>-->
</body>
</html>