<?php 
/**
 * Template Name:   registration-form
 * Template Post Type:post,page,my-post-type;
 */
get_header();
?>
<div class="container">
	<div class="registration mx-auto d-block w-100">
		<div class="page-header text-center">
			<h1>Registration-Form</h1>
		</div>
		<form id="registration-form" action="" method="post" class="" enctype="multipart/form-data" name="registration-form">
			<fieldset>
				<div class="form-group">
					<label for="exampleInputFirstName">FirstName </label>
					<input type="text" class="form-control" id="firstname" name="firstname">
				</div>
                <div class="form-group">
					<label for="exampleInputLastName">LastName </label>
					<input type="text" class="form-control" id="lastname" name="lastname">
				</div>
                <div class="form-group">
					<label for="exampleInputEmail1">Email Address </label>
					<input type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="exampleInputUserName">Username </label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="form-group">
					<label for="exampleInputPhoneNo">Phone No </label>
					<input type="text" class="form-control" id="phoneno" name="phoneno">
				</div>
				<div class="form-group">
					<label for="exampleInputReferenceId">Reference Id </label>
					<input type="text" class="form-control" id="referenceid" name="referenceid" onclick="Random()">
				</div>
				<div class="d-flex justify-content-between align-items-center">
					<div class="form-group d-flex justify-content-start">
						<button type="button" class="btn btn-primary" name="register" id="btn-register">Register</button>
					</div>
				</div>
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
        var username = $('#username').val().trim();
		var email = $('#email').val().trim();
                    // AJAX request
                    $.ajax({
                    type: "POST",
					data: {
						username : username,
						email : email,
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


  function Random() {
        var rnd = Math.floor(Math.random() * 1000000000);
        document.getElementById('referenceid').value = rnd;
    }
</script>
