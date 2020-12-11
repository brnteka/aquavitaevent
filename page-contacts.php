<?php get_header(); ?>
<main>
    <article>
        <header
            class="pt-48 pb-32 bg-center bg-no-repeat bg-cover bg-fixed"
            style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/bg-contacts.jpg)"
        >
            <div class="container mx-auto px-3">
                <div class="flex justify-center">
                    <div class="sm:w-10/12 md:w-8/12">
                        <h1 class="text-2xl lg:text-4xl leading-tight font-bold text-white text-center">
                            <?php echo carbon_get_the_post_meta('header_title'); ?></h1>
                        <div class="mt-5 text-white text-center text-lg lg:text-xl leading-relaxed font-light">
                            <?php echo carbon_get_the_post_meta('1st_section_lead'); ?></div>
                    </div>
                </div>
            </div>
        </header>
        <?php if ( function_exists('yoast_breadcrumb') ) : ?>
        <nav class="py-4">
            <div class="container mx-auto px-3">
                <?php yoast_breadcrumb( '<div id="breadcrumbs" style="color: #9297A9;" class="text-center text-sm">','</div>' ); ?>
            </div>
        </nav>
        <?php endif; ?>
        <section class="pt-24 pb-40 overflow-hidden">
            <div class="container mx-auto px-3">
                <div class="flex flex-col items-center sm:flex-row -mx-3 sm:justify-center">
                    <?php $contacts = crb_get_i18n_theme_option('contacts'); ?>
                    <?php if ( $contacts ) : ?>
                    <?php foreach ( $contacts as $contact ) : ?>
                    <div class="sm:w-4/12 md:w-3/12 px-3 mb-6 sm:mb-0">
                        <div class="flex items-center">
                            <div class="w-12">
                                <?php echo wp_get_attachment_image($contact[crb_get_nested_i18n_theme_option('contacts_icon')], 'full', false); ?>
                            </div>
                            <div>
                                <div class="text-lg font-bold mb-1">
                                    <?php echo $contact[crb_get_nested_i18n_theme_option('contacts_type')]; ?>
                                </div>
                                <div class="cms-content-contact text-sm">
                                    <?php echo $contact[crb_get_nested_i18n_theme_option('contacts_text')]; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php $socials = crb_get_i18n_theme_option('socials'); ?>
                <?php if ( $socials ) : ?>
                <ul class="mt-10 flex flex-wrap justify-center -mb-5 -mr-5">
                    <?php foreach ( $socials as $social ) : ?>
                    <li class="mr-5 mb-5">
                        <a
                            href="<?php echo $social[crb_get_nested_i18n_theme_option('social_url')]; ?>"
                            style="width: 35px; height: 35px; background-color: #962947;"
                            class="rounded-full text-white flex justify-center items-center"
                            target="_blank"
                        >
                            <?php echo wp_get_attachment_image($social[crb_get_nested_i18n_theme_option('social_icon')], 'full', true ); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </section>
        <section class="relative bg-white">
            <div class="container mx-auto px-3">
                <div class="md:flex -mx-3">
                    <div class="md:w-6/12 px-3">
                        <div class=" sm:pt-10 md:pt-32 md:pb-32">
                            <div class="-mx-3 sm:mx-0 px-3 py-10 sm:px-8 sm:py-10 lg:px-16 lg:py-20">
                                <div class="text-4xl leading-tight font-bold mb-5">
                                    <?php echo carbon_get_the_post_meta('2st_section_title'); ?></div>
                                <div class="text-xl leading-relaxed font-light mb-5 text-justify">
                                    <?php echo carbon_get_the_post_meta('2st_section_text'); ?></div>
                                <div class="text-sm leading-relaxed font-bold">
                                    <?php echo carbon_get_the_post_meta('2st_section_address'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sm:container sm:px-3 sm:mx-auto md:mw-auto md:px-0 md:mx-0">
                <div class="w-full h-128 md:h-auto md:w-6/12 md:absolute md:top-0 md:right-0 md:bottom-0">
                    <iframe
                        class="w-full h-full"
                        frameborder="0"
                        style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=<?php echo carbon_get_the_post_meta('2st_section_map_api_key'); ?>&language=<?php echo ICL_LANGUAGE_CODE; ?>&q=<?php echo urlencode(carbon_get_the_post_meta('2st_section_map')); ?>"
                        allowfullscreen
                    >
                    </iframe>
                </div>
            </div>
        </section>
    </article>
</main>
<?php get_footer(); ?>