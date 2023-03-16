<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wil_desa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kecamatan_id')->unsigned();
            $table->string('desa_kode');
            $table->string('desa');
            $table->timestamps();
        });

        Artisan::call( 'db:seed', [
            '--class' => 'WDesaSeeder',
            '--force' => true 
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wil_desa');
    }
}
