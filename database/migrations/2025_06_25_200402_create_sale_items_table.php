<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');
        $table->foreignId('accessory_batch_id')->constrained('accessory_batches');
        $table->foreignId('accessory_id')->constrained('accessories');
        $table->integer('quantity');
        $table->decimal('price_per_unit', 12, 2);
        $table->decimal('subtotal', 12, 2);
        $table->foreignId('user_id')->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
}
