<?php

// This file is part of the Carrington JAM Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2010 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

// NOTE: this file is here for compatibility reasons - active templates are in the posts/ dir 


// Ugly hack since custom taxononomy urls comes here
$queried_object = get_queried_object();
$taxonomy       = $queried_object->taxonomy;
$artworks_taxo  = array_keys(get_artworks_taxonomies_matches());

if (in_array($taxonomy, array_keys(get_artworks_taxonomies_matches())))
{
    cfct_page('artworks');
}
else
{
    cfct_posts();
}

?>