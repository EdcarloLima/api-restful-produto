<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /**
     * Colunas permitidas para inserção em massa (Request)
     * @var array $fillable
     */
    protected $fillable = ['descricao', 'preco', 'quantidade', 'marca', 'updated_at', 'created_at'];

}
