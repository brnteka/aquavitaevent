<?php get_header(); ?>
<main>
	<article>
		<!-- Hero -->
		<header
			class="pt-48 pb-32 bg-center bg-no-repeat bg-cover bg-fixed"
			style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/bg-about-us.jpg)"
		>
			<div class="container mx-auto px-3">
				<div class="flex justify-center">
					<div class="sm:w-10/12 md:w-8/12">
						<h1 class="text-2xl lg:text-4xl leading-tight font-bold text-white text-center">
							<?php echo carbon_get_the_post_meta('header_title'); ?></h1>
						<div class="mt-5 text-white text-center text-xl leading-relaxed font-light">
							<?php echo carbon_get_the_post_meta('1st_section_text'); ?></div>
					</div>
				</div>
			</div>
		</header>
		<!-- Breadcrumbs -->
		<?php if (function_exists('yoast_breadcrumb') ) : ?>
		<nav class="py-4">
			<div class="container mx-auto px-3">
				<?php yoast_breadcrumb('<div id="breadcrumbs" style="color: #9297A9;" class="text-center text-sm">', '</div>'); ?>
			</div>
		</nav>
		<?php endif; ?>
		<section class="pt-24 pb-40">
			<div class="container mx-auto px-3">
				<div class="flex -mx-3 justify-center">
					<div class="md:w-6/12 px-3">
						<div class="cms-content text-justify drop-cap text-sm leading-relaxed">
							<?php echo apply_filters('the_content', carbon_get_the_post_meta('2nd_section_text')); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section>
			<div class="container mx-auto px-3">
				<div class="bg-white py-20 -mx-3 sm:-mx-0">
					<div class="sm:flex sm:-mx-3">
						<!-- spacer -->
						<div class="hidden sm:block w-1/12 px-3"></div>
						<div class="sm:w-8/12 px-3">
							<div class="flex -mx-3">
								<div class="w-1/2 px-3">
									<div
										class="border-4 mb-5"
										style="border-color: #2F3343;"
									></div>
									<h5 class="text-lg sm:text-xl leading-relaxed whitespace-no-wrap">
										<?php echo carbon_get_the_post_meta('3d_section_small_text'); ?></h5>
								</div>
							</div>
							<div class="text-3dot5xl lg:text-5dot5xl font-bold uppercase leading-tight mt-10">
								<?php echo carbon_get_the_post_meta('3d_section_large_text'); ?></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Values -->
		<section class="py-40">
			<div class="container mx-auto px-3">
				<h3 class="text-4xl leading-tight font-bold mb-16">
					<?php echo carbon_get_the_post_meta('4th_section_title'); ?></h3>
				<?php $values = carbon_get_the_post_meta('4th_section_values'); ?>
				<?php if ($values ) : ?>
				<ul class="sm:flex -mx-3">
					<?php foreach ( $values as $value ) : ?>
					<li class="sm:w-1/3 px-3 mb-6 sm:mb-0">
						<div class="relative pl-12 sm:pl-16">
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
								/>
							</svg>
							<h3 class="font-bold uppercase mb-3"><?php echo $value['4th_section_value']; ?></h3>
							<p class="text-justify"><?php echo $value['4th_section_value_text']; ?></p>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>
		</section>
		<?php if (carbon_get_the_post_meta('history_section_milestones') || carbon_get_the_post_meta('history_section_title') ) : ?>
		<!-- History -->
		<section class="pt-40 pb-56 bg-white bg-history">
			<div class="container mx-auto px-3">
				<?php if (carbon_get_the_post_meta('history_section_milestones') ) :?>
				<h3 class="text-4xl leading-tight font-bold mb-16">
					<?php echo carbon_get_the_post_meta('history_section_title'); ?></h3>
				<?php endif; ?>
				<?php $milestones = carbon_get_the_post_meta('history_section_milestones'); ?>
				<?php if ($milestones ) : ?>
				<div class="md:flex -mx-3 md:py-40">
					<?php foreach ( $milestones as $milestone ) : ?>
					<div class="px-3 step md:w-1/12">
						<div class="step-inner-wrapper">
							<div class="year-wrapper">
								<div class="year"><?php echo $milestone['history_section_year']; ?></div>
							</div>
							<div class="description">
								<?php echo apply_filters('the_content', $milestone['history_section_desciption']); ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
					<div class="px-3 future-step md:w-1/12">
						<div class="relative">
							<div class="future-year"></div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<?php endif; ?>
		<!-- Responsibility -->
		<section class="py-40">
			<div class="container mx-auto px-3">
				<div class="flex -mx-3 justify-center">
					<div class="md:w-10/12 px-3">
						<h3 class="text-4xl leading-tight font-bold mb-16">
							<?php echo carbon_get_the_post_meta('5th_section_title'); ?></h3>
					</div>
				</div>
				<div class="flex -mx-3 justify-center">
					<div class="md:w-6/12 px-3">
						<div class="cms-content text-justify drop-cap text-sm leading-relaxed">
							<?php echo apply_filters('the_content', carbon_get_the_post_meta('5th_section_text')); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Team -->
		<section
			class="py-40 bg-team"
			style="background-color: #F1F2F6;"
		>
			<div class="container mx-auto px-3">
				<div class="flex flex-wrap -mx-3 justify-center md:justify-start">
					<div class="w-full md:w-4/12 px-3 mb-10 md:mb-0">
						<h3 class="text-4xl leading-tight font-bold mb-5">
							<?php echo carbon_get_the_post_meta('6th_section_title'); ?></h3>
						<div class="text-lg leading-relaxed">
							<?php echo carbon_get_the_post_meta('6th_section_text'); ?>
						</div>
					</div>
					<?php $team = carbon_get_the_post_meta('6th_section_team'); ?>
					<?php if ($team ) : ?>
					<div class="w-full sm:w-6/12 md:w-5/12 px-3">
						<div id="team-slider-main">
							<?php foreach ( $team as $team_member) : ?>
							<div class="relative">
								<div
									class="team-slider-main-photo aspect-ratio-square bg-center bg-cover"
									style="background-image: url(<?php echo wp_get_attachment_image_src($team_member['6th_section_team-member_photo'], 'full', false)[0]; ?>)"
								></div>
								<div class="team-slider-main-bg-gradient absolute bottom-0 left-0 right-0 h-48"></div>
								<div class="absolute inset-0 p-6 flex flex-col">
									<div class="mt-auto">
										<div class="mb-4">
											<div class="text-2xl leading-snug font-bold text-white">
												<?php echo $team_member['6th_section_team-member_name']; ?></div>
											<div class="text-sm leading-relaxed text-white">
												<?php echo $team_member['6th_section_team-member_position']; ?></div>
										</div>
										<div class="text-sm leading-relaxed text-white">
											<?php echo $team_member['6th_section_team-member_contacts']; ?></div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="sm:w-4/12 md:w-3/12 px-3">
						<div class="hidden sm:block mb-8">
							<div id="team-slider-supportive">
								<?php foreach ( $team as $team_member) : ?>
								<div class="relative">
									<div
										class="team-slider-supportive-photo aspect-ratio-square bg-center bg-cover"
										style="background-image: url(<?php echo wp_get_attachment_image_src($team_member['6th_section_team-member_photo'], 'full', false)[0]; ?>)"
									></div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="mt-3 sm:mt-0 flex">
							<div class="mr-1">
								<button
									id="team-slider-supportive-prev-arrow"
									class="button-square button-square-arrow button-square-arrow-left"
								></button>
							</div>
							<div>
								<button
									id="team-slider-supportive-next-arrow"
									class="button-square button-square-arrow button-square-arrow-right"
								></button>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<section class="bg-white py-40">
			<div class="container mx-auto px-3">
				<div class="md:flex -mx-3">
					<div class="md:w-4/12 px-3">
						<h3 class="text-4xl leading-tight font-bold mb-5">
							<?php echo carbon_get_the_post_meta('7th_section_title'); ?></h3>
						<p class="text-lg leading-relaxed mb-10 sm:mb-0">
							<?php echo carbon_get_the_post_meta('7th_section_lead'); ?>
						</p>
					</div>
					<div class="md:w-6/12 px-3">
						<div class="cms-content text-justify drop-cap text-sm leading-relaxed">
							<?php echo apply_filters('the_content', carbon_get_the_post_meta('7th_section_text')); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="py-40 bg-client">
			<div class="container mx-auto px-3">
				<div class="flex -mx-3 justify-center">
					<div class="md:w-6/12 px-3">
						<h3 class="text-4xl leading-tight font-bold mb-16">
							<?php echo carbon_get_the_post_meta('8th_section_title'); ?></h3>
					</div>
				</div>
				<div class="flex -mx-3 justify-end">
					<div class="md:w-6/12 px-3">
						<div class="cms-content text-justify drop-cap text-sm leading-relaxed">
							<?php echo apply_filters('the_content', carbon_get_the_post_meta('8th_section_text')); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</article>
</main>
<?php get_footer(); ?>