<?php

//###############################################################################################
// Serviços 

// captura os documentos da tabela de pessoas e insere na tabela documentos_pessoas
Route::resource('/services/insertDocumentos','Services\ServicesController@InsertDocumentos');//listar eventos
############################# //home ###############################################################
Route::get('/',function(){	return view('/site/login');}); //Página Inicial 
Route::get('/login','usuarios\LoginController@acessalogin'); //Pagina Login
Route::get('/login/{msg}','usuarios\LoginController@acessalogin'); //Pagina Login
Route::resource('/login/verificar','usuarios\LoginController@login');  //COntroller Login

Route::get('/social/login', 'usuarios\LoginController@redirectToProvider');
Route::get('/login/google/callback', 'usuarios\LoginController@handleProviderCallback');

Route::resource('/logout','usuarios\LoginController@logout');  //faz logout

Route::get('/termos', function(){ return view('/site/responsabilidade');}); //rota para o termo de reponsabilidade

Route::get('/anais/{evento_id}','eventos\ResultadosController@buscaAnais'); // lista anais
Route::get('/anais/{evento_id}/pdf/{trabalho_id}','eventos\ResultadosController@mostraAnais');

Route::get('/cadastrar',function(){	return view('/site/cadastrar'); });//Pagina Cdastro de novo usuário
Route::get('/cadastrar/{email}','usuarios\PessoasController@confirmar');//Controller
Route::resource('/cadastrar/novo','usuarios\PessoasController@cadastrar');//Controller Cadastrar
Route::put('/editar/pessoa/{id}','usuarios\PessoasController@editarPessoa');//Controller Editar
Route::post('/getPerguntaEmail', 'usuarios\PessoasController@getPerguntaEmail');
Route::get('/nova_senha', 'usuarios\PessoasController@novaSenha');
Route::get('/verifica/numero_doc/{numero_doc}', 'usuarios\PessoasController@verificaDocumentoCadastrado'); //Verificar se o documento Já foi cadastrado
Route::get('/verifica/email/{email}', 'usuarios\PessoasController@verificaEmailCadastrado'); //Verificar Email Já foi cadastrado
Route::post('/alterasenha', 'usuarios\PessoasController@alteraSenha');

//#####################	//Evento	########################################################

Route::resource('/eventos','eventos\EventosController@listarEventos');//listar eventos

Route::get('/escolher_evento/{id}','eventos\EventosController@acessarEvento');//listar eventos

Route::resource('/definir_acesso','eventos\AcessoController@getAcesso');//listar eventos
Route::resource('/termo_compromisso','eventos\AcessoController@getTermo');//listar eventos
Route::resource('/aceitar_termo','eventos\AcessoController@aceitarTermo');//atualizar evento_acesso_id para 1- aceito
Route::resource('/sistema','eventos\AcessoController@acessarSistema');//listar eventos
Route::resource('/resultado/evento','eventos\ResultadosController@buscaResultados');//listar eventos
Route::post('/Evento/uploadLogo','eventos\EventosController@uploadLogoDoEvento');

#########################################################################################################	

// ###################################################################################

Route::group(['prefix'=>'pessoa'],function(){


	Route::get('/editarperfil','usuarios\PessoasController@editar'); //editarPerfil

	//Master
	Route::get('/home',function(){
		return view('/usuarios/master/home');
	});
	Route::get('/',function(){
		return view('/usuarios/master/home');
	});

});
##########################################################################################


