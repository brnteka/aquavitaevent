<?php get_header(); ?>
<main>
	<article>
		<header
			class="pt-48 pb-32 bg-center bg-no-repeat bg-cover bg-fixed"
			style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/bg-services.jpg)"
		>
			<div class="container mx-auto px-3">
				<div class="flex justify-center">
					<div class="sm:w-10/12 md:w-8/12">
						<h1 class="text-2xl lg:text-4xl leading-tight font-bold text-white text-center">
							<?php echo carbon_get_the_post_meta('header_title'); ?></h1>
						<div class="mt-5 text-white text-xl text-justify leading-relaxed font-light">
							<?php echo carbon_get_the_post_meta('1st_section_text'); ?></div>
					</div>
				</div>
			</div>
		</header>
		<?php if (function_exists('yoast_breadcrumb') ) : ?>
		<nav class="py-4">
			<div class="container mx-auto px-3">
				<?php yoast_breadcrumb('<div id="breadcrumbs" style="color: #9297A9;" class="text-center text-sm">', '</div>'); ?>
			</div>
		</nav>
		<?php endif; ?>
		<section class="py-16">
			<div class="container px-3 mx-auto">
				<?php $services = carbon_get_the_post_meta('2nd_section_services'); ?>
				<?php if ($services) : ?>
				<div class="md:mb-32">
					<?php foreach ( $services as $index => $service) : ?>
					<?php if (( $index % 2 ) == 0 ) : ?>
					<div class="py-20 sm:py-24 md:py-12 lg:py-16 relative z-20">
						<div class="sm:flex sm:-mx-3 sm:items-center">
							<div class="sm:w-1/2 sm:px-3 mb-8 sm:mb-0">
								<h3 class="text-4xl leading-tight mb-5 font-bold">
									<?php echo $service['2nd_section_service_service']; ?></h3>
								<?php $advantage_list = $service['2nd_section_service_list']; ?>
								<?php if ($advantage_list ) : ?>
								<ul class="text-sm leading-relaxed">
									<?php foreach ( $advantage_list as $advantage_list_item) : ?>
									<li class="mb-3 pl-8 relative">
										<svg
											class="absolute left-0"
											width="20"
											height="20"
											viewBox="0 0 20 20"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M17.5 0.625L5.875 13.4091L2.5 10.8528H0.625L5.875 19.375L19.375 0.625H17.5Z"
												fill="#721F36"
											/>
										</svg>
										<span><?php echo $advantage_list_item['2nd_section_service_list_item']; ?></span>
									</li>
									<?php endforeach; ?>
								</ul>
								<?php endif; ?>
							</div>
							<div class="sm:w-1/2 sm:px-3">
								<div class="relative">
									<div class="aspect-ratio-square"></div>
									<div
										class="lazy absolute top-0 left-0 bottom-0 right-0 bg-center bg-no-repeat"
										data-bg="<?php echo wp_get_attachment_image_src($service['2nd_section_service_photo'], 'full', false)[0]; ?>"
									></div>
								</div>
							</div>
						</div>
					</div>
					<?php else : ?>
					<div class="py-20 sm:py-24 md:py-12 lg:py-16 relative z-10">
						<div
							class="absolute top-0 left-0 bottom-0 right-0 bg-white -mx-3 sm:-mx-2 md:-mx-8 lg:-mx-20 md:-my-20 lg:-my-32">
						</div>
						<div class="relative sm:flex sm:-mx-3 sm:items-center">
							<div class="sm:w-1/2 sm:px-3 mb-8 sm:mb-0">
								<div class="flex justify-center">
									<div class="w-4/6">
										<div class="relative">
											<div class="aspect-ratio-square"></div>
											<div
												class="lazy absolute top-0 left-0 bottom-0 right-0 bg-center bg-no-repeat"
												data-bg="<?php echo wp_get_attachment_image_src($service['2nd_section_service_photo'], 'full', false)[0]; ?>"
											></div>
										</div>
									</div>
								</div>
							</div>
							<div class="sm:w-1/2 sm:px-3">
								<h3 class="text-4xl leading-tight mb-5 font-bold">
									<?php echo $service['2nd_section_service_service']; ?></h3>
								<?php $advantage_list = $service['2nd_section_service_list']; ?>
								<?php if ($advantage_list ) : ?>
								<ul class="text-sm leading-relaxed">
									<?php foreach ( $advantage_list as $advantage_list_item) : ?>
									<li class="mb-3 pl-8 relative">
										<svg
											class="absolute left-0"
											width="20"
											height="20"
											viewBox="0 0 20 20"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M17.5 0.625L5.875 13.4091L2.5 10.8528H0.625L5.875 19.375L19.375 0.625H17.5Z"
												fill="#721F36"
											/>
										</svg>
										<span><?php echo $advantage_list_item['2nd_section_service_list_item']; ?></span>
									</li>
									<?php endforeach; ?>
								</ul>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<section>
			<div class="text-center">
				<button
					class="button"
					x-data="{
                        modalIsReady: false
                    }"
					x-show="modalIsReady"
					x-on:modalisready.document="if ($event.detail.modal === 'modal-contact-form' ) {modalIsReady = true;}"
					x-on:click="$dispatch('open-modal', {modal: 'modal-contact-form'})"
				><?php echo carbon_get_the_post_meta('3d_section_button_text'); ?></button>
			</div>
		</section>
		<section class="py-40 bg-potential">
			<div class="container mx-auto px-3">
				<div class="md:flex -mx-3 md:items-center">
					<div class="md:w-4/12 px-3 mb-10 md:mb-0">
						<h3 class="text-3xl lg:text-4xl font-bold leading-tight">
							<?php echo carbon_get_the_post_meta('3d_section_advantages_title'); ?></h3>
					</div>
					<?php $advantages = carbon_get_the_post_meta('3d_section_advantages_block'); ?>
					<?php if ($advantages ) : ?>
					<div class="hidden">
						<?php var_dump($advantages); ?>
					</div>
					<div class="md:w-8/12 px-3">
						<div class="bg-white px-3 py-16 lg:p-24 -mx-3 sm:-mx-0">
							<ul class="sm:col-count-2 sm:gap-6 -mb-8">
								<?php foreach ($advantages as $advantage) : ?>
								<li class="relative mb-8 pl-20">
									<?php echo wp_get_attachment_image($advantage['3d_section_advantage_block_icon'], 'full', false, array('class' => 'absolute left-0 bottom-0 top-0')); ?>
									<p class="text-lg leading-normal">
										<?php echo $advantage['3d_section_advantage_block_text']; ?></p>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	</article>
</main>
<?php get_footer(); ?>