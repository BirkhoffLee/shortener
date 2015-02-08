$(document).ready(function(){ 
	$("#submit").on("click",function(e){
		e.preventDefault();
		$.ajax({
			url: "index.php",
			type: "POST",
			data: {
				url: $("#url").val(),
				id: $("#id").val(),
				action: $("#action").val(),
				token: $("#token").val(),
				recaptchaResponse: $(".g-recaptcha-response").val()
			},
			dataType:"html",
			success: function(data){
				$(".description").fadeOut(function(){
					$(".description").html(data);
				});
				$(".g-recaptcha").fadeOut(function(){
					grecaptcha.reset();
				});
				$(".description").fadeIn();
				$(".g-recaptcha").fadeIn();
			}
		});
	});
	$(".header").html("<p>URL SHORTENER</p>");
});