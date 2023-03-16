<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilKabupatenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wil_kabupaten', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kabupaten_kode');
            $table->string('kabupaten');
            $table->timestamps();
        });

        Artisan::call( 'db:seed', [
            '--class' => 'WKabSeeder',
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
        Schema::dropIfExists('wil_kabupaten');
    }
}
