<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$news_page = "$_SERVER[REQUEST_URI]";
?>

            <div class="clear"></div>
            </div>
        </div><!-- .content -->


    <?php if(is_page('contact') || $news_page = '/news/') { ?>
             <div class="footer-wrapper" style="position: relative;">
    <?php } else {
 ?>
               <div class="footer-wrapper">


   <?php } ?>
       
            <div class="inner">
                <div class="footer">
                    <div class="logo"></div>
					
                    <div class="contact">
 
					<p class="footer-note">© 2014 International Rescue</p>
                    <div class="contactus">
						
						<ul class="social footersocial">
              
              <li><a class="icon-facebook_Frame" href="https://www.facebook.com/internationalrescue" target="_blank"><span class="visuallyhidden">Facebook</span></a></li>
              <li><a class="icon-twitter_Frame" href="https://twitter.com/intl_rescue" target="_blank"><span class="visuallyhidden">Twitter</span></a></li>
              <li><a class="icon-linked_Frame" href="http://www.linkedin.com/company/international-rescue" target="_blank"><span class="visuallyhidden">LinkedIn</span></a></li>
							<li><a class="icons-instagram_Frame" href="http://www.instagram.com/intl_rescue/" target="_blank"><span class="visuallyhidden">Pinterest</span></a></li>
              <li><a class="btn footer-btn contactfooter" href="<?php echo get_bloginfo( 'url' ) ?>/contact">Contact Us</a></li>
						</ul>
						
					</div>
											
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>


    <?php wp_footer(); ?>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->


    <script>
	/*$(function(){
  $('#header_nav').data('size','big');
});

$(window).scroll(function(){
  if($(document).scrollTop() > 0)
{
    if($('#header_nav').data('size') == 'big')
    {
        $('#header_nav').data('size','small');
        $('#header_nav').stop().animate({
          
        }, "slow", "easein" );
		 	$('#header_nav').removeClass( "big" );
		  $('#header_nav').addClass( "small" );
    }
}
else
  {
    if($('#header_nav').data('size') == 'small')
      {
        $('#header_nav').data('size','big');
        $('#header_nav').stop().animate({
             
        }, "slow", "easein" );
		$('#header_nav').removeClass( "small" );
		$('#header_nav').addClass( "big" );
      }  
  }
});*/
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-50284023-1', 'internationalrescue.com');
      ga('send', 'pageview');

    </script>
<script type="text/javascript">
$(document).on('click', function (e) {
    if ($(e.target).closest(".plz").length === 0) {
        $(".menucontent").slideUp('slow');
    }
});
    
$(document).ready(function() {



	$('#filterOptions li a').click(function() {
		// fetch the class of the clicked item
		var ourClass = $(this).attr('class');
		
		// reset the active class on all the buttons
		$('#filterOptions li').removeClass('active');
		// update the active state on our clicked button
		$(this).parent().addClass('active');
		
		if(ourClass == 'all') {
			// show all our items
			$('#ourHolder').children('li').show();	
		}
		else {
			// hide all elements that don't share ourClass
			$('#ourHolder').children('li:not(.' + ourClass + ')').hide();
			// show all elements that do share ourClass
			$('#ourHolder').children('li.' + ourClass).show();
		}
		return false;
	});
});
</script>
    </body>
</html>
