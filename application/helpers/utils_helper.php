<?php
defined('BASEPATH') or exit('No direct script access allowed');

function is_current_url($url)
{
    return current_url() === site_url($url);
}

function show_folio($nombre)
{
    return str_pad(number_format($nombre, 0, ","," "), 7, "0", STR_PAD_LEFT);
}