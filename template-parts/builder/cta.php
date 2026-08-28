<?php
$module_id        = get_sub_field('module_id') ?: '';
$primary_btn      = get_sub_field('primary_button') ?? false;
$secondary_btn    = get_sub_field('secondary_button') ?? false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-cta">
	<div class="container">
		<div class="m-cta__meeting">
			<?php if ( have_rows( 'meeting_list' ) ) : ?>
				<div class="m-cta__meeting-title">
					<?php echo _e( 'Meet Us Next', '_iag' ); ?>
				</div>
				
				<div class="m-cta__meeting-list">
					<?php while ( have_rows( 'meeting_list' ) ) : the_row();
						$item_type     = get_sub_field( 'item_type' ) ?? false;
						$item_image    = get_sub_field( 'item_image' ) ?? false;
						$item_title    = get_sub_field( 'item_title' ) ?? false;
						$item_subtitle = get_sub_field( 'item_subtitle' ) ?? false; ?>

						<?php if ( $item_image || $item_title ) : ?>
							<div class="meeting-item meeting-item-<?php echo esc_attr( $item_type ); ?>">
								<?php if ( $item_type === 'image' && $item_image) : ?>
									<?php echo wp_get_attachment_image( $item_image, 'medium', false, [ 'class' => 'meeting-item__image' ] ); ?>
								<?php endif; ?>
									
								<?php if ( $item_type === 'text' && $item_title ) : ?>
									<span class="meeting-item__title">
										<?php echo esc_html( $item_title ); ?>
									</span>
								<?php endif; ?>
								
								<?php if ( $item_type === 'text' && $item_subtitle ) : ?>
									<span class="meeting-item__subtitle">
										<?php echo esc_html( $item_subtitle ); ?>
									</span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<?php if ( $primary_btn || $secondary_btn ) : ?>
				<div class="m-cta__meeting-buttons">
					<?php if ( $primary_btn ) :
						$link_url = $primary_btn['url'];
						$link_title = $primary_btn['title'];
						$link_target = $primary_btn['target'] ? $primary_btn['target'] : '_self'; ?>
		
						<a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
							<?php echo esc_html( $link_title ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $secondary_btn ) :
						$link_url = $secondary_btn['url'];
						$link_title = $secondary_btn['title'];
						$link_target = $secondary_btn['target'] ? $secondary_btn['target'] : '_self'; ?>
		
						<a class="btn btn-ghost" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
							<?php echo esc_html( $link_title ); ?>
							<svg><use xlink:href="#arrow-right"></use></svg>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>