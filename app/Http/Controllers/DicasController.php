<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Dicas;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Dicas::all();
        
        return view('Dicas.index')
        ->with('titulo', 'Dicas e Tutoriais')
        ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dicas.form')
        ->with('titulo', 'Cadastrar Novo')
        ->with('customizar', true)
        ->with('edit', false);
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
            $slug = Str::slug($request->titulo, '-');
            
            $usuarioId = Session::get('usuario')->id;
            $post = Dicas::where('slug', $slug)->first();
            
            if ($post)
            {
                $slug = $slug.'-'.uniqid();
            }

            $data = [
                'usuario_id' => $usuarioId,
                'titulo' => $request->titulo,
                'descricao' => $request->desc,
                'slug' => $slug,
                'html' => $request->cod,
                'linguagem' => $request->linguagem
            ];

            Dicas::create($data);
            DB::commit();
            return redirect()->route('dicas.lista');
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $post = Dicas::where('slug', $slug);
        $post = $post->first();
        
        if(!$post)
        {
            $erroDados = [
            'mensagem' => 'Postagem do tipo dica não foi encontrada',
            'id_dica' => session()->get('epId'),
            ];

            Log::error('Erro:', $erroDados);
            Session::flash('erro', ['codigo' => '2100004', 'mostrar' => true]);
            return redirect()->route('dicas.principal');
        }

        return view('Dicas.ver')
        ->with('titulo', 'Ver postagem')
        ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (session()->get('epId') == NULL) {
            return redirect()->back();
        }

        $post = Dicas::find(session()->get('epId'));
        
        if(!$post)
        {
            $erroDados = [
            'mensagem' => 'Postagem do tipo dica não foi encontrada',
            'id_dica' => session()->get('epId'),
            ];

            Log::error('Erro:', $erroDados);
            Session::flash('erro', ['codigo' => '2100004', 'mostrar' => true]);
            return redirect()->back();
        }

        return view('Dicas.form')
        ->with('titulo', 'Editar dica')
        ->with('customizar', true)
        ->with('post', $post)
        ->with('edit', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'titulo' => $request->titulo,
                'descricao' => $request->desc,
                'html' => $request->cod,
                'linguagem' => $request->linguagem
            ];
    
            $post = Dicas::find($request->dica_id);
            
            if(!$post)
            {
                throw new Exception("Post não encontrado", 2100004);
            }
            $post->update($data);

            DB::commit();
            return redirect()->route('dicas.lista');
        } catch (Exception $e) {
            DB::rollBack();
            
            $erroDados = [
                'mensagem' => $e->getMessage(),
                'codigo' => $e->getCode(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
                'id_post' => $request->dica_id
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
        if (session()->get('epId') == NULL) {
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            $post = Dicas::find(session()->get('dpId'));

            if(!$post)
            {
                throw new Exception("Post não encontrado", 2100004);
            }

            $post->delete();
            DB::commit();
            return redirect()->route('dicas.lista');
        } catch (Exception $e) {
            DB::rollBack();
            
            $erroDados = [
                'mensagem' => $e->getMessage(),
                'codigo' => $e->getCode(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
                'id_post' => session()->get('epId')
            ];
            Session::flash('erro', ['codigo' => $e->getCode(), 'mostrar' => true]);
            Log::error('Erro:', $erroDados);
            return redirect()->back();            
        }
    }

    /**
     * Salva id do produto na sessoin com jquery
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function salvarIdSession(Request $request)
    {
        try {
            if($request->acao == 1)
            {
                session()->put('vpId', $request->id);
            }

            if($request->acao == 2)
            {
                session()->put('epId', $request->id);
            }

            if($request->acao == 3)
            {
                session()->put('dpId', $request->id);
            }
        } catch (Exception $e) {
            $erroDados = [
                'mensagem' => $e->getMessage(),
                'codigo' => $e->getCode(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine()
            ];

            Log::error('Erro:', $erroDados);
            return response()->json(['res' => false, 'codeErro' => $e->getCode(), 'mensagem' => $e->getMessage()]);            
        }
        return response()->json(['res' => true]);
    }
    /**
     * Mostra lista de dicas publicadas pelo usuário
     *
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        $usuarioId = Session::get('usuario')->id;
        $posts = Dicas::where('usuario_id', $usuarioId)->get();
        
        return view('Dicas.lista')
        ->with('titulo', 'Todas as dicas')
        ->with('customizar', false)
        ->with('posts', $posts);
    }
}
