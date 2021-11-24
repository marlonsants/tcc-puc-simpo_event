@extends('/usuarios/administradores/header')
<?php 
use App\Model\Evento;
$maxTrabalhoAvaliador = Evento::maxTrabalhoAvaliador();
	
 ?>
@push('scripts')
<script type="text/javascript" src="/js/abrirModal.js"></script>

@endpush
@section("conteudo")
<div class="row">
	<h4 class="text-center">Atribuir avaliadores</h4><hr>
</div>
<div class="col-md-9 col-xs-12 col-lg-9" style="overflow: auto">
	<div class="col-md-8">
		<h4 class="pull-right">Trabalhos para atribuição de avaliadores</h4>
	</div>
	<div class="col-md-4">
		<a target="_blank" class="btn btn-success pull-right" href="/administrador/exportar/atribuicoesAvaliadores">
					Exportar em PDF <span class="glyphicon glyphicon-open-file"></span>
		</a>	
	</div>
	
	
	<table class="table table-bordered table-hover table-bordered table-stripped" id="trab_atrib_aval">
		<thead>
			<th>Título</th>
			<th>Área</th>
			<th>Categoria</th>
			<th>Nº de Avaliador(es)</th>
			<th width="120">Ações</th>
		</thead>
		<tbody id="tBodyTrabalhos" name="tBodyTrabalhos">
			
		</tbody>
	</table>

</div>
<br><br>
<div class="col-md-3 col-xs-12">
<table class="table table-bordered table-hover table-bordered table-stripped" id="Trabalhos_atribuidos">	
	<thead><th>Nome</th><th>Trabalhos Atribuidos</th></thead>
	<tbody id="tBodyAtribuicoesDosAvalidores">
		
	</tbody>
</table>
</div>


<!-- Modal -->
<div class="modal fade" id="avaliadores_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 	>
	<div class="modal-dialog" role="document" style="width:70%">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Avaliadores do Trabalho</h4>
			</div>
			<div class="modal-body" >
				<div id="body_avaliadores_modal">

				</div>
				<!-- Formulario para atribuição de avaliadores -->
				<form action="#" method="get" accept-charset="utf-8" class="row">
					<div class="form-group">
						<input type="hidden" name="trabalho_id" id="trabalho_id" readonly="true" class="form-control">
					</div>
					<label style="margin-left: 38px">Avaliadores</label>
					<div class="col-md-12">

						<div class="col-md-9">
							{!!csrf_field()!!}
							
							<select class="form-control " id="select_avaliador">
															
							</select>
						</div>						
						<div class="col-md-1">
							<button style="margin-top: 7px" type="submit" class="btn btn-success btn-sm" trabalho_id="" data-toggle="modal" data-toggle="tooltip" data-placement="left" title="Atribuir a este avaliador" data-original-title="Incluir" id="btn-incluir">
								<span class="glyphicon glyphicon-search"> Incluir</span>
							</button>
						</div>
						<div class="col-md-1">
							<button pessoa_id="" id="detalhesDaPessoa" style="margin-top: 7px; margin-left: 5px;" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detalhes_avaliador_modal" data-toggle="tooltip" data-placement="left" title="Detalhes" data-original-title="Detalhes">
								<span class="glyphicon glyphicon-search"> Detalhes</span>
							</button> 	
						</div>
					</div>
				</form>
				<hr>
				<!-- Tabela de avaliadores do trabalho -->
				<table class="table table-bordered table-hover" id="trab_atrib_aval">
					<thead class="thead-padrao">
						<tr>
							<th>Avaliador</th>
							<th>Instituição</th>
							<th>Área</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody id="tabelaAvaliadores">
					</tbody>
				</table>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="fecharModal"><FIELDSET>Fechar</FIELDSET></button>
			</div>
		</div>
	</div>
</div>


<!-- Modal Cofirmação-->
<div class="modal fade" id="modal_remover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 	>
	<div class="modal-dialog" role="document" style="width:70%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Atenção</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12"><center>
						<h3><b class="text text-danger">Atenção</b></h3> 
						<h4>Esta ação irá remover a permissão para que o avaliador prossiga com as correções deste artigo.</h4>
						<h4> Deseja continuar ?</h4></center>
					</div>
				</div>
			</div>
			<div class="modal-footer" id="AcaoRemoverAvaliador">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Cofirmação-->
