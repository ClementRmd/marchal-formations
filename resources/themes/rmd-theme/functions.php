<?php
define( 'THEME_PATH' ,          get_template_directory()            );
define( 'TEMPLATE_PATH' ,       THEME_PATH .    '/templates'        );

define( 'THEME_URL' ,           get_template_directory_uri()        );
define( 'CSS_URL' ,             THEME_URL .    '/dist/styles'       );
define( 'IMAGES_URL' ,          THEME_URL .    '/dist/images'       );
define( 'JS_URL' ,              THEME_URL .    '/dist/scripts'      );
define( 'FAVICONS_URL' ,        THEME_URL .    '/dist/favicon'      );
define( 'ADMIN_IMAGES_URL' ,    IMAGES_URL .   '/admin'             );

$filesArray = [ 'posttypes' , 'function', 'class' ];

foreach ($filesArray as $value) {
  foreach ( glob( THEME_PATH . "/inc/" . $value ."/*.php") as $file ) {
    include_once $file;
  }
}

?>