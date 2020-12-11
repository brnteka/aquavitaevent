<?php get_header(); ?>
<main class="relative">
    <section class="h-screen relative">
        <div class="absolute inset-0 w-full h-full">
            <video class="w-full h-full object-cover" src="<?php echo get_template_directory_uri(); ?>/video/frontpage-bg.mp4" autoplay preload playsinline muted loop type="video/mp4"></video>
        </div>
        <div class="relative h-full">
            <div class="container px-3 mx-auto h-full">
                <div class="h-full flex justify-center items-center">
                    <div>
                        <h1 class="text-2xl lg:text-3xl xl:text-6xl text-center font-bold text-white">Сделаем MICE<br> сильной стороной вашего<br class="hidden xl:inline"> бизнеса</h1>
                        <div class="text-center mt-8 lg:hidden">
                            <button class="py-4 px-5 border-white border text-xs uppercase text-white leading-snug">запросить просчет</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-40">
        <div class="container mx-auto px-3">
            <div class="sm:flex -mx-3 sm:items-center">
                <div class="sm:w-1/2 px-3">
                    <h3 class="text-center sm:text-left mb-10 sm:mb-8 text-2xl xl:text-4xl leading-tight font-bold">Мы — профессионалы в:</h3>
                    <div class="hidden sm:block">
                        <a href="<?php echo get_permalink( get_page_by_path( 'services' ) ); ?>" class="inline-block py-5 px-6 text-white uppercase bg-red-800 text-xs xl:text-sm leading-none">УЗНАТЬ ОБ УСЛУГАХ</a>
                    </div>
                </div>
                <div class="sm:w-1/2 px-3 mb-10 sm:mb-0">
                    <ul class="-mb-3">
                        <li class="py-3 mb-3 flex -mx-3 items-center">
                            <div class="w-1/6 px-3">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/frontpage-icon.svg" alt="" class="mx-auto">
                            </div>
                            <div class="w-5/6 px-3">
                                <span class="xl:text-lg leading-normal">Организации деловых встреч, конференций, конгрессов</span>
                            </div>
                        </li>
                        <li class="py-3 mb-3 flex -mx-3 items-center">
                            <div class="w-1/6 px-3">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/globe.svg" alt="" class="mx-auto">
                            </div>
                            <div class="w-5/6 px-3">
                                <span class="xl:text-lg leading-normal">Разработке и реализации мотивационных и поощрительных туров</span>
                            </div>
                        </li>
                        <li class="py-3 mb-3 flex -mx-3 items-center">
                            <div class="w-1/6 px-3">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/handshake.svg" alt="" class="mx-auto">
                            </div>
                            <div class="w-5/6 px-3">
                                <span class="xl:text-lg leading-normal">Проведении деловых и корпоративных мероприятий</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="sm:hidden text-center">
                    <button class="inline-block py-5 px-6 text-white uppercase bg-red-800 text-xs xl:text-sm leading-none">УЗНАТЬ ОБ УСЛУГАХ</button>
                </div>
            </div>
        </div>
    </section>
    <section
        x-data="portfolio()"
        x-on:portfolio-modal.document="initPortfolioItem(event.detail.id, event.detail.posttype);"
        class="relative py-40 bg-gray-200"
    >
        <div class="absolute left-0 right-0 top-0 bg-white" style="height: 33%;"></div>
        <div class="relative container px-3 mx-auto">
            <div class="sm:flex sm:-mx-3">
                <div class="sm:w-1/2 mb-6 sm:mb-0 sm:px-3">
                    <div class="flex mb-16">
                        <div class="w-5/6">
                            <h3 class="text-4xl font-bold leading-tight mb-5">Несколько наших мероприятий</h3>
                            <p class="text-xl leading-relaxed">Давно выяснено, что при оценке дизайнааа текст мешает сосредоточиться</p>
                        </div>
                    </div>
                    <?php $portfolioLeftColumn = new WP_Query(
                        array(
                            'post_type' => array(
                                'portfolio_gallery'
                            ),
                            'posts_per_page' => 1
                        )
                    ); ?>
                    <?php if ( $portfolioLeftColumn->have_posts() ) : ?>
                    <div class="overflow-wrapper-left">
                        <?php while ( $portfolioLeftColumn->have_posts() ) : $portfolioLeftColumn->the_post(); ?>
                        <div class="relative -mx-3 sm:mx-0">
                            <div
                                class="aspect-ratio-square bg-center bg-cover bg-no-repeat"
                                style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)"
                            ></div>
                            <div
                                class="absolute text-left inset-0 flex flex-col transform duration-500 transition-opacity opacity-0 hover:opacity-100 cursor-pointer"
                                x-on:click="$dispatch('portfolio-modal', {
                                    id: <?php echo get_the_ID(); ?>,
                                    posttype: '<?php echo get_post_type() ?>'
                                })"
                            >
                                <div class="mt-auto relative p-6">
                                    <div class="absolute inset-0 bg-gradient-to-t opacity-75 from-black"></div>
                                    <div class="text-2xl font-bold text-white relative"><?php echo get_the_title(); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>
                </div>
                <div class="sm:w-1/2 px-3 sm:pt-32">
                    <div class="sm:h-full flex flex-col overflow-wrapper-right">
                        <?php $portfolioRightColumn = new WP_Query(
                            array(
                                'post_type' => array(
                                    'portfolio_gallery'
                                ),
                                'posts_per_page' => 4,
                                'offset' => 1
                            )
                        ); ?>
                        <?php if ( $portfolioRightColumn->have_posts() ) : ?>
                        <div class="flex flex-wrap -mx-3">
                            <?php while ( $portfolioRightColumn->have_posts() ) : $portfolioRightColumn->the_post(); ?>
                            <div class="w-1/2 px-3 mb-6">
                                <div class="relative">
                                    <div
                                        class="aspect-ratio-square bg-center bg-cover bg-no-repeat"
                                        style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)"
                                    ></div>
                                    <div
                                        class="absolute w-full h-full text-left inset-0 flex flex-col transform duration-500 transition-opacity opacity-0 hover:opacity-100 cursor-pointer"
                                        x-on:click="$dispatch('portfolio-modal', {
                                            id: <?php echo get_the_ID(); ?>,
                                            posttype: '<?php echo get_post_type() ?>',
                                        })"
                                    >
                                        <div class="mt-auto relative p-6">
                                            <div class="absolute inset-0 via-pink-black bg-gradient-to-t opacity-75 from-black"></div>
                                            <div class="text-2xl font-bold text-white relative"><?php echo get_the_title(); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                        <div class="mt-auto">
                            <button class="text-sm uppercase leading-snug py-6 px-8 bg-red-900 text-white tracking-wider">Портфолио</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-56 bg-gray-200 overflow-hidden">
        <div class="container px-3 mx-auto">
            <div class="lg:flex lg:justify-between lg:-mx-3">
                <div class="lg:w-6/12 lg:px-3 lg:pt-24 mb-16 lg:mb-0">
                    <h3 class="text-4xl font-bold leading-tight mb-16">Сотрудничество с нами — это всегда:</h3>
                    <ul class="sm:flex sm:flex-wrap -mx-3">
                        <li class="sm:w-1/2 px-3 mb-6">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 top-0" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28 1L9.4 21.4545L4 17.3645H1L9.4 31L31 1H28Z" fill="#721F36"></path>
                                </svg>
                                <h3 class="font-bold uppercase mb-3">Индивидуальный подход</h3>
                                <p class="text-sm leading-relaxed">к организации любого бизнес-мероприятия</p>
                            </div>
                        </li>
                        <li class="sm:w-1/2 px-3 mb-6">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 top-0" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28 1L9.4 21.4545L4 17.3645H1L9.4 31L31 1H28Z" fill="#721F36"></path>
                                </svg>
                                <h3 class="font-bold uppercase mb-3">Доступ к международной базе</h3>
                                <p class="text-sm leading-relaxed">партнеров с лучшими финансовыми предложениями</p>
                            </div>
                        </li>
                        <li class="sm:w-1/2 px-3 mb-6">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 top-0" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28 1L9.4 21.4545L4 17.3645H1L9.4 31L31 1H28Z" fill="#721F36"></path>
                                </svg>
                                <h3 class="font-bold uppercase mb-3">Большой выбор</h3>
                                <p class="text-sm leading-relaxed">креативных идей и инновационных направлений</p>
                            </div>
                        </li>
                        <li class="sm:w-1/2 px-3 mb-6">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 top-0" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28 1L9.4 21.4545L4 17.3645H1L9.4 31L31 1H28Z" fill="#721F36"></path>
                                </svg>
                                <h3 class="font-bold uppercase mb-3">Поддержка</h3>
                                <p class="text-sm leading-relaxed">квалифицированная поддержка менеджеров 24/7</p>
                            </div>
                        </li>
                        <li class="sm:w-1/2 px-3 mb-6">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 top-0" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28 1L9.4 21.4545L4 17.3645H1L9.4 31L31 1H28Z" fill="#721F36"></path>
                                </svg>
                                <h3 class="font-bold uppercase mb-3">Грамотное формирование</h3>
                                <p class="text-sm leading-relaxed">бюджета мероприятия</p>
                            </div>
                        </li>
                        <li class="sm:w-1/2 px-3 mb-6">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 top-0" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28 1L9.4 21.4545L4 17.3645H1L9.4 31L31 1H28Z" fill="#721F36"></path>
                                </svg>
                                <h3 class="font-bold uppercase mb-3">Долгосрочная работа</h3>
                                <p class="text-sm leading-relaxed">на выгодных условия</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="lg:w-5/12 lg:px-3">
                    <div class="py-16 sm:py-20 lg:py-24 px-3 sm:px-0 bg-white relative">
                        <div style="left: 100%;" class="hidden lg:block absolute top-0 bottom-0 w-screen bg-white"></div>
                        <div class="flex justify-center lg:justify-start text-center sm:text-left -mx-3">
                            <div class="hidden lg:block w-1/5 px-3"></div>
                            <div class="sm:w-10/12 lg:w-4/5 px-3">
                                <h3 class="text-3xl lg:text-4xl font-bold leading-tight mb-10 lg:mb-16">О нас в цифрах</h3>
                                <ul id="competedCounters" class="flex flex-wrap md:justify-center lg:justify-start -mx-3 -mb-8">
                                    <li class="w-1/2 px-3 mb-8">
                                        <div class="text-5xl lg:text-6xl" data-counter data-countto="234"></div>
                                        <div class="text-sm leading-relaxed">контракта с авиакомпаниями</div>
                                    </li>
                                    <li class="w-1/2 px-3 mb-8">
                                        <div class="text-5xl lg:text-6xl" data-counter data-countto="445"></div>
                                        <div class="text-sm leading-relaxed">контракта с авиакомпаниями</div>
                                    </li>
                                    <li class="w-1/2 px-3 mb-8">
                                        <div class="text-5xl lg:text-6xl" data-counter data-countto="25"></div>
                                        <div class="text-sm leading-relaxed">контракта с авиакомпаниями</div>
                                    </li>
                                    <li class="w-1/2 px-3 mb-8">
                                        <div class="text-5xl lg:text-6xl" data-counter data-countto="35"></div>
                                        <div class="text-sm leading-relaxed">контракта с авиакомпаниями</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 xl:py-40 text-white bg-center bg-cover text-center sm:text-left" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/competed-bg.jpg)">
        <div class="container px-3 mx-auto">
            <div class="text-2xl xl:text-4xl font-bold leading-tight mb-10 xl:mb-16">Нами реализовано с</div>
            <div id="implementedCounter" class="flex flex-wrap -mx-3 items-top">
                <div class="w-full sm:w-6/12 px-3 mb-10 sm:mb-0">
                    <div class="text-6xl xl:text-7xl leading-none">2016 года</div>
                </div>
                <div class="w-1/2 sm:w-3/12 px-3">
                    <div class="text-6xl xl:text-7xl leading-none" data-counter data-countto="182"></div>
                    <div class="text-sm leading-normal">международных проекта</div>
                </div>
                <div class="w-1/2 sm:w-3/12 px-3">
                    <div class="text-6xl xl:text-7xl leading-none" data-counter data-countto="667"></div>
                    <div class="text-sm leading-normal">проектов в Украине</div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>