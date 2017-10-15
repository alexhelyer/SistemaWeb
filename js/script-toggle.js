
	$(function(){
		var cont = 1;

		$('#toggle-menu').click(function() {
			if (cont%2==0) {
				$('.barra-lateral').animate({left: "-20%"});
				$('.main_titulo').animate({left: "0%"});
				$('.main_section').animate({width: "100%"});
				$('#toggle-menu').animate({left: "0%"});
				$('#toggle-menu').text("☰");
			}
			else {
				$('.barra-lateral').animate({left: "0%"});
				$('.main_titulo').animate({left: "20%"});
				$('.main_section').animate({width: "80%"});
				$('#toggle-menu').animate({left: "20%"});
				$('#toggle-menu').text("x");
			}
			cont++;
		});
	});