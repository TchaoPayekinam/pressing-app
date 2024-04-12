<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsCommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_commande', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('vetement_id');
            $table->foreign('commande_id')
                ->references('id')
                ->on('commandes')
                ->onDelete('CASCADE');
            $table->foreign('vetement_id')
                ->references('id')
                ->on('vetements')
                ->onDelete('CASCADE');
            $table->integer('nombre');
            $table->tinyInteger('laver')->default(0);
            $table->tinyInteger('repasser')->default(0);
            $table->tinyInteger('retoucher')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details_commande');
    }
}
