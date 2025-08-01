<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettyCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petty_cashes', function (Blueprint $table) {
               $table->id();
        $table->date('date')->nullable();
        $table->decimal('amount', 12, 2);
        $table->enum('type', ['in', 'out']); // 'in' for deposit, 'out' for expense
        $table->string('description')->nullable();
        $table->foreignId('user_id')->constrained('users');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petty_cashes');
    }
}
