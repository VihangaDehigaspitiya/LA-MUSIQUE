<!DOCTYPE html>
<html lang="en">

<head>
	<title>LA MUSIQUE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
			integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
			crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
			integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
			crossorigin="anonymous"></script>
</head>
<body class="back-content">
<div class="row justify-content-md-center mt-4" style="padding-top:60px;">
	<div class="col-md-4 login-wrapper">
		<div class="card user-management-card">
			<div class="card-body">
				<h4 class="text-center">Change your password</h4>
				<p class="text-center">Please enter new password</p>
				<div class="row justify-content-md-center">
					<div class="col-md-9">
						<form method="post" onSubmit="return validation();" action="<?php echo base_url()?>index.php/UserController/passwordResetFromLink" enctype="multipart/form-data">
							<?php
							echo '<input type="text" name="userId" value="'.$userDetails->getId().'" hidden>
							<input type="text" name="email" value="'.$userDetails->getEmail().'" hidden>
							<input type="text" name="f_name" value="'.$userDetails->getFirstName().'" hidden>
							<input type="text" name="l_name" value="'.$userDetails->getLastName().'" hidden>';
							?>
							<div class="form-group mb-2">
								<label for="validationCustom04">Password</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock"></i></span>
									</div>
									<input type="password" class="form-control custom-input" name="validationCustomPassword" id="validationCustomPassword" placeholder="Password" aria-describedby="inputGroupPrepend">
									<div class="invalid-feedback">
										Please provide a valid email.
									</div>
								</div>
							</div>
							<div class="form-group mb-2">
								<label for="validationCustom05">Confirm Password</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-check-square"></i></span>
									</div>
									<input type="password" class="form-control custom-input" name="validationCustomConfirmPassword" id="validationCustomConfirmPassword" placeholder="ConfirmPassword" aria-describedby="inputGroupPrepend">
									<div id="cpw" class="container p-0"></div>
								</div>
							</div>
							<div class="form-group mt-3">
								<button type="submit" class="btn btn-primary btn-block">Submit</button>
							</div>
							<div class="form-group">
								<p class="text-left"><a href="<?php echo base_url()?>index.php/UserController">< Back to Login</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<script>
    function validation() {
        if ($("#validationCustomPassword, #validationCustomConfirmPassword").val() == "") {
            $("#validationCustomPassword, #validationCustomConfirmPassword").addClass('is-invalid');
            return false;
        } else {
            $("#validationCustomPassword, #validationCustomConfirmPassword").removeClass('is-invalid');
            $("#validationCustomPassword, #validationCustomConfirmPassword").addClass('is-valid');
        }

        if ($("#validationCustomPassword").val() != $("#validationCustomConfirmPassword").val()) {
            $("#validationCustomConfirmPassword").addClass('is-invalid');
            $("#cpw").html('<div id="cpw_confirm_msg" class="invalid-feedback">Password and confirm password not matched!</div>');
            $("#cpw_confirm_msg").css("display", "block");
            return false;
        }
    }


    $(document).ready(function(e) {
        $("#validationCustomPassword").on("keyup", function() {
            if ($("#validationCustomPassword").val() == "") {
                $("#validationCustomPassword").addClass('is-invalid');
                return false;
            } else {
                $("#validationCustomPassword").removeClass('is-invalid');
                $("#validationCustomPassword").addClass('is-valid');
            }
        });
        $("#validationCustomConfirmPassword").on("keyup", function() {
            if ($("#validationCustomConfirmPassword").val() == "") {
                $("#validationCustomConfirmPassword").addClass('is-invalid');
                return false;
            } else {
                $("#validationCustomConfirmPassword").removeClass('is-invalid');
            }

            if ($("#validationCustomPassword").val() == $("#validationCustomConfirmPassword").val()) {
                $("#validationCustomConfirmPassword").removeClass('is-invalid');
                $("#validationCustomConfirmPassword").addClass('is-valid');
                $("#cpw").html('');
            } else {
                $("#validationCustomConfirmPassword").addClass('is-invalid');
                $("#cpw").html('<div id="cpw_confirm_msg" class="invalid-feedback">Password and confirm password not matched!</div>');
                $("#cpw_confirm_msg").css("display", "block");
            }
        });
    });
</script>


