<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_settings', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id')->primary();
            $table->string('main_ul_class', 100);
            $table->string('main_li_class', 100);
            $table->string('main_anch_class', 100);
            $table->string('suc_strt_div', 150)->nullable();
            $table->string('suc_end_div', 10)->nullable();
            $table->string('suc_strt_list', 150)->nullable();
            $table->string('suc_end_list', 10)->nullable();
            $table->string('suc_anch_class', 100)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_settings');
    }
}
