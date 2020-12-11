<?php

/* Exclude One Content Type From Yoast SEO Sitemap */
function sitemap_exclude_post_type($value, $post_type)
{
    if ($post_type == 'post') {
        return true;
    }
}
add_filter('wpseo_sitemap_exclude_post_type', 'sitemap_exclude_post_type', 10, 2);

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param  array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type) {
        /**
 * This filter is documented in wp-includes/formatting.php 
*/
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

        $urls = array_diff($urls, array($emoji_svg_url));
    }

    return $urls;
}

/**
 * Log
 */
if (!function_exists('write_log')) {
    function write_log($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

/**
 * Thank you page
 */
function redirectThankYouPage($post_ID)
{
    if (!(get_post_field('post_name', $post_ID) === 'thankyou')) {
        return;
    }

    if (strpos(wp_get_referer(), site_url()) !== false) {
        return;
    }

    wp_redirect(apply_filters('wpml_home_url', get_option('home')));
    exit;
}
add_action('template_redirect', 'redirectThankYouPage');

/**
 * Disable standard editor
 */
add_filter('use_block_editor_for_post', 'yourtheme_hide_editor', 10, 2);
function yourtheme_hide_editor($use_block_editor, $post_type)
{
    if (get_post_type() == 'page') {
        remove_post_type_support('page', 'editor');
        return false;
    }

    return $use_block_editor;
}

add_filter('widget_text', 'do_shortcode');

/**
 * Modal widget
 */

class wpb_widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'modal',
        );
        parent::__construct('modal', 'Modal', $widget_ops);
    }

    public function widget($args, $instance)
    {
        $id = $instance['id'];

        $title = $instance['title'];
        echo $args['before_widget'];

        ?>

<div
	x-data="{
                modalIsVisible: false,
                id: '<?php echo $id; ?>',
                toggleModale: function() {
                    this.modalIsVisible = !this.modalIsVisible;
                    document.body.classList.toggle('overflow-hidden');
                }
            }"
	x-init="$dispatch('modalisready', {modal: '<?php echo $id; ?>'})"
	x-show="modalIsVisible"
	class="fixed w-full h-full top-0 left-0 z-50"
	@open-modal.document="if ($event.detail.modal === id) {
                toggleModale();
            }"
	x-cloak
>
	<div class="absolute w-full h-full bg-black opacity-50"></div>
	<div class="absolute inset-0 flex overflow-auto">
		<div
			class="w-full h-full sm:w-auto sm:h-auto sm:w-11/12 md:max-w-3xl m-auto relative"
			x-on:click.away="toggleModale"
			style="background-color: #F1F2F6;"
		>
			<button
				class="absolute top-0 right-0 mt-3 mr-3"
				x-on:click="toggleModale"
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
						fill="#9297A9"
					/>
				</svg>
			</button>
			<div class="p-3 sm:p-16 md:py-20 md:px-24">
				<div class="text-center mb-8">
					<div class="text-text-2xl sm:text-4xl leading-tight font-bold "><?php echo $title; ?>
					</div>
				</div>
				<?php echo !empty($instance['form']) ? do_shortcode($instance['form']) : null; ?>
			</div>
		</div>
	</div>
</div>

<?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $id = (isset($instance['id'])) ? $instance['id'] : $this->id;
        $form = !empty($instance['form']) ? $instance['form'] : '';

        isset($instance['title']) || $instance['title'] = __('New Title');

        $title = $instance['title'];

        ?>
<p>
	<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('ID:');?></label>
	<input
		class="widefat"
		id="<?php echo $this->get_field_id('id'); ?>"
		name="<?php echo $this->get_field_name('id'); ?>"
		type="text"
		value="<?php echo esc_attr($id); ?>"
	/>
</p>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:');?></label>
	<input
		class="widefat"
		id="<?php echo $this->get_field_id('title'); ?>"
		name="<?php echo $this->get_field_name('title'); ?>"
		type="text"
		value="<?php echo esc_attr($title); ?>"
	/>
