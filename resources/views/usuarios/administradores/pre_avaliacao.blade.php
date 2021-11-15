@extends('/usuarios/administradores/header')
@push('scripts')
<script type="text/javascript" src="/js/modal.js"></script>
<script type="text/javascript" src="/js/abrirModal.js"></script>
@endpush

@section("conteudo")
<div class="row">
	<div class="container-fluid">
		@if(Session::has('mensagem'))
		<div class="{{Session::get('alertType')}} text-center"><p><b>{{Session::get('mensagem')}}</b></p></div>
		@endif
		<div class="col-md-12">
			<h4 class="text-center">Pré avaliação</h4><hr>
			<table class="table table-bordered table-responsive table-condensed table-bordered" id="pre_avaliacao">
				<thead>
					<tr>
						<th>Título</th>
						<th>Área</th>
						<th>Categoria</th>
						<th>Status</th>
						<th width="300">Ações</th>
					</tr>
				</thead>
				<tbody>
					@forelse($trabalhos as $trabalho)

					<tr>
						<td>{{$trabalho->titulo}} </td>
						<td>{{$trabalho->area}} </td>
						<td>{{$trabalho->categoria}} </td>
						<td>
							<b class="{{$trabalho->decoration}}">{{$trabalho->status}} <span class="glyphicon glyphicon-info-sign"/></b>
						</td>
						<td>
							<button id='AutoresDoTrabalho' trabalho_id = '{{$trabalho->id}}' acao='autores' class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Visualizar Autores" url='administrador/buscaPessoa'><span class="glyphicon glyphicon-user"></span></button>

							<button id='resumoDoTrabalho' trabalho_id = '{{$trabalho->id}}' class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title= "Resumo do trabalho"><span class="glyphicon glyphicon-search"></span></button>

							<button  trabalho_id="{{$trabalho->id}}" acao="reprovar" class="btn btn-danger btn-sm avaliar" data-toggle="tooltip" data-placement="left" title="Reprovar o trabalho"><span class="glyphicon glyphicon-remove"></span></button>

							@if($trabalho->status_id != 4)
								<a href="/autor/trabalhos/visualizar/{{$trabalho->id}}" target="_blank" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho"><span class="glyphicon glyphicon-download-alt"/></a>
							
								<button data-toggle="collapse" data-target="#obs{{$trabalho->id}}" class="btn btn-warning btn-sm" data-placement="left" title="Acrecentar observações">
									<span class="glyphicon glyphicon-plus"></span>
								</button>

								<button data-toggle="collapse" data-target="#TodasObservacoesTrab{{$trabalho->id}}" class="btn btn-danger btn-sm" data-placement="left" title="observações registradas">
									<span class="glyphicon glyphicon-tasks"></span>
								</button>
								@if($dataAtual > $data_fim_ava)
								<button class="btn btn-primary btn-sm correcao" trabalho_id="{{$trabalho->id}}" data-toggle="tooltip" data-placement="right" title="solicitar correção do trabalho" status_id="{{$trabalho->status_id}}"><span class="glyphicon glyphicon-list-alt"></span></button>
								@endif
							@endif
						</td>
					</tr>

					<tr id="obs{{$trabalho->id}}" class="collapse">
						<td colspan="5">
							<div class="col-md-12">
								<form  action="/administrador/pre_avaliador/parecer" method="post" accept-charset="utf-8" class="form-group">
									{{csrf_field()}}		

									<input type="hidden" name="trabalho_id" value="{{$trabalho->id}}">
									<textarea data-placement="bottom" data-toggle="popover" title="Quando este campo perder o foco o texto será salvo automaticamente, sendo assim para fazer alterações nas observações de avaliação basta digitar e clicar em qualquer parte da tela com o mouse" class="form-control" id="inputParecer" name="parecer" value="{{$parecer->parecer or ''}}" style="height: 100px">{{$trabalho->observacao or ''}}</textarea>
								</form>
								@if(!empty($trabalho->observacao))

								<form method="post" action="/administrador/deletar/parecer">
									{{csrf_field()}}
									<input type="hidden" value="{{$trabalho->id}}" name="trabalho_id"> 
									<button style="float: left;" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
									</h4>
								</form>

								@endif
							</div>
						</td>		
					</tr>

					<tr class="collapse" id="TodasObservacoesTrab{{$trabalho->id}}">
						<td colspan="5">
							<div class="col-md-12">
								@if(!empty($pre_avaliacoes[0]) )
									@forelse($pre_avaliacoes as $p_ava)
										@if($p_ava->trabalho_id == $trabalho->id)
											<p class="text-left">Responsável: {{$p_ava['nome']}}</p>
											<textarea style="height: 100px" class="form-control" readonly>{{$p_ava['observacao']}}</textarea>
										@endif
									@empty
									<h5>Nenhuma observação foi registrada até o momento</h5>
									@endforelse
								@endif

							</div>
						</td>
					</tr>

					@empty
					<tr> 
						<td colspan="5">
							<p>Nenhum trabalho cadastrado até o momento</p>	
						</td>
					</tr>
					
					@endforelse	

				</tbody>
			</table>
		</div>

		<!-- modal que mopstra as informações detalhadas do autor -->
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

		<!-- modal para aprovar ou reprovar o trabalho -->
		<div class="modal fade" id="modal_avaliar">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<center><h4 class="modal-title title-avaliar"></h4></center>
					</div>
					<div class="modal-body" id="conteudo">
						<table class="table table-bordered table-responsive table-condensed table-striped">
							<p id='body-avaliar' class="text-center"></p>
						</table>
					</div>
					<div class="modal-footer footer-avaliar">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><FIELDSET>Fechar</FIELDSET></button>
					</div>
				</div>
			</div>
		</div>
		<!-- fim do modal -->

		<!-- modal que questiona a ação do usuário  -->
		<div class="modal fade" id="modal_correcao">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<center><h3 class="modal-title">Atenção !</h3></center>
					</div>
					<div class="modal-body text-center" id="msg_correcao">
						
					</div>
					<div class="modal-footer" id="footer_correcao">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><FIELDSET>Não</FIELDSET></button>
					</div>
				</div>
			</div>
		</div>
		<!-- fim do modal -->

	</div>
</div>

<style type="text/css">
	textarea{width: 100%; height: 75px;}
</style>

<script type="text/javascript">
	modalAutoresDoTrabalho('modal_detalhes');
	modalResumoDoTrabalho('modal_detalhes');
	modalAvaliarTrabalho();

	$(document).on('blur','#inputParecer', function(){
		if($(this).val() != ''){

			$(this).parents('form:first').submit();
		}
	});

	$(document).on('click','.correcao', function(){
		status_id = $(this).attr('status_id');
		trabalho_id = $(this).attr('trabalho_id');
		$('#msg_correcao').html(' ');
		$('#footer_correcao').html(' ');
		if(status_id == 2 || status_id == 5){
			$('#msg_correcao').append('<h4>Deseja enviar uma solicitação de correção ?</h4>');
		}else if(status_id == 7){
			$('#msg_correcao').append('<h4>O autor já enviou a correção, deseja fazer uma nova solicitação ?</h4>');
		}else if(status_id == 6){
			$('#msg_correcao').append('<h4>O autor não enviou a correção, deseja cancelar essa solicitação ?</h4>');
		}
		$('#footer_correcao').prepend('<a  href="/administrador/trabalhos/correcao/'+trabalho_id+'" class="btn btn-success">Sim</a><button type="button" class="btn btn-danger" data-dismiss="modal"><FIELDSET>Não</FIELDSET></button>');
		$('#modal_correcao').modal();
	});

</script>



@stop 