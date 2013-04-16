<?php
include 'Views/topBar.php';
?>

<div>
	<h1>Upload a New Image</h1>
	<form  enctype="multipart/form-data" id="upload-new-image" action="javascript:void(0)">
		<input type="file" name="new-image" id="new-image" accept="image/*"></input>
	</form>
	<img src="" id="image-preview">
	<form method="post" action="">
		<input type="hidden" name="image-id" id="image-id" value="">
		<input type="hidden" name="image-path" id="image-path" value=""></input>
		<label for="image-title">Title:</label>
		<input type="text" name="image-title" id="image-title"></input><br />
		<label for="image-description">Description:</label>
		<textarea name="image-description" rows="10" id="image-description"></textarea><br />
		<input type="button" name="save"  class="save" value="Save Image"></input>
	</form>
</div>

<script type="text/javascript" src="../Views/js/file_upload.js"></script>
<script>
$(document).ready(function(){
	$('#image-preivew').hide();
	var basedir="<?php echo BASEDIR;?>";
	$("#new-image").live('change', function(){
		console.log('in upload');
		$('#upload-new-image').vPB({
			url: basedir+"Admin/?frontPage=uploadGalleriaImage",
			data: {output: 'json'},
			success: function(response){
				console.log('success');
				console.log(response);
				response = response.split('>');
				if(response.length>1){
					response = response[1].split('</pre');
					response = response[0];
				}else{
					response = response[0];
				}
				response = $.parseJSON(response);
				console.log(response);
				$('#image-preview').attr('src',basedir+response['imagePath']);
				$('#upload-new-image').hide();
				$('#new-image').val("");
				$('#image-preview').show();
			},
			error: function(){
				console.log('error');
			}
		}).submit();
	});
});
</script>