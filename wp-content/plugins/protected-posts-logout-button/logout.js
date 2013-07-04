jQuery(document).ready(function($){
	$('input.button.logout').click(function(){
				var data = {
					action : "pplb_logout"
				}
				
				$.post(MyAjax.ajaxurl, data, function(response) {
					if(response == '0'){
						
					}
					else{
						$('body').append('<p style="display:none;" id="pplb-message">'+response+'<p>');
						var text = $('#pplb-message').text();
						alert(text);
					}
					document.location.href = document.location.href;
				});
			});
		});