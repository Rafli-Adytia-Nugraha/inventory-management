<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('order_date');
            $table->date('delivery_date');
            $table->integer('total_amount');
            $table->uuid('supplier_id');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
