<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProdutoEstoqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produto_estoque', function (Blueprint $table) {
            $table->foreign(['produto_id'], 'produto_estoque_fk')->references(['id'])->on('produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produto_estoque', function (Blueprint $table) {
            $table->dropForeign('produto_estoque_fk');
        });
    }
}
