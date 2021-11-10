@extends(session('acesso_id') === 1 ? '/usuarios/autores/header' : '/usuarios/avaliadores/header')

@push('mask')
<script type="text/javascript" src="/js/mask/jquery.mask.js"></script>
@endpush

@section('conteudo') 
<div class="row">
	<div class="container-fluid col-xs-12 col-md-10 col-md-offset-1">
		<form action="{{url('autor/cadastrar/trabalho')}}" method="POST" accept-charset="utf-8" class="form-group" 
		oninput="texto = resumo.value.substr(0, 2500);resumo.value.length <= 2500 ? qr.value = resumo.value.length : qrm.value ='Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto';  resumo.value=texto;  
		textoT = titulo.value.substr(0, 200);titulo.value.length <= 200 ? qt.value = titulo.value.length : qtm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; titulo.value=textoT;  
		textoP = palavra_chave.value.substr(0, 200);palavra_chave.value.length <= 200 ? qp.value = palavra_chave.value.length : qpm.value='Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; palavra_chave.value=textoP;   
		textoA = abstract.value.substr(0, 2500);abstract.value.length <= 2500 ? qa.value = abstract.value.length : qam.value = 'Você chegou ao limite  de '+2500+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; abstract.value=textoA;    
		textoK = key_word.value.substr(0, 200);key_word.value.length <= 200 ? qk.value = key_word.value.length : qkm.value = 'Você chegou ao limite  de '+200+' caracteres permitido, caso você tenha copiado e colado o texto verifique o texto pois deve estar imcompleto'; key_word.value=textoK; ">
			{!!csrf_field()!!}

			<div class="row">
				<div class="col-xs-12 col-md-12">
					<output class="text-danger" name="qtm"></output>
					<input required type="tex" name="titulo"  class="form-control" placeholder="Título do Artigo" style="text-align: left;">
					<output name="qt">0</output>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-12">
					<output name="qrm" class="text-danger"></output>
					<textarea required name="resumo" class="form-control"  placeholder="Resumo do Artigo" style="width: 100%; height: 20%;"></textarea>
					<output name="qr">0</output>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-12">
					<output name="qpm" class="text-danger"></output>
					<textarea required name="palavra_chave" class="form-control"  placeholder="Palavras-chave" style="width: 100%;"></textarea>
					<output name="qp">0</output>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-12">
					<output name="qam" class="text-danger"></output>
					<textarea required name="abstract" class="form-control"  placeholder="Abstract" style="width: 100%; height: 20%;"></textarea>
					<output name="qa">0</output>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-12">
					<output name="qkm" class="text-danger"></output>
					<textarea required name="key_word" class="form-control"  placeholder="Key-words" style="width: 100%;"></textarea>
					<output name="qk">0</output>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<select name="categoria_id"  class="form-control" required>
						@forelse($categoria as $categorias)
						<option value="{{$categorias->id}}">{{$categorias['nome']}}</option>
						@empty
						<option></option>
						@endforelse
					</select>
				</div>

				<div class="col-xs-12 col-md-4">
					<select name="area_id"  class="form-control" required>
						@forelse($area as $areas)
						<option value="{{$areas->id}}">{{$areas['nome']}}</option>
						@empty
						<option></option>
						@endforelse
					</select>
				</div>

				<div class="col-xs-12 col-md-4">
					<select name="coautores" id="coautores"  class="form-control">
						@for($i = 0; $i < $maxAutores; $i++)
							@if($i == 0)
								<option value="{{$i}}">Não possui Coautores</option>
							@elseif($i == 1)
								<option value="{{$i}}">{{$i}} Coautor</option>
							@else
								<option value="{{$i}}">{{$i}} Coautores</option>
							@endif
						@endfor
					</select>
				</div>

				
				<div id="coautoresdiv"></div>

				<div class="col-xs-12 col-md-12">
					<input type="submit" value="Cadastrar" class="form-control btn btn-info" >
				</div>
			</div>

		</form>
	</div>
</div>

<script type="text/javascript">
	
	criaFormCoautores();
	buscaCoautor();

</script>

@stop
<style type="text/css" media="screen">
	input{
		text-align: center;
	}
</style>

