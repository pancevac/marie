<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('brand_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug');
            $table->text('short')->nullable();
            $table->text('content')->nullable();
            $table->string('link');
            $table->integer('gender')->default(0);
            $table->string('image')->nullable();
            $table->float('price')->default(0);
            $table->float('outlet_price')->default(0);
            $table->timestamp('published_at');
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
        Schema::dropIfExists('products');
    }
}
