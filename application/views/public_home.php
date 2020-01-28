<html>
<head>
	<title>LA MUSIQUE</title>
</head>
<body>
<?php
$this->load->view('shared/alerts');
?>
<div class="row justify-content-md-center">
    <div class="col-md-6 text-center">
        <div class="row body-content">
            <div class="col-md-4">
                <img class="img-circle rounded-circle" width="130px" height="130px" src="<?php echo base_url().'uploads/'.$userDetails->getImageUrl()?>" alt="Card image cap">
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 p-0">
                        <p class="text-left"><b class="highlight-font"><?php echo ''.$userDetails->getFirstName().' '.$userDetails->getLastName().'';?></b></p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3 p-0">
						<a  href="<?php echo base_url()?>index.php/PostController/userPostList"  class="follow_data_btn" ><p class="text-left"><b class="highlight-font"><?php echo $noOfPosts?></b> posts</p></a>
                    </div>
                    <div class="col-md-3 p-0">
                        <a data-toggle="modal" href="" data-target="#exampleModalCenter" class="follow_data_btn" name="followers"><p class="text-left"><b class="highlight-font" id="no_followers"><?php echo $noOfFollowing['followers']?></b> followers</p></a>
                    </div>
                    <div class="col-md-3 p-0">
						<a data-toggle="modal" href="" data-target="#exampleModalCenter" class="follow_data_btn" name="following"><p class="text-left"><b class="highlight-font" id="no_followings"><?php echo $noOfFollowing['following']?></b> following</p></a>
                    </div>
					<div class="col-md-3 p-0">
						<a data-toggle="modal" href="" data-target="#exampleModalCenter" class="follow_data_btn" name="friends"><p class="text-left"><b class="highlight-font" id="no_friends"><?php echo $noOfFollowing['friends']?></b> friends</p></a>
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
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header text-left">Create post</div>
                    <div class="card-body">
                        <form method="post" action="<?php echo base_url()?>index.php/PostController/createPost" enctype="multipart/form-data">
                            <section>
                                <div class="text">
                                    <img class="img-circle rounded-circle" src="<?php echo base_url().'uploads/'.$userDetails->getImageUrl()?>" alt="Card image cap">
                                    <textarea name="post_description" placeholder="what's in your mind?"></textarea>
                                </div>
                            </section>
                            <div class="form-group">
                                <button class="btn post-btn btn-primary float-right">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php foreach ($posts as $post){
				echo '<div class="col-md-12 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-header">
						<a href="'.base_url().'index.php/PostController/profile/'.$post->getId().'"><img class="img-circle rounded-circle post-profile-pic" src="'.base_url().'uploads/'.$post->getImageUrl().'"
                            alt="Card image cap"></a>
                            <p class="text-left m-0 post-user">
                        <a class="post-user-name-link" href="'.base_url().'index.php/PostController/profile/'.$post->getId().'" >'.$post->getFirstName().' '.$post->getLastName().'</a>
							</p>
                        <p><small class="text-muted cat">
                            <i class="far fa-clock text-info"></i> '.$post->getUpdatedAt().'
                        </small></p>
                    </div>
                    '.$post->getDescription()['text'].'
				    <div class="row">'.$post->getDescription()['images'].'</div>
                </div>
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
