<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
    <head>
        <title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ); ?></title>
        <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico" type="image/x-icon" />
        <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:image" content="<?php bloginfo('stylesheet_directory'); ?>/img/fb-share.jpg"/>

        <link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
        <?php wp_get_archives('type=monthly&format=link'); ?>
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'carrington-jam' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'carrington-jam' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
		
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />

        <?php wp_head(); ?>

    <script type='text/javascript'>
            (function (d, t) {
              var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
              bh.type = 'text/javascript';
              bh.src = '//www.bugherd.com/sidebarv2.js?apikey=bzmqqxif9wtc4vciizc7ww';
              s.parentNode.insertBefore(bh, s);
              })(document, 'script');
        </script>

    </head>
    <body <?php body_class(''); ?>>

    <!--[if lt IE 9]>
        <script type='text/javascript'>
            window.location.href = "<?php echo get_bloginfo( 'url' ) ?>/upgrade"
        </script>
    <![endif]-->

    <div class="container">

        <div class="menu-overlay" id="menu-overlay">
            <div class="menu-header">
                <div class="menu-logo"><a href="<?php echo get_bloginfo( 'url' ) ?>">International Rescue</a></div>
                <div class="menu-close">
                    <button id="menu-cross" class="menu-burger"><span class="icon-cross"></span></button>
                </div>
            </div>
            <div class="inner">
                <div class="the-menu">

                    <?php wp_nav_menu( array( 'container'=>false, 'theme_location' => 'primary' ) ); ?>
                    <div class='the-title'>
                        <h2>"<?php echo get_bloginfo('description'); ?>"</h2>
                        <h1><?php echo get_bloginfo('name'); ?></h1>
                    </div>
                    <ul class="social">
                        <li><a class="icon-facebook_Frame" href="https://www.facebook.com/internationalrescue" target="_blank"><span class="visuallyhidden">Facebook</span></a></li>
                        <li><a class="icon-pinterest_Frame" href="http://www.pinterest.com/intlrescue/" target="_blank"><span class="visuallyhidden">Pinterest</span></a></li>
                        <li><a class="icon-twitter_Frame" href="https://twitter.com/intl_rescue" target="_blank"><span class="visuallyhidden">Twitter</span></a></li>
                        <li><a class="icon-linked_Frame" href="http://www.linkedin.com/company/international-rescue" target="_blank"><span class="visuallyhidden">LinkedIn</span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <header>
            <div class="inner">
                <div class='logo'>
                    <a href="<?php echo get_bloginfo( 'url' ) ?>">International Rescue</a>
                </div>
                <div class="burger">
                    <button id="menu-burger" class="menu-burger"><span class="icon-burger"></span></button>
                </div>
                <div class="filters desktop">
                    <div class="inner">
                        <ul>
                            <li class="first">Browse by:</li>
                            <li class="filter filter-discipline" data-filter-block="filter-block-discipline">Disciplines</li>
                            <li class="filter filter-artist" data-filter-block="filter-block-artist">Artists</li>
                            <li class="filter filter-tag" data-filter-block="filter-block-tag">Tags</li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </header>

        <div class="dropdowns desktop" id="dropdowns">
            <?php
                $disciplines = get_disciplines();
                $tags        = get_artwork_tags();
                $artists     = get_published_artists_by_primary_discipline();
            ?>
            <div class="inner">
                <div class="filter-block" id="filter-block-discipline">
                    <ul>
                        <?php foreach ($disciplines as $key => $discipline): ?>
                            <li<?php if (0 === $key): ?> class="first"<?php endif; ?>>
                                <a class="<?php echo $discipline->slug ?>" href="<?php echo get_bloginfo( 'url' ) .'/artwork/discipline/'. $discipline->slug ?>">
                                    <?php echo $discipline->name ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="filter-block" id="filter-block-artist">
                    <ul class="artists-disciplines">
                        <?php foreach ($artists as $discipline): ?>

                            <li<?php if (0 === $key): ?> class="first"<?php endif; ?>>
                                <strong class="<?php echo $discipline['slug']; ?>">
                                    <?php echo $discipline['name']; ?>
                                </strong>

                                <ul class="artists">
                                    <?php foreach ($discipline['artists'] as $artist): ?>

                                        <li>
                                            <a class="<?php echo $discipline['slug']; ?>"
                                                href="<?php echo get_bloginfo( 'url' ) .'/artist/'. $artist->post_name ?>">
                                                <?php echo $artist->post_title ?>
                                            </a>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="filter-block" id="filter-block-tag">
                    <ul>
                        <?php foreach ($tags as $key => $tag): ?>
                            <li<?php if (0 === ($key % 3 )): ?> class="first"<?php endif; ?>>
                                <a href="<?php echo get_bloginfo( 'url' ) .'/artwork/artwork-tag/'.$tag->slug ?>">
                                    <?php echo $tag->name ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="dropdowns mobile" id="mobile-dropdowns">
            <div class="inner">
                <div class="filter-block filter-block-discipline">
                    <div class="select">
                        <select class="filter-by filter-by-discipline" id="filter-by-discipline">
                            <option value="">Discipline</option>
                        <?php foreach ($disciplines as $discipline): ?>
                            <option value="<?php echo get_bloginfo( 'url' ) .'/artwork/discipline/'. $discipline->slug ?>">
                                <?php echo $discipline->name ?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="filter-block filter-block-artist">
                    <div class="select">
                        <select class="filter-by filter-by-artist" id="filter-by-artist">
                            <option value="">Artist</option>
                            <?php foreach ($artists as $discipline): ?>
                                <optgroup label="<?php echo $discipline['name']; ?>">
                                    <?php foreach ($discipline['artists'] as $artist): ?>
                                        <option value="<?php echo get_bloginfo( 'url' ) .'/artist/'.  $artist->post_name ?>">
                                            <?php echo $artist->post_title ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="filter-block filter-block-tag">
                    <div class="select">
                        <select class="filter-by filter-by-tag" id="filter-by-tag">
                            <option value="">Tag</option>
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?php echo get_bloginfo( 'url' ) .'/artwork/artwork-tag/'.$tag->slug ?>">
                                <?php echo $tag->name ?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="inner">

