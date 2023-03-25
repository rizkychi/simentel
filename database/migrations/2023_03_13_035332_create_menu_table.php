<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu');
            $table->string('route')->nullable();
            $table->string('icon_type')->default('fas');
            $table->string('icon')->nullable();
            $table->string('level');
            $table->tinyInteger('roles_id');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        // Artisan::call( 'db:seed', [
        //     '--class' => 'MenuSeeder',
        //     '--force' => true 
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
