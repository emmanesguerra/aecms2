<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('contact_person');
            $table->string('telephone', 15)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('marker', 255);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
        
        Schema::create('office_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offices_id');
            $table->string('day', 20);
            $table->string('start', 20);
            $table->string('end', 20);
            
            $table->foreign('offices_id')->references('id')->on('offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_hours');
        Schema::dropIfExists('offices');
    }
}
