<?php
ob_start();
session_start();


if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// if (!isset($_COOKIE['HomepageSlider'])){
//     setcookie('homepageSlider', 1);
// }
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$page_check = "$_SERVER[REQUEST_URI]";
$string = 'artwork';
$stringtwo = 'about';
$stringthree = 'news';
$checka = strpos($page_check, $stringtwo);
$check =  strpos($page_check, $string);
$checks = strpos($page_check, $stringthree);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
    <head>
        <title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ); ?></title>
        <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/small.png" type="image/x-icon" />
        <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:image" content="<?php bloginfo('stylesheet_directory'); ?>/img/fb-share.jpg"/>

        <link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
        <?php wp_get_archives('type=monthly&format=link'); ?>
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'carrington-jam' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'carrington-jam' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
     <!--   <script type="text/javascript" src="/wp-content/themes/international-rescue/js/slider.js"></script>-->
		
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
    <body <?php body_class(''); ?> style="background-color:#ECECEC">

    <div class="container">


        <div class="menu-overlay" id="menu-overlay">
            <div class="menu-header">
                <div class="menu-logo"><a href="<?php echo get_bloginfo( 'url' ) ?>">
				<img src="<?php bloginfo("template_url");?>/img/irl-logo.png"></a></div>
                <div class="menu-close">
                    <button id="menu-cross" class="menu-burger"><span class="icon-cross"></span></button>

                </div>
            </div>
            <div class="inner">
  
                <div class="the-menu">

                    <?php wp_nav_menu( array( 'container'=>false, 'theme_location' => 'primary' ) ); ?>
                    
                    <ul class="social">
                        <li><a class="icon-facebook_Frame" href="https://www.facebook.com/internationalrescue" target="_blank"><span class="visuallyhidden">Facebook</span></a></li>
                                                <li><a class="icon-twitter_Frame" href="https://twitter.com/intl_rescue" target="_blank"><span class="visuallyhidden">Twitter</span></a></li>
                        <li><a class="icon-linked_Frame" href="http://www.linkedin.com/company/international-rescue" target="_blank"><span class="visuallyhidden">LinkedIn</span></a></li>
                        <li><a class="icons-instagram_Frames" href="http://www.instagram.com/intl_rescue/" target="_blank"><span class="visuallyhidden">Pinterest</span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <header id="header_nav" class="small">
           
            <div class="iner">
            <div class="padding">
				<?php if ( is_front_page() ) {?>
               
                <div class='logo'>
           <a href="<?php echo get_bloginfo( 'url' ) ?>">
                <!-- <img src="http://stage.internationalrescue.com/wp-content/uploads/2014/07/inter-1440x720.png" alt="International Rescue"> -->
    </a>
                </div>
            
				<?php } else { ?>
				<?php $partners_obj = get_terms( 'discipline', array('hide_empty' => false) ); 
             //   var_dump($partners_obj); 
              //  print_r(get_object_vars($partners_obj[0])) ?>

				<div class='pagelogo'>
                    <a href="<?php echo get_bloginfo( 'url' ) ?>">International Rescue</a>
                </div>
				
				<?php } ?>
				
                <div class="burger">
                    <button id="menu-burger" class="menu-burger"><span class="icon-burger"></span></button>


                </div>
                <div class="filters desktop">
        
                     <div class="inner">
         

                        <ul>
                            <!--li class="first">Browse by:</li-->
                            <li class="filter filter-discipline plz" data-filter-block="filter-block-discipline" id="header-item">Disciplines</li>
                            <li class="filter filter-artist plz" data-filter-block="filter-block-artists" id="header-item">Artists</li>
                            <li class="filter filter-tag plz" data-filter-block="filter-block-tag" id="header-item">Tags</li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            </div>
			  <div class="dropdowns desktop" id="dropdowns">
            <?php
                $disciplines = get_disciplines();
				$partners_obj = get_terms( 'discipline', array('hide_empty' => false) );				
                $tags        = get_artwork_tags();
                $artists     = get_published_artists_by_primary_discipline();
				
				
            ?>
             <?php if ( is_front_page() ) {?>
                <div class="inner" id="contain-this" style="padding: 0 3%">
                   
                    <?php } else { ?>
        <div class="inner">
        <?php } ?>
         
                <div class="filter-block plz menucontent" id="filter-block-discipline">
                    <ul class="artists-disciplines" id="ourHolder_disc">
                        <?php foreach ($partners_obj as $key => $discipline): ?>
                            <li<?php if (0 === $key): ?> class="first"<?php endif; ?>>
                                <a class="<?php echo $discipline->slug; ?>" href="<?php echo get_bloginfo( 'url' ) .'/artwork/discipline/'. $discipline->slug ?>">
                                    <?php echo $discipline->name; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
				
				
				<div class="filter-block plz menucontent" id="filter-block-artists">
				
					<ul id="filterOptions">
						<li class="active"><a href="#" class="all">All</a></li>
						<?php foreach ($partners_obj as $discipline): ?>
						<li><a href="#" class="<?php echo $discipline->slug; ?>"><?php echo $discipline->name;?></a></li>
						<?php endforeach; ?>
					</ul>
				
				
                    <ul class="artists-disciplines" id="ourHolder">
                        <?php
						$args = array( 'post_type' => 'artist',
							   'post_status' => 'publish',
							   'nopaging' => true,   
							   'orderby' => 'title',
							   'order' => 'ASC'
							   );
				        $the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) :
								while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                        <li class="<?php 
												$terms = get_field('discipline');
												//print_r($terms);
												foreach( $terms as $term ): 
												echo $term->slug." ";
												endforeach; ?>">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); 
												?>
												
												
                                            </a>
                                        </li>

                                    <?php 

								endwhile;
								endif;
								 
								// Reset Post Data
								wp_reset_postdata(); ?>
                    </ul>
					
                    <div class="clear"></div>
                </div>
				
				
				
                <!--div class="filter-block" id="filter-block-artist">
                    <ul class="artists-disciplines">
                        <!?php foreach ($artists as $discipline): ?>

                            <li<!?php if (0 === $key): ?> class="first"<!?php endif; ?>>
                                <strong class="<!?php echo $discipline['slug']; ?>">
                                    <!?php echo $discipline['name']; ?>
                                </strong>

                                <ul class="artists">
                                    <!?php foreach ($discipline['artists'] as $artist): ?>

                                        <li>
                                            <a class="<!?php echo $discipline['slug']; ?>"
                                                href="<!?php echo get_bloginfo( 'url' ) .'/artist/'. $artist->post_name ?>">
                                                <!?php echo $artist->post_title ?>
                                            </a>
                                        </li>

                                    <!?php endforeach; ?>
                                </ul>
                            </li>
                        <!?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div-->
                <div class="filter-block plz menucontent" id="filter-block-tag">
                    <ul class="artists-disciplines" id="ourHolder_tag">
					
                        <?php 
						
						foreach ($tags as $key => $tag): ?>
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
        </header>

      

        <div class="dropdowns mobile" id="mobile-dropdowns">
         <?php if ( is_front_page() ) {?>
                <div class="inner" id="contain-this" style="padding: 0 3%">
                   
                    <?php } else { ?>
        <div class="inner">
        <?php } ?>
            
                <div class="filter-block filter-block-discipline">
                    <div class="select">
                        <select class="filter-by filter-by-discipline" id="filter-by-discipline">
                            <option value="">Discipline</option>
                        <?php foreach ($partners_obj as $discipline): ?>
                            <option value="<?php echo get_bloginfo( 'url' ) .'/artwork/discipline/'. $discipline->slug ?>">

                            <?php    echo $discipline->name;  ?> 
                        
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
<?php if ( !is_front_page() ) {?>
        <div class="content" id="ak" style="padding: 70px 3% 0;">

        
<?php } else { ?>
    <div class="content" id="ak">
<?php }


    
// && isset($_COOKIE['sitename_newvisitor'])



