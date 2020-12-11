<?php get_header(); ?>
<main>
	<article>
		<header
			class="pt-48 pb-32 bg-center bg-no-repeat bg-cover bg-fixed"
			style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/bg-portfolio.jpg)"
		>
			<div class="container mx-auto px-3">
				<div class="flex justify-center">
					<div class="sm:w-10/12 md:w-8/12">
						<h1 class="text-2xl lg:text-4xl leading-tight font-bold text-white text-center">
							<?php echo carbon_get_the_post_meta('header_title'); ?></h1>
						<div class="mt-5 text-white text-center text-lg lg:text-xl leading-relaxed font-light">
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
		<section class="pt-24 pb-24">
			<div class="container mx-auto px-3">
				<div class="flex -mx-3 justify-center">
					<div class="sm:w-10/12 md:w-8/12 px-3">
						<div class="py-10 border-gray-900 border-t-4 border-b-4 text-center">
							<div class="text-lg leading-normal">
								<?php echo carbon_get_the_post_meta('2st_section_text'); ?></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php $portfolio = new WP_Query(
            array(
                'post_type' => array(
                    'portfolio_video',
                    'portfolio_gallery'
                ),
                'posts_per_page' => 6,
                'meta_query' => array(
                    array(
                        'key' => 'show_on_frontpage', 
                        'compare' => 'NOT EXISTS'
                    ),
                ),
            )
); ?>
		<?php if ($portfolio->have_posts()) : ?>
		<section
			x-data="portfolio()"
			x-init="function() {
                init();
                loadedposts = <?php echo $portfolio->post_count; ?>;
                totalposts = <?php echo $portfolio->found_posts; ?>;
                language = '<?php echo ICL_LANGUAGE_CODE; ?>';
            }"
			x-on:portfolio-modal.document="initPortfolioItem(event.detail.id, event.detail.posttype);"
			class="py-16"
		>
			<div class="container px-3 mx-auto">
				<div class="overflow-wrapper-both-sides">
					<div
						x-ref="masonry"
						class="-mx-3 -mb-6"
					>
						<?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
						<?php if (get_post_type() === "portfolio_gallery") : ?>
						<?php get_template_part('template-parts/portfolio', 'gallery') ?>
						<?php endif; ?>
						<?php if (get_post_type() === "portfolio_video") : ?>
						<?php get_template_part('template-parts/portfolio', 'video') ?>
						<?php endif; ?>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
					<template x-if="loadedposts < totalposts">
						<div class="mt-16 text-center">
							<button
								x-on:click="getData"
								id="masonry-add"
								class="button-transparent"
							><?php echo carbon_get_the_post_meta('3d_section_button_text'); ?></button>
						</div>
					</template>
				</div>
			</div>
		</section>
		<?php endif; ?>
		<section class="pt-16 pb-40">
			<div class="container px-3 mx-auto">
				<div class="bg-white py-20 px-3 -mx-3 sm:-mx-0">
					<div class="sm:flex -mx-3 sm:justify-center sm:items-center">
						<div class="sm:w-6/12 px-3 mb-8 sm:mb-0">
							<div class="w-4/6 border-gray-900 border-t-4 mb-10"></div>
							<h2 class="text-3xl md:text-5xl leading-tight font-bold uppercase">
								<?php echo carbon_get_the_post_meta('4th_section_title'); ?></h2>
						</div>
						<div class="sm:w-4/12 px-3 sm:text-right">
							<button
								class="button"
								x-data="{
                                    modalIsReady: false
                                }"
								x-show="modalIsReady"
								x-on:modalisready.document="if ($event.detail.modal === 'modal-contact-form' ) {modalIsReady = true;}"
								x-on:click="$dispatch('open-modal', {modal: 'modal-contact-form'})"
								x-cloak
							><?php echo carbon_get_the_post_meta('4th_section_button_text'); ?></button>
						</div>
					</div>
				</div>
			</div>
		</section>
	</article>
</main>
<?php get_footer(); ?>