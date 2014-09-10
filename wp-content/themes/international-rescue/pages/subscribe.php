<?php
/*
Template Name: Subscribe Template
*/

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

?>
<div class="post-content" style="width:50%;">
    <div class="the-post">
        <h1><?php the_title() ?></h1>
        <div class="clear"></div>
        <div class="email-signup" id="email-signup">
            <p style="margin-top:30px;">Please enter your details below to receive an inspiring image every now and then. </p>
            <form method="post" action="http://irmachine.internationalrescue.com/t/r/s/tdhukdi/">
                <div class="field-block">
                    <label>Full Name</label>
                    <input type="text" placeholder="Full Name" id="name" name="cm-name">
                </div>
                <div class="field-block">
                    <label>Email Address</label>
                    <input type="text" placeholder="Email Address" id="email" name="cm-tdhukdi-tdhukdi">
                </div>
                <div class="field-block submit">
                    <button type="submit" class="btn btn-submit" id="submit">Send</button>
                </div>
                <input type="hidden" name="action" value="cm_signup" />
            </form>

            <?php if ('1' == $_GET['submitted']): ?>
                <div class="thanks-message">
          e          <p>Thanks for signing up, we look forward to sharing our Artists and stories with you.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php 
get_footer();