$_SESSION['store_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


if($_SESSION['store_url'] == "http://localhost:8888/" || $_SESSION['store_url'] == "http://ir.fortylove.vleaf.co.nz/" || $_SESSION['store_url'] == "http://stage.internationalrescue.com/"){ 
?>
<div class="responsive-div">
<div class="hold-this">
<div class="slider-header"><h1>WE CREATE AN INSPIRING CONNECTION 
                      BETWEEN OUR ARTISTS AND CLIENTS</h1></div>

<div class="arrow-down" id="scroll">
</div>
<div id="slider-nav">
    <button class="slider-button" id="b-one" data-dir="prev" data-button="0" onclick="slide(0, this.id)"></button>
    <button class="slider-button" id="b-two" data-dir="next" data-button="1" onclick="slide(1, this.id)"></button>
    <button class="slider-button" id="b-three" data-dir="next" data-button="2" onclick="slide(2, this.id)"></button>
    <button class="slider-button" id="b-four" data-dir="next" data-button="3" onclick="slide(3, this.id)"></button>
    <button class="slider-button" id="b-five" data-dir="next" data-button="4" onclick="slide(4, this.id)"></button>
</div>
</div>

</div>
<div class="slider-container">
<div class="homepage-slider">
<?php


echo do_shortcode('[layerslider id="3"]'); 


?>
</div>

</div>
</div>

<div class="hide-it"></div>


<?php


?>

<?php if ( is_front_page() ) {?>
                <div class="inner" id="contain-this" style="padding: 0px 3% 0">
                   <div class="gap"><!-- <h1 style="margin-left:auto; margin-right:auto; width:100%; text-align:center; margin-top:30px;">Artists Works</h1> --></div>
                    <?php } else { ?>
        <div class="inner">
        <?php } ?>


<?php 
} 

if (isset($_COOKIE['homepageSlider'])){

?>
<script type='text/javascript'>



</script>

<?php } ?>

<!--Use wp_enqueue to load this script.-->

<?php if(is_front_page()){ ?>


<script>
$(document).ready(function () {
      $(".arrow-down").click(function() {
    console.log('clicked');
   $('html, body').animate({
        scrollTop: $('.gap').offset().top  -70
    }, 1000);
   return false;
    
});
$(".footer-wrapper").show();

});
 $('body').css('overflow-y', 'auto');

  function slide(number, item){
   var slideContainer = $('.homepage-slider ul').css('overflow-x', 'hidden').children('li'),
   imgsLen = slideContainer.length,
   imgWidth = slideContainer.width();
   var button = number;
   console.log(item);
   var dir = "data-button";
   var slider = $(".homepage-slider ul");
   var sliderButton = $(".slider-button");
   var marginLeft;
   var color;

  sliderButton.css({
    'background-color': 'rgba(255,255,255,0.1)'
  })
  $('#' + item).css({
    'background-color': 'rgba(255,255,255,0.6)'
  })
     switch(button){
        case 0:
        marginLeft = 0;

        break;

        case 1:
        marginLeft = imgWidth;
        break;

        case 2:
        marginLeft = imgWidth * 2;
        break;

        case 3:
        marginLeft = imgWidth * 3;
        break;

        case 4:
        marginLeft = imgWidth * 4;
        break;
     }
     

     slider.animate({
        'margin-left': -marginLeft
    });
    
    


}



</script>


<?php } 
      if(!is_front_page()){ ?>


     <?php   } ?>



