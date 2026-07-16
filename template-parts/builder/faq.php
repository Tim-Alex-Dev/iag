<?php
$module_id              = get_sub_field( 'module_id' ) ?: '';
$color_theme            = get_sub_field( 'color_theme' ) ?: 'white';
$module_title           = get_sub_field( 'module_title' ) ?? false;
$module_title_alignment = get_sub_field( 'module_title_alignment' ) ?: 'center';
$module_subtitle        = get_sub_field( 'module_subtitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-faq module-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">

		<?php if ( $module_title ) : ?>  
			<?php get_template_part( 'template-parts/builder/components/title', null, [ 'class' => 'm-faq__title' ] ); ?>
		<?php endif; ?>
	
		<?php if ( $module_subtitle ) : ?>
			<p class="subtitle m-faq__subtitle text-<?php echo esc_html( $module_title_alignment ); ?>">
				<?php echo esc_html( $module_subtitle ); ?>
			</p>
		<?php endif; ?>

		<?php if ( have_rows( 'faq_list' ) ) :
			$faq = [];
			$faq_items = [];
			while ( have_rows( 'faq_list' ) ) : the_row();

				$question = get_sub_field( 'question' ) ?: false;
				$answer   = get_sub_field( 'answer' ) ?: false;

				if ( ! $question || ! $answer ) {
					continue;
				}

				$faq[] = [
					'@type'          => 'Question',
					'name'           => wp_strip_all_tags( $question ),
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => wp_strip_all_tags( $answer ),
					],
				];

				$faq_items[] = [
					'question' => $question,
					'answer'   => $answer,
				];

			endwhile;
		endif;

		$faq_columns = [ [], [] ];

		foreach ( $faq_items as $index => $item ) {
			$faq_columns[ $index % 2 ][] = $item;
		}
		?>

		<?php if ( $faq_items ) : ?>
			<div class="m-faq__list js-accordion">
				<?php foreach ( $faq_columns as $column ) : ?>
					<div class="m-faq__column">
						<?php foreach ( $column as $item ) : ?>
							<div class="js-accordion-item m-faq__column-item">
								<div class="h5 js-accordion-title m-faq__column-item-title">
									<span><?php echo esc_html( wp_strip_all_tags( $item['question'] ) ); ?></span>
									<svg><use xlink:href="#close"></use></svg>
								</div>

								<div class="js-accordion-content m-faq__column-item-content">
									<div class="editor">
										<?php echo wp_kses_post( $item['answer'] ); ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>