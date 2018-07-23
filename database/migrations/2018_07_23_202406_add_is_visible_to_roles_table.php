<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsVisibleToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('is_visible')->after('guard_name')->default(1);
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->string('is_visible')->after('guard_name')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('is_visible');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('is_visible');
        });
    }
}
