<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-faq bg-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
        <?php if ( $module_title || $module_subtitle || $module_uptitle ) : ?>
            <div class="module-header alignment-<?php echo esc_attr( $module_alignment ); ?>">
                <?php if ( $module_uptitle ) : ?>
                    <span class="module-header__uptitle">
                        <?php echo esc_html( $module_uptitle ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( $module_title ) : ?>  
                    <?php get_template_part( 'template-parts/builder/components/title', null ); ?>
                <?php endif; ?>
                <?php if ( $module_subtitle ) : ?>
                    <p class="module-header__subtitle">
                        <?php echo esc_html( $module_subtitle ); ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

		<?php if ( have_rows( 'faq_list' ) ) : ?>
			<div class="m-faq__list js-accordion">
				<?php $faq = []; ?>
				<?php while ( have_rows( 'faq_list' ) ) : the_row(); ?>
					<?php
					$question = get_sub_field( 'question' );
					$answer   = get_sub_field( 'answer' );

					$faq[] = [
						'@type'          => 'Question',
						'name'           => esc_html( $question ),
						'acceptedAnswer' => [
							'@type' => 'Answer',
							'text'  => wp_strip_all_tags( $answer )
						]
					]
					?>
					<div class="m-faq__list-item js-accordion-item m-faq__item">
						<div class="js-accordion-title item-title"><span><?php echo wp_strip_all_tags( $question ); ?></span>
							<svg><use xlink:href="#angle-down"></use></svg>
						</div>
						<div class="js-accordion-content item-content">
							<div class="editor"><?php echo wp_kses_post( $answer ); ?></div>
						</div>
					</div>
				<?php endwhile; ?>

				<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "FAQPage",
						"mainEntity": <?php echo wp_json_encode( $faq ); ?>
					}
				</script>
			</div>
		<?php endif; ?>
	</div>
</section>