// ###################################################################################
//Administradores
Route::group(['middleware'=>'AcessoAdministrador','prefix'=>'administrador'],function(){

	Route::get('/cadastrar','usuarios\administrador\AdminController@viewCadastrar');

	Route::get('/editar/permissao','usuarios\administrador\AdminController@viewEditarPermissoes');

	Route::post('/editar/permissao','usuarios\administrador\AdminController@editarPermissoes');

	Route::post('/buscar/permissao','usuarios\administrador\AdminController@buscarPermissoes');
	
	Route::post('/cadastrar/novo', 'usuarios\administrador\AdminController@cadastrarAdm');

	Route::get('/editarperfil','usuarios\PessoasController@editar'); //editarPerfil

	Route::resource('/home', 'usuarios\administrador\AdmEventosController@listaEventos');
	Route::resource('/', 'usuarios\administrador\AdmEventosController@listaEventos');
	Route::resource('/escolherevento', 'usuarios\administrador\AdmEventosController@selecionaEvento');
	Route::get('/eventos/novo',function(){
		return view('/usuarios/administradores/criar_eventos');
	});
	Route::resource('/eventos/novo/cadastrar', 'eventos\EventosController@novoEvento');
	Route::put('/editar/evento/{id}', 'eventos\EventosController@editarEvento');
	Route::get('/editarEvento', 'eventos\EventosController@editar');
	Route::post('/cadastros_basicos/categorias/add','usuarios\administrador\CategoriasController@criaCategoria');
	Route::post('/cadastros_basicos/areas/add','usuarios\administrador\AreasController@criaArea');

	//Administradores-Autores

	// busca informações da pessoa pra mostrar no modal
	Route::get('/buscaPessoa/{id}', 'usuarios\PessoasController@buscaPessoa');

	Route::get('/trabalho/resumo/{id}', 'trabalhos\TrabalhosController@buscaResumo');

	// Aprovar o trabalho
	Route::get('/trabalho/aprovar/{trabalho_id}', 'trabalhos\TrabalhosController@aprovarTrabalho');

	// Reprovar o trabalho
	Route::get('/trabalho/reprovar/{trabalho_id}', 'trabalhos\TrabalhosController@reprovarTrabalho');

	Route::get('/buscaAutores/{trabalho_id}', 'trabalhos\TrabalhosController@buscaAutoresDoTrabalho');

	Route::get('/autores/listar','usuarios\administrador\AutorController@listaAutores');

	// busca todos trbalhos cadastrados sem restrições
	Route::get('/autores/buscaTrabalho/{id}/{view}','usuarios\trabalhos\TrabalhosController@buscaTrabalhos');

	Route::resource('/trabalhos/listar','trabalhos\TrabalhosController@buscaTrabalhos');

	Route::get('/autores/trabalhos/filtro/{[ativos]}','usuarios\trabalhos\TrabalhosController@filtrarTrabalhos');

	// busca os trabalhos do autor
	Route::get('/autores/trabalhos/{id}','trabalhos\TrabalhosController@listarTrabalhosDoAutor');	

	//Administradores-Avaliadores
	Route::get('/avaliadores/cadastrar',function(){
		return view('/usuarios/administradores/cadastrar_avaliador');
	});
	//fazer a aprovação ou reprovação do cadastro do avalidor
	Route::get('/avaliadores/check/{id}/{acao}','usuarios\administrador\AvaliadoresController@autenticaAvaliador');

	//listar todos os avalidores cadastrados
	Route::resource('/avaliadores/listar', 'usuarios\administrador\AvaliadoresController@listaAvaliadores');
	Route::get('/avaliadores/atribuir',function(){
		return view('/usuarios/administradores/atribuir_avaliadores');
	});
	Route::get('/avaliadores/getAvaliadoresExecetoAutores/{id}','usuarios\administrador\AvaliadoresController@GetAvaliadoresExcetoAutoresDoTrabalho');
	Route::get('/avaliadores/atribuir/atualizarPagina','trabalhos\AtribuicoesController@buscaTrabalhosAtribuirAvaliador');
	Route::get('/avaliadores/atribuir/buscaAvaliadorDoTrabalho/{id}','trabalhos\TrabalhosController@getAvaliadoresDoTrabalhoPeloId');
	Route::get('/avaliadores/progresso','usuarios\avaliadores\AvaliacoesController@progresso');
	Route::get('/cadastros_basicos/categorias','usuarios\administrador\CategoriasController@listaCategorias');
	Route::resource('/cadastros_basicos/categorias/delete','usuarios\administrador\CategoriasController@deletaCategorias');
	Route::resource('/cadastros_basicos/categorias/update','usuarios\administrador\CategoriasController@updateCategorias');
	Route::get('/cadastros_basicos/areas','usuarios\administrador\AreasController@listaAreas');
	Route::resource('/cadastros_basicos/areas/delete','usuarios\administrador\AreasController@deletaAreas');
	Route::resource('/cadastros_basicos/areas/update','usuarios\administrador\AreasController@updateAreas');
	Route::get('/cadastros_basicos/criterios','usuarios\administrador\CriteriosController@ViewCadastrarCriterios');
	Route::post('/cadastros_basicos/criterios/add','usuarios\administrador\CriteriosController@setCriterio');
	Route::resource('/cadastros_basicos/criterios/delete','usuarios\administrador\CriteriosController@deletarCriterios');
	Route::resource('/cadastros_basicos/criterios/update','usuarios\administrador\CriteriosController@updateCriterios');
	Route::get('/analise/completa','charts\GraficosController@graficoAnalitico');
	//rota que criei para testar a view pré-avaliar, nescessita mudanças
	Route::resource('/pre_avaliar','trabalhos\TrabalhosController@buscaTrabalhosPreAvaliacao');
	Route::post('/pre_avaliador/parecer','usuarios\administrador\Pre_avaliacaoController@inserirParecer');
	Route::post('/deletar/parecer','usuarios\administrador\Pre_avaliacaoController@deletarParecer');
	Route::resource('/pre_avaliar/visualizar','trabalhos\TrabalhosController@visualizarTrabalho');
	Route::post('/avaliadores/atribuir/add','trabalhos\AtribuicoesController@insereAtribuicao');
	Route::post('/avaliadores/atribuir/totalAtribuicoesAvaliador','trabalhos\AtribuicoesController@totalAtribuicoesAvaliador');
	Route::post('/avaliadores/atribuir/delete','trabalhos\AtribuicoesController@deleteAtribuicao');
	// solicitação de correção de traballho 
	Route::get('/trabalhos/correcao/{trabalho_id}','usuarios\administrador\Pre_avaliacaoController@solcitarCorrecao');
	Route::get('avalidores/atribuicoes','usuarios\administrador\AvaliadoresController@atribuicoesDosAvalidores');
	

});
Route::get('administrador/criterios/notas/{trabalho_id}','usuarios\administrador\CriteriosController@buscaNotas');


