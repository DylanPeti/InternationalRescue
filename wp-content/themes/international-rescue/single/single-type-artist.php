<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// Default home
get_header();

// Get artist
$artist      = find_artist(get_queried_object_id());
$artist_name = $artist->display('post_title');
$disciplines = get_artist_disciplines(get_queried_object_id());

// Get artworks by artist, taxonomy or not
$filters  = add_artwork_artist_filter(array(), $artist->display('post_name'));
$filters  = add_artwork_taxonomy_params_filter($filters, $_GET);
$artworks = get_ordered_published_artworks(ARTWORKS_PER_PAGE, $filters);
?>

    <div class="grid-wrapper">

        <div class="artist-header">
            <div class="name"><h1><?php echo $artist_name ?></h1></div>
            <div class="actions">
                <a href="<?php bloginfo('url'); ?>/contact/" class="btn btn-contactir">Contact Us</a>
                <?php if ($artist->field('portfolio.guid')): ?>
                    <a target="_blank" href="<?php echo $artist->field('portfolio.guid'); ?>" class="btn btn-download btn-contactir">Download Portfolio</a>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="column-left profile-column" id="profile-column">
            <div class="inner artistinner">
                
                <div class="main-image">
                    <?php if ($artist->field('picture.ID')): ?>
                        <?php echo wp_get_attachment_image( $artist->field('picture.ID'), 'thumbnail', false, array(
                            'class' => 'attachment-thumbnail lazy',
                            'alt' => $artist_name
                        )); ?>
                    <?php endif; ?>
                </div>
				<ul class="artist_discipline">
                    <!--?php foreach ($disciplines as $slug => $discipline): ?>
                        <li class="<!?php echo $slug ?>">
                            <a class="word word-discipline word-<!?php echo $slug ?>"
                                href="<!?php echo get_bloginfo( 'url' ) .'/artist/'.$artist->display('post_name').'?discipline='.$slug ?>">
                                <!?php echo $discipline['name'] ?>
                            </a>
                        </li>
                    <!?php endforeach; ?-->
					
					<?php 
												$terms = get_field('discipline');
												//print_r($terms);
												foreach( $terms as $term ): ?>
												<li class="<?php echo $term->slug; ?>">
                            <a class="word word-discipline disc-tit"
                                href="<?php echo get_permalink().'?discipline='.$term->slug; ?>">
												<?php echo $term->name;?>
											      </a>
                        </li>
                    <?php endforeach; ?>
					
                </ul>

                <?php echo $artist->display('post_content'); ?>
            </div>
        </div>


        <div class="artworks-column column-right" id="profile-artworks-wrapper" data-columns>
            <?php foreach ($artworks as $artwork): ?>
                <?php cfct_custom_content('type-artwork', compact('artwork')); ?>
            <?php endforeach; ?>

            <a class="next-page hidden" href="<?php echo $next_url ?>"></a>
        </div>
    </div>

<?php

get_footer();

?>
