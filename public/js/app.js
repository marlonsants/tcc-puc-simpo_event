

$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});


// Tooltips
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

// Dropdowns
$('.dropdown-toggle').dropdown()

// Collpase
$('.collapse').collapse() 

// Gráficos


// função pra criar foom de coautores 

function criaFormCoautores(){
	$(document).ready(function(){
		$(document).on('change','#coautores',function(){
			var ncoautor = $('#coautores option:selected').attr('value');
			ncoautor = parseInt(ncoautor) + 1;
			var count = 0;
			// console.log(ncoautor);
			$('#coautoresdiv').html('');
			for(count = 1;count < ncoautor;count++){

				var linha = '<div class="row form-group">'+
				'<div class="col-md-12 col-xs-12 col-lg-12">'+
				'<div class="col-md-4 coautores" name="cpfCoautor">'+

				'<input placeholder="cpf do coautor '+count+' " type="text" id="cpfcoautor'+count+'" name="cpfcoautor'+count+'" class="form-control cpfcoautor" required>'+
				'</div>'+

				'<div class="col-md-4" name="NomeCoautor">'+

				'<input placeholder="nome do coautor '+count+' " type="text" id="nomecoautor'+count+'" name="nomecoautor'+count+'" class="form-control"   required>'+
				'</div>'+

				'<div class="col-md-4" name="OrdemDeAutoria">'+

				'<Select id="OrdemDeAutoria" name="OrdemDeAutoria" class="form-control"   required>'+
				'<option>Selecione a ordem de autoria</option>'+
				'<option>1º</option>'+
				'<option>2º</option>'+
				'<option>3º</option>'+
				'<option>4º</option>'+
				'</select>'+
				'</div>'+

				'</div>'+
				'</div>';

				$('#coautoresdiv').append(linha);

				$(".cpfcoautor").mask("999.999.999-99");
			}
		});
	});
}

function buscaCoautor(){
	$(document).ready(function(){
		$(document).on('blur','.email',function(){
			var email = $('#email').val();
			

			$.get('/autor/trabalhos/coautor/'+email, function(coautor){
				
				// console.log(coautor);
				console.log(coautor);
				if('erro' in coautor){
					
					if(coautor['erro'] == 'excedeu o limite'){
						$('#email').val("");				
						$('#email').attr('placeholder',"Este coautor ja atingiu o limite de cadastro de trabalhos");
						$('#email').css("border-color","red");
					}
				}else if(coautor == ' '){
					
				}else{
					coautor = coautor[0];
					$('#idAutor').val(coautor.id);
					$('#nome').css("border-color","#ccc");
					$('#nome').val(coautor.nome);

				}
				
			})
			.fail(function() {
				// mae.html(' ');
				$('#ModalAutores').modal('toggle');
				$('#modalMensagem').modal('show');
  			});

		});
	});		

}



