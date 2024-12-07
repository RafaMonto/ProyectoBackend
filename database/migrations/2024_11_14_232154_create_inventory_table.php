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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name_product', 50);
            $table->integer('quantity');
            $table->integer('purchase_price');
            $table->foreignId('supplier_id');

            $table->foreign('supplier_id')
                ->references('id')
                ->on('supplier')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
