<?php
/**
 * bootstrap-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bootstrap-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bootstrap_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on bootstrap-theme, use a find and replace
		* to change 'bootstrap-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'bootstrap-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'bootstrap-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'bootstrap_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'bootstrap_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bootstrap_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bootstrap_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'bootstrap_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bootstrap_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bootstrap-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bootstrap-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'bootstrap_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bootstrap_theme_scripts() {
	wp_enqueue_style( 'bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), '5.0.2');
	wp_enqueue_style('css', get_template_directory_uri() .'/css.reset.css');
	wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
	wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css');
	wp_enqueue_style( 'bootstrap-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'bootstrap-theme-style', 'rtl', 'replace' );
	
	wp_enqueue_script('jquery-js', get_template_directory_uri() . '/js/jquery-3.6.0.min.js' );
    wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' );
	wp_enqueue_script('bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js' );
	wp_enqueue_script( 'bootstrap-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bootstrap_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function my_customize_register( $wp_customize ) {
    $wp_customize->add_setting('footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'footer_logo', array(
        'section' => 'title_tagline',
        'label' => 'Логотип в подвале'
    )));

    $wp_customize->selective_refresh->add_partial('footer_logo', array(
        'selector' => '.header-logo',
        'render_callback' => function() {
            $logo = get_theme_mod('footer_logo');
            $img = wp_get_attachment_image_src($logo, 'full');
            if ($img) {
                return '<img src="' . $img[0] . '" alt="">';
            } else {
                return '';
            }
        }
    ));
}
add_action( 'customize_register', 'my_customize_register' );




add_action( 'init', 'add_custom_post_type' );
 
function add_custom_post_type() {
 
	$labels = array(
		'name' => 'Новости',
		'singular_name' => 'Новость',
		'add_new' => 'Добавить новость',
		'add_new_item' => 'Добавить новый пост',
		'edit_item' => 'Редактировать новость',
		'new_item' => 'Новый пост',
		'all_items' => 'Все новости',
		'search_items' => 'Искать новость',
		'not_found' =>  'Новостей по заданным критериям не найдено.',
		'not_found_in_trash' => 'В корзине нет новостей.',
		'menu_name' => 'Новости'
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-admin-post',
		'menu_position' => 4,
		'supports' => array( 'title', 'editor' )
	);
 
	register_post_type( 'news', $args );
}


add_action( 'init', 'add_custom_product_type' );
 
function add_custom_product_type() {
 
	$labels = array(
		'name' => 'Продукты',
		'singular_name' => 'Продукт',
		'add_new' => 'Добавить продукт',
		'add_new_item' => 'Добавить новый продукт',
		'edit_item' => 'Редактировать продукт',
		'new_item' => 'Новый продукт',
		'all_items' => 'Все продукты',
		'search_items' => 'Искать продукт',
		'not_found' =>  'Товаров по заданным критериям не найдено.',
		'not_found_in_trash' => 'В корзине нет товаров.',
		'menu_name' => 'Продукты'
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_icon' => 'dashicons-admin-post',
		'menu_position' => 5,
	);
 
	register_post_type( 'product', $args );
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
 
add_action( 'carbon_fields_register_fields', 'make_custom_product_carbon' );
function make_custom_product_carbon() {
 
	Container::make( 'post_meta', 'Инфо о продукте' )
    ->where( 'post_type', '=', 'product')
	->add_fields( array(
 
		Field::make( 'text', 'product_h1', 'Заголовок' ),
		Field::make( 'textarea', 'product_decr', 'Описание' ),
		Field::make( 'media_gallery', 'product_images', 'Фотографии продукта')
        ->set_type( array( 'image', 'video' ) ),
		Field::make( 'select', 'product_select_options', 'Производитель - выбор из списка' )
		->set_options( 
			array(
				'2' => 'Apple',
				'3' => 'Google',
				'4' => 'Xiaomi',
			) 
			),
		Field::make( 'textarea', 'product_equipment', 'Комплектация' ),
		Field::make( 'text', 'product_price', 'Цена' )
		
 
       ) );
}

add_action( 'carbon_fields_register_fields', 'make_custom_post_carbon' );
function make_custom_post_carbon() {
 
	Container::make( 'post_meta', 'Редактировать новость' )
    ->where( 'post_type', '=', 'news')
	->add_fields( array(
		Field::make( 'text', 'news_h1', 'Заголовок' ),
		Field::make( 'textarea', 'news_decr', 'Описание' ),
		Field::make( 'image', 'news_img', 'Изображение' )
        ->set_value_type( 'url' ),
		Field::make( 'date', 'news_date', 'Дата публикации' )
       ) );
}
