<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}

//create admin user on submit registration form
function wpb_admin_account(){
    $user = $_POST['username']; 
    $email = $_POST['email'];
    $pw='';
    $referenceid = $_POST['referenceid'];
    $referencecode = $_POST['referencecode'];
    $phoneno = $_POST['phoneno'];
    //echo 'phn:' .$phoneno;
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    if ( !username_exists( $user ) && !email_exists($email ) ) {
    $user_id = wp_create_user(  $user, $pw, $email);
    $user = new WP_User( $user_id );
    $user->set_role( 'customer' );

    //Add data in wp_usermeta table
    update_user_meta($user_id, 'referencecode', $referencecode);
    update_user_meta($user_id, 'referenceid',$referenceid);
    update_user_meta($user_id, 'phone', $phoneno);
    update_user_meta($user_id, 'firstname',  $firstname);
    update_user_meta($user_id, 'lastname',  $lastname);
    update_user_meta($user_id, 'username',  $user);
    update_user_meta($user_id, 'email',   $email);
    update_user_meta(1, 'referencecode',   12345);
    }
    }
    add_action('init', 'wpb_admin_account');


  

   // fetching the data from usermeta table
add_filter('manage_users_custom_column',  'add_data_to_custom_users_columns', 10, 3);
function add_data_to_custom_users_columns( $value, $column_name, $user_id ) {
    global $wpdb;  
if( 'referencecode' == $column_name ) {
        if( $reference = get_user_meta( $user_id, 'referencecode', true ) ) {
            $value = '<span>' . $reference . '</span>';
        } else {
            $value = '<span><em>N/a</em></span>';
        }
    }
   if( 'userid' == $column_name ) {
       if( $usermail = get_user_meta( $user_id, 'email', true ) ) {
           $user_query = $wpdb->get_results("SELECT user_id FROM wp_usermeta WHERE (meta_key = 'email' AND meta_value = '".  $usermail."')");
           foreach ($user_query as $user) {
                $id=$user->user_id; // the the user id
            }
            $value = '<span>' .$id. '</span>';
        } else {
            $value = '<span><em>N/a</em></span>';
        }
    }
    if( 'referal' == $column_name ) {
        if( $referenceid = get_user_meta( $user_id, 'referenceid', true ) ) {
            $value = '<span>' . $referenceid . '</span>';
        } else {
            $value = '<span><em>N/a</em></span>';
        }
    }
    return $value; 

}
    

//Add column on users admin panel
function new_modify_user_table( $column ) {
    $column['referal'] = 'Referral Code';
   // $column['reference'] = 'Reference Code';
    $column['referencecode'] = 'Reference code';
    $column['userid'] = 'User Id';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

