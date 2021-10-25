<?php
if( have_rows('icon_option', 'options') ):
    while( have_rows('icon_option', 'options') ) : the_row();
        $image_id = get_sub_field('image_icon_option');
        $image = wp_get_attachment_image($image_id);
        $link = get_sub_field('link__icon_option', 'icon' , true);

        $datas['top'][] = array(
            'image' => $image,
            'link' => $link
        );

    endwhile;
endif;

$args = array(
    'theme_location' => 'header',
    'echo' => false
);
$menu = wp_nav_menu( $args );
$datas['menu'] = $menu;

INCLUDE TEMPLATE_PATH. '/header/header-top-bar.php';
INCLUDE TEMPLATE_PATH. '/header/header-menu.php';