<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wil_kecamatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kabupaten_id')->unsigned();
            $table->string('kecamatan_kode');
            $table->string('kecamatan');
            $table->timestamps();
        });

        Artisan::call( 'db:seed', [
            '--class' => 'WKecSeeder',
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
        Schema::dropIfExists('wil_kecamatan');
    }
}
