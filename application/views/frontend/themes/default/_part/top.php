<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $this->page_title . ' - ' . $seo->title ?></title>
        <meta name="keyword" content="<?php echo $seo->keyword ?>" />
        <meta name="description" content="<?php echo ($this->page_description) ? $this->page_description : $seo->description ?>" />
        <meta name="robots" content="index,follow"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <?php if ($canonical_url) {?>
        <link rel="canonical" href="<?php echo $canonical_url; ?>" />
        <?php }?>
        <?php if (!empty($this->page_seo->title)) {
	echo '<meta property="og:title" content="' . $this->page_seo->title . '"/>';
} else {
	echo '<meta property="og:title" content="' . $seo->title . '"/>';
}if (!empty($this->page_seo->description)) {
	echo '<meta property="og:description" content="' . $this->page_seo->description . '"/>';
} else {
	echo '<meta property="og:description" content="' . $seo->description . '"/>';
}
if (!empty($this->page_seo->type)) {
	echo '<meta property="og:type" content="' . $this->page_seo->type . '"/>';
}
if (!empty($this->canonical_url)) {
	echo '<meta property="og:url" content="' . $this->canonical_url . '"/>';
}
if (!empty($this->page_seo->image)) {
	echo '<meta property="og:image" content="' . $this->page_seo->image . '"/>';
}
?>


        <link href="https://fonts.googleapis.com/css?family=Play|Roboto" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/normalize.css" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/bootstrap/css/bootstrap.min.css" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/font-awesome.min.css" media="screen">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/animate.min.css" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/fancybox/jquery.fancybox.css?v=2.1.5" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/jquery-confirm/dist/jquery-confirm.min.css" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/responsive.css" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/guide.css" media="screen">
       <!--  <?php
// display css
//$this->carabiner->display('css');
?> -->
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/bxslider/jquery.bxslider.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/common.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/demo.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/vanilla-zoom.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/detail.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>public/assets/css/index.css" media="screen">
    </head>
    <body class="body_noscroll">
        <div class="loader"> <div class="loader1"></div></div>
