<html>
<head>
	<title>LA MUSIQUE</title>
</head>
<body>
<div id="cover-spin"></div>
<div class="row justify-content-md-center">
	<div class="col-md-6 text-center">
		<div class="row body-content">
			<div class="col-md-4">
				<img class="img-circle rounded-circle" width="130px" height="130px" src="<?php echo base_url().'uploads/'.$userDetails->getImageUrl()?>" alt="Card image cap">
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12 p-0">
						<p class="text-left card-userName">
							<b class="highlight-font"><?php echo ''.$userDetails->getFirstName().' '.$userDetails->getLastName().'';?></b>
							<?php if($userDetails->getId() != $this->session->userDetails['id']){
								echo '<button onclick="followUsersProfile(this)" value="'.$followType.'" id="'.$userDetails->getId().'" class="btn btn-primary btn-sm follow-btn '.$followType.'">'.$followType.'</buttton>';
							}?>

						</p>
					</div>

				</div>
				<div class="row">
					<div class="col-md-3 p-0">
						<p class="text-left"><b class="highlight-font"><?php echo $noOfPosts?></b> posts</p>
					</div>
					<div class="col-md-3 p-0">
						<p class="text-left"><b class="highlight-font" id="followers_count"><?php echo $noOfFollowing['followers']?></b> followers</p>
					</div>
					<div class="col-md-3 p-0">
						<p class="text-left"><b class="highlight-font" id="following_count"><?php echo $noOfFollowing['following']?></b> following</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 p-0">
						<p class="text-left"><?php echo $userDetails->getEmail()?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row pt-3">
			<?php foreach ($posts as $post){
				echo '<div class="col-md-12 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <img class="img-circle rounded-circle post-profile-pic" src="'.base_url().'uploads/'.$userDetails->getImageUrl().'"
                            alt="Card image cap">
                        <h6 class="post-user-name">'.$userDetails->getFirstName().' '.$userDetails->getLastName().'</h6>
                        <small class="text-muted cat">
                            <i class="far fa-clock text-info"></i> '.$post->getUpdatedAt().'
                        </small>
                    </div>';
				echo $post->getDescription()['text'];
				echo '<div class="row">'.$post->getDescription()['images'].'</div>';
				echo '</div>
            </div>';
			}?>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" id="img-area">

					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>

		</div>

	</div>
</div>


</body>
</html>
<script>
    var img_urls = '<?php echo json_encode($this->session) ?>';
</script>
<script src="<?php echo base_url()?>assets/js/slider.js"></script>
<script>

    function followUsersProfile(input){
        if(input.value == "Following"){
            $(`#${input.id}`).removeClass('Following');
            $(`#${input.id}`).addClass('Follow');
            $(`#${input.id}`).html('Follow');
            $(`#${input.id}`).attr('value', 'Follow');
            $(`#${input.id}`).attr('id', input.id);
            unFollowProfile(input.id);
        }else if(input.value == "Follow"){
            $(`#${input.id}`).removeClass('Follow');
            $(`#${input.id}`).addClass('Following');
            $(`#${input.id}`).html('Following');
            $(`#${input.id}`).attr('value', 'Following');
            $(`#${input.id}`).attr('id', input.id);
            followProfile(input.id);
        }else if(input.value == "FollowBack"){
            $(`#${input.id}`).removeClass('FollowBack');
            $(`#${input.id}`).addClass('Following');
            $(`#${input.id}`).html('Following');
            $(`#${input.id}`).attr('value', 'Following');
            $(`#${input.id}`).attr('id', input.id);
            followProfile(input.id);
        }
        console.log("type", input.id);
    }

    function followProfile(userId){
        $('#cover-spin').show(0)
        $.ajax({
            url: `${base_url}index.php/UserController/follow`,
            method: 'POST',
            dataType: "json",
            data: {"followingId" : userId},
            headers :{
                'Access-Control-Allow-Origin' : '*',
            }
        }).done(function(data){
            if(data == "Success"){
                // search();
                $('#cover-spin').hide(0);
                location.reload();
            }
        });
    }

    function unFollowProfile(userId){
        $('#cover-spin').show(0)
        $.ajax({
            url: `${base_url}index.php/UserController/unFollow`,
            method: 'POST',
            dataType: "json",
            data: {"unFollowedId" : userId},
            headers :{
                'Access-Control-Allow-Origin' : '*',
            }
        }).done(function(data){
            console.log(data);
            if(data == "Success"){
                // search();
                $('#cover-spin').hide(0);
                location.reload();
            }
        });
    }

</script>
