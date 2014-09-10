<?php

/*
Template Name: Production Template
*/

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
remove_filter ('the_content', 'wpautop'); 
get_header();
?>
<?php
cfct_loop(); ?>
<div class="post-content" id="post-content" style="margin: 0 auto;">
<div class="the-post">
<div class="production-page">
<h2>Line Production</h2>
<h4>Services</h4>
<p>International Rescue is here to help you. We have a versatile team of highly experienced producers and strategically placed production offices both in Australia and New Zealand. With a trusted network of industry professionals we have access to the best locations, crews and equipment in Australasia.</p>
<p>Whether dealing with your freight, visas and carnets or high speed data transfers you can rely on us to handle the logistics. As well as producing for your photographer we can also submit recommendations of local photographers to suit your needs.</p>
<p>Consistently favourable exchange rates against the US dollar, Euro and British pound ensures value for money. Call +64 21 797 021 or email <a href="mailto:production@internationalrescue.com" target="_self">production@internationalrescue.com</a> for a no obligation quote.</p>
<p style="margin-bottom: 0;"><img class="alignnone size-full wp-image-578" src="http://ir.site.gladeye.co/wp-content/uploads/2014/04/Untitled-1.jpg" alt="Line Production" width="730" height="221" /></p>
<h3>Location Management</h3>
<p style="margin-top: 25px; ">International Rescue offers location scouting and management to suit your needs. Both Australia and New Zealand have stunning unspoilt locations ranging from deserts to subtropical rainforests, all within a few hours drive of each other. We'll help you find what you're looking for and obtain all the necessary permits.</p>
<p>Shooting in Australasia has never been easier and the quality of light found here is second to none. Our summer months are opposite to those in the northern hemisphere providing an opportunity to shoot your campaigns ahead of time.</p>
<p>Visit <a href="http://www.searchpartylocations.com/locations" target="_blank">Search Party Australia</a> or <a href="http://www.filmscouts.co.nz/location-gallery.html" target="_blank">Film Scouts New Zealand</a> to view location options. Call +64 21 797 021 or email <a href="mailto:production@internationalrescue.com" target="_self">production@internationalrescue.com</a> for a tailor made location package.</p>
<h4>Talent</h4>
<img class="production-img alignleft size-full wp-image-370" src="http://ir.site.gladeye.co/wp-content/uploads/2014/04/talent.jpg" alt="International Rescue Talent Management" width="610" height="450" />
<p>International Rescue can help you source the right talent for your brief. Whether contracting models or street casting we can manage the entire process before you arrive. From the initial brief to the final selection we involve our clients every step of the way.</p>
<p style="margin-bottom: 30px;">Both Australia and New Zealand are multi cultural societies with a unique blend of european, pacific island and asian talent. We have extensive agency contacts locally and internationally and our producers can negotiate usage or full territorial buyouts on your behalf. Call +64 21 797 021 or email <a href="mailto:production@internationalrescue.com" target="_self">production@internationalrescue.com</a> with your talent brief.</p>
</div>
</div>
</div>
</div>
<div id="global-network" style="height: 70px; padding: 30px; background-color: #fff; height: auto;"><div id="production-bottom" style="width: 50%; margin: 0 auto 0;">
<h1 style="font-size: 24px;">Global Network</h1>
<p>International Rescue can help you with your global assignments. We have an extensive network of over 2000 photographers from around the world who can provide you with local knowledge and expertise. Our team can manage your geographic and budgetary requirements ensuring you save time and money.</p>
<p>Call +64 21 797 021 or email your brief and specific requirements to <a href="mailto:rob@internationalrescue.com">rob@internationalrescue.com</a></p>
<p><img class="alignnone size-full wp-image-581" src="http://ir.site.gladeye.co/wp-content/uploads/2014/04/Untitled-2.jpg" alt="Global Network" width="800" height="197" /></p>
</div>
</div>
</div>


<?php
get_footer();

?>
