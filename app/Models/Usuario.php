<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'nome', 'foto', 'email', 'senha', 'tipo'
    ];

    public function dicas()
    {
		  return $this->hasMany(Dicas::class, 'usuario_id', 'id');
    }
}