</p>
<p>
	<label for="<?php echo $this->get_field_id('form'); ?>"><?php _e('Form:');?></label>
	<input
		class="widefat"
		id="<?php echo $this->get_field_id('form'); ?>"
		name="<?php echo $this->get_field_name('form'); ?>"
		type="text"
		value="<?php echo esc_attr($form); ?>"
	/>
</p>

<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['id'] = (!empty($new_instance['id'])) ? sanitize_text_field($new_instance['id']) : $old_instance['id'];
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['form'] = (!empty($new_instance['form'])) ? sanitize_text_field($new_instance['form']) : $old_instance['form'];

        return $instance;
    }
}

function wpb_load_widget()
{
    register_widget('wpb_widget');

    register_sidebar(
        array(
        'name' => 'Modal window',
        'id' => 'home_right_1',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
        )
    );

    register_sidebar(
        array(
        'name' => 'Footer contact',
        'id' => 'footer',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
        )
    );

    register_sidebar(
        array(
        'name' => 'Header language switcher',
        'id' => 'header_language_switcher',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
        )
    );

    register_sidebar(
        array(
        'name' => 'Header mobile languages',
        'id' => 'header_mobile_languages',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
        )
    );
}
add_action('widgets_init', 'wpb_load_widget');

if (!function_exists('mytheme_register_nav_menu')) {
    function mytheme_register_nav_menu()
    {
        register_nav_menus(
            array(
            'primary_menu' => __('Primary Menu'),
            )
        );
    }
    add_action('after_setup_theme', 'mytheme_register_nav_menu', 0);
}

//

add_action('after_setup_theme', 'theme_setup');

function theme_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}

function crb_get_i18n_suffix()
{
    $suffix = '';
    if (!defined('ICL_LANGUAGE_CODE')) {
        return $suffix;
    }
    $suffix = '_' . ICL_LANGUAGE_CODE;
    return $suffix;
}

function crb_get_i18n_theme_option($option_name)
{
    $suffix = crb_get_i18n_suffix();
    return carbon_get_theme_option($option_name . $suffix);
}

function crb_get_nested_i18n_theme_option($option_name)
{
    $suffix = crb_get_i18n_suffix();
    return $option_name . $suffix;
}

add_filter(
    'carbon_fields_should_save_field_value', function ( $save, $value, $field ) {
        if ($value !== 'true' && $field->type === 'checkbox') {
            $save = false;
        }
        return $save;
    }, 10, 3 
);

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');

