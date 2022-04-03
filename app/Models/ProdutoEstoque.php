<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $produto_id
 * @property int $quantidade
 * @property Produto $produto
 */
class ProdutoEstoque extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'produto_estoque';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['produto_id', 'quantidade'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
}
