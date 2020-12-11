<?php get_header();?>
<main class="relative">
	<section class="h-screen relative">
		<div class="absolute inset-0 w-full h-full">
			<video
				class="w-full h-full object-cover"
				src="<?php echo get_template_directory_uri(); ?>/video/frontpage-bg.webm"
				autoplay
				preload
				playsinline
				muted
				loop
				type='video/webm; codecs="vp9"'
			></video>
		</div>
		<div class="relative h-full">
			<div class="container px-3 mx-auto h-full">
				<div class="h-full flex justify-center items-center">
					<div>
						<h1 class="text-3xl lg:text-4xl xl:text-hero text-center font-bold text-white leading-tight">
							<?php echo carbon_get_the_post_meta('hero_title'); ?></h1>
						<div class="text-center mt-8 lg:hidden">
							<button
								class="py-4 px-5 border-white border uppercase text-white leading-none"
								x-data="{
                                    modalIsReady: false
                                }"
								x-show="modalIsReady"
								x-on:modalisready.document="if ($event.detail.modal === 'modal-contact-form' ) {modalIsReady = true;}"
								x-on:click="$dispatch('open-modal', {modal: 'modal-contact-form'})"
								x-cloak
							><?php echo carbon_get_the_post_meta('hero_button_text'); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- new -->
	<?php if (carbon_get_the_post_meta('1st_section_mice') || carbon_get_the_post_meta('1st_section_advantages')) : ?>
	<section
		class="pt-24 pb-20"
		style="background-color: #F1F2F6;"
	>
		<div class="container mx-auto px-3">
			<div class="lg:flex -mx-3 lg:items-center">
				<!-- spacer -->
				<div class="w-1/12"></div>
				<!-- spacer -->
				<?php $first_section_mice = carbon_get_the_post_meta('1st_section_mice'); ?>
				<?php if ($first_section_mice) : ?>
				<div class="lg:w-5/12 mb-16 px-3 text-center lg:text-left">
					<ul class="mice inline-block lg:block text-left">
						<?php foreach($first_section_mice as $first_section_mice_item) : ?>
						<li class="mb-2"><span class="mice-word"><span
									class="mice-big-letter"><?php echo $first_section_mice_item['1st_section_mice_first_letter'];?></span><span
									class="mice-word-the-rest"
								><?php echo $first_section_mice_item['1st_section_mice_rest_of_word'];?></span></span><span
								class="mice-expanded-translation"
							>
								<?php if (!empty($first_section_mice_item['1st_section_mice_expanded_translation']) ) : ?>
								<span><span
										class="hidden sm:inline">/</span><?php echo $first_section_mice_item['1st_section_mice_expanded_translation']; ?></span>
								<?php endif; ?></span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php $first_section_advantages = carbon_get_the_post_meta('1st_section_advantages');?>
				<?php if ($first_section_advantages) : ?>
				<div class="lg:w-6/12 px-3">
					<ul class="sm:flex sm:flex-wrap -mb-3">
						<?php foreach ($first_section_advantages as $first_section_advantage): ?>
						<li class="sm:w-1/2 mb-4 px-3">
							<div class="bg-white p-6 h-full">
								<div>
									<img
										src="<?php echo wp_get_attachment_image_src($first_section_advantage['1st_section_advantage_icon'], 'full', false)[0]; ?>"
										alt=""
									>
								</div>
								<div>
									<span
										class="text-sm leading-normal"><?php echo $first_section_advantage['1st_section_advantage_text']; ?></span>
								</div>
							</div>
						</li>
						<?php endforeach;?>
					</ul>
				</div>
				<?php endif;?>
			</div>
		</div>
	</section>
	<?php endif; ?>
	<!-- new -->
	<section
		class="py-40 hidden"
		style="background-color: #F1F2F6;"
	>
		<div class="container mx-auto px-3">
			<div class="sm:flex -mx-3 sm:items-center">
				<div class="sm:w-1/2 px-3">
					<h3 class="text-center sm:text-left mb-10 sm:mb-8 text-2xl lg:text-4xl leading-tight font-bold">
						<?php // echo carbon_get_the_post_meta('1st_section_title'); ?></h3>
					<div class="hidden sm:block">
						<a
							href="<?php // echo get_permalink(get_page_by_path('services')); ?>"
							class="button button-extended button-arrow"
						><?php // echo carbon_get_the_post_meta('1st_section_button_text'); ?></a>
					</div>
				</div>
				<?php // $first_section_advantages = carbon_get_the_post_meta('1st_section_advantages');?>
				<?php // if ($first_section_advantages) : ?>
				<div class="sm:w-1/2 px-3 mb-10 sm:mb-0">
					<ul class="-mb-3">
						<?php // foreach ($first_section_advantages as $first_section_advantage): ?>
						<li class="py-3 mb-3 flex -mx-3 items-center">
							<div class="flex-initial pl-3 md:px-3">
								<img
									src="<?php // echo wp_get_attachment_image_src($first_section_advantage['1st_section_advantage_icon'], 'full', false)[0]; ?>"
									alt=""
									class="mx-auto"
								>
							</div>
							<div class="flex-1 px-3">
								<span
									class="xl:text-lg leading-normal text-justify"><?php // echo $first_section_advantage['1st_section_advantage_text']; ?></span>
							</div>
						</li>
						<?php // endforeach;?>
					</ul>
				</div>
				<?php // endif;?>
				<div class="sm:hidden text-center">
					<a
						class="button button-extended button-arrow"><?php // echo carbon_get_the_post_meta('1st_section_button_text'); ?></a>
				</div>
			</div>
		</div>
	</section>
	<section
		x-data="portfolio()"
		x-on:portfolio-modal.document="initPortfolioItem(event.detail.id, event.detail.posttype);"
		class="relative py-40 bg-gray-200"
	>
		<div
			class="absolute left-0 right-0 top-0 bg-white"
			style="height: 75%;"
		></div>
		<div class="relative container px-3 mx-auto">
			<div class="sm:flex sm:-mx-3">
				<div class="sm:w-1/2 mb-6 sm:mb-0 sm:px-3">
					<div class="flex mb-16">
						<div class="md:w-5/6">
							<h3 class="text-center md:text-left text-3xl lg:text-4xl font-bold leading-tight mb-5">
								<?php echo carbon_get_the_post_meta('2st_section_title'); ?></h3>
							<div class="text-center md:text-justify text-lg lg:text-xl leading-relaxed font-light">
								<?php echo carbon_get_the_post_meta('2st_section_lead'); ?></div>
						</div>
					</div>
					<?php $portfolioLeftColumn = new WP_Query(
                        array(
                        'post_type' => array(
                            'portfolio_gallery',
                        ),
                        'posts_per_page' => 1,
                        'meta_query'=>array(
                            array(
                                'key' => 'show_on_frontpage',
                                'value' => 'true',
                            ),
                        ),
                        )
                    );?>
					<?php if ($portfolioLeftColumn->have_posts()) : ?>
					<div class="overflow-wrapper-left">
						<?php while ($portfolioLeftColumn->have_posts()): $portfolioLeftColumn->the_post();?>
						<div class="front-page-tile relative -mx-3 sm:mx-0 overflow-hidden">
							<div
								class="lazy front-page-tile-bg aspect-ratio-square bg-center bg-cover bg-no-repeat duration-500 ease-in-out"
								data-bg="<?php echo get_the_post_thumbnail_url(); ?>"
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
									<div class="font-bold text-white relative"><?php echo get_the_title(); ?>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile;?>
					</div>
					<?php endif;?>
					<?php wp_reset_query();?>
				</div>
				<div class="sm:w-1/2 px-3">
					<div class="sm:h-full flex flex-col overflow-wrapper-right">
						<div
							class="hidden sm:block mb-4 bg-events"
							style="padding-bottom: 22.14%;"
						></div>
						<?php $portfolioRightColumn = new WP_Query(
                            array(
                                'post_type' => array(
                                    'portfolio_gallery',
                                ),
                                'posts_per_page' => 4,
                                'offset' => 1,
                                'meta_query'=>array(
                                    array(
                                        'key' => 'show_on_frontpage',
                                        'value' => 'true',
                                    ),
                                ),
                            )
                        );?>
						<?php if ($portfolioRightColumn->have_posts()) : ?>
						<div class="flex flex-wrap -mx-3">
							<?php while ($portfolioRightColumn->have_posts()): $portfolioRightColumn->the_post();?>
							<div class="w-1/2 px-3 mb-6">
								<div class="front-page-tile overflow-hidden relative">
									<div
										class="lazy front-page-tile-bg aspect-ratio-square bg-center bg-cover bg-no-repeat duration-500 ease-in-out"
										data-bg="<?php echo get_the_post_thumbnail_url(); ?>"
									></div>
									<div
										class="absolute w-full h-full text-left inset-0 flex flex-col transform duration-500 transition-opacity opacity-0 hover:opacity-100 cursor-pointer"
										x-on:click="$dispatch('portfolio-modal', {
                                                            id: <?php echo get_the_ID(); ?>,
                                                            posttype: '<?php echo get_post_type() ?>',
                                                        })"
									>
										<div class="mt-auto relative p-2 md:p-6 hidden md:block">
											<div
												class="absolute inset-0 via-pink-black bg-gradient-to-t opacity-75 from-black">
											</div>
											<div class="font-bold text-white relative">
												<?php echo get_the_title(); ?></div>
										</div>
									</div>
								</div>
							</div>
							<?php endwhile;?>
						</div>
						<?php endif;?>
						<?php wp_reset_query();?>
						<div class="mt-auto text-center sm:text-left">
							<a
								class="button button-extended button-portfolio"
								href="<?php echo home_url('/portfolio/') ?>"
							><?php echo carbon_get_the_post_meta('2st_section_button_text'); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="pb-56 bg-gray-200 overflow-hidden bg-numbers">
		<div class="container px-3 mx-auto">
			<div class="lg:flex lg:justify-between lg:-mx-3">
				<div class="lg:w-6/12 lg:px-3 lg:pt-24 mb-16 lg:mb-0">
					<h3 class="text-center sm:text-left text-3xl lg:text-4xl font-bold leading-tight mb-16">
						<?php echo carbon_get_the_post_meta('3d_section_advantages_title'); ?></h3>
					<?php $third_section_advantages = carbon_get_the_post_meta('3d_section_advantages');?>
					<?php if ($third_section_advantages) : ?>
					<ul class="sm:flex sm:flex-wrap -mx-3">
						<?php foreach ($third_section_advantages as $third_section_advantage): ?>
						<li class="sm:w-1/2 px-3 mb-6">
							<div class="relative pl-12">
								<svg
									class="absolute left-0 top-0"
									width="32"
									height="32"
									viewBox="0 0 32 32"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M28 1L9.4 21.4545L4 17.3645H1L9.4 31L31 1H28Z"
										fill="#721F36"
									></path>
								</svg>
								<div class="text-sm leading-relaxed text-justify mb-3">
									<?php echo $third_section_advantage['3d_section_advantage_text']; ?></div>
								<!-- <h3 class="font-bold uppercase mb-3"></h3>
                                <p class="text-sm leading-relaxed"></p> -->
							</div>
						</li>
						<?php endforeach;?>
					</ul>
					<?php endif;?>
				</div>
				<div class="lg:w-5/12 lg:px-3">
					<div class="py-16 sm:py-20 lg:py-24 px-3 sm:px-0 bg-white relative">
						<div
							style="left: 100%;"
							class="hidden lg:block absolute top-0 bottom-0 w-screen bg-white"
						></div>
						<div class="flex justify-center lg:justify-start text-left -mx-3">
							<div class="hidden lg:block w-1/5 px-3"></div>
							<div class="sm:w-10/12 lg:w-4/5 px-3">
								<h3 class="text-3xl lg:text-4xl font-bold leading-tight mb-10 lg:mb-16">
									<?php echo carbon_get_the_post_meta('3d_section_numbers_title'); ?></h3>
								<?php $third_section_numbers = carbon_get_the_post_meta('3d_section_numbers');?>
								<?php if ($third_section_numbers) : ?>
								<ul
									id="competedCounters"
									class="flex flex-wrap md:justify-center lg:justify-start -mx-3 -mb-8"
								>
									<?php foreach ($third_section_numbers as $third_section_number): ?>
									<li class="w-1/2 px-3 mb-8">
										<div
											class="text-5xl lg:text-6xl"
											data-counter
											data-countto="<?php echo $third_section_number['3d_section_number_number']; ?>"
										></div>
										<div class="text-sm leading-relaxed">
											<?php echo $third_section_number['3d_section_number_text']; ?></div>
									</li>
									<?php endforeach;?>
								</ul>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section
		class="lazy py-24 xl:py-40 text-white bg-center bg-cover text-center sm:text-left"
		data-bg="<?php echo get_template_directory_uri(); ?>/images/competed-bg.jpg"
	>
		<div class="container px-3 mx-auto">
			<div class="text-2xl xl:text-4xl font-bold leading-tight mb-10 xl:mb-16">
				<?php echo carbon_get_the_post_meta('4th_section_year_text'); ?></div>
			<div
				id="implementedCounter"
				class="flex flex-wrap -mx-3 items-top"
			>
				<div class="w-full sm:w-6/12 px-3 mb-10 sm:mb-0">
					<div class="text-6xl xl:text-7xl leading-none">
						<?php echo carbon_get_the_post_meta('4th_section_year'); ?></div>
				</div>
				<div class="w-1/2 sm:w-3/12 px-3">
					<div
						class="text-6xl xl:text-7xl leading-none"
						data-counter
						data-countto="<?php echo carbon_get_the_post_meta('4th_section_1st_number'); ?>"
					></div>
					<div class="text-sm leading-normal">
						<?php echo carbon_get_the_post_meta('4th_section_1st_number_text'); ?></div>
				</div>
				<div class="w-1/2 sm:w-3/12 px-3">
					<div
						class="text-6xl xl:text-7xl leading-none"
						data-counter
						data-countto="<?php echo carbon_get_the_post_meta('4th_section_2st_number'); ?>"
					></div>
					<div class="text-sm leading-normal">
						<?php echo carbon_get_the_post_meta('4th_section_2st_number_text'); ?></div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer();?>