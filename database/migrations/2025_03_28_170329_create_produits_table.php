<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom_prod')->default('Nom non spécifié');
            $table->binary('img_prod')->nullable();  // Permet à img_prod d'accepter null
            $table->text('description');  // Description du produit
            $table->float('prix');        // Prix du produit
            $table->timestamps();         // Colonnes created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
