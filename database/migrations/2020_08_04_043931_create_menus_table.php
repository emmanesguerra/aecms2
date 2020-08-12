<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title', '50')->nullable();
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('page_id')->nullable();
            $table->unsignedInteger('lft');
            $table->unsignedInteger('rgt');
            $table->unsignedInteger('lvl');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            
            $table->unique(['title', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
