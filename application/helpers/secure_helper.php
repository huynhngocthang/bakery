<?php

function is_admin() {
    $CI = & get_instance();
    $CI->load->library('session');
    if(!$CI->session->userdata['is_admin']) {
        redirect(site_url('admin/login'));
    } 
}
