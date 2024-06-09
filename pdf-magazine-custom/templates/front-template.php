<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="page page-front" style="background-image: url('<?php echo $front_background_image; ?>');">
    <div class="front-logo-container">
        <img src="<?php echo MAGAZINE_PLUGIN_URL . 'images/magnificat_logo.png'; ?>"  width="670" class="front-logo" />
    </div>

    <div class="front-bottom">
        <img src="<?php echo MAGAZINE_PLUGIN_URL . 'images/front_footer_background.png'; ?>"  width="795" class="front-bottom-background" />

        <div class="front-title">
            <?php echo $head_article_title; ?>
        </div>

        <div class="front-title-line"></div>

        <div class="front-articles">
            <?php if (isset($front_column_titles[0])) : ?>
                <div>Column: <?php echo $front_column_titles[0]; ?></div>
            <?php endif; ?>
            <?php if (isset($front_article_titles[0])) : ?>
                <div><?php echo $front_article_titles[0]; ?></div>
            <?php endif; ?>
            <?php if (isset($front_article_titles[1])) : ?>
                <div><?php echo $front_article_titles[1]; ?></div>
            <?php endif; ?>
        </div>

        <footer class="page-footer">
            Magnificat <?php echo $download_quarter; ?> <?php echo $download_year; ?>
        </footer>
    </div>
</div>
