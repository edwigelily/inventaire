<?php
defined('BASEPATH') or exit('No direct script access allowed');

function theme_url()
{
    return base_url() . 'theme/';
}

function is_current_url($url)
{
    return current_url() === site_url($url);
}