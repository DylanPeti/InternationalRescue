<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

function cfct_artworks($file = '', $data = null)
{
    if (empty($file))
    {
        $file = cfct_default_file('artworks-default');
    }
    cfct_template_file('artworks', $file, $data);
}

function cfct_custom_content($file = '', $data = null)
{
    if (empty($file))
    {
        $file = cfct_default_file('content-default');
    }
    cfct_template_file('content', $file, $data);
}

function cfct_custom_loop($file = '', $data = null)
{
    if (empty($file))
    {
        $file = cfct_default_file('loop-default');
    }
    cfct_template_file('loop', $file, $data);
}
