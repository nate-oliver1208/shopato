<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Anuncio
 * 
 * @property int $id
 * @property string $codigo
 * @property string $titulo
 * @property string $descricao
 * @property float $preco
 * @property string $situacao
 * @property string $anunciado_por
 * @property string $enviado_de
 * @property Carbon $criado_em
 * 
 * @property Collection|Carrinho[] $carrinhos
 *
 * @package App\Models
 */
class Anuncio extends Model
{
	protected $table = 'anuncios';
	public $timestamps = false;

	protected $casts = [
		'preco' => 'float',
		'criado_em' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'titulo',
		'descricao',
		'preco',
		'situacao',
		'anunciado_por',
		'enviado_de',
		'criado_em'
	];

	public function carrinhos()
	{
		return $this->hasMany(Carrinho::class, 'id_anuncio');
	}
}
