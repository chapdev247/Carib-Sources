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
            $table->boolean('type')->default(false);
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->text('image')->nullable();
            $table->text('thumb_image')->nullable();
            $table->integer('category_id');
            $table->integer('user');
            $table->integer('qty')->default(0);
            $table->string('price',30)->default('0');
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
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
