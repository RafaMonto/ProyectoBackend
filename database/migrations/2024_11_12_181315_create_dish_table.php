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
        Schema::create('dish', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 50)->unique(); //nombre
            $table->string('description', length: 200); 
            $table->float('precio'); 
            $table->boolean('availability');
            $table->foreingId('category_id');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish');
    }
};
