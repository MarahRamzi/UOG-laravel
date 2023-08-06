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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->foreignId('item_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->foreignId('inventory_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->integer('quantity');
            $table->primary(['item_id' , 'inventory_id']);
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
