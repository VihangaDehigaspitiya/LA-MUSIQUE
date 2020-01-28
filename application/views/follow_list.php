<html>
<body>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLongTitle"></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="content-area-follow">

			</div>
		</div>
	</div>
</div>
</body>
</html>
<script>
    var base_url = '<?php echo base_url(); ?>';
    $(document).on("click", ".follow_data_btn", function () {
        var type = $(this).attr('name');
        $.ajax({
            url: `${base_url}index.php/PostController/getFollowingList`,
            method: 'GET',
            dataType: "json",
            headers :{
                'Access-Control-Allow-Origin' : '*',
            }
        }).done(function(data){
            console.log(data);
            generateListContent(data, type);
        })
    });

    function generateListContent(data, follow_type){
        $("#content-area-follow").html('');
        if(follow_type === 'followers'){
            $(".modal-title").text('Followers');
            if(data.followedUsers.length > 0){
                data.followedUsers.forEach(function(entry) {
                    $("#content-area-follow").append(`
                		<div class="row justify-content-md-center mb-3">
                			<div class="col-md-11 ml-4">
                				<img class="img-circle rounded-circle follow-list-icon" src="${base_url}uploads/${entry.user_imageUrl}" alt="Card image cap">
                				<a class="m-0 pt-1 label-username" href="${base_url}index.php/PostController/profile/${entry.user_id}">${entry.user_firstName} ${entry.user_lastName}</a>
                				<p class="label-email">${entry.user_email}</p>
                			</div>
                		</div>`);
                });
            }else{
                $("#content-area-follow").html('<p>No folllowers to display</p>');
            }
        }else if(follow_type === 'following'){
            $(".modal-title").text('Following');
            if(data.followings.length > 0) {
                data.followings.forEach(function(entry) {
                    $("#content-area-follow").append(`
                		<div class="row justify-content-md-center mb-3">
                			<div class="col-md-11 ml-4">
                				<img class="img-circle rounded-circle follow-list-icon" src="${base_url}uploads/${entry.user_imageUrl}" alt="Card image cap">
                				<a class="m-0 pt-1 label-username" href="${base_url}index.php/PostController/profile/${entry.user_id}">${entry.user_firstName} ${entry.user_lastName}</a>
                				<p class="label-email">${entry.user_email}</p>
                			</div>
                		</div>`);
                });
            }else{
                $("#content-area-follow").html('<p>No followings to display</p>');
            }
        }else{
            $(".modal-title").text('Friends');
            if(data.friends.length > 0) {
                data.friends.forEach(function(entry) {
                    $("#content-area-follow").append(`
                		<div class="row justify-content-md-center mb-3">
                			<div class="col-md-11 ml-4">
                				<img class="img-circle rounded-circle follow-list-icon" src="${base_url}uploads/${entry.user_imageUrl}" alt="Card image cap">
                				<a class="m-0 pt-1 label-username" href="${base_url}index.php/PostController/profile/${entry.user_id}">${entry.user_firstName} ${entry.user_lastName}</a>
                				<p class="label-email">${entry.user_email}</p>
                			</div>
                		</div>`);
                });
            }else{
                $("#content-area-follow").html('<p>No followings to display</p>');
            }
        }
	}


</script>
