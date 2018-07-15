<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Blogs', function (Blueprint $table) {
            $table->string('seo_title')->after('short')->nullable();
            $table->string('seo_keywords')->after('seo_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Blogs', function (Blueprint $table) {
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_keywords');
        });
    }
}
