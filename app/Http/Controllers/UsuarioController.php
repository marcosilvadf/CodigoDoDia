<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Usuario.form')
        ->with('titulo', 'Cadastrar')
        ->with('customizar', true)
        ->with('editar', false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $arquivo = $request->file('imagem');
            if (!$arquivo) {
                Session::flash('erro', ['codigo' => 'U03', 'mostrar' => true]);
                //return redirect()->back();
            }
            $path = $arquivo->store('public/image/perfil');
            $path = str_replace("public/", "storage/", $path);
            
            $senha = $request->senha;
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            $nome = $request->nome;
            $email = $request->email;
            $tipo =  0;

            $dados = [
                'nome' => $nome,
                'foto' => $path,
                'email' => $email,
                'senha' => $hash,
                'tipo' => $tipo
            ];
            $usuario = Usuario::create($dados);
            $this->criarSessionPerfil($usuario->id);
            DB::commit();
            return redirect()->route('usuario.perfil');
        } catch (Exception $e) {
            DB::rollBack();
            
            $erroDados = [
                'mensagem' => $e->getMessage(),
                'codigo' => $e->getCode(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine()
            ];
            Session::flash('erro', ['codigo' => $e->getCode(), 'mostrar' => true]);
            Log::error('Erro:', $erroDados);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        try {
            $usuarioId = Session::get('usuario')->id;
            $usuario = Usuario::find($usuarioId);

            return view('Usuario.form')
            ->with('titulo', 'Editar Usuário')
            ->with('customizar', true)
            ->with('usuario', $usuario)
            ->with('editar', true);
        } catch (Exception $e) {
            
            $erroDados = [
                'mensagem' => $e->getMessage(),
                'codigo' => $e->getCode(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine()
            ];
            Session::flash('erro', ['codigo' => $e->getCode(), 'mostrar' => true]);
            Log::error('Erro:', $erroDados);
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        $usuario = Usuario::find($request->id);

        try {
            $foto = null;
            if (!isset($request->imagem))
            {
                $path = $usuario->foto;
            }
            else
            {
                $foto = $usuario->foto;
                $arquivo = $request->file('imagem');
                $path = $arquivo->store('public/image/perfil');
                $path = str_replace("public/", "storage/", $path);
            }

            $data = [
                'nome' => $request->nome,
                'foto' => $path
            ];

            $usuario->update($data);

            if ($foto != null) {
                unlink($foto);
            }
            DB::commit();
            $this->removerSession();
            $this->criarSessionPerfil($usuario->id);
            return redirect()->route('usuario.perfil');
        } catch (Exception $e) {
            DB::rollBack();

            $erroDados = [
                'mensagem' => $e->getMessage(),
                'codigo' => $e->getCode(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine()
            ];
            Session::flash('erro', ['codigo' => $e->getCode(), 'mostrar' => true]);
            Log::error('Erro:', $erroDados);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $usuarioId = Session::get('usuario')->id;
        DB::beginTransaction();
        try {
            $usuario = Usuario::find($usuarioId);
            $usuario->dicas()->delete();
            $usuario->delete();
            unlink($usuario->foto);
            $this->deslogar();
            DB::commit();
            return redirect()->route('dicas.principal');
        } catch (Exception $e) {
            DB::rollBack();
            
            $erroDados = [
                'mensagem' => $e->getMessage(),
                'codigo' => $e->getCode(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine()
            ];
            Session::flash('erro', ['codigo' => $e->getCode(), 'mostrar' => true]);
            Log::error('Erro:', $erroDados);
            return redirect()->back();
        }
    }

    /**
     * Mostra form de login do usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('Usuario.login')
        ->with('titulo', 'Login')
        ->with('customizar', true);
    }

    /**
     * Busca o usuário no banco pelo email e senha
     *
     * @return \Illuminate\Http\Response
     */
    public function logif(Request $request)
    {
        $email = $request->email;
        $senha = $request->senha;
        
        $dados = [
            'email' => $email
        ];
        
        $usuario = Usuario::where($dados)->first();
        
        if ($usuario)
        {
            //método bcrypt para criptografia de senhas
            if (password_verify($senha, $usuario->senha)) {
                $this->criarSessionPerfil($usuario->id);
                return redirect()->route('usuario.perfil');
            } else {
                Session::flash('erro', ['codigo' => 'U02', 'mostrar' => true]);
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('erro', ['codigo' => 'U01', 'mostrar' => true]);
            return redirect()->back();
        }
    }

    /**
     * Retorna o perfil do usuário
     *
     * @return \Illuminate\Http\Response
     */
    public function perfil()
    {
        $usuario = Usuario::find(Session::get('usuario')->id);
        return view('Usuario.perfil')
        ->with('titulo', 'Perfil')
        ->with('usuario', $usuario)
        ->with('customizar', true);
    }

    /**
     * Cria a sessão com os dados de login do usuário
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function criarSessionPerfil($id)
    {
        $usuario = Usuario::find($id);
        Session::put('usuario', $usuario);
    }

    /**
     * Chama a função para encerrar o login
     *
     * @return \Illuminate\Http\Response
     */
    public function deslogar()
    {
        $this->removerSession();
        return redirect()->route('dicas.principal');
    }

    /**
     * Encerra a session do usuario logado
     *
     * @return \Illuminate\Http\Response
     */
    public function removerSession()
    {
        Session::forget('usuario');
    }

    /**
     * Mostra o form de recuperação de senha
     *
     * @return \Illuminate\Http\Response
     */
    public function recuperar()
    {
        return view('Usuario.recuperar')
        ->with('titulo', 'Recuperar Usuário')
        ->with('customizar', true);
    }

    /**
     * Altera a senha do usuário
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function mudarSenha(Request $request)
    {
        DB::beginTransaction();
        try {
            $usuario = Usuario::where('email', $request->email)->first();
            if (!$usuario) {
                Session::flash('erro', ['codigo' => 'U01', 'mostrar' => true]);
                throw new Exception("E-mail não encontrado!", 100);                
            }
            $hash = password_hash($request->senha, PASSWORD_DEFAULT);
            $usuario->update(['senha' => $hash]);
            $this->criarSessionPerfil($usuario->id);
            DB::commit();
            return redirect()->route('usuario.perfil');
        } catch (Exception $e) {
            DB::rollBack();

            if(Session::get('erro') == null)
            {
                $erroDados = [
                    'mensagem' => $e->getMessage(),
                    'codigo' => $e->getCode(),
                    'arquivo' => $e->getFile(),
                    'linha' => $e->getLine()
                ];
                Session::flash('erro', ['codigo' => $e->getCode(), 'mostrar' => true]);
                Log::error('Erro:', $erroDados);
            }
            
            return redirect()->back();
        }
    }
}
