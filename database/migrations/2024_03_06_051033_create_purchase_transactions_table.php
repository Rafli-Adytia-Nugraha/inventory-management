<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('transaction_date');
            $table->integer('quantity_purchased');
            $table->decimal('unit_price');
            $table->decimal('total_price');
            $table->uuid('item_id');
            $table->uuid('order_id');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('inventory_items');
            $table->foreign('order_id')->references('id')->on('purchase_orders');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_transactions');
    }
};
