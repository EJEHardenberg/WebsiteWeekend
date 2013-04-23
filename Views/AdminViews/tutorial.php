<?php
require_once "Views/topBar.php";

function addHTTP($url){
	//Do we start with http://?
	if(preg_match('/^http:\/\//', $url)){
		return $url;
	}else{
		return 'http://' . $url;
	}
}

?>

<div class="tutorial">

<h2>Tutorials</h2>
<p>
	When in the course of Computer Science it becomes necessary to google 
	or search stack overflow, we often find tutorials. Sharing is caring, and
	sometimes we find cool things that we care about and want to share. Use
	the form below to submit your tutorials, we'll review it and if it's useful
	we'll post it below! Don't be shy! 
</p>
<form method="POST" action="<?= BASEDIR . 'Tutorial/?add=true'; ?>">
	<label for="url">URL</label><input type="text" name="url" />
	<label for="title">Title</label><input type="text" name="title" />
	<input type="submit" value="Help out!" />
</form>

<div id="tutorials">
	<ul>
		<?php
		if(isset($this->vars['tutorials'])){
			foreach ($this->vars['tutorials'] as $key => $cat) {
				echo '<li><ul class="tutCat"><h3>'.$key.'</h3>';
				foreach ($cat as $tutorial) {
					echo '<li><div> <span class="edit" rel="url" ref="'.$tutorial['id'].'">' . (urldecode($tutorial['url'])) . '</span><br/><span class="edit" rel="title" ref="'.$tutorial['id'].'">' . $tutorial['title'] . '</span><br/><span class="edit" rel="cat" ref="'.$tutorial['id'].'">'.$tutorial['cat'].'</span><br />Published:<input type="checkbox" class="publish" ref="'.$tutorial['id'].'" name="published" '. ($tutorial['published'] ? 'checked' : '') .'></div></li>';	
				}
				echo '</ul></li>';
			}	
		}else{
			echo '<li>No Tutorials! Why don\'t you submit one?</li>';
		}
		?>
	</ul>
</div>

</div>


<script>
	$('.publish').bind('click',function(){
		$.ajax({
			type: "POST",
			url:"<?= BASEDIR ?>Admin/?tutorial=publish",
			data: "id="+$(this).attr('ref')+"&pub="+$(this).is(':checked')+"&output=json",
			success: function(data){
				console.log(data);
			}
		});
	});
	$('.edit').bind('click',function(e){
		e.stopImmediatePropagation();
		e.preventDefault();
		var u = $(this).attr('rel');
		var id = $(this).attr('ref');
		
		//Make the input and add an ajax to it (remove any other ajax's first)
		$('.ajax').removeClass('ajax');  
		$(this).addClass('ajax');
		$(this).html(' <input id="editbox" rel="'+ u+'" ref="'+id+'" size="'+ $(this).text().length+'" type="text" value="' + $(this).text() + '">');  
		$('#editbox').focus();

	});
	$('.edit').keydown(function(event){  
    	if(event.which == 13){  
      		//We use the field to determine what we're updating and pass it's value along
      		$.ajax({    type: "POST",  
      					url:"<?= BASEDIR ?>Admin/?tutorial=edit",  
      					data: "id="+$(this).attr('ref')+"&up="+$(this).attr('rel')+"&data="+$('.ajax input').val()+"&output=json",
      					success: function(data){  
      						
      						console.log(data);
      						$('.ajax').html($('.ajax input').val());  
        					$('.ajax').removeClass('ajax');  
      						
       		}});  
    	}  
	    //Remove input box if they click outside of it
	    $('#editbox').live('blur',function(){  
	        $('.ajax').html($('.ajax input').val());  
	        $('.ajax').removeClass('ajax');  
		});
	});  
	//Remove input box if they click outside of it
	$('#editbox').live('blur',function(){  
	    $('.ajax').html($('.ajax input').val());  
	    $('.ajax').removeClass('ajax');  
	});
</script>

<?php
require_once "Views/footer.php";
?>

