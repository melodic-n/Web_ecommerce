<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanierProduitTable extends Migration
{
    public function up()
    {
        Schema::create('panier_produit', function (Blueprint $table) {
            $table->unsignedBigInteger('panier_id');
            $table->unsignedBigInteger('produit_id');
            $table->integer('quantite');
            
            // Définir la clé primaire composite
            $table->primary(['panier_id', 'produit_id']);
            
            // Définir les clés étrangères
            $table->foreign('panier_id')->references('id')->on('paniers')->onDelete('cascade');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('panier_produit');
    }
}
