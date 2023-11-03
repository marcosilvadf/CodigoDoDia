<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Criadores extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario_id', 'imagem', 'titulo', 'descricao', 'slug', 'html'
    ];

    public function usuario()
    {        
		return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }

    public function dataFormatadaUsuario()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function siglaNome()
    {
        $dados = [
            'js' => 'javascript',
            'java' => 'java',
            'php' => 'php',
        ];

        return $dados[$this->linguagem];
    }
}
