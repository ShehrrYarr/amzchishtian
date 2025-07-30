<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_restrictions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->time('start_time'); // e.g., 09:00
            $table->time('end_time');   // e.g., 17:00
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_restrictions');
    }
}
