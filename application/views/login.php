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
<?php
$this->load->view('shared/alerts');
?>
<div class="row justify-content-md-center mt-4">
	<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 login-wrapper">
		<div class="card user-management-card">
			<img class="logo-img-top img-circle rounded-circle" src="<?php echo base_url() ?>assets/images/logo_vertical.png" alt="Card image cap">
			<div class="card-body" style="padding-top:60px;">
				<h4 class="text-center">Login</h4>
				<p class="text-center">Please enter your email and password</p>
				<?php if($this->session->flashdata('errorMsg')) {
					echo '<div class="row justify-content-md-center">
					<div class="alert alert-danger text-center col-md-9" role="alert">
						'.$this->session->flashdata('errorMsg').'
					</div>
				</div>';
				}?>
				<div class="row justify-content-md-center">
					<div class="col-sm-9 col-md-9">
						<form method="post" onSubmit="return validation();" action="<?php echo base_url()?>index.php/UserController/login" enctype="multipart/form-data">
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
							<div class="form-group mb-3">
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
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
							<div class="form-group">
								<p class="text-center"><a href="<?php echo base_url()?>index.php/UserController/linkForgotPw">Forgot Password</a></p>
							</div>
							<div class="form-group">
								<p class="text-center">Don't have an account ? <a href="<?php echo base_url()?>index.php/UserController/linkSignUp">Sign Up</a></p>
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
        if ($("#validationCustomPassword, #validationCustomEmail").val() == "") {
            $("#validationCustomPassword, #validationCustomEmail").addClass('is-invalid');
            return false;
        } else if (($("#validationCustomPassword").val() == "")) {
            $("#validationCustomPassword").addClass('is-invalid');
            return false;
		}else{
            $("#validationCustomPassword, #validationCustomEmail").removeClass('is-invalid');
            $("#validationCustomPassword, #validationCustomEmail").addClass('is-valid');
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
        $("#validationCustomPassword").on("keyup", function() {
            if ($("#validationCustomPassword").val() == "") {
                $("#validationCustomPassword").addClass('is-invalid');
                return false;
            } else {
                $("#validationCustomPassword").removeClass('is-invalid');
                $("#validationCustomPassword").addClass('is-valid');
            }
        });
    })
</script>


