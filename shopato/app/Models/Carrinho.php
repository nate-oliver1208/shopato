<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carrinho
 * 
 * @property int $id
 * @property int $id_usuario
 * @property int $id_anuncio
 * @property int|null $quantidade
 * @property Carbon|null $adicionado_em
 * 
 * @property Usuario $usuario
 * @property Anuncio $anuncio
 *
 * @package App\Models
 */
class Carrinho extends Model
{
	protected $table = 'carrinho';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_anuncio' => 'int',
		'quantidade' => 'int',
		'adicionado_em' => 'datetime'
	];

	protected $fillable = [
		'id_usuario',
		'id_anuncio',
		'quantidade',
		'adicionado_em'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function anuncio()
	{
		return $this->belongsTo(Anuncio::class, 'id_anuncio');
	}
}
