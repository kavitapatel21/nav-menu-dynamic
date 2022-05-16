<?php
//$adharcard = $_FILES['adharcard']['name'];
// echo 'filename:'.$adharcard;
//echo "<pre>";
//print_r($_POST);
//echo "<br>";
//echo "<pre>";
//print_r($_FILES);
//echo "<br>";
foreach ($_FILES as $file) {
	//echo $file['name']; 
	echo $file['name'] . '</br>';
	echo $file['tmp_name'] . '</br>';
	move_uploaded_file($file['tmp_name'], "upload/" . $file["name"]);
}


/**echo 'filename:'.$_FILES['file']['name'];
$target_path = "upload/";
$target_path = $target_path . basename( $_FILES['file']['name']); 
if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
   echo "The file ".  basename( $_FILES['file']['name'])."has been uploaded";        
} else{
   echo "There was an error uploading the file, please try again!";
} */
//die;


require_once("../../../../wp-config.php");
require_once("../../../../wp-load.php");

$email = $_POST['email'];
//echo '<br>';
//echo 'phone no :' .  $_POST['phoneno'];
//echo '<br>';
//echo 'referencecode :' .  $_POST['referencecode'];
//echo '<br>';
//echo 'firstname :' .  $_POST['firstname'];
//echo '<br>';
//echo 'lastname :' .  $_POST['lastname'];
//echo '<br>';
//echo 'username :' .  $_POST['username'];
//echo '<br>';
//echo 'referenceid :' .  $_POST['referenceid'];
//echo '<br>';


global $wpdb;
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $pw=substr(str_shuffle($chars),0,12);
	$password=md5($pw);
	
    $wpdb->update(
        $wpdb->users,
        array(
            'user_pass'           => $password,
            'user_activation_key' => '',
        ),
        array( 'user_email' => $email )
    );
$post = $wpdb->get_results("SELECT * FROM wp_users WHERE user_email='$email'");
//echo "<pre>";
//print_r($post[0]->user_pass);
//echo "</pre>";
//$pw = $post[0]->user_pass;
//$hash = wp_hash_password($pw);
echo 'password:'.$pw ;
// echo $wpdb->last_result;
$subject = "Username & Password";
$txt = "Username : " . $_POST['username'].'<br>';
//echo '<br>';
//echo $txt;
$txt .= "Password :  $pw";
$to = $_POST['email'];
// echo $to;
$headers = array('Content-Type: text/html; charset=UTF-8', 'From:<kavita@plutustec.com>');
wp_mail($to, $subject, $txt, $headers);
