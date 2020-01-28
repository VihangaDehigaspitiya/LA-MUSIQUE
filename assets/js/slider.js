

function imageSlider(postId){
	$("#img-area").html('');
	var img_obj = JSON.parse(img_urls);
	if(img_obj.userdata[postId.id]){
		img_obj.userdata[postId.id].forEach(function(value, i) {
			if(i == 0){
				$("#img-area").append(`
                						<div class="carousel-item active">
                							<img class="d-block w-100" src="${value}" >
                						</div>
                               	`);
			}else{
				$("#img-area").append(`
                						<div class="carousel-item">
                							<img class="d-block w-100" src="${value}" >
                						</div>
                               	`);
			}
		});

		$('.bd-example-modal-lg').modal('show');

	}
}
