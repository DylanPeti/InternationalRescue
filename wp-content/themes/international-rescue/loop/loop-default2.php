<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

if (have_posts()) {



?>
<body style="position:relative; height: auto;">
    <div class="grid-wrapper">
        <div class="inner">
        <?php } ?>
        <?php 
         $news_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if($news_link == "http://stage.internationalrescue.com/news/" || $news_link == "localhost:8888/" ){ ?>


         <h1 id="news-title">News</h1>


         <?php
         }   
         ?> 

    <?php
 

        while (have_posts()) {

            the_post();
            cfct_content();
        }

        cfct_misc('nav-posts');

    ?>

        </div>
    </div>
<?php

}

?>
