<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_passwords', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('update_password');
            $table->string('delete_password');
            $table->string('approve_password');

        });
        // Now the table exists — insert the default record
        DB::table('master_passwords')->insert([
            'update_password' => '1111',
            'delete_password' => '2222',
            'approve_password' => '3333',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_passwords');
    }
}
