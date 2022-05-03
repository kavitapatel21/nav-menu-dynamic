<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}

function wpb_admin_account(){
    $user = $_POST['username']; 
    $fname = $_POST['firstname'];
    $email = $_POST['email'];
   // echo 'email:'.$email;
    //$pass = $_POST['password'];
     //print_r($_POST);
    
    if ( !email_exists($email ) ) {
    $user_id = wp_create_user(  $user, $fname, $email);
    $user = new WP_User( $user_id );
    $user->set_role( 'customer' );
    }
    //if( !is_wp_error( $user_id) ) {
        //if ($_POST['referenceid']) { 
            //echo $_POST['referenceid'];
           // $phone = mysql_real_escape_string($_POST['referenceid']);
           $reference=$_POST['referenceid'];
        update_user_meta($user_id, 'reference', esc_attr( $_POST['referenceid'] ) ); 
        }
    
   // }
    add_action('init', 'wpb_admin_account');
    

//Add column on users admin panel
function new_modify_user_table( $column ) {
    $column['referal'] = 'Referal';
    $column['reference'] = 'Reference';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

