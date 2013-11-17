<?php
function jk_add_admin_menu()
{
    add_menu_page( 'Create e주보' , 'Create e주보', 'manage_options' , 'create-jubo', 'jb_display_pages' );       
}
?>