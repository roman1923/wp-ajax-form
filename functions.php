<?php
/**
 * umova functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package umova
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
function umova_setup() {


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'umova' ),
			'menu-2' => esc_html__( 'Footer', 'umova')
		)
	);

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

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
			'umova_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);



	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'umova_setup' );

function widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'umova' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'umova' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'widgets_init' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function umova_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'umova_content_width', 640 );
}
add_action( 'after_setup_theme', 'umova_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


/**
 * Enqueue scripts and styles.
 */
function umova_scripts() {
	wp_enqueue_style( 'google-fonts-preconnect', 'https://fonts.googleapis.com', array(), null );
    wp_enqueue_style( 'google-fonts-gstatic-preconnect', 'https://fonts.gstatic.com', array(), null );

    // Enqueue the Google Fonts stylesheet
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Overpass:ital,wght@0,100..900;1,100..900&display=swap', array(), null );
    // Enqueue styles
    wp_enqueue_style( 'umova-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'umova-main', get_template_directory_uri() . '/dist/main.min.css', array(), _S_VERSION );
    
    // Enqueue scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-form' );
    wp_enqueue_script( 'umova-script', get_template_directory_uri() . '/js/script.js', array('jquery'), _S_VERSION, true );

    // Localize script
    wp_localize_script( 'umova-script', 'ajax_form_object', array( 
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-form-nonce' ),  ) );
}
add_action( 'wp_enqueue_scripts', 'umova_scripts' );




add_action( 'wp_ajax_ajax_form_action', 'ajax_action_callback' );
add_action( 'wp_ajax_nopriv_ajax_form_action', 'ajax_action_callback' );

function ajax_action_callback() {
    $errors = [];

    if (!wp_verify_nonce($_POST['nonce'], 'ajax-form-nonce')) {
        wp_die('Invalid request');
    }

    if ($_POST['form_anticheck'] === false || !empty($_POST['form_submitted'])) {
        wp_die('Invalid request');
    }

    if (empty($_POST['form_name'])) {
        $errors['name'] = 'Please enter your name.';
    } else {
        $form_name = sanitize_text_field($_POST['form_name']);
    }

    // Validate email address
    if (empty($_POST['form_email']) || !filter_var($_POST['form_email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    } else {
        $form_email = sanitize_email($_POST['form_email']);
    }

    // Validate phone number
    if (empty($_POST['form_tel']) || !preg_match("/^[0-9+\-\(\) ]+$/", $_POST['form_tel'])) {
        $errors['tel'] = 'Please enter a valid phone number.';
    } else {
        $form_tel = sanitize_text_field($_POST['form_tel']);
    }

    // Validate password - Example:
    if (empty($_POST['form_password'])) {
        $errors['password'] = 'Please enter a password.';
    } else {
        $form_password = sanitize_text_field($_POST['form_password']);
    }

    // Validate city - Example:
    if (empty($_POST['form_city'])) {
        $errors['city'] = 'Please select a city.';
    } else {
        $form_city = sanitize_text_field($_POST['form_city']);
    }

    // Validate privacy policy checkbox - Example:
    if (empty($_POST['form_privacy_policy'])) {
        $errors['privacy_policy'] = 'Please accept the privacy policy.';
    } else {
        $form_privacy_policy = $_POST['form_privacy_policy']; // No need to sanitize as it's just a checkbox value.
    }

    // Validate other fields as needed...

    if ($errors) {
        wp_send_json_error($errors);
    } else {
        // Prepare and send email
		$home_url = wp_parse_url( home_url() );
        $subject = 'Message from website ' . $home_url;
        $message = 'Name: ' . $form_name . '; ';
        $message .= 'Email: ' . $form_email . '; ';
        $message .= 'Phone: ' . $form_tel . '; ';
        $message .= 'Password: ' . $form_password . '; ';
        $message .= 'City: ' . $form_city . ' ';
        // Include other fields in the message as needed...

        $email_to = $form_email; 
        $email_from = get_option('admin_email');

        $headers = 'From: ' . $home_url['host'] . ' <' . $email_from . '>' . "\r\n" .
            'Reply-To: ' . $email_to . "\r\n";

        wp_mail($email_to, $subject, $message, $headers);

        wp_send_json_success('Message sent successfully.');
    }

    wp_die();
}
