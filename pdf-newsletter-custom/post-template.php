<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="post">
	<h1><?php echo $post_title; ?></h1>

	<?php if ( isset( $post_image ) && strlen( $post_image ) ) { ?>
		<div class="gallery">
			<div class="gallery-image">
				<img src="<?php echo $post_image; ?>">
			</div>
		</div>
	<?php } ?>

	<?php if ( isset( $post_excerpt ) ) { ?>
		<p><strong><?php echo $post_excerpt; ?></strong></p>
	<?php } ?>

	<?php if ( isset( $fields['galerij'] ) ) { ?>
		<div class="gallery">
			<?php $i = 0; foreach ( $fields['galerij'] as $image ) { ?>
				<?php if ( is_array( $image ) && count( $image ) ) { ?>
					<div class="gallery-image<?php echo $i > 0 ? ' small' : ''; ?>">
						<img src="<?php echo $image['url'];?>">
					</div>
				<?php $i++; } ?>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( ! empty( $fields['tussenkop'] ) || ! empty( $fields['alinea_tekst'] ) ) { ?>
		<div class="text-container">
			<?php if ( isset( $fields['tussenkop'] ) ) { ?>
				<strong><?php echo $fields['tussenkop']; ?></strong>
			<?php } ?>

			<?php if ( isset( $fields['alinea_tekst'] ) ) { ?>
				<p><?php echo $fields['alinea_tekst']; ?></p>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( ! empty( $fields['tussenkop_2'] ) || ! empty( $fields['alinea_tekst_2'] ) ) { ?>
		<div class="text-container">
			<?php if ( ! empty( $fields['tussenkop_2'] ) ) { ?>
				<strong><?php echo $fields['tussenkop_2']; ?></strong>
			<?php } ?>

			<?php if ( ! empty( $fields['alinea_tekst_2'] ) ) { ?>
				<p><?php echo $fields['alinea_tekst_2']; ?></p>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( ! empty( $fields['tussenkop_3'] ) || ! empty( $fields['alinea_tekst_3'] ) ) { ?>
		<div class="text-container">
			<?php if ( ! empty( $fields['tussenkop_3'] ) ) { ?>
				<strong><?php echo $fields['tussenkop_3']; ?></strong>
			<?php } ?>

			<?php if ( ! empty( $fields['alinea_tekst_3'] ) ) { ?>
				<p><?php echo $fields['alinea_tekst_3']; ?></p>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( ! empty( $fields['tussenkop_4'] ) || ! empty( $fields['alinea_tekst_4'] ) ) { ?>
		<div class="text-container">
			<?php if ( ! empty( $fields['tussenkop_4'] ) ) { ?>
				<strong><?php echo $fields['tussenkop_4']; ?></strong>
			<?php } ?>

			<?php if ( ! empty( $fields['alinea_tekst_4'] ) ) { ?>
				<p><?php echo $fields['alinea_tekst_4']; ?></p>
			<?php } ?>
		</div>
	<?php } ?>
</div>