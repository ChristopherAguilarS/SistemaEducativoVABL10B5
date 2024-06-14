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
        Schema::create('responsables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('tipo_responsable');
            $table->unsignedInteger('responsable_id')->nullable(); 
            $table->foreign('responsable_id')->references('id')->on('users');
            $table->unsignedInteger('responsables_id')->nullable(); 
            $table->foreign('responsables_id')->references('id')->on('areas');
            $table->boolean('estado');  
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsables');
    }
};
