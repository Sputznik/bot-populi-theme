<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
<?php wp_body_open();?>
<div id="site">

    <header>
        <!-- Navigation Bar -->
        <?php get_template_part( 'template-parts/header-nav' ); ?>        
    </header>
    
    <!-- Content Section -->
    <main>  