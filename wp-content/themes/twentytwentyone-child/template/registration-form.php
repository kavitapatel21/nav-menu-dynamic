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
		<form id="registration-form" method="post" name="registration-form" enctype="multipart/form-data">
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
					
					Adharcard   :    <input type="file" name="adharcard" id="adharcard"><br>
					Pancard  :    <input type="file" name="pancard" id="pancard"><br>
					Photo  :    <input type="file" name="photo" id="photo"><br>
					
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
		//var data= form.serialize();
		var firstname = $('#firstname').val().trim();
		var lastname = $('#lastname').val().trim();
        var username = $('#username').val().trim();
		var email = $('#email').val().trim();
		var referencecode = $('#referencecode').val().trim();
		var referenceid = $('#referenceid').val().trim();
		var phoneno = $('#phoneno').val().trim();
		var fd = new FormData();
        var adharcard = $('#adharcard')[0].files;     
		var pancard = $('#pancard')[0].files;     
		var photo = $('#photo')[0].files;     
           fd.append('adharcard',adharcard[0]);
		   fd.append('pancard',pancard[0]);
		   fd.append('photo',photo[0]);
		   fd.append('firstname',firstname);
		   fd.append('lastname',lastname);
		   fd.append('email',email);
		   fd.append('username',username);
		   fd.append('referenceid',referenceid);
		   fd.append('referencecode',referencecode);
		   fd.append('phoneno',phoneno);
                    // AJAX request
                    jQuery.ajax({
                    type: "POST",	      
                    url: "<?php echo get_stylesheet_directory_uri();?>/template/mailpw.php",
					data: fd,
					contentType: false, 
					processData: false,
                   // dataType: 'json',
                    success: 
                    function(data) {
                        console.log("success");
  }
});
                }
                
            });    
              
</script>





