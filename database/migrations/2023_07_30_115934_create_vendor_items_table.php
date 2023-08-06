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
        Schema::create('vendor_items', function (Blueprint $table) {
            $table->foreignId('item_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->foreignId('vendor_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->integer('quantity');
            $table->primary(['item_id' , 'vendor_id']);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_items');
    }
};
