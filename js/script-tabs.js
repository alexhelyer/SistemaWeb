
	$(function(){
		$('.form_type').hide();
		$('#form_1').show();
		$('#tipo01').click(function(){
			$('.form_type').hide();
			$('#form_1').show();
		});

		$('#tipo02').click(function(){
			$('.form_type').hide();
			$('#form_2').show();
		});

		$('#tipo03').click(function(){
			$('.form_type').hide();
			$('#form_3').show();
		});
	});