// ###################################################################################
//################################# Avaliadores ##########################################

Route::group(['middleware'=>'AcessoAvaliador', 'prefix'=>'avaliador'],function(){

	Route::get('/editarperfil/{id}','usuarios\PessoasController@editar'); //editarPerfil

	//Views da home Avaliadores
	Route::get('/home',function(){return view('/usuarios/avaliadores/home');});
	Route::get('/',function(){return view('/usuarios/avaliadores/home');});


	//View Regras e instruções
	Route::get('/regras/avaliadores',function(){return view('/usuarios/avaliadores/regras_avaliadores');});
	Route::get('/regras/download',function(){return view('/usuarios/avaliadores/regras_avaliador');});	;
	Route::get('/regras/autores',function(){return view('/usuarios/avaliadores/regras_autor');});
	Route::get('/trabalhos/direitos_autorais',function(){return view('/usuarios/avaliadores/direitos_autorais');});
	Route::get('/instrucoes',function(){return view('/usuarios/avaliadores/instrucoes');});


	//##############################################################################################
	//Trabalhos
	//Criar Trabalhos
	Route::get('/trabalhos/novo',function(){return view('/usuarios/avaliadores/novotrabalho');});
	//Exibir Trabalhos para correção
	Route::resource('/trabalhos','usuarios\avaliadores\AvaliadorController@listarTrabalhos');
	//Corrigir Trabalhos
	Route::get('/trabalhos/avaliar/{id}','usuarios\avaliadores\AvaliacoesController@ListarCriteriosAvaliador');

	//Dar Nota
	Route::resource('/criterio/nota','usuarios\avaliadores\NotasController@avaliarCriterio');

	Route::resource('/parecer','usuarios\avaliadores\ParecerController@inserirParecer');

	Route::post('/parecer/deletar','usuarios\avaliadores\ParecerController@deletarParecer');

	Route::post('/concluirAvaliacao','usuarios\avaliadores\AvaliacoesController@concluir');



	#####################################################################################################################



	Route::get('/',function(){
		return view('/usuarios/avaliadores/home');
	});

	Route::get('/instrucoes','usuarios\avaliadores\AvaliadorController@instrucoes');

	Route::resource('/artigos','usuarios\avaliadores\AvaliadorController@listarTrabalhos'); //avaliações

	Route::get('/regras/avaliadores',function(){
		return view('/usuarios/avaliadores/regras_avaliadores');
	});

	Route::get('/regras/download',function(){
		return view('/usuarios/avaliadores/regras_avaliador');
	});
	;
	Route::get('/regras/autores',function(){
		return view('/usuarios/avaliadores/regras_autor');
	});

	Route::get('/trabalhos/direitos_autorais',function(){
		return view('/usuarios/avaliadores/direitos_autorais');
	});

	Route::get('/trabalhos/novo',function(){
		return view('/usuarios/avaliadores/novotrabalho');
	});

});


