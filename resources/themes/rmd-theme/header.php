<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="header">
      <?php get_template_part('templates/header/header', 'main'); ?>
    </header>
    <div class="wrapper">