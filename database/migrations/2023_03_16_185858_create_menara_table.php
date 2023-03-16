<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menara', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('desa_id')->unsigned()->nullable();
            $table->integer('users_id')->unsigned()->nullable();
            $table->string('menara_kode')->unique();
            $table->string('provider');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('alamat')->nullable();
            $table->double('tinggi_menara', 5, 2);
            $table->double('tinggi_tumpuan', 5, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('is_valid')->default(0);
            $table->boolean('is_rekom')->default(0);
            $table->boolean('is_imb')->default(0);
            $table->string('url_photo')->nullable();
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
        Schema::dropIfExists('menara');
    }
}
