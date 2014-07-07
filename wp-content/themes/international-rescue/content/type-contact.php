<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

?>
<div class="post-content">
    <div class="the-post">
        <h1><?php the_title() ?></h1>
        <?php the_content(); ?>
        <div class="clear"></div>
      <!--   <div class="email-signup" id="email-signup">
            <h2>Sign up to receive updates!</h2>
            <form method="post" action="http://irmachine.internationalrescue.com/t/r/s/tdhukdi/">
                <div class="field-block">
                    <label>Full name</label>
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
                    <p>Thanks for signing up, we look forward to sharing our Artists and stories with you.</p>
                </div>
            <?php endif; ?>
        </div> -->
    </div>
</div>




