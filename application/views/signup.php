<!DOCTYPE html>
<html lang="en">

<head>
	<title>LA MUSIQUE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body class="back-content">
<?php
$this->load->view('shared/alerts');
?>
<div class="row justify-content-md-center">
	<div class="col-md-6 signup-wrapper">
		<div class="card user-management-card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-5 logo-container">
						<img src="<?php echo base_url()?>assets/images/logo_vertical.png" class="logo-vertical">
					</div>
					<!-- <div class="vl"></div> -->
					<div class="col-md-7 p-0">
						<div class="row justify-content-md-center">
							<div class="col-md-9">
								<h4 class="text-center">Sign Up</h4>
								<form method="POST" action="<?php echo base_url()?>index.php/UserController/register" onSubmit="return validation();" enctype="multipart/form-data">
									<div class="form-group mb-2">
										<label for="validationCustom01">First Name</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
											</div>
											<input type="text" class="form-control custom-input" name="validationCustomFirstName" id="validationCustomFirstName" placeholder="FirstName" aria-describedby="inputGroupPrepend">
											<div class="invalid-feedback">
												Please provide a valid first name.
											</div>
										</div>
									</div>
									<div class="form-group mb-2">
										<label for="validationCustom02">Last Name</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
											</div>
											<input type="text" class="form-control custom-input" name="validationCustomLastName" id="validationCustomLastName" placeholder="LastName" aria-describedby="inputGroupPrepend">
											<div class="invalid-feedback">
												Please provide a valid last name.
											</div>
										</div>
									</div>
									<div class="form-group mb-2">
										<label for="validationCustom03">Email</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-envelope"></i></span>
											</div>
											<input type="email" class="form-control custom-input" name="validationCustomEmail" id="validationCustomEmail" placeholder="Email" aria-describedby="inputGroupPrepend">
											<div id="email_check" class="container p-0"></div>
											<div class="invalid-feedback">
												Please provide a valid email.
											</div>
										</div>
									</div>
									<div class="form-group mb-2">
										<label for="validationCustom04">Password</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock"></i></span>
											</div>
											<input type="password" class="form-control custom-input" name="validationCustomPassword" id="validationCustomPassword" placeholder="Password" aria-describedby="inputGroupPrepend">
											<div class="invalid-feedback">
												Please provide a valid password.
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
									<div class="form-group pt-3">
										<button class="btn btn-primary btn-block" type="submit">Next</button>
									</div>
								</form>
							</div>
						</div>
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
        if ($("#validationCustomFirstName, #validationCustomLastName, #validationCustomPassword, #validationCustomConfirmPassword, #validationCustomEmail").val() == "") {
            $("#validationCustomFirstName, #validationCustomLastName, #validationCustomPassword, #validationCustomConfirmPassword, #validationCustomEmail").addClass('is-invalid');
            return false;
        } else {
            $("#validationCustomFirstName, #validationCustomLastName, #validationCustomPassword, #validationCustomConfirmPassword, #validationCustomEmail").removeClass('is-invalid');
            $("#validationCustomFirstName, #validationCustomLastName, #validationCustomPassword, #validationCustomConfirmPassword, #validationCustomEmail").addClass('is-valid');
        }

    }

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $(document).ready(function(e) {
        $("#validationCustomFirstName").on("keyup", function() {
            if ($("#validationCustomFirstName").val() == "") {
                $("#validationCustomFirstName").addClass('is-invalid');
                return false;
            } else {
                $("#validationCustomFirstName").removeClass('is-invalid');
                $("#validationCustomFirstName").addClass('is-valid');
            }
        });
        $("#validationCustomLastName").on("keyup", function() {
            if ($("#validationCustomLastName").val() == "") {
                $("#validationCustomLastName").addClass('is-invalid');
                return false;
            } else {
                $("#validationCustomLastName").removeClass('is-invalid');
                $("#validationCustomLastName").addClass('is-valid');
            }
        });
        $("#validationCustomEmail").on("keyup", function() {
            if ($("#validationCustomEmail").val() == "") {
                $("#validationCustomEmail").addClass('is-invalid');
                return false;
            } else {
                $("#validationCustomEmail").removeClass('is-invalid');
                $("#validationCustomEmail").addClass('is-valid');
            }

            if (validateEmail($("#validationCustomEmail").val())) {
                $("#validationCustomEmail").removeClass('is-invalid');
                $("#validationCustomEmail").addClass('is-valid');
                $("#email_check").html('');

            } else {
                $("#validationCustomEmail").removeClass('is-invalid');
                $("#validationCustomEmail").addClass('is-valid');
                $("#email_check").html('<div id="cpw_confirm_msg_email" class="invalid-feedback">@ is missing in the email address!</div>');
                $("#cpw_confirm_msg_email").css("display", "block");
            }
        });
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
