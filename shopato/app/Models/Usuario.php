<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'sobrenome',
        'email',
        'senha',
        'cpf',
        'cep',
        'rua',
        'bairro',
        'cidade',
        'uf',
        'telefone',
        'anuncios',
        'criado_em'
    ];

    protected $hidden = [
        'senha',
    ];

    /**
     * Desabilita a verificação de remember_token (opcional).
     */
    public function getRememberTokenName()
    {
        return null;
    }
}