function crb_attach_theme_options()
{
    Container::make('post_meta', 'Gallery')
        ->where('post_type', '=', 'portfolio_gallery')
        ->add_tab(
            __('Gallery'), array(
            Field::make('media_gallery', 'portfolio_item_gallery', 'Gallery'),
            )
        )
        ->add_tab(
            __('List'), array(
            Field::make('text', 'gallery_list_heading', 'List heading'),
            Field::make('complex', 'gallery_list', 'List')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', 'gallery_list_item', 'List item'),
                    )
                )
            )
        )
        ->add_tab(
            __('Display options'), array(
            Field::make('checkbox', 'show_on_frontpage', 'Display on frontpage')
            ->set_option_value('true')
            )
        );

    Container::make('post_meta', 'Video')
        ->where('post_type', '=', 'portfolio_video')
        ->add_tab(
            __('Video'), array(
            Field::make('text', 'portfolio_item_video', 'Video'),
            )
        )
        ->add_tab(
            __('List'), array(
            Field::make('text', 'video_list_heading', 'List heading'),
            Field::make('complex', 'video_list', 'List')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', 'video_list_item', 'List item'),
                    )
                )
            )
        );

    // Theme options
    Container::make('theme_options', __('Theme Options'))
        ->add_tab(
            __('Header'), array(
            Field::make('text', 'header_button_text' . crb_get_i18n_suffix(), 'text'),
            )
        )
        ->add_tab(
            __('Socials'), array(
            Field::make('complex', 'socials' . crb_get_i18n_suffix(), 'Socials')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', 'social_url' . crb_get_i18n_suffix(), 'URL'),
                    Field::make('image', 'social_icon' . crb_get_i18n_suffix(), 'Icon'),
                    )
                ),
            )
        )
        ->add_tab(
            __('Contacts'), array(
            Field::make('complex', 'contacts' . crb_get_i18n_suffix(), 'Contacts')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', 'contacts_type' . crb_get_i18n_suffix(), 'Type'),
                    Field::make('image', 'contacts_icon' . crb_get_i18n_suffix(), 'Icon'),
                    Field::make('rich_text', 'contacts_text' . crb_get_i18n_suffix(), 'Text'),
                    )
                ),
            )
        )
        ->add_tab(
            __('404'), array(
            Field::make('text', '404_text' . crb_get_i18n_suffix(), 'Text'),
            Field::make('text', '404_button_text' . crb_get_i18n_suffix(), 'Button text'),
            )
        )
        ->add_tab(
            __('Thank you'), array(
            Field::make('text', 'thankyou_title' . crb_get_i18n_suffix(), 'Title'),
            Field::make('text', 'thankyou_lead' . crb_get_i18n_suffix(), 'Lead'),
            Field::make('text', 'thankyou_button_text' . crb_get_i18n_suffix(), 'Button text'),
            )
        )
        ->add_tab(
            __('Footer'), array(
            Field::make('text', 'footer_socials_title' . crb_get_i18n_suffix(), 'Socials title'),
            Field::make('rich_text', 'footer_socials_text' . crb_get_i18n_suffix(), 'Socials text'),
            Field::make('text', 'footer_contact_form_title' . crb_get_i18n_suffix(), 'Contact form title'),
            Field::make('rich_text', 'footer_contact_form_text' . crb_get_i18n_suffix(), 'Contact form text'),
            )
        );

    // Frontpage
    Container::make('post_meta', 'meta')
        ->where('post_id', '=', get_option('page_on_front'))
        ->add_tab(
            __('Hero'), array(
            Field::make('text', 'hero_title', 'Title'),
            Field::make('text', 'hero_button_text', 'Button text'),
            )
        )
        ->add_tab(
            __('1st section'), array(
            // Field::make('text', '1st_section_title', 'Title'),
            // Field::make('text', '1st_section_button_text', 'Button text'),
            Field::make('complex', '1st_section_mice', 'MICE')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', '1st_section_mice_first_letter', 'First letter')
                    ->set_width(15),
                    Field::make('text', '1st_section_mice_rest_of_word', 'Rest of a word')
                    ->set_width(25),
                    Field::make('text', '1st_section_mice_expanded_translation', 'Expanded translation')
                    ->set_width(60),
                    )
                ),
            Field::make('complex', '1st_section_advantages', 'Advantages')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', '1st_section_advantage_text', 'Advantage text'),
                    Field::make('image', '1st_section_advantage_icon', 'Advantage icon'),
                    )
                )
            )
        )
        ->add_tab(
            __('2nd section'), array(
            Field::make('text', '2st_section_title', 'Title'),
            Field::make('text', '2st_section_lead', 'Lead'),
            Field::make('text', '2st_section_button_text', 'Button text'),
            )
        )
        ->add_tab(
            __('3d section'), array(
            Field::make('text', '3d_section_advantages_title', 'Advantages title'),
            Field::make('complex', '3d_section_advantages', 'Advantages')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('rich_text', '3d_section_advantage_text', 'Advantage'),
                    )
                ),
            Field::make('text', '3d_section_numbers_title', 'Numbers title'),
            Field::make('complex', '3d_section_numbers', 'Numbers')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', '3d_section_number_number', 'Number'),
                    Field::make('text', '3d_section_number_text', 'Text'),
                    )
                )
            )
        )
        ->add_tab(
            __('4th section'), array(
            Field::make('text', '4th_section_year_text', 'Year text'),
            Field::make('text', '4th_section_year', 'Year'),
            Field::make('text', '4th_section_1st_number', '1st number'),
            Field::make('text', '4th_section_1st_number_text', '1st number text'),
            Field::make('text', '4th_section_2st_number', '2st number'),
            Field::make('text', '4th_section_2st_number_text', '2st number text'),
            )
        );

    //Portfolio
    Container::make('post_meta', 'meta')
    //->where( 'post_id', '=', get_page_by_path( 'portfolio' )->ID )
        ->where(
            'post_id', 'CUSTOM', function ($post_id) {
                $slug = get_post_field('post_name', $post_id);
                return $slug === 'portfolio';
            }
        )
        ->add_tab(
            __('Header'), array(
            Field::make('text', 'header_title', 'Title'),
            )
        )
        ->add_tab(
            __('1st section'), array(
            Field::make('rich_text', '1st_section_text', 'Text'),
            )
        )
        ->add_tab(
            __('2nd section'), array(
            Field::make('rich_text', '2st_section_text', 'Text'),
            )
        )
        ->add_tab(
            __('3d section'), array(
            Field::make('text', '3d_section_button_text', 'Button text'),
            )
        )
        ->add_tab(
            __('4th section'), array(
            Field::make('text', '4th_section_title', 'Title'),
            Field::make('text', '4th_section_button_text', 'Button text'),
            )
        );

    //Services
    Container::make('post_meta', 'meta')
    //->where( 'post_id', '=', get_page_by_path( 'services' )->ID )
        ->where(
            'post_id', 'CUSTOM', function ($post_id) {
                $slug = get_post_field('post_name', $post_id);
                return $slug === 'services';
            }
        )
        ->add_tab(
            __('Header'), array(
            Field::make('text', 'header_title', 'Title'),
            )
        )
        ->add_tab(
            __('1st section'), array(
            Field::make('rich_text', '1st_section_text', 'Text'),
            )
        )
        ->add_tab(
            __('2nd section'), array(
            Field::make('complex', '2nd_section_services', 'Services')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', '2nd_section_service_service', 'Service'),
                    Field::make('image', '2nd_section_service_photo', 'Photo'),
                    Field::make('complex', '2nd_section_service_list', 'List')
                        ->set_layout('tabbed-horizontal')
                        ->add_fields(
                            array(
                            Field::make('text', '2nd_section_service_list_item', 'List item'),
                            )
                        )
                    )
                )
            )
        )
        ->add_tab(
            __('3d section'), array(
            Field::make('text', '3d_section_button_text', 'Button text'),
            Field::make('text', '3d_section_advantages_title', 'Advantages title'),
            Field::make('complex', '3d_section_advantages_block', 'Advantages')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('image', '3d_section_advantage_block_icon', 'Advantage icon'),
                    Field::make('text', '3d_section_advantage_block_text', 'Advantage text'),
                    )
                )
            )
        );

    //About us
    Container::make('post_meta', 'meta')
        ->where(
            'post_id', 'CUSTOM', function ($post_id) {
                $slug = get_post_field('post_name', $post_id);
                return $slug === 'about-us';
            }
        )
        ->add_tab(
            __('Header'), array(
            Field::make('text', 'header_title', 'Title'),
            Field::make('rich_text', '1st_section_text', 'Text'),
            )
        )
        ->add_tab(
            __('1nd section'), array(
            Field::make('rich_text', '2nd_section_text', 'Text'),
            )
        )
        ->add_tab(
            __('2d section'), array(
            Field::make('text', '3d_section_small_text', 'Small text'),
            Field::make('text', '3d_section_large_text', 'Large text '),
            )
        )
        ->add_tab(
            __('3th section'), array(
            Field::make('text', '4th_section_title', 'Title'),
            Field::make('complex', '4th_section_values', 'Values')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', '4th_section_value', 'Value'),
                    Field::make('text', '4th_section_value_text', 'Text'),
                    )
                )
            )
        )
        ->add_tab(
            __('4th section'), array(
            Field::make('text', 'history_section_title', 'Title'),
            Field::make('complex', 'history_section_milestones', 'Milestones')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('text', 'history_section_year', 'Year'),
                    Field::make('rich_text', 'history_section_desciption', 'Desciption'),
                    )
                )
            )
        )
        ->add_tab(
            __('5th section'), array(
            Field::make('text', '5th_section_title', 'Title'),
            Field::make('rich_text', '5th_section_text', 'Text '),
            )
        )
        ->add_tab(
            __('6th section'), array(
            Field::make('text', '6th_section_title', 'Title'),
            Field::make('rich_text', '6th_section_text', 'Text'),
            Field::make('complex', '6th_section_team', 'Team')
                ->set_layout('tabbed-horizontal')
                ->add_fields(
                    array(
                    Field::make('image', '6th_section_team-member_photo', 'Photo'),
                    Field::make('text', '6th_section_team-member_name', 'Name'),
                    Field::make('text', '6th_section_team-member_position', 'Position'),
                    Field::make('rich_text', '6th_section_team-member_contacts', 'Contacts'),
                    Field::make('complex', '6th_section_team-member_socials', 'Socials')
                        ->set_layout('tabbed-horizontal')
                        ->add_fields(
                            array(
                            Field::make('image', '6th_section_team-member_social_icon', 'Icon'),
                            Field::make('text', '6th_section_team-member_social_url', 'URL'),
                            )
                        )
                    )
                )
            )
        )
        ->add_tab(
            __('7th section'), array(
            Field::make('text', '7th_section_title', 'Title'),
            Field::make('text', '7th_section_lead', 'Lead'),
            Field::make('rich_text', '7th_section_text', 'Text '),
            )
        )
        ->add_tab(
            __('8th section'), array(
            Field::make('text', '8th_section_title', 'Title'),
            Field::make('rich_text', '8th_section_text', 'Text '),
            )
        );

    //Contacts
    Container::make('post_meta', 'meta')
        ->where(
            'post_id', 'CUSTOM', function ($post_id) {
                $slug = get_post_field('post_name', $post_id);
                return $slug === 'contacts';
            }
        )
        ->add_tab(
            __('Header'), array(
            Field::make('text', 'header_title', 'Title'),
            )
        )
        ->add_tab(
            __('1st section'), array(
            Field::make('text', '1st_section_lead', 'Lead'),
            )
        )
        ->add_tab(
            __('2nd section'), array(
            Field::make('text', '2st_section_title', 'Title'),
            Field::make('rich_text', '2st_section_text', 'Text'),
            Field::make('text', '2st_section_address', 'Address'),
            Field::make('text', '2st_section_map', __('Map')),
            Field::make('text', '2st_section_map_api_key', __('Map API key')),
            )
        );
}

