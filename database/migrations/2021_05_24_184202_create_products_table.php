<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->string('name', 200);
            $table->text('content')->nullable();
            $table->string('slug', 200);
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2, true)->default(0);
            $table->timestamps();
            //foreign key, id categories table
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
            //foreign key, id brands table
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->nullOnDelete();
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
