<!DOCTYPE html>
<html lang="en">

<head>
	<title>LA MUSIQUE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
			integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
			crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
			integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
			crossorigin="anonymous"></script>
</head>

<body class="back-content">
<div class="row justify-content-md-center">
	<div class="col-md-7 signup-wrapper">
		<div class="card user-management-card">
			<div class="card-body">
				<form method="POST" action="<?php echo base_url()?>index.php/UserController/addUersGenres" onSubmit="return validation();" enctype="multipart/form-data">
					<?php foreach($userDetails as $key => $val) {
						echo '<input type="text" value="'.$val.'" name="'.$key.'" hidden>';
					}
					?>
					<div class="row">
						<div class="col-md-4 logo-container">
							<div class="avatar-upload">
								<div class="avatar-edit">
									<input type='file' id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg"/>
									<label for="imageUpload"><i class="fas fa-pen"></i></label>
								</div>
								<div class="avatar-preview">
									<div id="imagePreview"
										 style="background-image: url(data:image/png;base64,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);">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8 p-0">
							<div class="row justify-content-md-center">
								<div class="col-md-9">
									<!--									<h1 class="text-center">Sign Up</h1>-->
									<div class="form-group mb-3">
										<label for="validationCustom01" class="pt-3">Select Genres</label>
										<div class="row">
											<?php
											foreach ($genreList as $item) {
												echo '<div class="col-md-3 pr-0 pt-2">
																<label class="block-check">
																	<div class="card hovereffect">
																		<img src="'.base_url().'/assets/images/' . $item->getImageUrl() . '" class="card-img-top" alt="...">
																		<input type="checkbox" name="genres[]" value="' . $item->getGenreId() . '">
																		<span class="checkmark"></span>
																		<div class="overlay">
																			<h3>' . $item->getName() . '</h3>
																		</div>
																	</div>
																</label>
															</div>';
											}
											?>
										</div>
										<div id="check_selection_msg" class="container p-0"></div>
									</div>
									<div class="form-group pt-2">
										<button class="btn btn-primary btn-block" type="submit">Register</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>

</html>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
				// $('#imageUpload').val(e.target.result);
				console.log(e.target.result);
            }
			console.log(input.files[0]);
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function () {
        readURL(this);
    });

    var check_arr = [];

    function validation() {
        if (check_arr.length === 0) {
            $("#check_selection_msg").html('<div id="check_confirm_msg" class="invalid-feedback">Please select one or more genres!</div>');
            $("#check_confirm_msg").css("display", "block");
            return false;
        } else {
            $("#check_selection_msg").html('');
        }
    }

    $("input[type='checkbox']").change(function () {
        if (this.checked) {
            check_arr.push(this.value)
        } else {
            check_arr.pop(this.value);
        }
        validation();
    });


</script>
