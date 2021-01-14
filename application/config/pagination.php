<?php 

// Customisation du routing 

$config['enable_query_strings'] = TRUE;
$config['page_query_string'] = true;
$config['query_string_segment'] = 'p';


// Customisation de la pagination
$config['attributes'] = array('class' => 'page-link');
$config['full_tag_open'] = "<ul class='pagination'>";
$config['full_tag_close'] = '</ul>';
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"> <a class="page-link" href="#"> ';
$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
$config['last_link'] = 'Dernière Page';
$config['first_link'] = 'Début';



$config['prev_link'] = '&laquo;';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';


$config['next_link'] = '&raquo;';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';