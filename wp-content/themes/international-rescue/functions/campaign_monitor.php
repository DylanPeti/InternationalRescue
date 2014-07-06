<?php

// process the subscribe to list form
function ir_cm_signup()
{

    // only proceed with this function if we are posting from our email subscribe form
    if (isset($_POST['action']) && $_POST['action'] == 'cm_signup')
    {
        // setup the email varaible
        $email = strip_tags($_POST['email']);
        $name  = strip_tags($_POST['name']);

        // check for a valid email
        if (!is_email($email))
        {
            wp_die(__('Your email address is invalid. Click back and enter a valid email address.', 'campaign-monitor-dashboard'), __('Invalid Email', 'campaign-monitor-dashboard'));
        }

        // send this email to campaign_monitor
        $signedup = ir_subscribe_email($email, $name);

        // send user to the confirmation page
        wp_redirect(add_query_arg('submitted', '1', wp_get_referer()).'#email-signup');
        exit;
    }
}

add_action('init', 'ir_cm_signup');


/**
 * Subscribe someone to a list
 *
 */
function ir_subscribe_email($email, $name)
{
    $cm_api  = get_option('cm_api_option');
    $cm_list = get_option('cm_list_id_option');
    $wrap    = new CS_REST_Subscribers($cm_list, $cm_api);

    $result = $wrap->add(array(
        'EmailAddress' => $email,
        'Name'         => $name,
        'Resubscribe'  => true
    ));

    if ($result->was_successful())
    {
        return true;
    }

    return false;
}