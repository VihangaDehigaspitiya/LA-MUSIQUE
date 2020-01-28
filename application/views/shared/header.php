<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
			integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
			crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
			integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
            crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<?php
	if(!$this->session->has_userdata('userDetails')){
		redirect(site_url().'/UserController');
	}
?>



<nav class="navbar center navbar-expand-lg fixed-top nav-bar-background p-0">

    <a class="navbar-brand text-white" href="<?php echo base_url() ?>index.php/PostController/home">
		<img src="<?php echo base_url()?>assets/images/logo_horizontal.png" width="150px">
	</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
	<div class="input-group col-sm-3 col-md-3 search-section">
		<input type="text" class="form-control search-input" placeholder="Search" name="srch-term" id="srch-term">
		<div class="input-group-btn search-input">
			<button  id="search_btn"  onclick="search()" class="btn btn-default pt-0"><i class="fas fa-search"></i></button>
		</div>
	</div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav nav-bar-right-icons">
			<li class="nav-item nav-item-icon <?= strpos(current_url(),"home") ? 'nav-item-selection' : 'nav-item-normal' ?>"><a class="nav-link" href="<?php echo base_url()?>index.php/PostController/home"><i class="fas fa-home navbar-icons"></i></a></li>
			<li class="nav-item nav-item-icon <?= strpos(current_url(),"userPostList") ? 'nav-item-selection' : 'nav-item-normal' ?>"><a class="nav-link" href="<?php echo base_url()?>index.php/PostController/userPostList"><i class="fas fa-clipboard navbar-icons""></i></a></li>
			<li class="nav-item nav-item-icon <?= strpos(current_url(), $this->session->userDetails['id']) || strpos(current_url(), "editUser") ? 'nav-item-selection' : 'nav-item-normal' ?>"><a class="nav-link" href="<?php echo base_url() ?>index.php/PostController/profile/<?php echo $this->session->userDetails['id'] ?>"><i class="fas fa-user-circle navbar-icons"></i></a></li>
            <li class="nav-item dropdown float-right">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
					<img class="img-circle rounded-circle" height="30px" width="30px" src="<?php echo base_url().'uploads/'.$this->session->imageUrl?>" alt="Card image cap">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url()?>index.php/UserController/editUser">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="logout()" href="<?php echo base_url() ?>index.php/UserController/logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div id="cover-spin"></div>
<div class="modal fade" id="exampleModalCenterSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitleSearch" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalCenterTitleSearch">Search Result</h6>
				<button type="button" onclick="closeModal()" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"  id="content-area">

			</div>
		</div>
	</div>
</div>
</html>

