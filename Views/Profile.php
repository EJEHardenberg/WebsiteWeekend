<?php
require_once "topBar.php";
?>

<script type="text/javascript">
$(document).ready(function(){
	// grab our profile data from DB
	var query = <? echo BASEDIR; ?>+"User/?getProfile=true&output=json";
	$.getJSON(query, function(data) {
		// set our inputs full of data from the DB
		console.log(data);
		if(data['fldAboutMe']!= ""){
			$('.descripText').text(data['fldAboutMe']);
		}
		if(data['fldProfileImage'] != ""){
			var basedir = <? echo "'".BASEDIR."'"; ?>;
			var imgStr = "<img src='"+basedir+"Views/images/profile_images/"+data['fldProfileImage']+"'>"
			$('.profilePicNest').html(imgStr);

		}else{
			$('.profilePicNest').html("<img class='avatar'>");
		}
		if(data['fldFirstName']!= ""){
		}
		if(data['fldLastName']!= ""){
		}
		if(data['fldLastName']!= "" && data['fldFirstName']!= ""){
			$('.contentHeader').text(data['fldFirstName']+" "+data['fldLastName']);
		}
		if(data['fldPersonalURL']!= ""){
		}
		// social shit
		if(data['fldGitURL']!= ""){
			$('.social').append("<a target='_blank' href='"+data['fldTwitterURL']+
				"'><img alt='img' class='icon' src='"+<?echo BASEDIR; ?>+"Views/css/fonts/icons/elegantmediaicons/PNG/git.png'></a>");
		}
		if(data['fldTwitterURL']!= ""){
			$('.social').append("<a target='_blank' href='"+data['fldTwitterURL']+
				"'><img alt='img' class='icon' src='"+<?echo BASEDIR; ?>+"Views/css/fonts/icons/elegantmediaicons/PNG/twitter.png'></a>");
		}
		if(data['fldFacebookURL']!= ""){
			$('.social').append("<a target='_blank' href='"+data['fldFacebookURL']+
				"'><img alt='img' class='icon' src='"+<? echo BASEDIR; ?>+"Views/css/fonts/icons/elegantmediaicons/PNG/facebook.png'></a>");
		}
		if(data['fldLinkedinURL']!= ""){
			$('.social').append("<a target='_blank' href='"+data['fldLinkedinURL']+
				"'><img alt='img' class='icon' src='"+<? echo BASEDIR; ?>+"Views/css/fonts/icons/elegantmediaicons/PNG/linkedin.png'></a>");
		}
		if(data['fldGoogleURL']!= ""){
			$('.social').append("<a target='_blank' href='"+data['fldGoogleURL']+
				"'><img alt='img' class='icon' src='"+<? echo BASEDIR; ?>+"Views/css/fonts/icons/elegantmediaicons/PNG/google.png'></a>");
		}
	});
});
</script>

<div class="profileContain">
	<div class="contentHeader">
	</div>
	<ul>
		<li class="containRow row1">

				<div class="nest">
					<div class="profilePicNest">
					</div>

					<div class="profileDescrip">
						<b>About Me</b><br />
						<span class="descripText"></span>
					</div>
					<div class="social">
					</div>
					<div class="clearBoth"></div>
				</div>
			
		</li>
	</ul>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.projectRow').click(function(){
			var url = $(this).find("input[type='hidden']").val();
			window.open(url);
		});
	});
</script>