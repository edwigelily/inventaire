<?php
defined('BASEPATH') or exit('No direct script access allowed');

function est_connecte()
{
    $CI = &get_instance();

    $CI->load->library('session');

    $token_invent = $CI->session->userdata('token_invent');

    return  $token_invent != null;
}
