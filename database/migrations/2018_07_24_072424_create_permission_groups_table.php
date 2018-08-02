<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('order')->default(1);
            $table->boolean('is_visible')->default(1);
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
        Schema::dropIfExists('permission_groups');

        Schema::table('permissions', function (Blueprint $table) {
            /*$table->dropColumn('permission_group_id');*/
            /*$table->dropColumn('is_visible');*/
        });

        Schema::table('roles', function (Blueprint $table) {
            /*$table->dropColumn('is_visible');*/
        });
    }
}