<div class="modal fade" id="modal_alerta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 	>
	<div class="modal-dialog" role="document" style="width:70%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Atenção</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12"><center id='msg_alerta'>
						
					</div>
				</div>
			</div>
			<div class="modal-footer" id="AcaoRemoverAvaliador">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- modal que mostra as informações detalhadas do autor -->
		<div class="modal fade" id="modal_detalhes">
			<div class="modal-dialog" style="width: 90%" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<center><h4 class="modal-title"></h4></center>
					</div>
					<div class="modal-body" id="conteudo">
						<table class="table table-bordered table-responsive table-condensed table-striped">
							<thead id='ModalHead' class="thead-padrao"></thead>
							<tbody id='body'></tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><FIELDSET>Fechar</FIELDSET></button>
					</div>
				</div>
			</div>
		</div>
		<!-- fim do modal -->

<script>
// função para abir o modal de autores e de resumo
modalAutoresDoTrabalho('modal_detalhes');
modalResumoDoTrabalho('modal_detalhes');
ModalDetPessoa('modal_detalhes');

// função para carregar as informações da tabela de trabalhos
CarregarTabelaDeTrabalhos();

//função para atualizar a tabela de atribuicoes dos avaliadores e as opções do select de avaliadores 
CarregarAtribuicoesDoAvaliador();
// $("#fecharModal").click(function(){
// // location.reload();
// })


	function montaTabelaAvaliadores(avaliadores){
		if(typeof avaliadores[0] !== 'undefined'){

			$("#body_avaliadores_modal").html(' ');
			if($.inArray(3, avaliadores[0].trabalho_status) >= 0 || $.inArray(2, avaliadores[0].trabalho_status)  >= 0){
				$("#body_avaliadores_modal").prepend("<div class='alert alert-danger'>Atenção, já foram iniciadas as avaliações para este trabalho</div>");
			}else{
				$("#body_avaliadores_modal").prepend("<div class='alert alert-success'>Ainda não foram iniciadas as avaliações para este trabalho</div>");
			}
				

			var html = '';
			$.each(avaliadores, function(index,avaliador){
				html += '<tr id="'+avaliador.id+'">';
				html += '<td class="td_nome">';
				html += avaliador.nome.toUpperCase();
				html += '</td>';
				html += '<td class="td_instituicao">';
				html += avaliador.instituicao.toUpperCase();
				html += '</td>';
				html += '<td class="td_area_descricao">';
				html += avaliador.area.toUpperCase();
				html += '</td>';
				
				html += '<td>';
				html += '<button pessoa_id="'+avaliador.id+'" id="detalhesDaPessoa" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detalhes_avaliador_modal" data-toggle="tooltip" data-placement="left" title="Detalhes" data-original-title="Detalhes">'+
				'<span class="glyphicon glyphicon-search"></span>'+
				'</button> ';
				html += '<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_remover" data-toggle="tooltip" data-placement="left" title="Excluir" data-original-title="Detalhes" onclick="atencaoExcluirAvaliador(\''+avaliador.id+'\',\''+avaliador.trabalho_id+'\')">'+
				'<span class="glyphicon glyphicon-trash"></span>'+
				'</button> ';
				html += '</td>';
				html += '</tr>';
			});
			$("#tabelaAvaliadores").html('');
			$("#tabelaAvaliadores").append(html);
		}

	}

	

	function atencaoExcluirAvaliador(idAvaliador, idTrabalho){
		btn = '';
		btn += '<button type="button" class="btn btn-danger" onclick="removerAvaliador(\''+idAvaliador+'\',\''+idTrabalho+'\')">Remover</button>';
		btn += '<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>';
		$("#AcaoRemoverAvaliador").html(btn);
	}

	function removerAvaliador(idAvaliador,idTrabalho){
		data = {};
		data.id_avaliador = idAvaliador;
		data.id_artigo = idTrabalho;
		data._token = $("input[name*='_token']").val();
		totalDeAtribuicao = $('#AtribuicoesDoTrabalho'+idTrabalho).text();
		totalDeAtribuicao = parseInt(totalDeAtribuicao);
		console.log('atribuicoes '+totalDeAtribuicao);
		console.log(idTrabalho);
		$.ajax({
			type: "POST",
			url: '/administrador/avaliadores/atribuir/delete',
			data: data,
			dataType: 'json',
			success: function(o){
				$("#"+idAvaliador).hide();
				console.log('removido com sucesso');
				$('#AtribuicoesDoTrabalho'+idTrabalho).text(totalDeAtribuicao-1);
				$("#modal_remover").modal('hide');
				DataTablesDestroy();
				CarregarAtribuicoesDoAvaliador();
				CarregarTabelaDeTrabalhos();
				CarregarSelectDosAvaliadores(idTrabalho);

			},
			error: function(erro){
				console.log('Erro ao remover.'+ erro.message);
			}
		});
	}

	

	function getAvaliadores(){

		$.ajax({
			type: "GET",
			url: '/administrador/avalidores/atribuicoes',
			
			success: function(avaliadores){
				return avaliadores;

			},error: function(data){
				console.log("erro "+data);
			}

		});
	}

	function getAvaliadoresDoTrabalho(id){
		
		$('#tabelaAvaliadores').html(' ');				
		$.ajax({
			type: "GET",
			url: '/administrador/avaliadores/atribuir/buscaAvaliadorDoTrabalho/'+id,
						
			success: function(avaliadores){
				
				
				montaTabelaAvaliadores(avaliadores);
				CarregarSelectDosAvaliadores(id);
				$("#btn-incluir").attr('trabalho_id',id);

			},error: function(data){
				console.log("erro "+data);
			}

		});
	}

	
	function CarregarAtribuicoesDoAvaliador(){
				
		$.ajax({
			type: "GET",
			url: '/administrador/avalidores/atribuicoes',
			
			success: function(atribuicoesDosAvalidores){
				linhaTabela = '';
				
				$.each(atribuicoesDosAvalidores, function(index,avaliador){
					
					linhaTabela += '<tr>'+
										'<td id="tdAvaliadorNome"'+avaliador.id+'>'+avaliador.nome+'</td>'+
										'<td id="tdQuantidadeTrabalhoAvaliador'+avaliador.id+'">'+avaliador.numeroDeAtribuicoes+'</td>'+
									'</tr>';

					
				});									
				$('#tBodyAtribuicoesDosAvalidores').html(' ');
				$('#tBodyAtribuicoesDosAvalidores').append(linhaTabela);
				
				carregaDataTableAtribuicoesAvaliadores();

			},error: function(data){
				console.log("erro "+data);
			}

		});
	}

	function CarregarSelectDosAvaliadores(trabalho_id){
		$.ajax({
			type: "GET",
			url: '/administrador/avaliadores/getAvaliadoresExecetoAutores/'+trabalho_id,
			
			success: function(avaliadores){
				
				linhaOption = '<option selected disabled="true" id="selecione" value="none"> SELECIONE UMA OPÇÃO </option>';
				$.each(avaliadores, function(index,avaliador){
					
					linhaOption +=	'<option id="selectAvaliador'+avaliador.id+'" qtdAtribAvaliador="'+avaliador.numeroDeAtribuicoes+'" class="selectAvaliador" value="'+avaliador.id+'">'+
										''+avaliador.nome+' (   Hà '+avaliador.numeroDeAtribuicoes+' Trabalho(s) atribuido(s) a este avalidor  )'+
									'</option>';
				});									
				
				$('#select_avaliador').html(' ');
				$('#select_avaliador').append(linhaOption);


			},error: function(data){
				console.log("erro "+data);
			}

		});
	}

	function CarregarTabelaDeTrabalhos(){
				
		$.ajax({
			type: "GET",
			url: '/administrador/avaliadores/atribuir/atualizarPagina',
			
			success: function(trabalhos){
				linha = '';
				$.each(trabalhos, function(index,trabalho){
					
					
				linha +=	'<tr>'+
							'<td>'+trabalho.titulo+'</td>'+
							'<td>'+trabalho.area+'</td>'+
							'<td>'+trabalho.categoria+'</td>'+
							'<td id="AtribuicoesDoTrabalho'+trabalho.id+'">'+trabalho.avaliacoes_atribuidas+'</td>'+
							'<td>'+
								'<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#avaliadores_modal" onclick="getAvaliadoresDoTrabalho('+trabalho.id+')" data-toggle="tooltip" data-placement="left" title="Avaliadores" data-original-title="Avaliadores">'+
									'<span class="glyphicon glyphicon-user"></span>'+
								'</button>'+
								'<button id="AutoresDoTrabalho" trabalho_id = "'+trabalho.id+'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Visualizar Autores"><span class="glyphicon glyphicon-education"></span></button>'+
								'<button id="resumoDoTrabalho" trabalho_id = "'+trabalho.id+'" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title= "Resumo do trabalho"><span class="glyphicon glyphicon-search"></span></button>'+
							'</td>'+
						'</tr>';
			
				});									
				$('#tBodyTrabalhos').html(' ');
				$('#tBodyTrabalhos').append(linha);

				carregaDataTableTrabalhos();
				

			},error: function(data){
				console.log("erro "+data);
			}

		});
	}

	// insere o id do avlaiador no botão de detalhes do select
	$("#select_avaliador").on('change',function(e){  
		var avaliador_id = $(this).val();
		$('#detalhesDaPessoa').attr('pessoa_id',avaliador_id);

	});
	
	$("#btn-incluir").on('click',function(e){

		e.preventDefault();
		data = {};
		data.id_avaliador = $('#select_avaliador option:selected').val();
		data.id_artigo = $(this).attr('trabalho_id');
		data._token = $("input[name*='_token']").val();
		totalDeAtribuicao = $('#AtribuicoesDoTrabalho'+data.id_artigo).text();
		totalDeAtribuicao = parseInt(totalDeAtribuicao);
		totalAtribuido = $('#select_avaliador option:selected').attr('qtdAtribAvaliador');
		maxTrabAvaliadorPermitido = '<?= $maxTrabalhoAvaliador; ?>';
		console.log('total atribuido '+totalAtribuido);

		if(totalAtribuido >= maxTrabAvaliadorPermitido){
			
			var html = '';
			$("#modal_alerta").modal('show');
			html += '<h3><b class="text text-danger">Atenção</b></h3>';
			html += '<h4>Este autor já possui '+totalAtribuido+' trabalho(s) atribuido(s), portanto já ultrapassou a quantidade máxima de '+maxTrabAvaliadorPermitido+' trabalho(s) definida para este evento.</h4>';
			$("#msg_alerta").html('');
			$("#msg_alerta").append(html);
		}	
						
		
			if(data.id_avaliador != 'none'){
				

					if( $("#"+data.id_avaliador).is(':visible') ){
						var html = '';
						$("#modal_alerta").modal('show');
						html += '<h3><b class="text text-danger">Atenção</b></h3>';
						html += '<h4>Este avaliador já está autorizado a avaliar este trabalho.</h4>';
						html += '<h4> Por favor, escolha outra opção!</h4></center>';
						$("#msg_alerta").html('');
						$("#msg_alerta").append(html);
					}else{
						$.ajax({
							type: "POST",
							url: '/administrador/avaliadores/atribuir/add',
							data: data,
							dataType: 'json',
							
							success: function(o){
								
								getAvaliadoresDoTrabalho(data.id_artigo);
								
								$('#AtribuicoesDoTrabalho'+data.id_artigo).text(totalDeAtribuicao+1);
								
								DataTablesDestroy();
								CarregarSelectDosAvaliadores(data.id_artigo);
								CarregarAtribuicoesDoAvaliador();
								CarregarTabelaDeTrabalhos();
								
							}
						});
					}
			
			}else{
				var html = '';
				$("#modal_alerta").modal('show');
				html += '<h3><b class="text text-danger">Atenção</b></h3>';
				html += '<h4>Você deve selecionar uma opção antes de incluir.</h4>';
				html += '<h4> Por favor, escolha outra opção!</h4></center>';
				$("#msg_alerta").html('');
				$("#msg_alerta").append(html);
			}
		
	});



