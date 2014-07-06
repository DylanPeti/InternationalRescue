<?php

/**
 * Register artworks order page
 */
function artworks_list_register()
{
    add_submenu_page(
        'edit.php?post_type=artwork',     // parent slug
        'Artworks by artist',     // page title
        'Artworks by artist',     // menu title
        'edit_posts',   // capability
        'artworks-order',     // menu slug
        'artworks_list_render' // callback function
    );
}

/**
 * Add scripts in footer in admin page
 */
function admin_sortable_scripts($hook)
{
    if ( 'artwork_page_artworks-order' != $hook )
    {
        return;
    }

    $dir = get_bloginfo('stylesheet_directory');
    wp_enqueue_script('jqueryui.core', $dir . '/bower_components/jquery-ui/ui/jquery.ui.core.js',
        array('jquery'), false, true);
    wp_enqueue_script('jqueryui.widget', $dir . '/bower_components/jquery-ui/ui/jquery.ui.widget.js',
        array('jquery'), false, true);
    wp_enqueue_script('jqueryui.mouse', $dir . '/bower_components/jquery-ui/ui/jquery.ui.mouse.js',
        array('jquery'), false, true);
    wp_enqueue_script('jqueryui.sortable', $dir . '/bower_components/jquery-ui/ui/jquery.ui.sortable.js',
        array('jquery'), false, true);

    wp_enqueue_script('admin_sortable', $dir . '/js/admin_sortable.js', array(), false, true);

    wp_localize_script('admin_sortable', 'admin_artworks', array(
        'ajaxurl'          => admin_url( 'admin-ajax.php' ),
        'action'           => 'artworks_order_update',
        'sortable_item'    => '#the-list',
        'position_display' => '.position'
    ));
}

/**
 * Update artworks order
 */
function artworks_order_update_action()
{
    $artist_id          = $_POST['artist_id'];
    $artworks_positions = $_POST['artworks_positions'];

    $ids = update_artworks_order($artist_id, $artworks_positions);

    echo json_encode(array(
        'status' => (($ids) ? true : false),
    ));

    die();
}


/**
 * Render arworks list render
 */
function artworks_list_render()
{
    global $title;

    $post_type = $_GET['post_type'];
    $page      = $_GET['page'];
    $artist_id = $_GET['artist_id'];

    $artists   = get_published_artists();
    $artworks  = get_ordered_published_artworks_by_artist(50, $artist_id);

    ?>

    <div class="wrap">

        <h2><?php echo $title ?></h2>

        <?php if ($artist_id): ?>
            <?php edit_post_link( 'edit artist', '', '', $artist_id); ?>
        <?php endif; ?>

        <form id="posts-filter" action="" method="get">

            <div class="tablenav top">
                <div class="alignleft actions bulkactions">
                    <select name="artist_id">
                        <option value="">Select an artist</option>
                        <?php foreach ($artists as $artist): ?>
                            <option value="<?php echo $artist->ID ?>"<?php if ($artist_id == $artist->ID): ?> selected="selected"<?php endif; ?>>
                                <?php echo $artist->post_title ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="post_type" value="<?php echo $post_type ?>">
                    <input type="hidden" name="page" value="<?php echo $page ?>">
                    <input name="" id="doaction" class="button action" value="Apply" type="submit">
                </div>

                <div class="alignleft actions"></div>
                <div class="tablenav-pages">
                    <span class="displaying-num"><?php echo count($artworks) ?> items</span>
                </div>
            </div>
        </form>

        <?php if ($artist_id): ?>

            <form id="sortable-arworks" action="" method="post">
                <table class="wp-list-table widefat fixed posts" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 60px">Position</th>
                            <th style="width: 60px">Featured</th>
                            <th style="width: 100px">Media</th>
                            <th>Name</th>
                            <th>Discipline</th>
                            <th>Tags</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th style="width: 60px">Position</th>
                            <th style="width: 60px">Featured</th>
                            <th style="width: 100px">Media</th>
                            <th>Name</th>
                            <th>Discipline</th>
                            <th>Tags</th>
                        </tr>
                    </tfoot>

                    <tbody id="the-list">

                        <?php foreach ($artworks as $position => $artwork): ?>

                            <?php //var_dump($artwork) ?>
                            <?php $tags = explode(',', $artwork->tags_name); ?>

                            <tr id="post-<?php echo $artwork->ID ?>" class="hentry <?php if ($position % 2 == 0): ?> alternate<?php endif ?>" valign="top" style="cursor: move">
                                <td class="position" style="width: 60px">
                                    <?php echo $artwork->position ?>
                                </td>
                                <td style="width: 60px">
                                    <?php if ('1' == $artwork->featured): ?>
                                        ✓
                                    <?php endif; ?>
                                </td>

                                <td class="column-icon media-icon" style="width: 100px; text-align: left">
                                    <?php echo wp_get_attachment_image( $artwork->media_id, 'thumbnail' ) ?>
                                </td>

                                <td>
                                    <?php edit_post_link( $artwork->post_title, '', '', $artwork->ID ); ?>
                                    <input type="hidden" name="artworks_positions[<?php echo $artwork->ID ?>]" value="<?php echo $position++ ?>">
                                </td>

                                <td>
                                    <?php echo $artwork->discipline_name ?>
                                </td>

                                <td>
                                    <?php echo join(', ', $tags) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <input type="hidden" name="artist_id" value="<?php echo $artist_id ?>">
                <input type="hidden" name="action" value="artworks_order_update">
            </form>

            <form id="posts-filter" action="" method="get">
                <div class="tablenav bottom">

                    <div class="alignleft actions bulkactions">
                        <select name="artist_id">
                            <option value="">Select an artist</option>
                            <?php foreach ($artists as $artist): ?>
                                <option value="<?php echo $artist->ID ?>"<?php if ($artist_id == $artist->ID): ?> selected="selected"<?php endif; ?>>
                                    <?php echo $artist->post_title ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="post_type" value="<?php echo $post_type ?>">
                        <input type="hidden" name="page" value="<?php echo $page ?>">
                        <input name="" id="doaction2" class="button action" value="Apply" type="submit">
                    </div>
                    <div class="alignleft actions"></div>
                    <div class="tablenav-pages one-page">
                        <span class="displaying-num"><?php echo count($artworks) ?> items</span>
                    </div>
                    <br class="clear">
                </div>
            </form>
        </div>

    <?php endif; ?>

<?php

}
