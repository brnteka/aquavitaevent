</div>
<footer
    class="footer lg:fixed lg:bottom-0 lg:left-0 lg:right-0"
    style="z-index: -1;padding: 100px 0; background-color: #2F3343;"
>
    <div class="container mx-auto px-3">
        <div class="md:flex -mx-3">
            <div class="md:w-1/2 px-3 mb-16 md:mb-0">
                <section class="hidden md:block mb-20">
                    <nav>
                        <?php wp_nav_menu(
                            array(
                                'menu' => 'primary_menu',
                                'menu_class' => 'footer-menu',
                                'container' => '',
                                'fallback_cb' => false 
                            )); ?>
                    </nav>
                </section>
                <div class="sm:flex -mx-3 md:block">
                    <div class="sm:w-1/2 px-3 md:w-auto mb-16 sm:mb-0 md:mb-20">
                        <section>
                            <?php if ( get_theme_mod( 'custom_logo' ) ) : ?>
                            <div class="mb-10 text-center md:text-left">
                                <a
                                    class="inline-block"
                                    href=""
                                >
                                    <?php echo wp_get_attachment_image(get_theme_mod( 'custom_logo' ), 'full', false, array('class' => '')); ?>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php $footer_contacts = crb_get_i18n_theme_option('contacts'); ?>
                            <?php if ( $footer_contacts ) : ?>
                            <ul class="text-white text-center md:text-left">
                                <?php foreach ( $footer_contacts as $contact ) : ?>
                                <li class="mt-3">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <?php echo wp_get_attachment_image($contact[crb_get_nested_i18n_theme_option('contacts_icon')], 'full', false, array('class' => 'h-5')); ?>
                                        </div>
                                        <div
                                            class="text-sm"
                                            style="color: #EAEDF4 !important;"
                                        ><?php echo $contact[crb_get_nested_i18n_theme_option('contacts_text')]; ?>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </section>
                    </div>
                    <div class="sm:w-1/2 px-3 md:w-auto">
                        <section>
                            <div
                                class="text-xl leading-relaxed font-bold uppercase text-white mb-3 text-center md:text-left">
                                <?php echo crb_get_i18n_theme_option('footer_socials_title'); ?></div>
                            <?php $socials = crb_get_i18n_theme_option('socials'); ?>
                            <?php if ( $socials ) : ?>
                            <div class="overflow-hidden mb-5">
                                <ul class="flex flex-wrap justify-center md:justify-start -mb-5 -mr-5">
                                    <?php foreach ( $socials as $social ) : ?>
                                    <li class="mr-5 mb-5">
                                        <a
                                            href="<?php echo $social[crb_get_nested_i18n_theme_option('social_url')]; ?>"
                                            style="width: 35px; height: 35px;"
                                            class="social-footer rounded-full flex justify-center items-center"
                                            target="_blank"
                                        >
                                            <?php echo wp_get_attachment_image($social[crb_get_nested_i18n_theme_option('social_icon')], 'full', true ); ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <div class="text-sm leading-relaxed text-white text-center md:text-left">
                                <?php echo crb_get_i18n_theme_option('footer_socials_text'); ?></div>
                        </section>
                    </div>
                </div>
            </div>
            <?php if ( is_active_sidebar( 'footer' ) ) : ?>
            <div class="md:w-1/2 px-3">
                <div>
                    <section class="mb-8">
                        <h2 class="text-white uppercase font-bold mb-4 text-3xl text-center">
                            <?php echo crb_get_i18n_theme_option('footer_contact_form_title'); ?></h2>
                        <div class="text-center text-gray-500">
                            <?php echo crb_get_i18n_theme_option('footer_contact_form_text'); ?></div>
                    </section>
                    <?php dynamic_sidebar( 'footer' ); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
<?php if ( is_active_sidebar( 'home_right_1' ) ) : ?>
<div>
    <?php dynamic_sidebar( 'home_right_1' ); ?>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
</body>

</html>