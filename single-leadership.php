<?php
/**
 * The template for displaying all single Leadership Pages
 */

get_header();
the_post();

$leader_id = get_the_ID();

$leader_photo       = get_field( 'leadership_photo', $leader_id ) ?? false;
$leader_name        = get_field( 'leadership_name', $leader_id ) ?? false;
$leader_position    = get_field( 'leadership_position', $leader_id ) ?? false;
$leader_description = get_field( 'leadership_description', $leader_id ) ?? false;
$leader_button      = get_field( 'leadership_button', $leader_id ) ?? false;
$leader_cf          = get_field( 'leadership_contact_form', $leader_id ) ?? false;
$leader_cf_title    = get_field( 'contact_form_title', $leader_id ) ?? false;
$leader_cf_subtitle = get_field( 'contact_form_subtitle', $leader_id ) ?? false;
?>


<article class="leadership">
    <div class="leadership-main">
        <div class="container">
            <div class="leadership-main__content">
                <?php if ( $leader_photo ) : ?>
                    <div class="leadership-main__photo">
                        <?php echo wp_get_attachment_image( $leader_photo, 'full', false, [ 'class' => 'leadership-main__photo-img' ]); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $leader_name ) : ?>
                    <div class="leadership-main__data">
                        <div class="leadership-main__data-uptitle eyebrow">
                            <?php echo _e( 'Leadership team', '_iag' ); ?>
                        </div>

                        <h1 class="h1 leadership-main__data-title">
                            <?php echo esc_html( $leader_name ); ?>
                        </h1>

                        <?php if ( $leader_position ) : ?>
                            <span class="leadership-main__data-position">
                                <?php echo esc_html( $leader_position ); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ( $leader_description ) : ?>
                            <span class="leadership-main__data-subtitle">
                                <?php echo esc_html( $leader_description ); ?>
                            </span>
                        <?php endif; ?>
    
                        <a class="btn btn-primary leadership-main__data-button" href="/contact-us/#contact-us">
                            <?php echo esc_html( $leader_cf_title ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ( have_rows( 'biography_list', $leader_id ) ) : ?>
        <div class="leadership-biography bg-white">
            <div class="container">
                <div class="leadership-biography__blocks">
                    <?php while ( have_rows( 'biography_list', $leader_id ) ) : the_row();
                        $title   = get_sub_field( 'list_item_title' ) ?? false;
                        $content = get_sub_field( 'list_item_content' ) ?? false; ?>

                        <?php if ( $title && $content ) : ?>
                            <div class="leadership-biography__block">
                                <span class="h3 block-title">
                                    <?php echo esc_html( $title ); ?>
                                </span>

                                <div class="editor block-content">
                                    <?php echo wp_kses_post( $content ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( $leader_cf && ( $leader_cf_title || $leader_cf_subtitle ) ) :
        $id    = $leader_cf->ID ?? false;
        $title = get_the_title( $leader_cf->ID ) ?? false; ?>

        <div class="leadership-contact bg-gray" id="leadership-contact">
            <div class="container">
                <div class="leadership-contact__form bg-blue">
                    <div class="contact-form__header">
                        <span class="eyebrow">
                            <?php echo _e( 'Get in touch', '_iag' ); ?>
                        </span>
                        <h2 class="h2 form__header-title">
                            <?php echo esc_html( $leader_cf_title ); ?>
                        </h2>
                        <span class="subtitle">
                            <?php echo esc_html( $leader_cf_subtitle ); ?>
                        </span>
                    </div>

                    <?php if ( $id && $title ) : ?>
                        <div class="contact-form__wrapper">
                            <?php echo do_shortcode( '[contact-form-7 id="'.$id.'" title="'.$title.'"]' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</article>

<?php
get_footer();