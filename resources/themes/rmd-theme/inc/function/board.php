<?php
  remove_action('welcome_panel', 'wp_welcome_panel'); //Delete bloc welcome

  add_action('wp_dashboard_setup', 'kodex_remove_dashboard_widgets');
  function kodex_remove_dashboard_widgets() {
    global $wp_meta_boxes;

    // D'un coup d'oeil
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);

    // Brouillon rapide
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

    // Nouvelles de WordPress
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  }

  function my_login_logo() { 
    $img = IMAGES_URL .'/logo-hypnogone.png';
    ?>
    <style type="text/css">
    #login {
      padding: 3% 0 0 !important;
    }
    #login h1 a, .login h1 a {
      background-image: url(<?php echo $img; ?>);
      height:30vh;
      width: 100%;
      background-repeat: no-repeat;
      background-size: contain;
    }
    .login h1 a{
      margin: 0 !important;
    }
    </style>
  <?php }
  add_action( 'login_enqueue_scripts', 'my_login_logo' );

  //add thumbnail
  add_theme_support( 'post-thumbnails' );