<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

load_theme_textdomain('carrington-jam');

define('CFCT_DEBUG', false);
define('CFCT_PATH', trailingslashit(TEMPLATEPATH));

// Number of arworks

define('MAX_FEATURED_BY_ARTIST', 3);
define('ARTWORKS_PER_PAGE', 100);

// Order names
define('ORDER_HOME', 'order_home');
define('ORDER_DISCIPLINE', 'order_discipline');
define('ORDER_ARTWORK_TAG', 'order_artwork_tag');


include_once(TEMPLATEPATH.'/carrington-core/carrington.php');

// Additions to the core
include_once(STYLESHEETPATH.'/carrington-core/templates.php');

include_once(STYLESHEETPATH.'/functions/helpers.php');

include_once(STYLESHEETPATH.'/functions/admin_artworks_list_page.php');

include_once(STYLESHEETPATH.'/functions/infinite_scroll.php');

include_once(STYLESHEETPATH.'/functions/campaign_monitor.php');

include_once(STYLESHEETPATH.'/functions/hooks.php');


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .column-column-meta .attachment-thumbnail {
  height: 121px !important;
  width: 80% !important;
}
  </style>';
}
?>
