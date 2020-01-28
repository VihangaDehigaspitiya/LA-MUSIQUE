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
				<h4 class="text-center">Forgot your password</h4>
				<p class="text-center">Please enter your email</p>
				<div class="row justify-content-md-center">
					<div class="col-md-9">
						<form method="post" onSubmit="return validation();" action="<?php echo base_url()?>index.php/UserController/forgotPassword" enctype="multipart/form-data">
							<div class="form-group mb-3">
								<label for="validationCustom03">Email</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-envelope"></i></span>
									</div>
									<input type="email" class="form-control custom-input" name="validationCustomEmail" id="validationCustomEmail" placeholder="Email" aria-describedby="inputGroupPrepend">
									<div id="email_check" class="container p-0"></div>
									<div class="invalid-feedback" id="email_empty">
										Please provide a valid email.
									</div>
								</div>
							</div>
							<div class="form-group">
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
        if ($("#validationCustomEmail").val() == "") {
            $("#validationCustomEmail").addClass('is-invalid');
            return false;
        } else {
            $("#validationCustomEmail").removeClass('is-invalid');
            $("#validationCustomEmail").addClass('is-valid');
        }
    }

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $(document).ready(function(e) {
        $("#validationCustomEmail").on("keyup", function() {
            if ($("#validationCustomEmail").val() == "") {
                $("#validationCustomEmail").addClass('is-invalid');
                $("#email_empty").show();
                $("#email_check").html('');
                return false;
            } else {
                if (validateEmail($("#validationCustomEmail").val())) {
                    $("#validationCustomEmail").removeClass('is-invalid');
                    $("#validationCustomEmail").addClass('is-valid');
                    $("#email_check").html('');

                } else {
                    $("#validationCustomEmail").removeClass('is-valid');
                    $("#validationCustomEmail").addClass('is-invalid');
					$("#email_empty").hide();
                    $("#email_check").html('<div id="cpw_confirm_msg_email" class="invalid-feedback">@ and . is missing in the email address!</div>');
                    $("#cpw_confirm_msg_email").css("display", "block");
                }
            }

        });
    })
</script>


