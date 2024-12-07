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
        Schema::create('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger("order_id")->nullable();

            $table->id();
            $table->string("ean")->nullable();
            $table->string("product_code");
            $table->string("dog_breed");
            $table->boolean("with_name");
            $table->string("name")->nullable();
            $table->decimal('price', 9, 2)->nullable();
            $table->integer("quantity");
            $table->timestamps();

            $table->foreign("order_id")->references("id")->on("orders")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
