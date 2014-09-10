<?php

use Models\DasltaFetcher\ArtistFetcher;
use Models\DataFetcher\ArtworkFetcher;
use Models\DataFetcher\DisciplineFetcher;

// Validate artwork pre save
add_filter('pods_api_field_validation', 'check_nb_featured', 10, 7);

// Add scripts in footer
add_action('wp_enqueue_scripts', 'enqueue_scripts');
add_action('admin_enqueue_scripts', 'admin_sortable_scripts');

// Hide unnecessary admin menus and top bar items for client
add_action('admin_menu', 'remove_admin_menu_items');
add_action('wp_before_admin_bar_render', 'remove_admin_top_bar_items' );

// Display link for artworks per artist page
add_action('add_meta_boxes_artist', 'adding_custom_meta_boxes');

// Custom css icons in admin
add_action('admin_head', 'add_menu_icons_styles' );

// Ajax for infinite scroll
add_action('wp_ajax_artworks_infinite_scroll', 'artworks_infinite_scroll_action');
add_action('wp_ajax_nopriv_artworks_infinite_scroll', 'artworks_infinite_scroll_action');

// Ajax action to update artworks order
add_action('wp_ajax_artworks_order_update', 'artworks_order_update_action');

// Artworks admin list page
add_action('admin_menu', 'artworks_list_register');


/**
 * Add scripts in footer
 */
function enqueue_scripts()
{


    $dir = get_bloginfo('stylesheet_directory');

    // Header
     if(is_front_page()){
    wp_enqueue_script('slider', $dir . '/js/slider.js', array('jquery'), '4.2.3', true);
}
    wp_enqueue_script('modernizr', $dir . '/bower_components/modernizr/modernizr.js', array(), '2.7.2');

    // 
    wp_enqueue_script('salvattore', $dir . '/bower_components/salvattore/dist/salvattore.min.js', array(), '1.0.4', true);
    wp_deregister_script('jquery');
    wp_enqueue_script('flowtype', $dir . '/js/FlowType.JS-master/flowtype.js', array(), false, true);
    wp_enqueue_script('jquery', $dir . '/bower_components/jquery/dist/jquery.min.js', array(), '1.11.0', true);
    wp_enqueue_script('jquery.mmenu', $dir . '/bower_components/jQuery.mmenu/src/js/jquery.mmenu.min.js', array('jquery'), '4.2.3', true);
    wp_enqueue_script('jquery.throttle', $dir . '/bower_components/jquery-throttle-debounce/jquery.ba-throttle-debounce.js', array('jquery'), '1.1', true);
    wp_enqueue_script('jquery.columnizer', $dir . '/bower_components/jquery.columnizer/src/jquery.columnizer.js', array(), '1.6.0', true);
    wp_enqueue_script('jquery.lazyload', $dir . '/bower_components/jquery.lazyload/jquery.lazyload.min.js', array(), '1.9.1', true);
    wp_enqueue_script('jquery.infinitescroll', $dir . '/bower_components/infinite-scroll/jquery.infinitescroll.min.js', array(), false, true);
    wp_enqueue_script('plugins', $dir . '/js/plugins.js', array(), false, true);
    wp_enqueue_script('main', $dir . '/js/main.js', array(), false, true);
}

/**
 * Hide unnecessary admin menus items for client
 */
function remove_admin_menu_items()
{
    global $user_ID;

    /**
     * Hide Taxonomies boxes discipline and artwork tags from artwork form page
     * The user should use the relationship field instead to bind them
     */
    remove_meta_box('tagsdiv-artwork_tag', 'artwork', 'side');
    remove_meta_box('tagsdiv-discipline', 'artwork', 'side');

    if ( !current_user_can( 'update_core' ) )
    {
        // Discipline menu
        remove_submenu_page( 'edit.php?post_type=artwork', 'edit-tags.php?taxonomy=discipline&amp;post_type=artwork' );
        // Tool menu
        remove_menu_page( 'tools.php' );
    }
}

/**
 * Hide unnecessary admin top bar items for client
 */
function remove_admin_top_bar_items()
{
    if ( !current_user_can( 'update_core' ) )
    {
        global $user_ID;
        global $wp_admin_bar;

        // Remove edit page from top admin bar
        $object = get_queried_object();
        if ($object
            && ('page' === $object->post_type) || (DisciplineFetcher::TAXONOMY_DISCIPLINE === $object->taxonomy))
        {
            $wp_admin_bar->remove_menu('edit');
        }
    }
}

/**
 * Add artist artworks metabox
 *
 * @param $post
 */
function adding_custom_meta_boxes( $post )
{
    if ('edit' === $post->filter) {
        add_meta_box(
            'artist-artworks',
            __( 'Artworks' ),
            'render_meta_box_artist_artworks',
            'artist',
            'side',
            'default',
            array($post)
        );
    }
}

/**
 * Render artist artworks metabox
 */
function render_meta_box_artist_artworks($post)
{
    echo '<a href="edit.php?post_type=artwork&page=artworks-order&artist_id='.$post->ID.'">See artist\'s artworks</a>';
}

/*
 * Icon in admin bar
 */
function add_menu_icons_styles()
{
    echo '
<style>
#adminmenu #menu-posts-artwork div.wp-menu-image:before {
    content: "\f128";
}

#adminmenu #menu-posts-artist div.wp-menu-image:before {
    content: "\f309";
}

</style>';

}

/**
 * Check number of featured artworks
 *
 * @param $valid
 * @param $value
 * @param $field
 * @param $object_fields
 * @param $fields
 * @param $pod
 * @param $params
 *
 * @return string
 */
function check_nb_featured($valid, $value, $field, $object_fields, $fields, $pod, $params)
{
    if (ArtworkFetcher::FIELD_FEATURED === $field && true == $value)
    {
        $artwork = pods(ArtworkFetcher::POST_TYPE_ARTWORK, $params->id);

        $filters  = add_artwork_featured_filter(array());
        $filters  = add_artwork_artist_id_filter($filters, $artwork->field(ArtworkFetcher::FIELD_ARTIST.'.ID'));
        $featured = get_ordered_published_artworks(null, $filters);

        $nb_featured = count($featured);

        if ( $nb_featured >= MAX_FEATURED_BY_ARTIST)
        {
            return 'There are already ' .MAX_FEATURED_BY_ARTIST.' featured artworks for this artist';
        }

    }

    return $valid;
}

// Teach Carrington to use meta-page the loop instead of content/file
function filter_cfct_general_match_order($exec_order) {
    return array_merge(array('meta'), $exec_order);
}
add_filter("cfct_general_match_order", "filter_cfct_general_match_order");

function cfct_choose_general_template_meta($dir, $files) {
    return cfct_choose_single_template_meta($dir, $files, "*");
}

// Register Menu
function register_menus() {
  register_nav_menus( array(
        'primary' => __('Primary Menu'),
        'about_menu' => __('About Menu'),
        'production_menu' => __('Production Menu')
    ));
}
add_action( 'init', 'register_menus' );
