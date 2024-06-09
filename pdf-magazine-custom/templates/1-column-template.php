<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="page page-column page-columns-1<?php echo isset( $post_background ) ? ' has-bg' : ''; ?><?php echo isset( $post_category ) ? ' is-' . $post_category : ''; ?>"
     id="<?php echo $post_id; ?>"
     name="<?php echo $post_id; ?>">

    <?php if ( isset( $post_background ) ) : ?>
        <img src="<?php echo MAGAZINE_PLUGIN_URL . 'images/' . $post_background; ?>" width="795" class="page-background-image">
    <?php endif; ?>

    <div class="column-side-title" style="color: <?php echo $post_text_color; ?>;">
        <span class="text"><?php echo $post_category_name ?? 'Vanuit de geloofsgemeenschap'; ?></span>
    </div>
    <?php if ( ! isset( $post_background ) ) : ?>
        <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>
    <?php else : ?>
        <div class="page-background-color"></div>
    <?php endif; ?>

    <div class="column-header"><?php echo $post_title; ?></div>

    <?php foreach ( $fields as $key => $field ) : ?>
        <?php if ( strpos( $key, 'schrijver_' ) !== false && isset( $field[0] ) ) : ?>
            <div class="author">Door <?php echo $field[0]; ?></div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ( ! empty( $post_image ) ) { ?>
        <?php if ( ! isset( $post_background ) ) : ?>
            <div class="gallery">
                <div class="gallery-image">
                    <?php echo $post_image; ?>
                </div>
            </div>
        <?php elseif ( ! empty ( $post_image_url ) ) : ?>
            <div class="gallery">
                <div class="gallery-image">
                    <img src="<?php echo $post_image_url; ?>">
                </div>
            </div>
        <?php endif; ?>
    <?php } ?>

    <?php foreach ( $fields as $key => $field ) : ?>
        <?php if ( strpos( $key, 'afbeelding_' ) !== false && is_array( $field ) && isset( $field['url'] ) ) : ?>
            <div class="gallery">
                <div class="gallery-image">
                    <img src="<?php echo $field['url']; ?>">
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ( ! empty( $post_excerpt ) && $post_category !== 'column' ) { ?>
        <p><strong><?php echo $post_excerpt; ?></strong></p>
    <?php } ?>

    <?php if ( ! empty( $fields['dikgedrukte inleiding'] ) && $post_category !== 'column' ) { ?>
        <p><strong><?php echo $fields['dikgedrukte inleiding']; ?></strong></p>
    <?php } ?>

    <?php if ( ! isset( $post_background ) ) : ?>
        <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>
    <?php else : ?>
        <div class="page-background-color"></div>
    <?php endif; ?>

    <?php if ( ! empty( $fields['column_tekst'] ) ) { ?>
        <div class="text-container">
            <p><?php echo $fields['column_tekst']; ?></p>
        </div>
    <?php } ?>

    <?php if ( ! isset( $post_background ) ) : ?>
        <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>
    <?php else : ?>
        <div class="page-background-color"></div>
    <?php endif; ?>

    <?php if ( ! empty( $fields['tussenkop_1'] ) || ! empty( $fields['alinea_tekst_1'] ) ) { ?>
        <div class="text-container">
            <?php if ( isset( $fields['tussenkop_1'] ) ) { ?>
                <h3><?php echo $fields['tussenkop_1']; ?></h3>
            <?php } ?>

            <?php if ( isset( $fields['alinea_tekst_1'] ) ) { ?>
                <?php if ( ! isset( $post_background ) ) : ?>
                    <p><?php echo insertPdfSides( $fields['alinea_tekst_1'], $post_color ); ?></p>
                <?php else : ?>
                    <p><?php echo $fields['alinea_tekst_1']; ?></p>
                <?php endif; ?>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ( ! isset( $post_background ) ) : ?>
        <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>
    <?php else : ?>
        <div class="page-background-color"></div>
    <?php endif; ?>

    <?php if ( ! empty( $fields['tussenkop_2'] ) || ! empty( $fields['alinea_tekst_2'] ) ) { ?>
        <div class="text-container">
            <?php if ( ! empty( $fields['tussenkop_2'] ) ) { ?>
                <h3><?php echo $fields['tussenkop_2']; ?></h3>
            <?php } ?>

            <?php if ( ! empty( $fields['alinea_tekst_2'] ) ) { ?>
                <?php if ( ! isset( $post_background ) ) : ?>
                    <p><?php echo insertPdfSides( $fields['alinea_tekst_2'], $post_color ); ?></p>
                <?php else : ?>
                    <p><?php echo $fields['alinea_tekst_2']; ?></p>
                <?php endif; ?>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ( ! isset( $post_background ) ) : ?>
        <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>
    <?php else : ?>
        <div class="page-background-color"></div>
    <?php endif; ?>

    <?php if ( ! empty( $fields['tussenkop_3'] ) || ! empty( $fields['alinea_tekst_3'] ) ) { ?>
        <div class="text-container">
            <?php if ( ! empty( $fields['tussenkop_3'] ) ) { ?>
                <h3><?php echo $fields['tussenkop_3']; ?></h3>
            <?php } ?>

            <?php if ( ! empty( $fields['alinea_tekst_3'] ) ) { ?>
                <?php if ( ! isset( $post_background ) ) : ?>
                    <p><?php echo insertPdfSides( $fields['alinea_tekst_3'], $post_color ); ?></p>
                <?php else : ?>
                    <p><?php echo $fields['alinea_tekst_3']; ?></p>
                <?php endif; ?>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ( ! isset( $post_background ) ) : ?>
        <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>
    <?php else : ?>
        <div class="page-background-color"></div>
    <?php endif; ?>

    <?php if ( ! empty( $fields['tussenkop_4'] ) || ! empty( $fields['alinea_tekst_4'] ) ) { ?>
        <div class="text-container">
            <?php if ( ! empty( $fields['tussenkop_4'] ) ) { ?>
                <h3><?php echo $fields['tussenkop_4']; ?></h3>
            <?php } ?>

            <?php if ( ! empty( $fields['alinea_tekst_4'] ) ) { ?>
                <?php if ( ! isset( $post_background ) ) : ?>
                    <p><?php echo insertPdfSides( $fields['alinea_tekst_4'], $post_color ); ?></p>
                <?php else : ?>
                    <p><?php echo $fields['alinea_tekst_4']; ?></p>
                <?php endif; ?>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ( ! isset( $post_background ) ) : ?>
        <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>
    <?php else : ?>
        <div class="page-background-color"></div>
    <?php endif; ?>

    <?php if ( isset( $fields['serie_afbeeldingen'] ) && count( $fields['serie_afbeeldingen'] ) ) { ?>
        <div class="gallery gallery-series">
            <?php $i = 0; foreach ( $fields['serie_afbeeldingen'] as $image ) { ?>
                <?php if ( is_array( $image ) && count( $image ) ) { ?>
                    <div class="gallery-image">
                        <img src="<?php echo $image['url'];?>">
                    </div>
                    <?php $i++; } ?>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ( ! isset( $post_background ) ) : ?>
        <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>
    <?php else : ?>
        <div class="page-background-color"></div>
    <?php endif; ?>

    <?php if ( ! isset( $post_background ) ) : ?>
        <footer class="page-footer">
            <div class="page-footer-line" style="background-color: <?php echo $post_color; ?>;"></div>
            <div class="page-footer-image">
                <img src="<?php echo MAGAZINE_PLUGIN_URL . 'images/magnificat_logo_small.png'; ?>" width="50" height="50">
            </div>
            <div class="page-footer-text">Magnificat <?php echo $download_quarter; ?> <?php echo $download_year; ?></div>
        </footer>
    <?php endif; ?>
</div>
