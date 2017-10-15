
	$(document).ready(main);
	
	function populate(s1, s2) {
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);

		s2.innerHTML = "";

		if (s1.value == "aritmetica" ) {
			var optionArray = ["naturales|Naturales","enteros|Enteros","fraccionarios|Fraccionarios","decimales|Decimales"];
		}
		else if (s1.value == "algebra" ) {
			var optionArray = ["ec_1|Ecuación de 1er Grado (ax+b=cx+d)","ec_2|Ecuación de 1er Grado (x+a=b)","ec_3|Ecuación de 2do Grado","factorizacion|Factorización"];
		}
		else if(s1.value == "geometria") {
			var optionArray = ["perimetros|Perímetros y Áreas","volumen|Volumen de Cubos","prismas|Prismas y Pirámides","pendiente|Ecuación de la Pendiente"];
		}
		else if(s1.value == "trigonometria") {
			var optionArray = ["isosceles|Triángulos Isosceles y Equilateros","inscritos|Ángulos Inscritos","rectangulos|Triángulos Rectángulos","pitagoras|Teorema de Pitágoras"];
		}
		else if(s1.value == "probabilidad") {
			var optionArray = ["excluyentes|2 Eventos Mutuamente Excluyentes","independientes|2 Eventos Independientes","equiprobables|Resultados Equiprobables y No Equiprobables"];
		}

		for(var option in optionArray) {
			var pair = optionArray[option].split("|");
			var newOption = document.createElement("option");
			newOption.value = pair[0];
			newOption.innerHTML = pair[1];
			s2.options.add(newOption);
		}

		$('.selectpicker').selectpicker('refresh');
	}