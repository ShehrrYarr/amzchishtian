<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoryBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessory_batches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('accessory_id')->constrained();
$table->foreignId('vendor_id')->constrained();
$table->integer('qty_purchased');
$table->integer('qty_remaining');
$table->decimal('purchase_price', 12, 2);
$table->decimal('selling_price', 12, 2)->nullable();
$table->string('barcode')->unique();
$table->date('purchase_date');
$table->string('description')->nullable();

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
        Schema::dropIfExists('accessory_batches');
    }
}
