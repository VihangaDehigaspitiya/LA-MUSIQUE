<html>
<head>
	<title>LA MUSIQUE</title>
</head>
<body>
<div class="row justify-content-md-center">
	<div class="col-md-6 text-center">
		<div class="row content-row">
			<?php foreach ($posts as $post) {
				echo '<div class="col-md-12 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <img class="img-circle rounded-circle post-profile-pic" src="' . base_url() . 'uploads/' . $userDetails->getImageUrl() . '"
                            alt="Card image cap">
                           <div class="dropdown post-remove-dropdown">
							  <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v"></i>
							  </a>
							  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
							  	<a class="dropdown-item" id="' . $post->getPostId() . '" onclick="editPost(this)">Edit</a>
								<a class="dropdown-item" href="' . base_url() . 'index.php/PostController/removePost/' . $post->getPostId() . '">Remove</a>
							  </div>
							</div>
                        <h6 class="post-user-name">' . $userDetails->getFirstName() . ' ' . $userDetails->getLastName() . '</h6>
                        <small class="text-muted cat">
                            <i class="far fa-clock text-info"></i> ' . $post->getUpdatedAt() . '
                        </small>
                    </div>';
				echo $post->getDescription()['text'];
				echo '<div class="row">' . $post->getDescription()['images'] . '</div>';
				echo '</div>
            </div>';
			} ?>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	 aria-hidden="true">
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?php echo base_url()?>index.php/PostController/updatePost" method="post">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" name="postId" id="postId" hidden>
						<textarea  rows="6" class="form-control"name="content" id="postVal"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<script>
    var img_urls = '<?php echo json_encode($this->session) ?>';
</script>
<script src="<?php echo base_url() ?>assets/js/slider.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';

    function editPost(element) {
        $.ajax({
            url: `${base_url}index.php/PostController/getPostDetails`,
            method: 'GET',
            dataType: "json",
            data: {"postId": element.id},
            headers :{
                'Access-Control-Allow-Origin' : '*',
            }
        }).done(function (data) {
            if (data) {
                $("#postId").val(element.id);
                $("#postVal").val(data.description);
                $('#exampleModal').modal('show');
            }
        });
    }
</script>