function carregaDataTableTrabalhos(){


	$('#trab_atrib_aval').DataTable(
	{
		"scrollY":        "350px",
        "scrollCollapse": true,
        "paging":         false,
        
		language: {
			"decimal":        "",
			"emptyTable":     "Não há informações a ser exibida",
			"info":           "Mostrando _START_ até _END_ de _TOTAL_ registros.",
			"infoEmpty":      "Mostrando 0 até 0 de 0 registros.",
			"infoFiltered":   "(Do total de _MAX_ registros)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrando _MENU_ registros.",
			"loadingRecords": "Carregando...",
			"processing":     "Processando...",
			"search":         "Pesquisar Trabalho:",
			"zeroRecords":    "Não foi encontrada nenhuma informação",
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		
		}
	});

	$("input[type=search]").addClass("form-control");
	$("#trab_atrib_aval_wrapper").addClass("text-center");	
	$("#trab_atrib_aval_filter").addClass("text-left");
	$("#trab_atrib_aval_length").hide();	

}

function carregaDataTableAtribuicoesAvaliadores(){
	$('#Trabalhos_atribuidos').DataTable(
	{
		"scrollY":        "350px",
        "scrollCollapse": true,
        "paging":         false,
        
		language: {
			"decimal":        "",
			"emptyTable":     "Não há informações a ser exibida",
			"info":           "Mostrando _START_ até _END_ de _TOTAL_ registros.",
			"infoEmpty":      "Mostrando 0 até 0 de 0 registros.",
			"infoFiltered":   "(Do total de _MAX_ registros)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrando _MENU_ registros.",
			"loadingRecords": "Carregando...",
			"processing":     "Processando...",
			"search":         "Pesquisar Avaliador:",
			"zeroRecords":    "Não foi encontrada nenhuma informação",
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}

		}
	});

	

	$("input[type=search]").addClass("form-control");
	$("#Trabalhos_atribuidos_wrapper").addClass("text-center");	
	$("#Trabalhos_atribuidos_filter").addClass("text-left");
	$("#Trabalhos_atribuidos_length").hide();	
}

function DataTablesDestroy(json){
	var table = $('#Trabalhos_atribuidos').DataTable();
	var table2 = $('#trab_atrib_aval').DataTable();
	
	table.destroy();
	table2.destroy();
}


</script>

@stop 	