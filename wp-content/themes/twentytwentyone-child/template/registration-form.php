<?php 
/**
 * Template Name:   registration-form
 * Template Post Type:post,page,my-post-type;
 */
get_header();
?>
<?php
 $rnd = rand(1,100000);;
//echo $rnd;
?>
<div class="container">
	<div class="registration mx-auto d-block w-100">
		<div class="page-header text-center">
			<h1>Registration-Form</h1>
		</div>
		<form id="registration-form" action="upload.php" method="post" class="" name="registration-form" enctype="multipart/form-data">
			<fieldset>
				<div class="form-group">
					<label for="firstname">FirstName </label>
					<input type="text" class="form-control" id="firstname" name="firstname">
				</div>
                <div class="form-group">
					<label for="lastname">LastName </label>
					<input type="text" class="form-control" id="lastname" name="lastname">
				</div>
                <div class="form-group">
					<label for="email">Email Address </label>
					<input type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="username">Username </label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="form-group">
					<label for="phoneno">Phone No </label>
					<input type="text" class="form-control" id="phoneno" name="phoneno">
				</div>
				<div class="form-group">
					<label for="referenceid">Reference Id </label>
					<input type="text" class="form-control" id="referenceid" name="referenceid">
				</div>
				<div class="form-group">
					<label for="documnet">Document Uploaded</label><br>
					Idproof   :    <input type="file" name="idproof" id="idproof">
					Passbook  :   <input type="file" name="passbook" id="passbook">
					Pancard   :    <input type="file" name="pancard" id="pancard">
				</div> 
				<div class="d-flex justify-content-between align-items-center">
					<div class="form-group d-flex justify-content-start">
						<button type="button" class="btn btn-primary" name="register" id="btn-register">Register</button>
					</div>
				</div>
				
					<input type="hidden" class="form-control" id="referencecode" name="referencecode" value="<?php echo $rnd; ?>">
			
			</fieldset>
		</form>
	</div>
</div>
<script>
$("#registration-form").validate({
        rules: {
firstname: {
required: true
},
lastname: {
required: true
},
username: {
required: true
},
email: {
required: true,
email: true,
},
phoneno: {
required: true,
minlength: 10,
maxlength: 10,
number: true
},
},
messages: {
    firstname: 'Please enter firstname.',
    lastname: 'Please enter lastname.',
    username: 'Please enter username.',
    email: {
          required: 'Please enter email address.',
          email: 'Please enter a valid email address.',
          
        },
        phoneno: {
          required: 'Please enter phoneno.',
          rangelength: 'phoneno should be 10 digit number.'
        },
      },
});
 // Save user 
 $('#btn-register').click(function(){
    var form =  $("#registration-form");
    if (form.valid()) {
		var firstname = $('#firstname').val().trim();
		var lastname = $('#lastname').val().trim();
        var username = $('#username').val().trim();
		var email = $('#email').val().trim();
		var referencecode = $('#referencecode').val().trim();
		var referenceid = $('#referenceid').val().trim();
		var phoneno = $('#phoneno').val().trim();
                    // AJAX request
                    $.ajax({
                    type: "POST",
					data: {
						firstname : firstname,
						lastname : lastname,
						username : username,
						email : email,
						phoneno : phoneno,
						referencecode : referencecode,
						referenceid : referenceid,
							}, 
                    url: "<?php echo get_stylesheet_directory_uri();?>/template/mailpw.php",
                   // dataType: 'json',
                    success: 
                    function(data) {
                        console.log("success");
  }
});
                }
                
            });    
</script>
<?php
if(isset($_POST['idproof'])){
	$my_folder = "upload/";
if (move_uploaded_file($_FILES['idproof']['tmp_name'], $my_folder . $_FILES['idproof']['name'])) {
    echo 'Received file' . $_FILES['idproof']['name'] . ' with size ' . $_FILES['idproof']['size'];
} else {
    echo 'Upload failed!';

    var_dump($_FILES['idproof']['error']);
}
}
?>
