<?php

namespace App\Http\Controllers\usuarios;

use App\Mail\registerMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Model\Pessoa;
use App\Model\Eventos_acesso_id;
use App\Model\Adm_evento;
use App\Model\Perguntas;
use App\Model\Documentos_pessoas;


class PessoasController extends Controller
{

    private $pessoa;
    private $eventos_acesso_id;
    private $adm_evento;

    public function __construct(Pessoa $pessoa, Eventos_acesso_id $eventos_acesso_id, adm_evento $adm_evento)
    {
        $this->pessoa = $pessoa;
        $this->eventos_acesso_id = $eventos_acesso_id;
        $this->adm_evento = $adm_evento;
    }

    public function novaSenha()
    {
        $perguntas = Perguntas::getPerguntas();
        return view('/site/nova_senha', compact('perguntas'));
    }


    public function getPerguntaEmail(Request $request)
    {
        $perguntas = $this->pessoa->getPerguntaEmail($request->email);
        return $perguntas;
    }

    public function alteraSenha(Request $request)
    {

        $select = $this->pessoa
            ->where('email', $request->usuario)
            //->where('cpf', $request->CPF)
            //->where('rg', $request->rg)
            ->where('resposta_seguranca', $request->resposta)
            ->select('senha')
            ->get();
        if (!empty($select[0])) {

            if ($select[0]->senha != md5($request->senha)) {
                $update = DB::table('pessoas')
                    ->where('email', $request->usuario)
                   // ->where('cpf', $request->CPF)
                   // ->where('rg', $request->rg)
                    ->where('resposta_seguranca', $request->resposta)
                    ->update(array(
                        'senha' => md5($request->senha)
                    ));
                return redirect("/login/$update");

            } else {
                return redirect("/login/3");
            }
        } else {
            return redirect("/login/4");
        }
    }

    //Função para cadastro de Pessoas
    public function cadastrar(Request $request)
    {

        $pessoa = $request->except(['_token', 'confirmarSenha', 'cadastrar']); //Request dados do Formulário

        $pessoa['senha'] = md5($pessoa['senha']); //Criptografar Senha
        $pessoa['status'] = 'A'; //Ativo

        // Mail::to($pessoa['email'])->send(new registerMail($pessoa));

        $insert = $this->pessoa->create($pessoa); //Salvar dados no Banco

        if ($insert) {
            //cria um array com as informãções do documento e insere no banco de dados
            $doc = array('numero' => $pessoa['numero_doc'], 'tipo_documento_id' => $pessoa['tipo_doc'], 'pessoa_id' => $insert->id);
            Documentos_pessoas::SetDocumento($doc);

            return redirect('/login/5');
        } else {
            return redirect()->back()->withInput($request->except('_token'));
        }
    }

    public function editar()
    {
        $pessoa = $this->pessoa->find(session('id'));
        // echo '<pre>'; 
        // echo var_dump($pessoa);
        // echo var_dump(session('id'));
        // echo '</pre>';
        return view('.site.cadastrar', compact('pessoa'));
    }

    public function editarPessoa(Request $request, $id)
    {
        $dados = $request->all();
        $pessoa = $this->pessoa->find($id);
        $update = $pessoa->update($dados);
        
        $doc = array('numero' => $dados['numero_doc'], 'tipo_documento_id' => $dados['tipo_doc']);
        if (isset($pessoa) && count($pessoa->documento()->get()) > 0) {
            
            DB::table('documentos_pessoas')
            ->where('pessoa_id', $id)
            ->update($doc);
        } else {
           $doc['pessoa_id'] =  $id;
           Documentos_pessoas::SetDocumento($doc);
        }
        
        $acesso = Eventos_acesso_id::getAcessoNoEvento(session('id'), session('evento_id'));
        $acesso = $acesso[0]->acesso_id;
        
        if ($acesso != null) {

            session()->put('pessoa_nome', $dados['nome']);
            if ($acesso == 1) {
                return redirect('/autor/trabalhos/listar');
            } elseif ($acesso == 2) {
                return redirect('/avaliador/trabalhos');
            } elseif ($acesso == 3) {
                return redirect('/administrador/analise/completa');
            } elseif ($acesso == 4) {
                return redirect('/administrador/analise/completa');
            }

        } else {
            return redirect()->back();
        }
    }


    public function verificaDocumentoCadastrado($numero_doc)
    {

        $result = Documentos_pessoas::
        where('numero', '=', $numero_doc)
            ->get();
        return Response::json($result);

    }

    public function verificaEmailCadastrado($email)
    {
        $result = $this->pessoa
            ->where('email', $email)
            ->get();

        return Response::json($result);
    }


    // busca as informações de um usuario na tabela pessoas
    public function buscaPessoa($id)
    {


        $pessoa = $this->pessoa->select('pessoas.id', 'nome','sobrenome', 'email', 'instituicao', 'titulo', 'cidade', 'estado', 'pais', 'celular', 'telefone', 'dt.descricao', 'doc.numero')
            ->join('documentos_pessoas as doc', 'doc.pessoa_id', 'pessoas.id')
            ->join('documentos_tipos as dt', 'doc.tipo_documento_id', 'dt.id')
            ->where('pessoas.id', $id)->get();

        if ($pessoa) {
            return response::json($pessoa);
        } else {
            return response::json('erro');

        }


    }

    public function confirmar($email)
    {
        $update = DB::table('pessoas')
            ->where('email', $email)
            ->update(array(
                'confirmado' => 1
            ));
        if ($update) {
            return redirect("/login/6");
        } else {
            return redirect("/login/7");
        }
        return redirect('/login');
    }
}

