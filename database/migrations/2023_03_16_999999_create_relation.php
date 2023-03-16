<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->foreign('roles_id')->references('id')->on('roles');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('roles_id')->references('id')->on('roles');
        });

        Schema::table('wil_kecamatan', function (Blueprint $table) {
            $table->foreign('kabupaten_id')->references('id')->on('wil_kabupaten')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('wil_desa', function (Blueprint $table) {
            $table->foreign('kecamatan_id')->references('id')->on('wil_kecamatan')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('menara', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('category')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('desa_id')->references('id')->on('wil_desa')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('pengawasan', function (Blueprint $table) {
            $table->foreign('menara_id')->references('id')->on('menara')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 
    }
}
