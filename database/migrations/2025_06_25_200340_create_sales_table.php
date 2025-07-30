<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors');
        $table->string('customer_name')->nullable();
        $table->string('customer_mobile', 20)->nullable();
        $table->dateTime('sale_date');
        $table->decimal('total_amount', 12, 2)->default(0);
        $table->decimal('discount_amount', 12, 2)->default(0);
        $table->foreignId('user_id')->constrained('users');
        $table->string('status')->default('pending');
        $table->timestamp('approved_at')->nullable();
        $table->foreignId('approved_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