/**
 * Portfolio menu item
 */

add_action('admin_menu', 'wpdocs_unsub_add_pages');

function wpdocs_unsub_add_pages()
{
    add_menu_page('Portfolio', 'Portfolio', 'manage_options', 'portfolio.php', '');
}

/**
 * Register CPT 'portfolio gallery'
 */

add_action('init', 'portfolio_cpt');

/**
 * Register CPT 'portfolio gallery'
 */
function portfolio_cpt()
{
    register_post_type(
        'portfolio_video', array(
        'label' => 'Video',
        'public' => false,
        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'has_archive' => false,
        'show_in_menu' => 'portfolio.php',
        'supports' => array('title', 'thumbnail'),
        )
    );

    remove_post_type_support('portfolio_video', 'editor');

    register_post_type(
        'portfolio_gallery', array(
        'label' => 'Gallery',
        'public' => false,
        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'has_archive' => false,
        'show_in_menu' => 'portfolio.php',
        'supports' => array('title', 'thumbnail'),
        )
    );

    remove_post_type_support('portfolio_gallery', 'editor');
}


/**
 * Portfolio content
 */

function portfolioContent()
{
    $ID = $_POST['id'];

    $portfolio_language = $_POST['language'];

    global $sitepress;
    $sitepress->switch_lang($portfolio_language);

    $post_type = get_post_type($ID);

    if ($post_type === 'portfolio_gallery') {
        $gallery = carbon_get_post_meta($ID, 'portfolio_item_gallery');

        if (empty($gallery)) {
            wp_die();
        }

        wp_send_json(
            array_map(
                function ($item) {
                    return array(
                    'src' => wp_get_attachment_image_src($item, 'full')[0],
                    'title' => get_post_meta($item, '_wp_attachment_image_alt', true),
                    );
                }, $gallery
            )
        );
    }

    if ($post_type === 'portfolio_video') {
        wp_send_json(
            array(
            'src' => carbon_get_post_meta($ID, 'portfolio_item_video'),
            )
        );
    }

    wp_die();
}

