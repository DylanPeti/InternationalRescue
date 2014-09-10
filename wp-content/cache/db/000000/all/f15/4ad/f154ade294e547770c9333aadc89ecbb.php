!T<?php exit; ?>a:6:{s:10:"last_error";s:0:"";s:10:"last_query";s:2532:"

SELECT DISTINCT
`t`.*,
`featured`.meta_value as featured,
`position`.meta_value as position,
`vimeo_id`.meta_value as vimeo_id,
`artwork_artist`.ID as artist_id, `artwork_artist`.post_title as artist_name, `artwork_artist`.post_name as artist_slug,
`artwork_media`.ID as media_id, `artwork_media`.post_title as media_name, `artwork_media`.post_content as media_description, `artwork_media`.guid as media_src,
`artwork_discipline`.term_id as discipline_id, `artwork_discipline`.name as discipline_name, `artwork_discipline`.slug as discipline_slug,
GROUP_CONCAT(`artwork_tags`.term_id) as tags_id, GROUP_CONCAT(`artwork_tags`.name) as tags_name, GROUP_CONCAT(`artwork_tags`.slug) as tags_slug



FROM `wp_posts` AS `t`


LEFT JOIN `wp_podsrel` AS `podsrel_artist`
    ON (t.ID = podsrel_artist.item_id)
    AND (podsrel_artist.pod_id = @artwork_pod_id  )
    AND (podsrel_artist.field_id = @artist_field_id)

LEFT JOIN `wp_posts` AS `artwork_artist`
    ON `artwork_artist`.ID = `podsrel_artist`.related_item_id


LEFT JOIN `wp_podsrel` AS `podsrel_media`
    ON (t.ID = podsrel_media.item_id)
    AND (podsrel_media.pod_id = @artwork_pod_id)
    AND (podsrel_media.field_id = @media_field_id)

LEFT JOIN `wp_posts` AS `artwork_media`
    ON `artwork_media`.ID = `podsrel_media`.related_item_id


LEFT JOIN `wp_podsrel` AS `podsrel_discipline`
    ON (t.ID = podsrel_discipline.item_id)
    AND (podsrel_discipline.pod_id = @artwork_pod_id)
    AND (podsrel_discipline.field_id = @discipline_field_id)


LEFT JOIN `wp_terms` AS `artwork_discipline`
    ON `artwork_discipline`.term_id = `podsrel_discipline`.related_item_id


LEFT JOIN `wp_podsrel` AS `podsrel_tags`
    ON (t.ID = podsrel_tags.item_id)
    AND (podsrel_tags.pod_id = @artwork_pod_id)
    AND (podsrel_tags.field_id = @tag_field_id)


LEFT JOIN `wp_terms` AS `artwork_tags`
    ON `artwork_tags`.term_id = `podsrel_tags`.related_item_id


LEFT JOIN `wp_postmeta` AS `featured`
    ON `featured`.`meta_key` = "featured"
    AND `featured`.`post_id` = `t`.`ID`


LEFT JOIN `wp_postmeta` AS `position`
    ON `position`.`meta_key` = "position"
    AND `position`.`post_id` = `t`.`ID`


LEFT JOIN `wp_postmeta` AS `vimeo_id`
    ON `vimeo_id`.`meta_key` = "vimeo_id"
    AND `vimeo_id`.`post_id` = `t`.`ID`

WHERE ( ( `t`.`post_type` = "artwork" ) AND ( `t`.`post_status` = "publish" ) AND (`artwork_artist`.post_name = 'janine-wareham' ) ) GROUP BY t.ID ORDER BY CAST(position.meta_value as SIGNED) ASC, `t`.`menu_order`, `t`.`post_title`, `t`.`post_date` LIMIT 0, 30";s:11:"last_result";a:0:{}s:8:"col_info";a:39:{i:0;O:8:"stdClass":13:{s:4:"name";s:2:"ID";s:7:"orgname";s:2:"ID";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:20;s:9:"charsetnr";i:63;s:5:"flags";i:49699;s:4:"type";i:8;s:8:"decimals";i:0;}i:1;O:8:"stdClass":13:{s:4:"name";s:11:"post_author";s:7:"orgname";s:11:"post_author";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:20;s:9:"charsetnr";i:63;s:5:"flags";i:49193;s:4:"type";i:8;s:8:"decimals";i:0;}i:2;O:8:"stdClass":13:{s:4:"name";s:9:"post_date";s:7:"orgname";s:9:"post_date";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:19;s:9:"charsetnr";i:63;s:5:"flags";i:16513;s:4:"type";i:12;s:8:"decimals";i:0;}i:3;O:8:"stdClass":13:{s:4:"name";s:13:"post_date_gmt";s:7:"orgname";s:13:"post_date_gmt";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:19;s:9:"charsetnr";i:63;s:5:"flags";i:129;s:4:"type";i:12;s:8:"decimals";i:0;}i:4;O:8:"stdClass":13:{s:4:"name";s:12:"post_content";s:7:"orgname";s:12:"post_content";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:4294967295;s:9:"charsetnr";i:33;s:5:"flags";i:4113;s:4:"type";i:252;s:8:"decimals";i:0;}i:5;O:8:"stdClass":13:{s:4:"name";s:10:"post_title";s:7:"orgname";s:10:"post_title";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:196605;s:9:"charsetnr";i:33;s:5:"flags";i:4113;s:4:"type";i:252;s:8:"decimals";i:0;}i:6;O:8:"stdClass":13:{s:4:"name";s:12:"post_excerpt";s:7:"orgname";s:12:"post_excerpt";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:196605;s:9:"charsetnr";i:33;s:5:"flags";i:4113;s:4:"type";i:252;s:8:"decimals";i:0;}i:7;O:8:"stdClass":13:{s:4:"name";s:11:"post_status";s:7:"orgname";s:11:"post_status";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:60;s:9:"charsetnr";i:33;s:5:"flags";i:16385;s:4:"type";i:253;s:8:"decimals";i:0;}i:8;O:8:"stdClass":13:{s:4:"name";s:14:"comment_status";s:7:"orgname";s:14:"comment_status";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:60;s:9:"charsetnr";i:33;s:5:"flags";i:1;s:4:"type";i:253;s:8:"decimals";i:0;}i:9;O:8:"stdClass":13:{s:4:"name";s:11:"ping_status";s:7:"orgname";s:11:"ping_status";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:60;s:9:"charsetnr";i:33;s:5:"flags";i:1;s:4:"type";i:253;s:8:"decimals";i:0;}i:10;O:8:"stdClass":13:{s:4:"name";s:13:"post_password";s:7:"orgname";s:13:"post_password";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:60;s:9:"charsetnr";i:33;s:5:"flags";i:1;s:4:"type";i:253;s:8:"decimals";i:0;}i:11;O:8:"stdClass":13:{s:4:"name";s:9:"post_name";s:7:"orgname";s:9:"post_name";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:600;s:9:"charsetnr";i:33;s:5:"flags";i:16393;s:4:"type";i:253;s:8:"decimals";i:0;}i:12;O:8:"stdClass":13:{s:4:"name";s:7:"to_ping";s:7:"orgname";s:7:"to_ping";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:196605;s:9:"charsetnr";i:33;s:5:"flags";i:4113;s:4:"type";i:252;s:8:"decimals";i:0;}i:13;O:8:"stdClass":13:{s:4:"name";s:6:"pinged";s:7:"orgname";s:6:"pinged";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:196605;s:9:"charsetnr";i:33;s:5:"flags";i:4113;s:4:"type";i:252;s:8:"decimals";i:0;}i:14;O:8:"stdClass":13:{s:4:"name";s:13:"post_modified";s:7:"orgname";s:13:"post_modified";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:19;s:9:"charsetnr";i:63;s:5:"flags";i:129;s:4:"type";i:12;s:8:"decimals";i:0;}i:15;O:8:"stdClass":13:{s:4:"name";s:17:"post_modified_gmt";s:7:"orgname";s:17:"post_modified_gmt";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:19;s:9:"charsetnr";i:63;s:5:"flags";i:129;s:4:"type";i:12;s:8:"decimals";i:0;}i:16;O:8:"stdClass":13:{s:4:"name";s:21:"post_content_filtered";s:7:"orgname";s:21:"post_content_filtered";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:4294967295;s:9:"charsetnr";i:33;s:5:"flags";i:4113;s:4:"type";i:252;s:8:"decimals";i:0;}i:17;O:8:"stdClass":13:{s:4:"name";s:11:"post_parent";s:7:"orgname";s:11:"post_parent";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:20;s:9:"charsetnr";i:63;s:5:"flags";i:49193;s:4:"type";i:8;s:8:"decimals";i:0;}i:18;O:8:"stdClass":13:{s:4:"name";s:4:"guid";s:7:"orgname";s:4:"guid";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:765;s:9:"charsetnr";i:33;s:5:"flags";i:1;s:4:"type";i:253;s:8:"decimals";i:0;}i:19;O:8:"stdClass":13:{s:4:"name";s:10:"menu_order";s:7:"orgname";s:10:"menu_order";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:11;s:9:"charsetnr";i:63;s:5:"flags";i:32769;s:4:"type";i:3;s:8:"decimals";i:0;}i:20;O:8:"stdClass":13:{s:4:"name";s:9:"post_type";s:7:"orgname";s:9:"post_type";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:60;s:9:"charsetnr";i:33;s:5:"flags";i:16393;s:4:"type";i:253;s:8:"decimals";i:0;}i:21;O:8:"stdClass":13:{s:4:"name";s:14:"post_mime_type";s:7:"orgname";s:14:"post_mime_type";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:300;s:9:"charsetnr";i:33;s:5:"flags";i:1;s:4:"type";i:253;s:8:"decimals";i:0;}i:22;O:8:"stdClass":13:{s:4:"name";s:13:"comment_count";s:7:"orgname";s:13:"comment_count";s:5:"table";s:1:"t";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:20;s:9:"charsetnr";i:63;s:5:"flags";i:32769;s:4:"type";i:8;s:8:"decimals";i:0;}i:23;O:8:"stdClass":13:{s:4:"name";s:8:"featured";s:7:"orgname";s:10:"meta_value";s:5:"table";s:8:"featured";s:8:"orgtable";s:11:"wp_postmeta";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:4294967295;s:9:"charsetnr";i:33;s:5:"flags";i:16;s:4:"type";i:252;s:8:"decimals";i:0;}i:24;O:8:"stdClass":13:{s:4:"name";s:8:"position";s:7:"orgname";s:10:"meta_value";s:5:"table";s:8:"position";s:8:"orgtable";s:11:"wp_postmeta";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:4294967295;s:9:"charsetnr";i:33;s:5:"flags";i:16;s:4:"type";i:252;s:8:"decimals";i:0;}i:25;O:8:"stdClass":13:{s:4:"name";s:8:"vimeo_id";s:7:"orgname";s:10:"meta_value";s:5:"table";s:8:"vimeo_id";s:8:"orgtable";s:11:"wp_postmeta";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:4294967295;s:9:"charsetnr";i:33;s:5:"flags";i:16;s:4:"type";i:252;s:8:"decimals";i:0;}i:26;O:8:"stdClass":13:{s:4:"name";s:9:"artist_id";s:7:"orgname";s:2:"ID";s:5:"table";s:14:"artwork_artist";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:20;s:9:"charsetnr";i:63;s:5:"flags";i:49698;s:4:"type";i:8;s:8:"decimals";i:0;}i:27;O:8:"stdClass":13:{s:4:"name";s:11:"artist_name";s:7:"orgname";s:10:"post_title";s:5:"table";s:14:"artwork_artist";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:196605;s:9:"charsetnr";i:33;s:5:"flags";i:4112;s:4:"type";i:252;s:8:"decimals";i:0;}i:28;O:8:"stdClass":13:{s:4:"name";s:11:"artist_slug";s:7:"orgname";s:9:"post_name";s:5:"table";s:14:"artwork_artist";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:600;s:9:"charsetnr";i:33;s:5:"flags";i:16392;s:4:"type";i:253;s:8:"decimals";i:0;}i:29;O:8:"stdClass":13:{s:4:"name";s:8:"media_id";s:7:"orgname";s:2:"ID";s:5:"table";s:13:"artwork_media";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:20;s:9:"charsetnr";i:63;s:5:"flags";i:49698;s:4:"type";i:8;s:8:"decimals";i:0;}i:30;O:8:"stdClass":13:{s:4:"name";s:10:"media_name";s:7:"orgname";s:10:"post_title";s:5:"table";s:13:"artwork_media";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:196605;s:9:"charsetnr";i:33;s:5:"flags";i:4112;s:4:"type";i:252;s:8:"decimals";i:0;}i:31;O:8:"stdClass":13:{s:4:"name";s:17:"media_description";s:7:"orgname";s:12:"post_content";s:5:"table";s:13:"artwork_media";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:4294967295;s:9:"charsetnr";i:33;s:5:"flags";i:4112;s:4:"type";i:252;s:8:"decimals";i:0;}i:32;O:8:"stdClass":13:{s:4:"name";s:9:"media_src";s:7:"orgname";s:4:"guid";s:5:"table";s:13:"artwork_media";s:8:"orgtable";s:8:"wp_posts";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:765;s:9:"charsetnr";i:33;s:5:"flags";i:0;s:4:"type";i:253;s:8:"decimals";i:0;}i:33;O:8:"stdClass":13:{s:4:"name";s:13:"discipline_id";s:7:"orgname";s:7:"term_id";s:5:"table";s:18:"artwork_discipline";s:8:"orgtable";s:8:"wp_terms";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:20;s:9:"charsetnr";i:63;s:5:"flags";i:49698;s:4:"type";i:8;s:8:"decimals";i:0;}i:34;O:8:"stdClass":13:{s:4:"name";s:15:"discipline_name";s:7:"orgname";s:4:"name";s:5:"table";s:18:"artwork_discipline";s:8:"orgtable";s:8:"wp_terms";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:600;s:9:"charsetnr";i:33;s:5:"flags";i:16392;s:4:"type";i:253;s:8:"decimals";i:0;}i:35;O:8:"stdClass":13:{s:4:"name";s:15:"discipline_slug";s:7:"orgname";s:4:"slug";s:5:"table";s:18:"artwork_discipline";s:8:"orgtable";s:8:"wp_terms";s:3:"def";s:0:"";s:2:"db";s:20:"international rescue";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:600;s:9:"charsetnr";i:33;s:5:"flags";i:16388;s:4:"type";i:253;s:8:"decimals";i:0;}i:36;O:8:"stdClass":13:{s:4:"name";s:7:"tags_id";s:7:"orgname";s:0:"";s:5:"table";s:0:"";s:8:"orgtable";s:0:"";s:3:"def";s:0:"";s:2:"db";s:0:"";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:1023;s:9:"charsetnr";i:33;s:5:"flags";i:0;s:4:"type";i:253;s:8:"decimals";i:0;}i:37;O:8:"stdClass":13:{s:4:"name";s:9:"tags_name";s:7:"orgname";s:0:"";s:5:"table";s:0:"";s:8:"orgtable";s:0:"";s:3:"def";s:0:"";s:2:"db";s:0:"";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:1023;s:9:"charsetnr";i:33;s:5:"flags";i:0;s:4:"type";i:253;s:8:"decimals";i:0;}i:38;O:8:"stdClass":13:{s:4:"name";s:9:"tags_slug";s:7:"orgname";s:0:"";s:5:"table";s:0:"";s:8:"orgtable";s:0:"";s:3:"def";s:0:"";s:2:"db";s:0:"";s:7:"catalog";s:3:"def";s:10:"max_length";i:0;s:6:"length";i:1023;s:9:"charsetnr";i:33;s:5:"flags";i:0;s:4:"type";i:253;s:8:"decimals";i:0;}}s:8:"num_rows";i:0;s:10:"return_val";i:0;}