<script>
    $(document).ready(function(e) {
        $("#search_btn").attr("disabled", true);
        $("#srch-term").on("keyup", function () {
            if ($("#srch-term").val() == "") {
                $("#search_btn").attr("disabled", true);
            }else{
                $("#search_btn").attr("disabled", false);
			}
        })
    });

    var base_url = '<?php echo base_url(); ?>';
    var loggedUserId = '<?php echo $this->session->userDetails['id']; ?>';
	var pub_userId = '<?php echo $this->uri->segment(3); ?>';

    console.log(pub_userId);

	function search(){
        $( "#content-area" ).empty();
        // $("#content-area").html('');
	    var search_data = $("#srch-term").val();
        $.ajax({
            url: `${base_url}index.php/PostController/search`,
            method: 'POST',
            dataType: "json",
            data: {"keyWord" : search_data},
			headers :{
                'Access-Control-Allow-Origin' : '*',
			}
        }).done(function(data){
            console.log(data);
            if(data.length > 0){
                data.forEach(function(entry) {
                    if(entry.user_id != loggedUserId){
                        $("#content-area").append(`
                		<div class="row justify-content-md-center mb-3">
                			<div class="col-md-11">
                				<img class="img-circle rounded-circle follow-list-icon" src="${base_url}uploads/${entry.user_imageUrl}" alt="Card image cap">
                				<a class="m-0 pt-1 label-username" href="${base_url}index.php/PostController/profile/${entry.user_id}">${entry.user_firstName} ${entry.user_lastName}</a>
								<button value="${entry.followType}" id="${entry.user_id}"  class="btn btn-sm btn-primary float-right ${entry.followType}" onclick="followUsers(this)">${entry.followType}</button>
                				<p class="label-email">${entry.user_email}</p>
                			</div>
                		</div>`);
					}else{
					if(data.length == 1){
						$("#content-area").html('<p>No results were found.</p>');
					}
                        					}
                });
			}else{
        		$("#content-area").html('<p>No results were found.</p>');
			}
            $( ".modal-backdrop" ).show();
            $('#exampleModalCenterSearch').show();
            $('#exampleModalCenterSearch').modal('show');
        });
	}

	function followUsers(input){
	    if(input.value == "Following"){
	        if(localStorage.getItem(input.id)){
                $(`#${input.id}`).html('FollowBack');
                $(`#${input.id}`).attr('value', 'FollowBack');
            }else{
                $(`#${input.id}`).html('Follow');
                $(`#${input.id}`).attr('value', 'Follow');
            }
            $(`#${input.id}`).removeClass('Following');
            $(`#${input.id}`).addClass('Follow');
            $(`#${input.id}`).attr('id', input.id);
            unFollow(input.id);
		}else if(input.value == "Follow"){
            $(`#${input.id}`).removeClass('Follow');
            $(`#${input.id}`).addClass('Following');
            $(`#${input.id}`).html('Following');
            $(`#${input.id}`).attr('value', 'Following');
            $(`#${input.id}`).attr('id', input.id);
            follow(input.id);
		}else if(input.value == "FollowBack"){
	        localStorage.setItem(input.id,"FollowBack");
            $(`#${input.id}`).removeClass('FollowBack');
            $(`#${input.id}`).addClass('Following');
            $(`#${input.id}`).html('Following');
            $(`#${input.id}`).attr('value', 'Following');
            $(`#${input.id}`).attr('id', input.id);
            follow(input.id);
		}
        console.log("type", input.id);
	}

	function follow(userId){
        $.ajax({
            url: `${base_url}index.php/UserController/follow`,
            method: 'POST',
            dataType: "json",
            data: {"followingId" : userId},
            headers :{
                'Access-Control-Allow-Origin' : '*',
            }
        }).done(function(data){
            if(pub_userId === ""){
                console.log("UserId",loggedUserId);
                geFollowDetails(loggedUserId);
            }else{
                console.log("PUBUserId",pub_userId);
                geFollowDetails(pub_userId);
            }
            search();
		});
	}

	function unFollow(userId){
        $.ajax({
            url: `${base_url}index.php/UserController/unFollow`,
            method: 'POST',
            dataType: "json",
            data: {"unFollowedId" : userId},
            headers :{
                'Access-Control-Allow-Origin' : '*',
            }
        }).done(function(data){
            if(pub_userId === ""){
                geFollowDetails(loggedUserId);
            }else{
                geFollowDetails(pub_userId);
            }
            search();

        });
	}


	function geFollowDetails(userId){
        $.ajax({
            url: `${base_url}index.php/UserController/getFollowingCounts`,
            method: 'GET',
            dataType: "json",
            data: {"userId" : userId },
            headers :{
                'Access-Control-Allow-Origin' : '*',
            }
        }).done(function(data){
            if(pub_userId === ""){
                $("#no_followers").text(data.followers);
                $("#no_followings").text(data.following);
                $("#no_friends").text(data.friends);

			}else{
                $("#followers_count").text(data.followers);
                $("#following_count").text(data.following);
			}
        });
	}

	function logout(){
	    localStorage.clear();
	}

	function closeModal(){
        $( ".modal-backdrop" ).remove();
        $('#exampleModalCenterSearch').hide();
	}


</script>
