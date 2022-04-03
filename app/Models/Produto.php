<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $nome
 * @property string $sku
 * @property ProdutoEstoque $produtoEstoque
 */
class Produto extends Model
{
    use SoftDeletes;
    // use Au
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'produto';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'sku'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estoque()
    {
        return $this->hasOne('App\Models\ProdutoEstoque');
    }
}
