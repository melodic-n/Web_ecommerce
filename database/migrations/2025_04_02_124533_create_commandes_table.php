<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status'); 
            $table->float('montant');
            $table->string('livraison_info'); 
            $table->json('cart_data')->nullable(); // Change to json type
            $table->foreignId('panier_id')->nullable()->constrained(); // Make panier_id nullable
            $table->timestamps();
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
