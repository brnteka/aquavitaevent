<?php get_header(); ?>
<main>
    <div
        id="bgThankYou"
        class="h-screen bg-no-repeat bg-center"
        style="
            background-image:
                url(<?php echo get_template_directory_uri(); ?>/images/thankyou/1920-3.png),
                url(<?php echo get_template_directory_uri(); ?>/images/thankyou/1920-4.png),
                url(<?php echo get_template_directory_uri(); ?>/images/thankyou/plane.png),
                url(<?php echo get_template_directory_uri(); ?>/images/thankyou/1920-1.png),
                url(<?php echo get_template_directory_uri(); ?>/images/thankyou/1920-2.png),
                url(<?php echo get_template_directory_uri(); ?>/images/thankyou/bg.jpg);
            "
    >
        <div class="absolute inset-0 flex flex-col text-center">
            <div class="mt-auto pb-6 md:pb-24">
                <div class="container mx-auto px-3">
                    <div class="flex justify-center">
                        <div class="lg:w-6/12 px-3">
                            <div class="text-5xl lg:text-7xl leading-tight text-white font-bold mb-10"><?php echo crb_get_i18n_theme_option('thankyou_title'); ?></div>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="lg:w-4/12 px-3">
                            <div class="text-lg text-white mb-6 font-light"><?php echo crb_get_i18n_theme_option('thankyou_lead'); ?></div>
                            <a
                                class="button button-extended button-arrow"
                                href="<?php echo apply_filters( 'wpml_home_url', get_option( 'home' ) ); ?>"
                            ><?php echo crb_get_i18n_theme_option('thankyou_button_text'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>