// ###################################################################################

//#################		//Autores ######################################################

Route::group(['middleware'=>'AcessoAutor','prefix'=>'autor'],function(){


	Route::resource('/cadastrar/trabalho','trabalhos\TrabalhoBuilder@build');//Controller Cadastrar

	Route::get('/editarperfil/{id}','usuarios\PessoasController@editar'); //editarPerfil
	Route::get('/pegarcpfadministrador','usuarios\PessoasController@CPFAdministradores'); //editarPerfil

	Route::get('/trabalhos/coautor/{email}','usuarios\autores\AutorController@buscaCoautor');

	Route::resource('/trabalhos/novo','usuarios\autores\AutorController@submeterTrabalho');//Controller submeter trabalho

	Route::resource('/trabalhos/listar','usuarios\autores\AutorController@listarTrabalhos');

	Route::resource('/trabalhos/upload','trabalhos\UploadController@upload');//Controller fazer upload

	Route::resource('/trabalhos/delete','trabalhos\TrabalhosController@delete');
	Route::get('/trabalhos/editar/{trabalho_id}','trabalhos\TrabalhosController@Editar');
	Route::put('/trabalhos/editarTrabalho/{trabalho_id}','trabalhos\TrabalhosController@EditarTrabalho');

	Route::get('/home',function(){
		return view('/usuarios/autores/home');
	})->name('autor/home');

	Route::get('/',function(){
		return view('/usuarios/autores/home');
	});


	Route::get('/trabalhos/regras',function(){
		return view('/usuarios/autores/regras');
	});

	Route::get('/trabalhos/manual_submissao', function(){
		return view('/usuarios/autores/manual_submissao');
	});

	Route::get('/trabalhos/direitos_autorais',function(){
		return view('/usuarios/autores/direitos_autorais');
	});

	Route::get('/trabalhos/comprovantepdf',function(){
		return view('/usuarios/autores/comprovantepdf');
	});

	Route::resource('trabalhos/visualizarComprovante', 'trabalhos\ComprovanteController@visualizarComprovante');
	// faz update do tipo de acesso
	Route::post('/acesso/update','eventos\AcessoController@updateAcesso');//Controller visualizar trabalho

});

Route::get('autor/trabalhos/visualizar/{trabalho_id}','trabalhos\TrabalhosController@visualizarTrabalho');//Controller visualizar trabalho



// #####################################################<?php

