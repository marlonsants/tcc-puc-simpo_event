<?php $__env->startSection('conteudo'); ?>

<?php
use App\Model\Perguntas;
use App\Model\Documentos_tipos;

$tiposDeDocumentos = Documentos_tipos::GetTipos();
?>

<body class="body-cinza">

    <div class="row">
        <?php if( isset($errors) and count($errors) > 0 ): ?>
        <div class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-12">

            <?php if(isset($pessoa)): ?>
            <form action="<?php echo e(url('/editar/pessoa', $pessoa->id)); ?>" method="POST" id="form-cadastro" accept-charset="utf-8">
                <?php echo method_field('PUT'); ?>

                <?php else: ?>
                <form action="<?php echo e(url('/cadastrar/novo')); ?>"  method="POST" id="form-cadastro" method="POST" accept-charset="utf-8">
                    <?php endif; ?>
                    <!--Form-->
                    <?php echo csrf_field(); ?>


                    <div class="row">
                        <div class="panel panel-default panel-body borda-0px sombra"><!-- primeiro painel-->
                            <div class="row"><div class="col-md-12 legenda">Dados:</div></div>
                            <div id="msg"> 

                            </div>

                            <div class="row"><!--linha 1-->
                                <div class="col-md-3" >
                                    <label>Nome *</label>
                                    <input required type="text" name="nome" class="form-control" placeholder="nome" minlength="5" maxlength="75" value="<?php echo e(isset($pessoa->nome) ? $pessoa->nome : old('nome')); ?>">
                                </div>
                                <div class="col-md-3" >
                                    <label>Sobrenome *</label>
                                    <input required type="text" name="sobrenome" class="form-control" placeholder="Sobrenome" minlength="5" maxlength="75" value="<?php echo e(isset($pessoa->sobrenome) ? $pessoa->sobrenome : old('sobrenome')); ?>">
                                </div>
                                <div class="col-md-2" >
                                    <label>Nascimento *</label>
                                    <input required type="text" id="nascimento" name="nascimento" class="form-control" placeholder="Nascimento" value="<?php echo e(isset($pessoa->nascimento) ? $pessoa->nascimento : old('nascimento')); ?>">
                                </div>
                                <div class="col-md-2" >
                                    <label>Tipo de documento</label>
                                    <select name="tipo_doc" id="tipo_doc" class="form-control" placeholder="Tipo de documento" >
                                        <?php if( ( isset($pessoa->documento->tipo) && $pessoa->documento->tipo != null  )  ): ?>
                                            <option selected  value="<?php echo e(isset($pessoa->documento->tipo->id) ? $pessoa->documento->tipo->id : old('tipo_doc')); ?>">
                                                <?php echo e(isset($pessoa->documento->tipo->descricao) ? $pessoa->documento->tipo->descricao : old('tipo_doc')); ?>

                                            </option>
                                            <?php $__currentLoopData = $tiposDeDocumentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <?php if($tipo->id != $pessoa->documento->tipo->id): ?>
                                                    <option value="<?php echo e(isset($tipo->id) ? $tipo->id : old('tipo_doc')); ?>">
                                                        <?php echo e(isset($tipo->descricao) ? $tipo->descricao : old('tipo_doc')); ?>

                                                    </option> 
                                                <?php endif; ?>                                           
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php else: ?>
                                            <?php $__currentLoopData = $tiposDeDocumentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <option value="<?php echo e(isset($tipo->id) ? $tipo->id : old('tipo_doc')); ?>">
                                                    <?php echo e(isset($tipo->descricao) ? $tipo->descricao : old('tipo_doc')); ?>

                                                </option> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>    
                                        <?php endif; ?>

                                    </select>
                                </div>
                                <div class="col-md-2" >
                                    <label>Número do documento</label>
                                    <input required type="text" id="numero_doc" name="numero_doc" class="form-control" placeholder="Numero" value="<?php echo e(isset($pessoa->documento->numero) ? $pessoa->documento->numero : old('numero_doc')); ?>">
                                </div>
                               
                            </div>

                            <div class="row">
                                 <div class="col-md-2" >
                                    <label>Sexo *</label>
                                    <select name="sexo" class="form-control" placeholder="Sexo" >
                                        <option value="Masculino" >Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                        <?php if( ( isset($pessoa->sexo) && $pessoa->sexo != null  )||  old('sexo') != null ): ?>
                                        <option value="<?php echo e(isset($pessoa->sexo) ? $pessoa->sexo : old('sexo')); ?>" selected><?php echo e(isset($pessoa->sexo) ? $pessoa->sexo : old('sexo')); ?></option>}}
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label>Instituição de ensino *</label>
                                    <input required type="text" name="instituicao" class="form-control" placeholder="Instituição" maxlength="75" value="<?php echo e(isset($pessoa->instituicao) ? $pessoa->instituicao : old('instituicao')); ?>">
                                </div>
                                <div class="col-md-5" >
                                    <label>Formação acadêmica *</label>
                                   
                                    <select name="titulo" class="form-control" placeholder="Título" >
                                        <?php if( isset($pessoa) && (old('titulo') !== null || $pessoa->titulo !== null) ): ?> 
                                        <option value="<?php echo e(isset($pessoa->titulo) ? $pessoa->titulo : old('titulo')); ?>" selected><?php echo e(isset($pessoa->titulo) ? $pessoa->titulo : old('titulo')); ?></option>}}
                                            <?php if($pessoa->titulo != 'Doutor'): ?>
                                            <option value="Doutor">Doutor</option>
                                            <?php endif; ?>
                                            <?php if($pessoa->titulo != 'Mestre'): ?>
                                            <option value="Mestre">Mestre</option>
                                            <?php endif; ?>
                                            <?php if($pessoa->titulo != 'Estudante'): ?>
                                            <option value="Estudante de graduação">Estudante de graduação</option>
                                            <?php endif; ?>
                                            <?php if($pessoa->titulo != 'Estudante'): ?>
                                            <option value="Estudante de pós graduação" >Estudante de pós graduação</option>
                                            <?php endif; ?>
                                            <?php if($pessoa->titulo != 'Estudante'): ?>
                                            <option value="Bacharel" >Bacharel</option>
                                            <?php endif; ?>
                                            <?php if($pessoa->titulo != 'Estudante'): ?>
                                            <option value="Ensino médio" >Ensino médio</option>
                                            <?php endif; ?>
                                        <?php else: ?> 
                                        <option value="Doutor">Doutor</option>
                                        <option value="Mestre">Mestre</option>
                                        <option value="Estudante" selected="selected">Estudante de graduação</option>
                                        <option value="Estudante" >Estudante de pós graduação</option>
                                        <option value="Estudante" >Bacharel</option>
                                        <option value="Estudante" >Ensino médio</option>
                                        <?php endif; ?>
                                        
                                    </select>
                                </div>
                            </div>

                        </div><!-- segundo painel-->
                    </div>

                    <div class="row">
                        <div class="panel panel-default panel-body borda-0px sombra"><!-- primeiro painel-->
                            <div class="row"><div class="col-md-12 legenda">Endereço:</div></div>
                            
                            <div class="row"><!--linha 2-->
                                
                                <div class="col-md-4" >
                                    <label>Cidade *</label>
                                    <input required type="text" name="cidade" class="form-control" placeholder="Cidade" value="<?php echo e(isset($pessoa->cidade) ? $pessoa->cidade : old('cidade')); ?>">
                                </div>
                                <div class="col-md-4" >
                                    <label>Estado *</label>
                                    <select id="estado" name="estado" class="form-control"> 
                                        <?php if( old('estado') !== null): ?>)
                                        <option value="<?php echo e(isset($pessoa->estado) ? $pessoa->estado : old('estado')); ?>" selected><?php echo e(isset($pessoa->estado) ? $pessoa->estado : old('estado')); ?></option>}}
                                        <?php endif; ?>                               
                                        <option>AC</option>
                                        <option>AL</option> 
                                        <option>AP</option>
                                        <option>BA</option>            
                                        <option>AM</option> 
                                        <option>CE</option> 
                                        <option>DF</option> 
                                        <option>ES</option> 
                                        <option>GO</option> 
                                        <option>MA</option> 
                                        <option>MT</option> 
                                        <option>MS</option> 
                                        <option>MG</option> 
                                        <option>PA</option> 
                                        <option>PB</option> 
                                        <option>PR</option> 
                                        <option>PE</option> 
                                        <option>PI</option> 
                                        <option>RJ</option> 
                                        <option>RN</option> 
                                        <option>RS</option> 
                                        <option>RO</option> 
                                        <option>RR</option>
                                        <option>SC</option>
                                        <option selected>SP</option> 
                                        <option>SE</option> 
                                        <option>TO</option>
                                    </select>
                                </div>
                               
                                <div class="col-md-4" >
                                    <label>País *</label>
                                    <select id="pais" name="pais" class="form-control">
                                        <?php if( old('pais') !== null): ?>)
                                        <option value="<?php echo e(isset($pessoa->pais) ? $pessoa->pais : old('pais')); ?>" selected><?php echo e(isset($pessoa->pais) ? $pessoa->pais : old('pais')); ?></option>}}
                                        <?php endif; ?>    
                                        <option>Afeganistão</option>
                                        <option>África do Sul</option>
                                        <option>Akrotiri</option>
                                        <option>Albânia</option>
                                        <option>Alemanha</option>
                                        <option>Andorra</option>
                                        <option>Angola</option>
                                        <option>Anguila</option>
                                        <option>Antárctida</option>
                                        <option>Antígua e Barbuda</option>
                                        <option>Antilhas Neerlandesas</option>
                                        <option>Arábia Saudita</option>
                                        <option>Arctic Ocean</option>
                                        <option>Argélia</option>
                                        <option>Argentina</option>
                                        <option>Arménia</option>
                                        <option>Aruba</option>
                                        <option>Ashmore and Cartier Islands</option>
                                        <option>Atlantic Ocean</option>
                                        <option>Austrália</option>
                                        <option>Áustria</option>
                                        <option>Azerbaijão</option>
                                        <option>Baamas</option>
                                        <option>Bangladeche</option>
                                        <option>Barbados</option>
                                        <option>Barém</option>
                                        <option>Bélgica</option>
                                        <option>Belize</option>
                                        <option>Benim</option>
                                        <option>Bermudas</option>
                                        <option>Bielorrússia</option>
                                        <option>Birmânia</option>
                                        <option>Bolívia</option>
                                        <option>Bósnia e Herzegovina</option>
                                        <option>Botsuana</option>
                                        <option selected>Brasil</option>
                                        <option>Brunei</option>
                                        <option>Bulgária</option>
                                        <option>Burquina Faso</option>
                                        <option>Burúndi</option>
                                        <option>Butão</option>
                                        <option>Cabo Verde</option>
                                        <option>Camarões</option>
                                        <option>Camboja</option>
                                        <option>Canadá</option>
                                        <option>Catar</option>
                                        <option>Cazaquistão</option>
                                        <option>Chade</option>
                                        <option>Chile</option>
                                        <option>China</option>
                                        <option>Chipre</option>
                                        <option>Clipperton Island</option>
                                        <option>Colômbia</option>
                                        <option>Comores</option>
                                        <option>Congo-Brazzaville</option>
                                        <option>Congo-Kinshasa</option>
                                        <option>Coral Sea Islands</option>
                                        <option>Coreia do Norte</option>
                                        <option>Coreia do Sul</option>
                                        <option>Costa do Marfim</option>
                                        <option>Costa Rica</option>
                                        <option>Croácia</option>
                                        <option>Cuba</option>
                                        <option>Dhekelia</option>
                                        <option>Dinamarca</option>
                                        <option>Domínica</option>
                                        <option>Egipto</option>
                                        <option>Emiratos Árabes Unidos</option>
                                        <option>Equador</option>
                                        <option>Eritreia</option>
                                        <option>Eslováquia</option>
                                        <option>Eslovénia</option>
                                        <option>Espanha</option>
                                        <option>Estados Unidos</option>
                                        <option>Estónia</option>
                                        <option>Etiópia</option>
                                        <option>Faroé</option>
                                        <option>Fiji</option>
                                        <option>Filipinas</option>
                                        <option>Finlândia</option>
                                        <option>França</option>
                                        <option>Gabão</option>
                                        <option>Gâmbia</option>
                                        <option>Gana</option>
                                        <option>Gaza Strip</option>
                                        <option>Geórgia</option>
                                        <option>Geórgia do Sul e Sandwich do Sul</option>
                                        <option>Gibraltar</option>
                                        <option>Granada</option>
                                        <option>Grécia</option>
                                        <option>Gronelândia</option>
                                        <option>Guame</option>
                                        <option>Guatemala</option>
                                        <option>Guernsey</option>
                                        <option>Guiana</option>
                                        <option>Guiné</option>
                                        <option>Guiné Equatorial</option>
                                        <option>Guiné-Bissau</option>
                                        <option>Haiti</option>
                                        <option>Honduras</option>
                                        <option>Hong Kong</option>
                                        <option>Hungria</option>
                                        <option>Iémen</option>
                                        <option>Ilha Bouvet</option>
                                        <option>Ilha do Natal</option>
                                        <option>Ilha Norfolk</option>
                                        <option>Ilhas Caimão</option>
                                        <option>Ilhas Cook</option>
                                        <option>Ilhas dos Cocos</option>
                                        <option>Ilhas Falkland</option>
                                        <option>Ilhas Heard e McDonald</option>
                                        <option>Ilhas Marshall</option>
                                        <option>Ilhas Salomão</option>
                                        <option>Ilhas Turcas e Caicos</option>
                                        <option>Ilhas Virgens Americanas</option>
                                        <option>Ilhas Virgens Britânicas</option>
                                        <option>Índia</option>
                                        <option>Indian Ocean</option>
                                        <option>Indonésia</option>
                                        <option>Irão</option>
                                        <option>Iraque</option>
                                        <option>Irlanda</option>
                                        <option>Islândia</option>
                                        <option>Israel</option>
                                        <option>Itália</option>
                                        <option>Jamaica</option>
                                        <option>Jan Mayen</option>
                                        <option>Japão</option>
                                        <option>Jersey</option>
                                        <option>Jibuti</option>
                                        <option>Jordânia</option>
                                        <option>Kuwait</option>
                                        <option>Laos</option>
                                        <option>Lesoto</option>
                                        <option>Letónia</option>
                                        <option>Líbano</option>
                                        <option>Libéria</option>
                                        <option>Líbia</option>
                                        <option>Listenstaine</option>
                                        <option>Lituânia</option>
                                        <option>Luxemburgo</option>
                                        <option>Macau</option>
                                        <option>Macedónia</option>
                                        <option>Madagáscar</option>
                                        <option>Malásia</option>
                                        <option>Malávi</option>
                                        <option>Maldivas</option>
                                        <option>Mali</option>
                                        <option>Malta</option>
                                        <option>Man, Isle of</option>
                                        <option>Marianas do Norte</option>
                                        <option>Marrocos</option>
                                        <option>Maurícia</option>
                                        <option>Mauritânia</option>
                                        <option>Mayotte</option>
                                        <option>México</option>
                                        <option>Micronésia</option>
                                        <option>Moçambique</option>
                                        <option>Moldávia</option>
                                        <option>Mónaco</option>
                                        <option>Mongólia</option>
                                        <option>Monserrate</option>
                                        <option>Montenegro</option>
                                        <option>Mundo</option>
                                        <option>Namíbia</option>
                                        <option>Nauru</option>
                                        <option>Navassa Island</option>
                                        <option>Nepal</option>
                                        <option>Nicarágua</option>
                                        <option>Níger</option>
                                        <option>Nigéria</option>
                                        <option>Niue</option>
                                        <option>Noruega</option>
                                        <option>Nova Caledónia</option>
                                        <option>Nova Zelândia</option>
                                        <option>Omã</option>
                                        <option>Pacific Ocean</option>
                                        <option>Países Baixos</option>
                                        <option>Palau</option>
                                        <option>Panamá</option>
                                        <option>Papua-Nova Guiné</option>
                                        <option>Paquistão</option>
                                        <option>Paracel Islands</option>
                                        <option>Paraguai</option>
                                        <option>Peru</option>
                                        <option>Pitcairn</option>
                                        <option>Polinésia Francesa</option>
                                        <option>Polónia</option>
                                        <option>Porto Rico</option>
                                        <option>Portugal</option>
                                        <option>Quénia</option>
                                        <option>Quirguizistão</option>
                                        <option>Quiribáti</option>
                                        <option>Reino Unido</option>
                                        <option>República Centro-Africana</option>
                                        <option>República Checa</option>
                                        <option>República Dominicana</option>
                                        <option>Roménia</option>
                                        <option>Ruanda</option>
                                        <option>Rússia</option>
                                        <option>Salvador</option>
                                        <option>Samoa</option>
                                        <option>Samoa Americana</option>
                                        <option>Santa Helena</option>
                                        <option>Santa Lúcia</option>
                                        <option>São Cristóvão e Neves</option>
                                        <option>São Marinho</option>
                                        <option>São Pedro e Miquelon</option>
                                        <option>São Tomé e Príncipe</option>
                                        <option>São Vicente e Granadinas</option>
                                        <option>Sara Ocidental</option>
                                        <option>Seicheles</option>
                                        <option>Senegal</option>
                                        <option>Serra Leoa</option>
                                        <option>Sérvia</option>
                                        <option>Singapura</option>
                                        <option>Síria</option>
                                        <option>Somália</option>
                                        <option>Southern Ocean</option>
                                        <option>Spratly Islands</option>
                                        <option>Sri Lanca</option>
                                        <option>Suazilândia</option>
                                        <option>Sudão</option>
                                        <option>Suécia</option>
                                        <option>Suíça</option>
                                        <option>Suriname</option>
                                        <option>Svalbard e Jan Mayen</option>
                                        <option>Tailândia</option>
                                        <option>Taiwan</option>
                                        <option>Tajiquistão</option>
                                        <option>Tanzânia</option>
                                        <option>Território Britânico do Oceano Índico</option>
                                        <option>Territórios Austrais Franceses</option>
                                        <option>Timor Leste</option>
                                        <option>Togo</option>
                                        <option>Tokelau</option>
                                        <option>Tonga</option>
                                        <option>Trindade e Tobago</option>
                                        <option>Tunísia</option>
                                        <option>Turquemenistão</option>
                                        <option>Turquia</option>
                                        <option>Tuvalu</option>
                                        <option>Ucrânia</option>
                                        <option>Uganda</option>
                                        <option>União Europeia</option>
                                        <option>Uruguai</option>
                                        <option>Usbequistão</option>
                                        <option>Vanuatu</option>
                                        <option>Vaticano</option>
                                        <option>Venezuela</option>
                                        <option>Vietname</option>
                                        <option>Wake Island</option>
                                        <option>Wallis e Futuna</option>
                                        <option>West Bank</option>
                                        <option>Zâmbia</option>
                                        <option>Zimbabué</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /segundo painel-->
                    </div>

                    <div class="row">
                        <div class="panel panel-default panel-body borda-0px sombra"><!-- terceiro painel-->
                            <div class="row"><div class="col-md-12 legenda">Contato:</div></div>
                            <div class="row">
                                <div class="col-md-4" >
                                    <label>Telefone</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Telefone" value="<?php echo e(isset($pessoa->telefone) ? $pessoa->telefone : old('telefone')); ?>">
                                </div>
                                <div class="col-md-4" >
                                    <label>Celular</label>
                                    <input type="text" id="celular" name="celular" class="form-control" placeholder="Celular" value="<?php echo e(isset($pessoa->celular) ? $pessoa->celular : old('celular')); ?>">
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default panel-body borda-0px sombra"><!-- terceiro painel-->
                            <div class="row"><div class="col-md-12 legenda">Acesso:</div></div>
                            <div class="row">
                                <div class="col-md-6" >
                                    <label>E-mail *</label>
                                    <input required type="email" min="8" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo e(isset($pessoa->email) ? $pessoa->email : old('email')); ?>">
                                </div>
                                <?php if(isset($pessoa)): ?>
                                <?php else: ?> 
                                <div class="col-md-3" >
                                    <label>Senha *</label>
                                    <input required type="password" name="senha" id="senha" class="form-control" placeholder="Senha" >
                                </div>
                                <div class="col-md-3" >
                                    <label>Confirmar senha *</label>
                                    <input required type="password" name="confirmarsenha" id="confirmarsenha" class="form-control" placeholder="Confirmar Senha">
                                </div>
                                <?php endif; ?>
                            </div><br>
                               <!--  <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <a href="javascript:window.history.go(-1)" class="col-xs-12 col-md-3 col-md-offset-2 btn btn-warning margin-top-10 borda-0px" value="Voltar">Voltar</a>
                                        <input required type="button" onclick="submitForm()" name="cadastrar" value="Salvar" class="col-xs-12  col-md-3 col-md-offset-2 btn btn-primary margin-top-10 borda-0px">
                                    </div>
                                </div> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default panel-body borda-0px sombra"><!-- terceiro painel-->
                            <div class="row"><div class="col-md-12 legenda">Pergunta de Segurança:</div></div>
                            <div class="row">
                                <div class="col-md-6" >
                                <?php $perguntas = Perguntas::getPerguntas(); ?>
                                    <select name="pergunta_id" class="form-control" >
                                       <?php foreach ($perguntas as $pergunta): ?>
                                           <option value="<?php echo e($pergunta->id); ?>"><?php echo e($pergunta->pergunta); ?></option>}
                                       <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6" >
                                <input type="text" name="resposta_seguranca" value="<?php echo e(isset($pessoa->resposta_seguranca) ? $pessoa->resposta_seguranca : old('resposta_seguranca')); ?>"  class="form-control" placeholder="Resposta de Segurança">
                                </div>
                               
                            </div><br>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <a href="javascript:window.history.go(-1)" class="col-xs-12 col-md-3 col-md-offset-2 btn btn-warning margin-top-10 borda-0px" value="Voltar">Voltar</a>
                                    <input required type="submit" name="cadastrar" value="Salvar" class="col-xs-12  col-md-3 col-md-offset-2 btn btn-primary margin-top-10 borda-0px">
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>

        <script required type="text/javascript">
            verificaCPFCadastrado();
            verificaEmailCadastrado();

            $('#confirmarsenha').on('blur', function(){ 
                if( $("#senha").val() != $("#confirmarsenha").val()){

                    $("#confirmarsenha").val('');
                    $("#confirmarsenha").attr('placeholder',' Atenção Senha diferente, verifique !');
                    
                }
            });    
            
        </script>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('site.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>