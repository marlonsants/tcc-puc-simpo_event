@extends("/usuarios/avaliadores/header")
@section('conteudo')

@if(Session::has('mensagem'))
	<div class="{{Session::get('alertType')}} text-center"><p><b>{{Session::get('mensagem')}}</b></p></div>
@endif
<div class="row">
	<div class="col-md-12 panel panel-default">
		<a href="/autor/trabalhos/visualizar/{{$trabalho->id}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title= "PDF do Trabalho" target="_blank"><b>Clique aqui para visualizar trabalho</b></a>
		<h4>Informações do trabalho:</h4>
		<h5><b>Titulo:</b> {{$trabalho->titulo}}</h5>
		<h5><b>Area:</b> {{$trabalho->area}}</h5>
		<h5><b>Categoria:</b> {{$trabalho->categoria}}</h5>
		<h5><b>Resumo:</b> {{$trabalho->resumo}}</h5>
		<h5><b>Palavras Chave:</b> {{$trabalho->palavra_chave}}</h5>
		<h5><b>Abstract:</b> {{$trabalho->abstract}}</h5>
		<h5><b>Key words:</b> {{$trabalho->key_word}}</h5>
		
	</div>
</div>

@if(Session::has('msgNotaMax'))
<br><div class="{{Session::get('alertType')}} text-center col-md-12"><p><b>{{Session::get('msgNotaMax')}}</b></p></div>
@endif

<div class="row">
	@if(isset($Criterios))
	@foreach($Criterios as $criterio)
	<div class="col-md-3 col-xs-12">
		
		<form action="/avaliador/criterio/nota" method="post" accept-charset="utf-8" class="form-group">
			{{csrf_field()}}

			<div class="col-md-12">

				<div class="row">
					<div style="margin-top:5px;margin-left: 20px;font-weight: bold">{{$criterio->nome}} (Peso {{$criterio->peso}})</div>
			
					<div class="col-md-8 col-xs-8">
						<input <?php echo $trabalho->status_avaliacao == 3?'readonly':'' ?> data-placement="bottom" data-toggle="popover" title="Instruções" data-content="Quando este campo perder o foco a nota será salva automaticamente"   required type="number" name="nota" min='0' max="{{$notaMax}}" value="{{$criterio->nota or ''}}" class="form-control inputNota" placeholder='Nota de 0 a {{$notaMax}}'>

						<input type="hidden" name="trabalho_id" value="{{$trabalho->id}}">
						<input type="hidden" name="criterio_id" value="{{$criterio->id}}">
					</div>
					<div class="col-md-4 col-xs-4">
						<a href="/administrador/cadastros_basicos/criterios/detalhes/{{$criterio->id}}"
							class="btn btn-primary" data-toggle="modal" data-target="#{{$criterio->id}}"
							style="margin-top:5px">
							<span class="glyphicon glyphicon-eye-open"></span>
						</a>
						<!-- <button type="submit" class="btn btn-success" style="margin-top:5px">
							<span class="glyphicon glyphicon-send"></span>
						</button> -->
						
					</div>
				</div>


			</div>
			<hr>
		</form>
	</div>
	@endforeach
</div>
<div class="col-md-8 col-md-offset-2 col-xs-12">
	<div class="row">
		<div class="col-md-4 col-md-offset-5 col-xs-12">
			
			@if(!isset($parecer->parecer))
			<div class="row">
				<h4><b>Parecer:</b> 
					<button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#NewParecer" data-placement="left"><span class="glyphicon glyphicon-plus" ></span></button>
				</h4>	
			</div>
			@endif		
			@if(isset($parecer->parecer))
			<div class="row">
				<form method="post" action="{{url('\avaliador\parecer\deletar')}}">
					{{csrf_field()}}
					<h4><b>Parecer:</b>
						<input type="hidden" value="{{$trabalho->id}}" name="trabalho_id"> 
						<button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
					</h4>
				</form>
			</div>	
			@endif

		</div>
	</div>

	<div class="col-md-8 col-md-offset-2 col-xs-12" <?= !isset($parecer->parecer) ? 'class="collapse"':'class=""' ?>  id="NewParecer">
		<center>
			<form  action="/avaliador/parecer" method="post" accept-charset="utf-8" class="form-group">
				{{csrf_field()}}		

				<input type="hidden" name="trabalho_id" value="{{$trabalho->id}}">
				<textarea data-placement="right" data-toggle="popover" title="Instruções" data-content="Quando este campo perder o foco o texto será salvo automaticamente, sendo assim para fazer alterações no parecer de avaliação basta digitar e clicar em qualquer parte da tela com o mouse" class="form-control" id="inputParecer" name="parecer" value="{{$parecer->parecer or ''}}" style="height: 250px">{{$parecer->parecer or ''}}</textarea>	
			</form>
		</center>
	</div>

</div>
</div><br>

@if($trabalho->status_avaliacao != 3)
<div class="row">
	<div class="col-md-2 col-md-offset-5 col-xs-12">
		<button class="btn btn-success col-md-12" data-toggle="modal" data-target="#confirmar">
			<span class="glyphicon glyphicon-ok"></span> Confirmar avaliação
		</button>
	</div>
</div>
@endif
<br>

<!--Modal de confirmação de avaliação-->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmar">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">
					<span class="glyphicon glyphicon-alert"></span> Deseja confirmar o termino da avaliação deste trabalho? <span class="glyphicon glyphicon-alert"></span>
				</h4>
			</div>
			<div class="modal-body">
				<p>Ao clicar em sim, não será possivel refazer a avaliação, por isso verifique se todas as informações estão corretas.</p>
			</div>
			<div class="modal-footer">
				<div class="col-md-1 col-md-offset-1">
					<form method="post" action="\avaliador\concluirAvaliacao">
						{{csrf_field()}}
					<input type="hidden" name="trabalho_id" value="{{$trabalho->id}}" name="">	
					<button type="submit" class="btn btn-success">Sim</button>
					</form>
				</div>
				<div class="col-md-1 col-md-offset-7">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal para os criterios -->
@foreach($Criterios as $criterio)
<div class="modal fade" tabindex="-1" role="dialog" id="{{$criterio->id}}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center">{{$criterio->nome}}</h4>
			</div>
			<div class="modal-body">
				<p class="text text-center">{{$criterio->descricao}}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach
@endif

<style type="text/css">
.modal-backdrop {z-index: -1;}
</style>

<script type="text/javascript">
	$(document).on('blur','.inputNota', function(){
		if($(this).val() != ''){

			$(this).parents('form:first').submit();
		}
	});

	$(document).on('blur','#inputParecer', function(){
		if($(this).val() != ''){

			$(this).parents('form:first').submit();
		}
	});
	

	$(document).ready(function(){
	    $('[data-toggle="popover"]').popover(); 
	});
</script>
@stop

