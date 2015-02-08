$(document).ready(function(){
	$('head').append('<link rel="stylesheet" href="css/style.css" type="text/css">');
	$('head').append('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700"type="text/css">');
	$(".header").html("<p>URL SHORTENER</p>");

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
});