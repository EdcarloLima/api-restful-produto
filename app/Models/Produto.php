<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table      = 'produto';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    /**
     * Colunas permitidas para inserção em massa (Request)
     * @var array $fillable
     */
    protected $fillable = [
        'descricao', 'preco', 'quantidade', 'marca'
    ];

}