add_action('wp_ajax_nopriv_portfolioContent', 'portfolioContent');
add_action('wp_ajax_portfolioContent', 'portfolioContent');

/**
 * Load more portfolio items
 */

function more_post_ajax()
{
    $portfolio_language = $_POST['language'];

    global $sitepress;
    
    $sitepress->switch_lang($portfolio_language);
    
    $loop = new WP_Query(
        array(
        'post_type' => array('portfolio_video', 'portfolio_gallery'),
        'paged' => (isset($_POST['paged'])) ? $_POST['paged'] : 1,
        'posts_per_page' => 6,
        'meta_query' => array(
            array(
                'key' => 'show_on_frontpage', 
                'compare' => 'NOT EXISTS'
            ),
        ),
        )
    );

    if ($loop->have_posts()) {
        ob_start();

        while ($loop->have_posts()) {
            $loop->the_post();
            if (get_post_type() === "portfolio_gallery") {
                get_template_part('template-parts/portfolio', 'gallery');
            }

            if (get_post_type() === "portfolio_video") {
                get_template_part('template-parts/portfolio', 'video');
            }
        }
    }

    wp_reset_postdata();

    wp_send_json(
        array(
        'html' => ob_get_clean(),
        'totalposts' => $loop->found_posts,
        )
    );

    wp_die();
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

add_theme_support('custom-logo');

function styles()
{
    /**
     * Style
     */
    wp_enqueue_style('style', get_stylesheet_uri(), array('gothampro', 'gothampro-light', 'gothampro-bold'), filemtime(get_stylesheet_directory() . '/style.css'), 'all');

    /**
     * Debounce
     */
    wp_enqueue_script('javascript-debounce', 'https://cdn.jsdelivr.net/npm/javascript-debounce@1.0.1/dist/javascript-debounce.min.js', array('jquery'), false, true);

    /**
     * Script
     */
    wp_enqueue_script('script', get_template_directory_uri() . '/src/js/script.js', array('jquery', 'alpine-ie', 'javascript-debounce'), filemtime(get_stylesheet_directory() . '/src/js/script.js'), true);

    wp_localize_script("script", "localize", array('ajaxurl' => admin_url('admin-ajax.php')));

    /**
     * Alpine.js
     */
    //wp_enqueue_script('alpine', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js', array('spruce'), false, true);

    wp_enqueue_script('alpine', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js', array(), false, true);
    wp_enqueue_script('alpine-ie', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js', array('alpine'), false, true);

    /**
     * Spruce
     */
    //wp_enqueue_script('spruce', 'https://cdn.jsdelivr.net/gh/ryangjchandler/spruce@0.x.x/dist/spruce.umd.js', array(), false, true);

    if (is_front_page() || is_page('portfolio')) {
        /**
         * Magnific Popup
         */
        wp_enqueue_style('magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', array('style'), false, 'all');

        /**
         * Magnific Popup
         */
        wp_enqueue_script('magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array('jquery'), false, true);
    }

    if (is_front_page()) {
        /**
         * CountUp.js
         */
        wp_enqueue_script('countup', 'https://cdn.jsdelivr.net/npm/countup@1.8.2/dist/countUp.min.js', array(), false, true);

        /**
         * in-view.js
         */
        wp_enqueue_script('in-view', 'https://cdn.jsdelivr.net/npm/in-view@0.6.1/dist/in-view.min.js', array(), false, true);

        /**
         * Frontpage script
         */
        wp_enqueue_script('frontpage-script', get_template_directory_uri() . '/src/js/frontpage-script.js', array('in-view', 'countup'), filemtime(get_stylesheet_directory() . '/src/js/frontpage-script.js'), true);

        /**
         * Portfolio
         */
        wp_enqueue_script('portfolio', get_template_directory_uri() . '/src/js/portfolio.js', array('alpine-ie', 'magnific-popup'), filemtime(get_stylesheet_directory() . '/src/js/portfolio.js'), true);
    }

    if (is_page('portfolio')) {
        /**
         * Masonry
         */
        wp_enqueue_script('masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array(), false, true);

        /**
         * imagesLoaded
         */
        wp_enqueue_script('imagesloaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array(), false, true);

        /**
         * Portfolio
         */
        wp_enqueue_script('portfolio', get_template_directory_uri() . '/src/js/portfolio.js', array('jquery', 'script', 'masonry', 'imagesloaded', 'magnific-popup'), filemtime(get_stylesheet_directory() . '/src/js/portfolio.js'), true);
    }

    if (is_page('about-us')) {
        /**
         * Slick carousel style
         */
        wp_enqueue_style('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), false, 'all');

        /**
         * Slick carousel theme style
         */
        wp_enqueue_style('slick-theme', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array(), false, 'all');

        /**
         * Slick carousel
         */
        wp_enqueue_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), false, true);

        /**
         * Slick carousel
         */
        wp_enqueue_script('about-us', get_template_directory_uri() . '/src/js/about-us.js', array('jquery', 'slick'), filemtime(get_stylesheet_directory() . '/src/js/about-us.js'), true);
    }

    if (is_404()) {
        /**
         * 404 Script
         */
        wp_enqueue_script('404-script', get_template_directory_uri() . '/src/js/404.js', array(), filemtime(get_stylesheet_directory() . '/src/js/404.js'), true);
    }

    if (is_page('thankyou')) {
        /**
         * Thank You script
         */
        wp_enqueue_script('thankyou-script', get_template_directory_uri() . '/src/js/thankyou.js', array(), filemtime(get_stylesheet_directory() . '/src/js/thankyou.js'), true);
    }

    /**
     * vanilla-lazyload
     */
    wp_enqueue_script('vanilla-lazyload', 'https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.1.2/dist/lazyload.min.js', array(), false, true);
    wp_add_inline_script('vanilla-lazyload', 'new LazyLoad();');

    /**
     * Fonts
     */
    wp_enqueue_style('gothampro', get_template_directory_uri() . '/fonts/GothamPro/GothamPro-Bold.woff', array(), null);
    wp_enqueue_style('gothampro-light', get_template_directory_uri() . '/fonts/GothamPro/GothamPro-Light.woff', array(), null);
    wp_enqueue_style('gothampro-bold', get_template_directory_uri() . '/fonts/GothamPro/GothamPro.woff', array(), null);
}

add_action('wp_enqueue_scripts', 'styles');

add_filter('style_loader_tag', 'my_style_loader_tag_filter', 11, 2);

function my_style_loader_tag_filter($html, $handle)
{
    if ($handle === 'gothampro' || $handle === 'gothampro-light' || $handle === 'gothampro-bold') {
        $html = str_replace("rel='stylesheet'", "rel='preload'", $html);
        $html = str_replace("type='text/css'", "as='font' type='font/woff' crossorigin='anonymous'", $html);
        $html = str_replace("media='all'", "", $html);
    }
    return $html;
}

add_filter('script_loader_tag', 'alpine_edit_attr', 10, 3);

function alpine_edit_attr($tag, $handle, $src)
{
    if ($handle === 'alpine') {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    if ($handle === 'alpine-ie') {
        return '<script nomodule src="' . esc_url($src) . '" defer></script>';
    }
    return $tag;
}

/**
 * WPCF7
 */
function action_wpcf7_enqueue_scripts()
{
    wp_enqueue_script('wpcf7-custom', get_template_directory_uri() . '/src/js/wpcf7.js', array(), filemtime(get_stylesheet_directory() . '/src/js/wpcf7.js'), true);
}
add_action('wpcf7_enqueue_scripts', 'action_wpcf7_enqueue_scripts', 10, 0); 