<?php

$role = 'Responsable';
$display_name = 'Responsable';
$capabilities = get_role( 'administrator' )->capabilities;

add_role( $role, $display_name, $capabilities );

$user = wp_get_current_user();
if (is_user_logged_in()) {
  if ($user->roles[0] === 'Responsable') {
    add_action( 'admin_menu', 'remove_menu_pages' );
  }
}

function remove_menu_pages() {
  remove_menu_page('tools.php');
  remove_menu_page('edit-comments.php');
  remove_menu_page('edit.php?post_type=acf');
  remove_menu_page('edit.php?post_type=acf-field-group' );
  remove_menu_page('users.php');
  remove_menu_page('themes.php');
  remove_menu_page('plugins.php');
  remove_menu_page('options-general.php');
}
