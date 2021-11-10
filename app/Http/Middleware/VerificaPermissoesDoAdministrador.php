<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Adm_permissoes;

class VerificaPermissoesDoAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        // caso o administrador seja master não verifica as permissões
        if(session('acesso_id') == 4){
            return $next($request);
        }else{
            $permissoes = Adm_permissoes::buscaPermissoes(session('id'));
        } 

        if(
            $request->is('administrador/autores/listar')|| $request->is('administrador/trabalhos/listar')||
            $request->is('administrador/avaliadores/listar') || $request->is('administrador/avaliadores/atribuir') || $request->is('administrador/avaliadores/progresso')|| $request->is('administrador/cadastros_basicos/categorias') || $request->is('administrador/cadastros_basicos/areas') || $request->is('administrador/cadastros_basicos/criterios') || $request->is('administrador/analise/completa') || $request->is('administrador/analise/geografica') || $request->is('administrador/analise/total_trabalhos') || $request->is('administrador/analise/total_reprovados') || $request->is('analise/total_pendentes') ||$request->is('administrador/pre_avaliar')
        ){

            if($request->is('administrador/autores/listar') ){
                if(in_array(1, $permissoes)){
                    return $next($request);
                }else{
                    return redirect()->back();
                }
            }

            if($request->is('administrador/trabalhos/listar') ){
                if(in_array(2, $permissoes)){
                    return $next($request);
                }else{
                    return redirect()->back();
                }
            }

            if($request->is('administrador/avaliadores/listar') || $request->is('administrador/avaliadores/atribuir') || $request->is('administrador/avaliadores/progresso') ){
                if(in_array(3, $permissoes)){
                    return $next($request);
                }else{
                    return redirect()->back();
                }
            }

            if($request->is('administrador/cadastros_basicos/categorias') || $request->is('administrador/cadastros_basicos/areas') || $request->is('administrador/cadastros_basicos/criterios') ){
                if(in_array(4, $permissoes)){
                    return $next($request);
                }else{
                    return redirect()->back();
                }
            }

            if($request->is('administrador/analise/completa') || $request->is('administrador/analise/geografica') || $request->is('administrador/analise/total_trabalhos') || $request->is('administrador/analise/total_reprovados') || $request->is('analise/total_pendentes') ){

                return $next($request);

            }

            if( $request->is('administrador/pre_avaliar') ){
                if(in_array(6, $permissoes)){
                    return $next($request);
                }else{
                   return redirect()->back();
               }
           }


       }else{
         return $next($request);
     }
       // fim do if


 }
}
