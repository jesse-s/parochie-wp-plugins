<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$colofon_acf_post_id = 29230;

// Calculate index height to know when to break to the second column. FML
$index_category_columns = [[], []];
$index_heights = ['category' => 44, 'article' => 22];
$max_index_height = 790;
$total_index_height = 0;

foreach ( $index_categories as $slug => $category ) {
    $total_index_height += $index_heights['category'];

    foreach ( $category['articles'] as $article ) {
        $total_index_height += ($index_heights['article'] * (floor(strlen($article['title']) / 25) + 1));
    }

    if ( $total_index_height > $max_index_height ) {
        $index_category_columns[1][$slug] = $category;
    } else {
        $index_category_columns[0][$slug] = $category;
    }
}
?>
<div class="page page-index">
    <img src="<?php echo MAGAZINE_PLUGIN_URL . 'images/index_page_background.png'; ?>" width="795" class="page-background-image">

    <div class="index-side-title">
        Inhoudsopgave
    </div>

    <div class="index-content">
        <div class="index-title">
            Inhoud
        </div>

        <?php $i=0; foreach ( $index_category_columns as $categories ) : ?>
            <div class="index-category-column">
                <?php foreach ( $categories as $slug => $category ) : ?>
                    <?php if ( count( $category['articles'] ) === 0 ) continue; ?>
                    <div class="index-category">
                        <div class="index-category-title">
                            <?php echo $category['title']; ?>

                            <div class="index-category-line" style="background-color: <?php echo $category['color']; ?>;"></div>
                        </div>

                        <?php foreach ( $category['articles'] as $article ) : ?>
                            <a href="#<?php echo $article['id']; ?>" class="index-category-article"><?php echo $article['title']; ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        <?php endforeach; ?>

        <div class="clear"></div>
    </div>

    <div class="index-colofon">
        <div class="index-colofon-block">
            <div class="index-colofon-header">
                Colofon
            </div>
        </div>

        <div class="index-colofon-block">
            <div class="index-colofon-subheader">
                Redactie
            </div>

            <?php foreach ( get_field('redactie', $colofon_acf_post_id) as $author ) : ?>
                <div class="index-colofon-author">
                    <?php echo $author; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="index-colofon-block">
            <div class="index-colofon-subheader">
                Ook jij kunt bijdragen!
            </div>


            <?php
                $bijdragen_text = get_field('ook_jij_kunt_bijdragen!', $colofon_acf_post_id);

                // Place the mailto link in the text
                $mail_pattern = '/([A-z0-9._-]+@\s?[A-z0-9_-]+\.)([A-z0-9_\-.]{1,}[A-z])/';
                $bijdragen_text_mailto = preg_replace($mail_pattern, '<a href="mailto:$1$2">$1$2</a>', $bijdragen_text);

                // Remove the space in the email address in the mailto: section
                $mailto_pattern = '/mailto:([A-z0-9._-]+)@\s?([A-z0-9_-]+\.)([A-z0-9_\-.]{1,}[A-z])/';
                echo preg_replace($mailto_pattern, 'mailto:$1@$2$3', $bijdragen_text_mailto);
            ?>
            <!--
            Stuur je kopij naar <a href="mailto:parochieblad@lievevrouweparochie.nl">parochieblad@<br>lievevrouweparochie.nl</a>
            -->
        </div>

        <div class="index-colofon-block">
            Deadline volgende uitgave:<br>
            <?php echo get_field('aanlever-deadline_volgende_uitgave', $colofon_acf_post_id); ?><br>
            De redactie beslist over de plaatsing.
        </div>

        <div class="index-colofon-block">
            <div class="index-colofon-subheader">
                Foto voorpagina
            </div>


            <?php foreach ( get_field('fotograaf_foto_voorpagina', $colofon_acf_post_id) as $photographer ) : ?>
                <div>
                    <?php echo $photographer; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="page-footer">
        Magnificat <?php echo $download_month; ?> <?php echo $download_year; ?>
    </footer>
</div>
