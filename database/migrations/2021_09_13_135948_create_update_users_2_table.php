<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateUsers2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullalbe()->change();
            $table->string('social_id')->nullable();
            $table->string('type_social')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   
}
