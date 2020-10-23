<?php

if (!function_exists('resize_image')) {

    function resize_image($file, $w=600, $h=400) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file;
        //$config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $w;
        $config['height'] = $h;
        
        $CI = & get_instance();

        $CI->load->library('image_lib', $config);

        $CI->image_lib->resize();
    }

}
