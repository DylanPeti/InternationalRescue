<?php

/*
Template Name: Artworks Template
*/

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// Accessed by static page with artworks template, including home
cfct_page('artworks');

?>