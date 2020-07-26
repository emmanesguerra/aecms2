<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('firstname', 50)->after('id');
            $table->string('middlename', 50)->after('firstname');
            $table->string('lastname', 50)->after('middlename');
            $table->unsignedInteger('usertype_id')->after('password');
            $table->unsignedInteger('created_by')->after('remember_token');
            $table->unsignedInteger('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn('firstname');
            $table->dropColumn('middlename');
            $table->dropColumn('lastname');
            $table->dropColumn('usertype_id');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
