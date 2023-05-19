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
        Schema::create('prices', function (Blueprint $table) {
            $table->uuid('guid')->primary();
            // $price->price семантически выглядит хуже чем $price->value
            $table->unsignedDecimal('value', 10, 2)->default(1);
            $table->uuid('product_guid')->notNullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_guid')->references('guid')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
