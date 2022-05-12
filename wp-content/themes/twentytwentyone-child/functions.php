<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<?php 
//Working code without page reload
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
    $adharcard = $_FILES['adharcard']['name'];
    //echo $_FILES['adharcard']['name'];
    $pancard = $_FILES['pancard']['name'];
    $photo = $_FILES['photo']['name'];
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
    update_user_meta($user_id, 'adharcard',  $adharcard);
    update_user_meta($user_id, 'pancard',  $pancard);
    update_user_meta($user_id, 'photo',  $photo);
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

add_action('admin_menu', 'custom_menu');
function custom_menu() { 
    add_menu_page( 
        'Page Title', 
        'Users Listing', 
        'edit_posts', 
        'menu_slug', 
        'showdata', 
        'dashicons-media-spreadsheet' 
    );
  }
 //show all saved record
function showdata()
{ ?>
<div class="container" style="margin-top: 20px;">
  <div class="row">
  <?php
	$count_args  = array(
        'role'      => 'Customer',
    );
    $user = get_users(  $count_args );
    $total_rows = count($user);
    if (!isset ($_GET['paged']) ) {  
        $page_number = 1;  
    } else {  
        $page_number = $_GET['paged'];   
    } 
    $limit = 3;  // variable to store the number of rows per page  
    $offset = ($page_number - 1) * $limit;  // get the initial page number
    $total_pages = ceil ($total_rows / $limit);   // get the required number of pages

    $args  = array(
        'role'      => 'Customer',
        'number'    => $limit,
        'offset'    => $offset,
    ); 
    $users = get_users( $args );
    ?>
       <div class="col-12">       
        <input type="text" class="field" name="search-meta" id="search-meta" placeholder="Search" />
        <input type="button" name="search" value="Search" class="btn-search">
        <div id="datafetch">
        </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Lastname</th>
            <th scope="col">E-mail</th>
            <th scope="col">Phone</th>
            <th scope="col" colspan="3">Action</th>
          </tr>
        </thead>
        <?php 
        $a=1;
        foreach($users as $user){
         $user_info=(get_user_meta ( $user->ID));
          $name =  $user_info['firstname'][0];
          $lastname =  $user_info['lastname'][0];
          $email = $user_info['email'][0];
          $phone = $user_info['phone'][0];
          $adharcard = $user_info['adharcard'][0];
          $pancard = $user_info['pancard'][0];
          $photo = $user_info['photo'][0];
            ?>
        <tbody>
          <tr> 
            <td><?php echo $a; ?></td>
            <td><?php echo $name;?></td>
            <td><?php echo $lastname;?></td>
            <td><?php echo $email;?></td>
            <td><?php echo $phone;?></td>
            <td>
                    <a href="<?php echo get_stylesheet_directory_uri();?>/template/upload/<?php echo $adharcard;?>" download="aadharcard">
                    <i class="fa fa-id-card" aria-hidden="true">
                    </i>
                    </a>
                    <a href="<?php echo get_stylesheet_directory_uri();?>/template/upload/<?php echo $pancard;?>" download="pancard">
                    <i class="fa fa-address-book" aria-hidden="true">
                    </i>
                    </a>
                    <a href="<?php echo get_stylesheet_directory_uri();?>/template/upload/<?php echo $photo;?>" download="photo">
                    <i class="fa fa-id-card-o" aria-hidden="true">
                    </i>
                    </a>   
            </td>
          </tr>
          <?php $a++; }  ?>
          </tbody>
      </table>
    </div>  
  </div>
</div> 
<?php
$tag = '<div class="pagination">' ;
$tag .= paginate_links( array(
        'base'              => add_query_arg('paged','%#%'),
        'format'            => '',
        'current'           => $page_number,
        'total'             =>  $total_pages,
        'prev_next'         => True,
        'prev_text'         => __('«'),
        'next_text'         => __('»'),
        'before_page_number' => '<span class="pagenum" style="color:blue;">',
        'after_page_number'  => '</span>'
    ) );
$tag .= '</div>';
echo $tag; 
}
// add the ajax fetch js
add_action( 'admin_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
	<script type="text/javascript">
	jQuery('input[name="search"]').on('click', function(){

	    jQuery.ajax({
	        url : '<?php echo admin_url('admin-ajax.php'); ?>',
	        type : 'POST',
	        data : { 
	        	action : 'data_fetch', 
	        	search : jQuery('#search-meta').val(),
	        },
	        success: function(data) {
                jQuery('#datafetch').html( data );
	        }
	    });

	});
	</script>
 <?php
}


// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
//add_action('init','data_fetch');
function data_fetch(){
    $search = $_POST['search'];
    //echo 'search:'. $search;
if ($search){
    //echo "hi";
$args  = array(
    'role'      => 'Customer',
    's' => '*'.$search.'*',
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key'     => 'firstname',
            'value'   => $search,
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'lastname',
            'value'   => $search,
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'email',
            'value'   => $search,
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'phone',
            'value'   => $search,
            'compare' => 'LIKE'
        ),   
    )
); 
$users = get_users( $args );
}
else {
$args  = array(
    'role'      => 'Customer',
); 
$users = get_users( $args );
}   
?>
   <div class="col-12">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Lastname</th>
        <th scope="col">E-mail</th>
        <th scope="col">Phone</th>
        <th scope="col" colspan="3">Action</th>
      </tr>
    </thead>
    <?php 
    $a=1;
    foreach($users as $user){
     $user_info=(get_user_meta ( $user->ID));
      $name =  $user_info['firstname'][0];
      $lastname =  $user_info['lastname'][0];
      $email = $user_info['email'][0];
      $phone = $user_info['phone'][0];
      $adharcard = $user_info['adharcard'][0];
      $pancard = $user_info['pancard'][0];
      $photo = $user_info['photo'][0];
        ?>
    <tbody>
      <tr> 
        <td><?php echo $a; ?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $lastname;?></td>
        <td><?php echo $email;?></td>
        <td><?php echo $phone;?></td>
        <td>
                <a href="<?php echo get_stylesheet_directory_uri();?>/template/upload/<?php echo $adharcard;?>" download="aadharcard">
                <i class="fa fa-id-card" aria-hidden="true">
                </i>
                </a>
                <a href="<?php echo get_stylesheet_directory_uri();?>/template/upload/<?php echo $pancard;?>" download="pancard">
                <i class="fa fa-address-book" aria-hidden="true">
                </i>
                </a>
                <a href="<?php echo get_stylesheet_directory_uri();?>/template/upload/<?php echo $photo;?>" download="photo">
                <i class="fa fa-id-card-o" aria-hidden="true">
                </i>
                </a>   
        </td>
      </tr>
      <?php $a++; }  ?>
      </tbody>
  </table>
</div>  
</div>
</div> 
<?php
die();
}
?>





