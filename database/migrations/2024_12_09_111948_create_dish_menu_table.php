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
        Schema::create('dish_menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id'); // Relación con menus
            $table->unsignedBigInteger('dish_id'); // Relación con dishes
            $table->timestamps();

            // Claves foráneas
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish_menu');
    }
};
