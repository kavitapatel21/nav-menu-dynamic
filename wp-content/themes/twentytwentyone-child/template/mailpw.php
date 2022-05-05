<?php
require_once("../../../../wp-config.php");
require_once("../../../../wp-load.php");

    $email = $_POST['email'];
	echo '<br>';
	echo 'phone no :'.  $_POST['phoneno'];
	echo '<br>';
	echo 'referencecode :'.  $_POST['referencecode'];
	echo '<br>';
	echo 'firstname :'.  $_POST['firstname'];
	echo '<br>';
	echo 'lastname :'.  $_POST['lastname'];
	echo '<br>';
	echo 'username :'.  $_POST['username'];
	echo '<br>';
	echo 'referenceid :'.  $_POST['referenceid'];
	echo '<br>';


    global $wpdb;
    global $wpdb;
	$post= $wpdb->get_results("SELECT * FROM wp_users WHERE user_email='$email'");
	//echo "<pre>";
	//print_r($post[0]->user_pass);
	//echo "</pre>";
    $pw=$post[0]->user_pass;
   // echo $wpdb->last_result;
	$subject = "Username & Password";
    $txt= "Username : ".$_POST['username'];
	echo '<br>';
    //echo $txt;
	$txt.= "Password :  $pw";
	$to = $_POST['email'];
   // echo $to;
	$headers = array('Content-Type: text/plain; charset=UTF-8','From:<kavita@plutustec.com>');
	wp_mail( $to, $subject, $txt, $headers );	

?>