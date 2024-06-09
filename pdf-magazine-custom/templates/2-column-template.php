<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div class="page page-column page-columns-2" id="<?php echo $post_id; ?>" name="<?php echo $post_id; ?>">
    <div class="column-side-title" style="color: <?php echo $post_text_color; ?>;">
        <span class="text">
            <?php echo $post_category_name ?? 'Vanuit de geloofsgemeenschap'; ?>
        </span>
    </div>
    <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>

    <div class="column-header"><?php echo $post_title; ?></div>

    <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>

    <?php foreach ( $fields as $key => $field ) : ?>
        <?php if ( strpos( $key, 'schrijver_' ) !== false && isset( $field[0] ) ) : ?>
            <div class="author">Door <?php echo $field[0]; ?></div>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="columns-container">
        <div class="column-1-content">
            <?php if ( isset( $fields['kolom_1']['kolom_afbeelding'] ) ) { ?>
                <img src="<?php echo $fields['kolom_1']['kolom_afbeelding']; ?>">
            <?php } ?>

            <?php if ( ! empty( $fields['kolom 1 dikgedrukte inleiding'] ) ) { ?>
                <p><strong><?php echo $fields['kolom 1 dikgedrukte inleiding']; ?></strong></p>
            <?php } ?>

            <?php echo $fields['kolom_1']['kolom_tekst'] ?? ''; ?>
        </div>
        <div class="column-2-content">
            <?php echo $fields['kolom_2']['kolom_tekst'] ?? ''; ?>

            <?php if ( isset( $fields['kolom_2']['kolom_afbeelding'] ) ) { ?>
                <img src="<?php echo $fields['kolom_2']['kolom_afbeelding']; ?>">
            <?php } ?>
        </div>
        <div class="break"></div>
    </div>

    <div class="pdf-side pdf-left" style="background-color: <?php echo $post_color; ?>;"></div>

    <?php if (
        ! empty( $fields['kolom_3']['kolom_tekst'] ) ||
        ! empty( $fields['kolom_3']['kolom_afbeelding'] ) ||
        ! empty( $fields['kolom_4']['kolom_tekst'] ) ||
        ! empty( $fields['kolom_4']['kolom_afbeelding'] )
    ) : ?>
        <div class="columns-container new-page">
            <div class="column-1-content">
                <?php if ( isset( $fields['kolom_3']['kolom_afbeelding'] ) ) { ?>
                    <img src="<?php echo $fields['kolom_3']['kolom_afbeelding']; ?>">
                <?php } ?>

                <?php echo $fields['kolom_3']['kolom_tekst'] ?? ''; ?>
            </div>
            <div class="column-2-content">
                <?php echo $fields['kolom_4']['kolom_tekst'] ?? ''; ?>

                <?php if ( isset( $fields['kolom_4']['kolom_afbeelding'] ) ) { ?>
                    <img src="<?php echo $fields['kolom_4']['kolom_afbeelding']; ?>">
                <?php } ?>
            </div>
            <div class="break"></div>
        </div>
    <?php endif; ?>

    <footer class="page-footer">
        <div class="page-footer-line" style="background-color: <?php echo $post_color; ?>;"></div>
        <div class="page-footer-image">
            <img src="<?php echo MAGAZINE_PLUGIN_URL . 'images/magnificat_logo_small.png'; ?>" width="50" height="50">
        </div>
        <div class="page-footer-text">Magnificat <?php echo $download_quarter; ?> <?php echo $download_year; ?></div>
    </footer>
</div>
