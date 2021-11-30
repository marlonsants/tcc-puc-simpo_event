//Mascaras de formatação
$(document).ready(function(){
	
	
	$('#numero_doc').mask('999.999.999-99');	

	$(document).on('change','#tipo_doc', function(){
		var tipoDoc = $('#tipo_doc option:selected').val();
		if(tipoDoc == 1){
			$('#numero_doc').mask('999.999.999-99');		
		}else{
			$('#numero_doc').unmask();	
		}
	});
	
	
	$('#nascimento').mask('00/00/0000');
	$('#telefone').mask('(99) 9999-9999');
	$('#celular').mask('(99) 99999-9999');
	$('#contato').mask('(99) 99999-9999');
	$('#cep').mask('99.999-999');


	$('input[name="CPF"]').mask('999.999.999-99');
	$('input[name="rg"]').mask('99.999.999-9');
	$('input[name="nascimento"]').mask('00/00/0000');
	$('input[name="telefone"]').mask('(99) 9999-9999');
	$('input[name="celular"]').mask('(99) 99999-9999');
	$('input[name="contato"]').mask('(99) 99999-9999');
	$('input[name="cep"]').mask('99.999-999');
});

// Função para verificar se o CPF já está cadastrado
function verificaCPFCadastrado(){	
	$(document).on('blur','#numero_doc',function(){
		var numero_doc = $(this).val();
		if (numero_doc != undefined && numero_doc != "" ) {
			$.get('/verifica/numero_doc/'+numero_doc, function(resultado){
				if(resultado[0] !== undefined ){			
					$('#numero_doc').val("");				
					$('#numero_doc').attr('placeholder',"Já cadastrado!");
					$('#numero_doc').css("border-color","red");
				}else  if(resultado[0] === undefined){
					$('#numero_doc').css("border-color","#ccc");
				}
			});
		}
	});
}


// Função para verificar se o CPF já está cadastrado
function verificaEmailCadastrado(){
	$(document).on('blur', '#email', function(){
		var email = $('#email').val();
		$.get('/verifica/email/'+email, function(resultado){
			console.log("Verificando EMAIL...");
			if(resultado[0] !== undefined){				
				$('#email').val("");				
				$('#email').attr('placeholder',"email já cadastrado!");
				$('#email').css("border-color","red");
			}else  if(resultado[0] === undefined){
			
				$('#email').css("border-color","#ccc");
			}
		});
	});
}

function selectAvaliador(){
	$(document).on('change','#acesso_id', function(){
		if($(this).val() == 2){
			$('#label').css("display","inline-block");
			$('#area').css("display","inline-block");
		}else{
			$('#label').css("display","none");
			$('#area').css("display","none");
		}
		
		
	});
}

//Faz aparecer o select com as categorias que precisam ser cadastradas
$(document).ready(function(){
	$('#selectArea').hide();
	$('#nvl_acesso').change(function(){
		if ($('#nvl_acesso').val() >= '2'){ $('#selectArea').show(); }
		else{ $('#selectArea').hide(); }
	});
});

