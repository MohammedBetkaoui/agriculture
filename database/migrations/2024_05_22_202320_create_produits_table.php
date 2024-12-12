<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->text('photo1');
            $table->text('photo2');
            $table->text('photo3');
            $table->text('description');
            $table->decimal('prix');
            $table->string('type_vente')->default('normal');
            $table->dateTime('date_debut')->default(null);
            $table->dateTime('date_fin')->default(null);
            $table->integer('id_proprietaire');
            $table->integer('id_categorie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_produits');
    }
};
