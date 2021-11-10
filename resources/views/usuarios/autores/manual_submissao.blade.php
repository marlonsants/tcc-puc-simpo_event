@extends('/usuarios/autores/header')

@section('conteudo')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="centralizar text-info">Manual de submissão dos trabalhos</h3><br>
			<ol>
				<h4><li>Para submeter um artigo no evento selecionado, basta clicar na opção <b>Trabalho</b> e depois em <b>Criar Novo</b>, nesta opção você deve inserir os dados referentes ao artigo:</h4>
					<ol>
						<li><b>Titulo do Artigo -</b> Deve possuir entre 100 a 300 caracteres contando espaços, letras, numeros e pulos de linha.</li>
						<li><b>Resumo do Artigo -</b> Deve possuir entre 1000 a 2500 caracteres contando espaços, letras, numeros e pulos de linha.</li>
						<li><b>Area -</b> Aqui você seleciona em qual area o artigo se enquadra.</li>
						<li><b>Categoria -</b> Se é um artigo de iniciação cientifica, resumo espandido ou artigo completo.</li>
						<li><b>Coautores -</b> Aqui é informado quantos couatores o trabalho possui e caso possua um ou mais coautores informar surgirá os campos para informar CPF de cada um deles.<br>(Lembrando que os couautores precisam estar tambem cadastrados em nosso sitema para que o cadastro seja valido)</li>
						<li><b>Botão Cadastrar -</b> Ao clicar nesse botão, caso todos os campos anteriores estejam preenchidos corretamente, o cadastro será concluido, mas o artigo em PDF deve ser enviado na tela 'Meus Artigos'.</li>
					</ol>
				</li><br>

				<h4><li>Para visualizar a situação dos trabalhos enviados para o evento selecionado, basta clicar na opção <b>Trabalho</b> e depois em <b>Meus Trabalhos</b>, nesta opção você verá uma tabela com as informações dos artigos que você enviou para o evento:</h4>
					<ol>
						<li><b>Titulo -</b> Titulos dos artigos enviados para o evento selecionado.</li>
						<li><b>Status -</b> Se o artigo foi aprovado, reprovado, se esta em avaliação ou se ainda não foi enviado.</li>
						<li><b>Ações -</b> Esse botões permitem realizar determinadas ações relacionadas ao documaneto e eles podem estar visiveis ou não dependo da situação de envio do artigo:
							<ul>
								<li><b>Enviar Arquivo <button class="btn btn-info"><span class="glyphicon glyphicon-save-file"/></button> -</b> Neste botão você ira o arquivo em formato PDF com o artigo.</li><br>
								<li><b>Excluir Trabalho <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"/></button> -</b> Irá excluir o trabalho selecionado.</li><br>
								<li><b>Enviar Trabalhos Corrigidos <button class="btn btn-warning subPdf"><span class="glyphicon glyphicon-pencil"/></button> -</b> Este botão serve para enviar um novo arquivo com a correção do anterior caso seja solicitado pelos organizadores do evento.</li><br>
								<li><b>Visualizar Artigo <button class="btn btn-success" ><span class="glyphicon glyphicon-eye-open"/></button> -</b> Permite visualizar o arquivo enviado e também baixar o mesmo.</li><br>
								<li><b>Parecer de Avaliação <button class="btn btn-primary"><span class="glyphicon glyphicon-plus"/></button> -</b> Permite visualizar o parecer do avaliador sobre o trabalho.</li><br>
							</ul>
						</li>
					</ol>
				</li>

			</ol><br>
		</div>
	</div>
</div>

@stop