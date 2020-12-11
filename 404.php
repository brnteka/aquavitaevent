<?php get_header(); ?>
<main>
    <div
        id="bg404"
        class="h-screen bg-no-repeat bg-center"
        style="
            background-image:
                url(<?php echo get_template_directory_uri(); ?>/images/404/depth-3.png),
                url(<?php echo get_template_directory_uri(); ?>/images/404/depth-2.png),
                url(<?php echo get_template_directory_uri(); ?>/images/404/depth-1.png);
            background-color: #2F3343;
        "
    >
        <div class="absolute inset-0 flex justify-center items-center">
            <div class="text-8xl text-white font-bold opacity-25">404</div>
        </div>
        <div class="absolute inset-0 flex flex-col">
            <div class="mt-auto pb-6 md:pb-24 text-center">
                <div class="text-4xl font-bold text-white mb-8"><?php echo crb_get_i18n_theme_option('404_text'); ?>
                </div>
                <a
                    class="button button-extended button-arrow"
                    href="<?php echo apply_filters( 'wpml_home_url', get_option( 'home' ) ); ?>"
                ><?php echo crb_get_i18n_theme_option('404_button_text'); ?></a>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>