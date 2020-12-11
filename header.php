<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
	<meta charset="UTF-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0"
	>
	<meta content="IE=edge" />
	<title><?php wp_title();?></title>
	<?php wp_head();?>
</head>

<body <?php body_class(array('font-gothampro', 'text-black'));?>>
	<div
		class="main relative"
		style="background-color: #F7F7F7;"
	>
		<header class="header py-4 absolute z-20 top-0 left-0 w-full">
			<div class="header-container mx-auto px-3">
				<div class="flex items-center">
					<div class="desktopmenu:hidden -ml: flex-1">
						<button
							x-data="{}"
							x-on:click="$dispatch('toggle-mobile-menu', 'navigation'); toggleBodyOverflow();"
						>
							<svg
								width="32"
								height="32"
								viewBox="0 0 32 32"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									fill-rule="evenodd"
									clip-rule="evenodd"
									d="M5 8H27V10H5V8ZM5 15H22V17H5V15ZM17 22H5V24H17V22Z"
									fill="white"
								/>
							</svg>
						</button>
					</div>
					<nav class="hidden desktopmenu:block flex-1">
						<?php wp_nav_menu(
                            array(
                                    'menu' => 'primary_menu',
                                    'menu_class' => 'header-menu',
                                    'container' => '',
                                    'fallback_cb' => false,
                                )
                        );?>
					</nav>
					<?php if (get_theme_mod('custom_logo')) : ?>
					<a
						class="flex-initial"
						href="<?php echo get_home_url(); ?>"
					>
						<?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, array('class' => 'mx-auto')); ?>
					</a>
					<?php endif;?>
					<div class="flex-1 flex justify-end items-center">
						<?php if (is_active_sidebar('header_language_switcher')) : ?>
						<div class="hidden sm:block mr-5">
							<?php dynamic_sidebar('header_language_switcher');?>
						</div>
						<?php endif;?>
						<?php if (is_active_sidebar('header_mobile_languages')) : ?>
						<div class="sm:hidden mr-5">
							<button
								class="text-white text-sm leading-snug uppercase"
								x-data="{}"
								x-on:click="$dispatch('toggle-mobile-menu', 'language'); toggleBodyOverflow();"
							>
								<svg
									width="20"
									height="20"
									viewBox="0 0 20 20"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M9.99 0C4.47 0 0 4.48 0 10C0 15.52 4.47 20 9.99 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 9.99 0ZM16.92 6H13.97C13.657 4.76146 13.1936 3.5659 12.59 2.44C14.4141 3.068 15.9512 4.33172 16.92 6ZM10 2.04C10.83 3.24 11.48 4.57 11.91 6H8.09C8.52 4.57 9.17 3.24 10 2.04ZM2.26 12C2.1 11.36 2 10.69 2 10C2 9.31 2.1 8.64 2.26 8H5.64C5.56 8.66 5.5 9.32 5.5 10C5.5 10.68 5.56 11.34 5.64 12H2.26ZM3.08 14H6.03C6.35 15.25 6.81 16.45 7.41 17.56C5.58397 16.9354 4.04583 15.6708 3.08 14V14ZM6.03 6H3.08C4.04583 4.32918 5.58397 3.06457 7.41 2.44C6.80643 3.5659 6.34298 4.76146 6.03 6V6ZM10 17.96C9.17 16.76 8.52 15.43 8.09 14H11.91C11.48 15.43 10.83 16.76 10 17.96ZM12.34 12H7.66C7.57 11.34 7.5 10.68 7.5 10C7.5 9.32 7.57 8.65 7.66 8H12.34C12.43 8.65 12.5 9.32 12.5 10C12.5 10.68 12.43 11.34 12.34 12ZM12.59 17.56C13.19 16.45 13.65 15.25 13.97 14H16.92C15.9512 15.6683 14.4141 16.932 12.59 17.56V17.56ZM14.36 12C14.44 11.34 14.5 10.68 14.5 10C14.5 9.32 14.44 8.66 14.36 8H17.74C17.9 8.64 18 9.31 18 10C18 10.69 17.9 11.36 17.74 12H14.36Z"
										fill="white"
									/>
								</svg>
							</button>
						</div>
						<?php endif;?>
						<?php $header_button_text = crb_get_i18n_theme_option('header_button_text');?>
						<?php if ($header_button_text) : ?>
						<button
							x-data="{
                                modalIsReady: false
                            }"
							x-show="modalIsReady"
							x-on:modalisready.document="if ($event.detail.modal === 'modal-contact-form' ) {modalIsReady = true;}"
							x-on:click="$dispatch('open-modal', {modal: 'modal-contact-form'})"
							class="hidden desktopmenu:block py-4 px-5 border-white border uppercase text-white leading-none"
							x-cloak
						><?php echo $header_button_text; ?></button>
						<?php endif;?>
					</div>
				</div>
			</div>
		</header>
		<div
			x-subscribe
			x-data="{
                active: ''
            }"
			x-cloak
		>
			<div
				x-show="active !== ''"
				class="fixed inset-0 h-full w-full bg-black bg-opacity-50 z-20"
				x-on:click="active = ''; toggleBodyOverflow();"
				x-transition:enter="transition ease-out duration-300"
				x-transition:enter-start="opacity-0 transform scale-0"
				x-transition:enter-end="opacity-100 transform scale-100"
				x-transition:leave="transition ease-in duration-300"
				x-transition:leave-start="opacity-100 transform scale-100"
				x-transition:leave-end="opacity-0 transform scale-0"
			></div>
			<div
				class="fixed right-0 bottom-0 top-0 z-20 pt-16 pb-10 px-6"
				style="background-color: #2F3343; width: 116px;"
				x-show="active === 'language'"
				x-transition:enter="transform origin-right transition-transform ease-out duration-300"
				x-transition:enter-start="translate-x-full"
				x-transition:enter-end="translate-x-0"
				x-transition:leave="transform transition-transform ease-in duration-300"
				x-transition:leave-start="translate-x-0"
				x-transition:leave-end="translate-x-full"
				x-on:toggle-mobile-menu.document="active = $event.detail;"
			>
				<button
					class="absolute mt-6 mr-6 top-0 right-0"
					x-on:click="active = ''; toggleBodyOverflow();"
				>
					<svg
						width="44"
						height="44"
						viewBox="0 0 44 44"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path
							fill-rule="evenodd"
							clip-rule="evenodd"
							d="M23.5099 22L32 30.4901L30.4901 32L22 23.5099L13.5099 32L12 30.4901L20.4901 22L12 13.5099L13.5099 12L22 20.4901L30.4901 12L32 13.5099L23.5099 22Z"
							fill="white"
						/>
					</svg>
				</button>
				<?php if (is_active_sidebar('header_mobile_languages')) : ?>
				<div class="text-white text-center">
					<?php dynamic_sidebar('header_mobile_languages');?>
				</div>
				<?php endif;?>
			</div>
			<div
				class="fixed left-0 bottom-0 top-0 z-20 pt-16 pb-10 px-12"
				style="background-color: #2F3343; width: 284px;"
				x-show="active === 'navigation'"
				x-transition:enter="transform origin-right transition-transform ease-out duration-300"
				x-transition:enter-start="-translate-x-full"
				x-transition:enter-end="translate-x-0"
				x-transition:leave="transform transition-transform ease-in duration-300"
				x-transition:leave-start="translate-x-0"
				x-transition:leave-end="-translate-x-full"
			>
				<button
					class="absolute mt-6 mr-6 top-0 right-0"
					x-on:click="active = ''; toggleBodyOverflow();"
				>
					<svg
						width="44"
						height="44"
						viewBox="0 0 44 44"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path
							fill-rule="evenodd"
							clip-rule="evenodd"
							d="M23.5099 22L32 30.4901L30.4901 32L22 23.5099L13.5099 32L12 30.4901L20.4901 22L12 13.5099L13.5099 12L22 20.4901L30.4901 12L32 13.5099L23.5099 22Z"
							fill="white"
						/>
					</svg>
				</button>
				<div class="absolute inset-0 mt-16 mb-10 mx-12 overflow-auto">
					<nav>
						<?php wp_nav_menu(
                            array(
                                    'menu' => 'primary_menu',
                                    'menu_class' => 'mobile-menu',
                                    'container' => '',
                                    'fallback_cb' => false,
                            )
                        );?>
					</nav>
				</div>
			</div>
		</div>